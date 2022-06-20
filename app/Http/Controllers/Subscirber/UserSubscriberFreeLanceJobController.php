<?php

namespace App\Http\Controllers\Subscirber;

use Auth;
use DB;
use Validator;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Media;
use App\Models\ServiceProductVariation;
use App\Models\ServiceProfileInfo;
use App\Models\ServiceProfile;
use App\Models\OrderItem;
use App\Models\OrderWork;
use App\Models\Subscriber;
use App\Models\WorkStation;
use App\Models\JobWorkLink;
use App\Models\JobCategory;
use App\Models\ServiceProfileInfoValue;
use Illuminate\Http\Request;
use App\Models\OrderPayment;
use App\Models\AdminBalance;
use App\Models\Honorarium;
use App\Models\FreelancerJob;
use App\Models\JobSubcategory;
use App\Models\FreelanceJobWork;
use App\Models\BalanceTransaction;
use App\Models\SubscriberHonorarium;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ServiceProductCart;
use App\Models\ServiceProductImage;
use App\Models\ServiceProductOrder;
use App\Models\ServiceProfileProduct;
use App\Models\ServiceProfileProductWishlist;
use App\Models\ServiceProfileVisitor;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Intervention\Image\Facades\Image;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Size;
use App\Models\ServiceProfileWorker;


class UserSubscriberFreeLanceJobController extends Controller
{
    public function freelanceJobDetails(FreelancerJob $freelanceJob)
    {
        $request = request();
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }
        // menuSubmenu('job','job');

        $workDone = FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)
            ->where('status', 'pending')
            ->where('subscriber_id', $subscription->id)
            ->where('freelancer_job_id', $freelanceJob->id)
            ->first();


        $worklock = FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)
            ->where('status', 'locked')
            ->where('subscriber_id', $subscription->id)
            ->where('freelancer_job_id', $freelanceJob->id)
            ->first();

        return view('subscriber.job.freelanceJobDetails', [
            'subscription' => $subscription,
            'freelanceJob' => $freelanceJob,
            'workDone' => $workDone,
            'worklock' => $worklock
        ]);
    }

    public function freelanceWorkLock(FreelancerJob $freelanceJob)
    {

        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        if ($freelanceJob->status == 'completed') {
            return back()->with('info', 'Sorry, we could not accept your work because job works quota already filled-up. usfjc:78');
        }

        if ($freelanceJob->status == 'cancel') {
            return back()->with('info', 'Sorry, we could not accept your work because the job is cancelled. usfjc:83');
        }


        // if admin given workers completed
        if ($freelanceJob->admin_given_workers > 0) {
            if ($freelanceJob->admin_given_workers <= $freelanceJob->worksCountWithoutReject()) {
                $freelanceJob->admin_completed_status = 'completed';
                $freelanceJob->save();
                return back()->with('info', 'Sorry, we could not accept your lock request because job  quota already filled-up. usfjc:93');
            }
        }

        if ($freelanceJob->total_worker <= $freelanceJob->worksCountWithoutReject()) {

            if ($freelanceJob->lockedWorksCount()) {
                $freelanceJob->status = null;
            } else {
                $freelanceJob->status = 'completed';
            }
            $freelanceJob->save();

            return back()->with('info', 'Sorry, we could not accept your lock request because job works quota already filled-up. usfjc:112');
        }

        $oldWork = FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)
            ->where('subscriber_id', $subscription->id)
            ->where('status', '<>', 'locked')
            // ->where('status','pending')
            ->where('freelancer_job_id', $freelanceJob->id)
            ->first();
        if ($oldWork) {
            return back()->with('error', 'Sorry, You have already submitted your work. usfjc:122');
        }


        DB::table('freelance_job_works')->insert([
            'work_station_id' => $freelanceJob->work_station_id,
            'subscriber_id' => $subscription->id,
            'user_id' => $subscription->user_id,
            'freelancer_job_id' => $freelanceJob->id,
            'category_id' => $freelanceJob->category_id,
            'subcategory_id' => $freelanceJob->subcategory_id,
            'title' => $freelanceJob->title,
            'description' => $freelanceJob->description,
            'status' => 'locked',
            'distributed_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $freelanceJob->is_lock = true;
        $freelanceJob->save();

        // $work = new FreelanceJobWork;
        // $work->work_station_id = $freelanceJob->work_station_id;
        // $work->subscriber_id = $subscription->id;
        // $work->user_id = $subscription->user_id;
        // $work->freelancer_job_id = $freelanceJob->id;
        // $work->category_id = $freelanceJob->category_id;
        // $work->subcategory_id = $freelanceJob->subcategory_id;
        // $work->title = $freelanceJob->title;
        // $work->description = $freelanceJob->description;
        // // $work->require_details = $request->description;
        // $work->status = 'locked';

        // $work->distributed_at = null;
        // // dd($work);

        // $work->save();

        return back()->with('success', 'Successfully job is locked. Please submit the task within 15 minutes.');
    }

    public function freelanceWorkSubmit(FreelancerJob $freelanceJob)
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        // if($freelanceJob->status == 'completed')
        // {
        //     return back()->with('info', 'Sorry, we could not accept your work because job works quota already filled-up. usfjc:150');
        // }

        if ($freelanceJob->status == 'cancel') {
            return back()->with('info', 'Sorry, we could not accept your work because the job is cancelled. usfjc:155');
        }

        // // if admin given workers completed
        // if($freelanceJob->admin_given_workers > 0)
        // {
        //     if($freelanceJob->admin_given_workers <= $freelanceJob->worksCountWithoutReject())
        //     {
        //         $freelanceJob->admin_completed_status = 'completed';
        //         $freelanceJob->save();
        //         return back()->with('info', 'Sorry, we could not accept your work because job works quota already filled-up. usfjc:165');
        //     }
        // }


        // if there are 2 worker need when 1 worker submit job after locked another can not submit though he locked the job
        // if($freelanceJob->total_worker <= $freelanceJob->worksCountWithoutReject())
        // {
        //     if($freelanceJob->lockedWorksCount())
        //     {
        //       $freelanceJob->status = null;

        //     }
        //     else
        //     {
        //       $freelanceJob->status = 'completed';

        //     }

        //     $freelanceJob->save();

        //     return back()->with('info', 'Sorry, we could not accept your work because job works quota already filled-up.');
        // }


        $oldWork = FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)
            ->where('subscriber_id', $subscription->id)
            ->where('status', '<>', 'locked')
            ->where('freelancer_job_id', $freelanceJob->id)
            ->first();
        if ($oldWork) {
            return back()->with('error', 'Sorry, You have already submitted your work');
        }

        $lockedWork = FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)
            ->where('subscriber_id', $subscription->id)
            ->where('status', 'locked')
            ->where('freelancer_job_id', $freelanceJob->id)
            ->first();

        // dd($lockedWork);
        if ($work = $lockedWork) {
            $lnk = new JobWorkLink;
            $subcat = JobSubcategory::where('id', $freelanceJob->subcategory_id)->first();
            if ($subcat) {
                if ($subcat->work_link) {
                    if (!$request->work_link) {
                        return back()->with('info', 'Please, try again with work link');
                    } elseif ($request->work_link) {
                        // $link = $subscription->workLinks()->where('link', $request->work_link)->first();
                        $link = JobWorkLink::where('subscriber_id', $subscription->id)->where('link', $request->work_link)->first();
                        if ($link) {
                            return back()->with('info', 'Please, try again with correct link, Your provided link is already recorded.');
                        }
                    }
                }

                if ($subcat->screenshot == 2) {
                    if (!($request->image1 && $request->image2)) {
                        return back()->with('info', 'Please try again with two screenshots');
                    }
                } elseif ($subcat->screenshot == 1) {
                    if (!($request->image1 or $request->image2)) {
                        return back()->with('info', 'Please try again with a screenshot');
                    }
                }
            }

            // $work = new FreelanceJobWork;
            $work->work_station_id = $freelanceJob->work_station_id;
            $work->subscriber_id = $subscription->id;
            $work->user_id = $subscription->user_id;
            $work->freelancer_job_id = $freelanceJob->id;
            $work->category_id = $freelanceJob->category_id;
            $work->subcategory_id = $freelanceJob->subcategory_id;
            $work->title = $freelanceJob->title;
            $work->description = $freelanceJob->description;
      
            // $work->require_details = $request->description;
            $work->status = 'pending';
            $work->pending_at = now();
            $work->distributed_at = null;
            $work->save();

            $lnk->subscriber_id = $subscription->id;
            $lnk->work_id = $work->id;
            $lnk->link = $request->work_link;
            $lnk->save();
            
            $freelanceJob->is_lock = false;
            $freelanceJob->save();




            // if($freelanceJob->total_worker < $freelanceJob->worksCountWithoutReject())
            // {
            //     $freelanceJob->status = 'completed';
            //     $work->delete();
            //     return back()->with('info', 'Sorry, we could not accept your work because job works quota already filled-up. usfljc:283');
            // }



            $freelanceJob->work_done = $freelanceJob->worksCountWithoutReject();
            $freelanceJob->save();


            if ($cp = $request->image1) {
                $extension = strtolower($cp->getClientOriginalExtension());
                $randomFileName = $work->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

                list($width, $height) = getimagesize($cp);
                $mime = $cp->getClientOriginalExtension();
                $size = $cp->getSize();

                $originalName = strtolower($cp->getClientOriginalName());

                Storage::disk('public')->put('work/image/' . $randomFileName, File::get($cp));

                $work->img = $randomFileName;

                $work->save();
            }

            if ($cp2 = $request->image2) {
                $extension = strtolower($cp2->getClientOriginalExtension());
                $randomFileName = $work->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

                list($width, $height) = getimagesize($cp2);
                $mime = $cp2->getClientOriginalExtension();
                $size = $cp2->getSize();

                $originalName = strtolower($cp2->getClientOriginalName());

                Storage::disk('public')->put('work/image/' . $randomFileName, File::get($cp2));

                $work->img2 = $randomFileName;

                $work->save();
            }

            return back()->with('success', 'Your submission has been success.Please wait until reviewed. usfjc:328');
        }

        return back();
    }

    public function subscriptionSubmittedWork()
    {
        $request = request();
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        menuSubmenu('myjob', 'submittedWork');
        $works = FreelanceJobWork::where('status', 'pending')->paginate(15);
        return view('subscriber.job.submittedWork', [
            'subscription' => $subscription,
            'works' => $works
        ]);
    }

    public function subscriptionWorksList(FreelancerJob $freelanceJob)
    {
        $request = request();
        // dd($request->subscription);

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        $works = FreelanceJobWork::where('freelancer_job_id', $freelanceJob->id)
            ->where(function ($query) {
                $query->where('status', 'pending');
                $query->orWhere('status', 'locked');
            })
            // ->orWhere('status','locked')
            ->paginate(15);
        if ($freelanceJob->status != 'cancel') {
            return view('subscriber.job.submittedWork', [
                'subscription' => $subscription,
                'works' => $works,
                'freelanceJob' => $freelanceJob
            ]);
        } else {
            return back()->with('error', 'Someting went to wrong.');
        }
    }



    public function subscriptionEditJob(FreelancerJob $freelanceJob)
    {
        $request = request();

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }

        $categories = JobCategory::all();
        $subcategories = JobSubcategory::all();
        // dd($freelanceJob);
        if ($freelanceJob->status != 'cancel') {
            return view('subscriber.job.editJob', [
                'subscription' => $subscription,
                'freelanceJob' => $freelanceJob,
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
        }

        return back()->with('error', 'Someting went to wrong.');
    }

    public function subscriptionUpdateJobpost(FreelancerJob $job, Subscriber $subscription, WorkStation $worksation, Request $request)
    {
        // dd($request->all());
        // dd($freelanceJob);
        $validation = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255', 'min:4'],
                'description' => ['required', 'string', 'min:5'],
                'cost_per_worker' => ['required', 'numeric'],
                'total_worker' => ['required', 'numeric'],
            ]
        );


        if ($validation->fails()) {

            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $sc = JobSubCategory::find($job->subcategory_id);
        // dd($sc);

        $totalPrice = ($job->job_post_price) * ($request->total_worker);

        if ($totalPrice != $request->estimate_cost) {
            return back()->with('error', 'Somting Went To Wrong.');
        }

        $job->title = $request->title;
        $job->description = $request->description;
        $job->link = $request->link;
        $job->expired_day = $request->estimate_day ?: now();


        $me = Auth::user();

        if ($cp = $request->image) {
            $f = 'media/job/' . $job->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
                $job->media()->where('collection_name', 'job_image')->delete();
            }
            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $extension = strtolower($cp->getClientOriginalExtension());
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $job->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('media/job/' . $randomFileName, File::get($cp));

            $file_new_url = 'storage/media/job/' . $randomFileName;

            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'job_image';
            // $media->disk  = 'public';
            $job->media()->save($media);

            $job->img_name = $randomFileName;
        }

        $job->save();





        $oldWorker = $job->total_worker;
        $newWorker = $request->total_worker;

        if ($newWorker > $oldWorker) {
            $finalWorker = $newWorker - $oldWorker;
            //upgraded work
            $balance = $me->balance;

            $oldJobPostTotalCost = $job->total_job_post_cost;
            $oldJobWorkTotalCost = $job->total_job_work_cost;
            $oldCommission = $job->commission;

            $newJobPostTotalCost = ($sc->job_post_price * $finalWorker);
            $newJobWorkTotalCost = ($sc->job_work_price * $finalWorker);
            $newCommission = $newJobPostTotalCost - $newJobWorkTotalCost;

            if ($balance >= $newJobPostTotalCost) {
                $job->total_worker = $job->total_worker + $finalWorker;
                $job->total_job_post_cost = $oldJobPostTotalCost + $newJobPostTotalCost;
                $job->total_job_work_cost  = $oldJobWorkTotalCost + $newJobWorkTotalCost;
                $job->commission = $oldCommission + $newCommission;
                $job->status = null;
                $job->save();

                //user balance decrease
                $oldBalance = $me->balance;
                $newBalance = $oldBalance - $newJobPostTotalCost;
                $me->balance  = $newBalance;
                $me->save();

                $order = new Order;
                $order->work_station_id = $worksation->id;
                $order->subscriber_id = $subscription->id;
                $order->user_id = $me->id;
                $order->name = $me->name;
                $order->mobile = $me->mobile;
                $order->order_for = "job_post";
                $order->order_status = "delivered";
                $order->payment_status = "paid";
                $order->paid_amount = $newJobPostTotalCost;
                $order->addedby_id = Auth::id();
                $order->delivered_at = Carbon::now();
                $order->save();

                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->work_station_id = $order->work_station_id;
                $orderItem->subscriber_id = $order->subscriber_id;
                $orderItem->user_id = $order->user_id;
                $orderItem->order_status = 'delivered';
                $orderItem->itemable_id = $job->id;
                $orderItem->itemable_type  = 'App/Models/FreelancerJob';
                $orderItem->extra_description = 'Extra job worker added';
                $orderItem->final_price = $order->paid_amount;
                $orderItem->addedby_id = Auth::id();
                $orderItem->delivered_at = Carbon::now();
                $orderItem->save();

                $orderPayment = new OrderPayment;
                $orderPayment->order_id = $order->id;
                $orderPayment->work_station_id = $order->work_station_id;
                $orderPayment->subscriber_id = $order->subscriber_id;
                $orderPayment->user_id = $order->user_id;
                $orderPayment->trans_date = Carbon::today()->toDateString();
                $orderPayment->payment_by = 'balance';
                $orderPayment->payment_type = null;
                $orderPayment->payment_status = 'completed';
                $orderPayment->bank_name = null;
                $orderPayment->account_number = null;
                $orderPayment->cheque_number = null;
                $orderPayment->note = '';
                $orderPayment->sender = $order->user->mobile;
                $orderPayment->paid_amount = $order->paid_amount;
                $orderPayment->receivedby_id = null;
                $orderPayment->addedby_id = Auth::id();
                $orderPayment->save();

                //balance transfer  created here for admin add balance order fund
                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                // $bt->from = 'user';
                // $bt->to = 'admin';
                // $bt->purpose = 'job_post';
                // $bt->user_id = $me->id;
                // $bt->previous_balance = $oldBalance;  // user old balance
                // $bt->moved_balance = $newJobPostTotalCost; // job cost
                // $bt->new_balance = $newBalance; // user new balance (uob-jobcost)
                // $bt->type = 'order';
                // $bt->details = "{$newJobPostTotalCost} TK deducted from my balance for job post updated work.";
                // $bt->type_id = $order->id;
                // $bt->addedby_id = Auth::id();
                // $bt->save();

                // balance added to admin order balance
                // $admin_balance = $this->updateAdBlnc($newJobPostTotalCost, $orderPayment->work_station_id, 'order_base_payment');

                //total job work price
                // $admin_balance = $this->updateAdBlnc($newJobWorkTotalCost, $orderPayment->work_station_id, 'order_wages_payment');

                $oma = 0; //order minius amount

                //affiliate commission for job post

                //for signup commission
                $workorderUptoAmount = Honorarium::where('workstation_id', $subscription->work_station_id)
                    ->where('active', 1)
                    ->where('system_type', 'Working')
                    ->where('earning_type', 'Affiliate')
                    ->where('workorder_upto_amount', '>=', $newJobPostTotalCost)
                    ->orderBy('workorder_upto_amount', 'asc')
                    // ->pluck('workorder_upto_amount');
                    ->first();


                if (!$workorderUptoAmount) {
                    // return back()->with('error','Please contact admin for deposit balance.'); //
                    return back();
                }

                $workorderUptoAmount = $workorderUptoAmount->workorder_upto_amount;

                $honorariumComm = Honorarium::where('workstation_id', $subscription->work_station_id)
                    ->where('active', 1)
                    ->where('system_type', 'Working')
                    ->where('earning_type', 'Affiliate')
                    ->where('workorder_upto_amount', $workorderUptoAmount)
                    ->sum('commission');
                $affAmount = $honorariumComm * ($newJobPostTotalCost / 100); //commmission * (job post fee /100)

                // $ad->order = $ad->order - $affAmount;
                // $ad->save();

                // $admin_balance = $this->updateAdBalance($affAmount,$orderPayment->work_station_id,'order_base_payment');

                $oma = $affAmount + $oma; // update order amount

                $subscriberOldBalance = $subscription->balance;
                $subscriberNewBalance = $subscriberOldBalance + $affAmount;


                //bt will be here
                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                // $bt->from = 'admin';
                // $bt->to = 'subscriber';
                // $bt->purpose = 'job_post';
                // $bt->user_id = $me->id;
                // $bt->previous_balance = $subscriberOldBalance;  // subscriber old balance
                // $bt->moved_balance = $affAmount; // affiliate amount
                // $bt->new_balance = $subscriberNewBalance; // subscriber new balance (uob-jobcost)
                // $bt->type = 'order';
                // $bt->details = "{$affAmount} TK added to subscriber balance from admin.";
                // $bt->type_id = $order->id;
                // $bt->addedby_id = Auth::id();
                // $bt->save();

                //for affiliate comm to subscriber
                $subscription->balance = $subscription->balance + $affAmount;
                //10tk
                $subscription->save();


                //subscriber_honorarium row will be created here
                $sh = new SubscriberHonorarium;
                $sh->workstation_id = $subscription->work_station_id;
                $sh->subscriber_id = $subscription->id;
                $sh->user_id = $subscription->user_id;
                $sh->system_type = 'Working';
                $sh->earning_type = 'Affiliate';
                $sh->commission = $honorariumComm; //in percent
                $sh->amount = $affAmount;
                $sh->delivered_to = 'subscriber';
                $sh->completed = 1;
                $sh->addedby_id = Auth::id();
                $sh->save();

                //for up commission

                $upComm = Honorarium::where('workstation_id', $subscription->work_station_id)
                    ->where('active', 1)
                    ->where('system_type', 'Working')
                    ->where('earning_type', 'Up')
                    ->sum('commission');

                $upAmount = $upComm * ($newJobPostTotalCost / 100); // job post commission
                $subOwnAmount = $upAmount / 2;  // subscriber own account
                $upAmount = $upAmount - $subOwnAmount; // to all top subscriber

                // $ad->order = $ad->order - $subOwnAmount;
                // $ad->save();
                // $admin_balance = $this->updateAdBalance($subOwnAmount,$orderPayment->work_station_id,'order_base_payment');
                //70tk

                $oma = $subOwnAmount + $oma; // update order amount for subscriber own

                $subscrbOldBalance = $subscription->balance;
                $subcrbNewBalance = $subscrbOldBalance + $subOwnAmount;
                //bt will be here

                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                // $bt->from = 'admin';
                // $bt->to = 'subscriber';
                // $bt->purpose = 'job_post';
                // $bt->user_id = $me->id;
                // $bt->previous_balance = $subscrbOldBalance;  // subscriber old balance
                // $bt->moved_balance = $subOwnAmount; // up amount for subscr
                // $bt->new_balance = $subcrbNewBalance; // subscriber new balance
                // $bt->type = 'order';
                // $bt->details = "{$subOwnAmount} TK added to subscriber balance from admin.";
                // $bt->type_id = $order->id;
                // $bt->addedby_id = Auth::id();
                // $bt->save();


                //for own subscriber_honorarium  row  here for post up commission
                $shth = new SubscriberHonorarium;
                $shth->workstation_id = $subscription->work_station_id;
                $shth->subscriber_id = $subscription->id;
                $shth->user_id = $subscription->user_id;
                $shth->system_type = 'Working';
                $shth->earning_type = 'Up';
                $shth->commission = $upComm; //in percent
                $shth->amount = $subOwnAmount;
                $shth->delivered_to = 'subscriber';
                $shth->completed = 1;
                $shth->addedby_id = Auth::id();
                $shth->save();
                //10tk

                // topsubscriber up commission
                $j = $subscription->ws_position;

                $k = $j;
                $workUpAmount = 0;
                for ($j = $subscription->ws_position; $j > 0; $j--) {
                    if ($j != $k) {

                        continue;
                    }

                    $id = (int) ($k / 2);

                    //id will be credited;
                    $topSubscriber = Subscriber::where('ws_position', $id)
                        ->where('work_station_id', $subscription->work_station_id)
                        ->first();
                    if ($topSubscriber) {

                        $upAmount = $upAmount / 2;
                        if ($upAmount == 0) {
                            break;
                        }

                        // $ad->order = $ad->order - $upAmount;
                        $workUpAmount = $workUpAmount + $upAmount;
                        //for topSubscriber subscriber_honorarium  row created here for up commission
                        $sht = new SubscriberHonorarium;
                        $sht->workstation_id = $subscription->work_station_id;
                        $sht->subscriber_id = $topSubscriber->id;
                        $sht->user_id = $topSubscriber->user_id;
                        $sht->system_type = 'Working';
                        $sht->earning_type = 'Up';
                        $sht->commission = $upComm; //in percent
                        $sht->amount = $upAmount;
                        $sht->delivered_to = 'subscriber';
                        $sht->completed = 1;
                        $sht->addedby_id = Auth::id();
                        $sht->save();

                        $topSubscriber->balance = $topSubscriber->balance + $upAmount;
                        $topSubscriber->save();
                        $k = $id;
                    }
                }

                // $ad->save();

                // $admin_balance = $this->updateAdBalance($workUpAmount,$orderPayment->work_station_id,'order_base_payment');

                $oma = $workUpAmount + $oma; // order amount update to all top subscrb
                $orderSoftcodeBalance = ($newCommission) - $oma;

                // $admin_balance = $this->updateAdBlnc($orderSoftcodeBalance, $orderPayment->work_station_id, 'order_softcode_balance');

                $subOldBalance = $subscription->balance;
                $subNewBalance = $subscrbOldBalance + $workUpAmount;

                //bt will be here

                // $bt = new BalanceTransaction;
                // $bt->subscriber_id = $subscription->id;
                // $bt->from = 'admin';
                // $bt->to = 'subscriber';
                // $bt->purpose = 'job_post';
                // $bt->user_id = $me->id;
                // $bt->previous_balance = $subOldBalance;  // subscriber old balance
                // $bt->moved_balance = $workUpAmount; // up amount for subscr
                // $bt->new_balance = $subNewBalance; // subscriber new balance
                // $bt->type = 'order';
                // $bt->details = "{$workUpAmount} TK added to subscriber balance from admin.";
                // $bt->type_id = $order->id;
                // $bt->addedby_id = Auth::id();
                // $bt->save();


                //updown commission start from here...
                ///...


            }
        }

        return back()->with('success', 'Your posted job successfully updated');
    }

    public function subscriptionSubmittedWorkDetails(FreelanceJobWork $freelancejobWork)
    {
        $request = request();
        // dd($freelancejobWork);
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        menuSubmenu('myjob', 'submittedWork');

        return view('subscriber.work.submittedWorkDetails', [
            'subscription' => $subscription,
            'freelancejobWork' => $freelancejobWork
        ]);
    }

    public function subscriptionSubmittedWorkApprove(FreelanceJobWork $freelancejobWork)
    {
        $request = request();
        // dd($request->all());
        $status = $request->status;
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }

        $me = Auth::user();
        $job = FreelancerJob::find($freelancejobWork->freelancer_job_id);

        if ($me->id != $job->user_id) {
            abort(401);
        } else {
            if ($status == 'approved') {

                if ($freelancejobWork->status == 'approved') {
                    return redirect()->route('subscriber.subscriptionPostedJob', ['subscription' => $subscription->subscription_code])->with('warning', 'Remember, your id is in danger. Don\'t try again.');
                }
                // return back()->with('error','Someting went to wrong.');
                if (($request->ratting > 5) or ($request->ratting < 0)) {
                    return back()->with('error', 'Ratting should be out of 5');
                } else {
                    $freelancejobWork->ratting = $request->ratting;
                }

                $freelancejobWork->status = 'approved';

                $freelancejobWork->job_owner_note = $request->comment;
                $freelancejobWork->approved_at = now();
                $freelancejobWork->distributed_at = now();
                $freelancejobWork->editedby_id = Auth::id();
                $freelancejobWork->save();

                // worker balance added
                $subscriberWorker = $freelancejobWork->subscriber;
                $sOldbalance = $subscriberWorker->balance;
                $sNewBalance = $subscriberWorker->balance + $job->job_work_price;
                $subscriberWorker->balance =   $sNewBalance;
                $subscriberWorker->save();

                $job->work_done = $job->worksCountWithoutReject();

                if ($job->total_worker <= $job->work_done) {
                    if ($job->status != 'completed') {
                        // $job->status = 'completed';
                        if ($job->lockedWorksCount()) {
                            $job->status = null;
                        } else {
                            $job->status = 'completed';
                        }
                    }
                }

                $job->save();

                // AdminBalance::where('work_station_id',$freelancejobWork->work_station_id)->where('type','work_done')->where('last',true)->update([
                //     'last' => 0
                // ]);

                // $adminBalance = AdminBalance::where('work_station_id',$freelancejobWork->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

                // if($adminBalance)
                // {
                //     $previousB = $adminBalance->new_balance;
                // }
                // else
                // {
                //     $previousB = 0;
                // }

                // $ab = new AdminBalance;

                // $ab->work_station_id = $freelancejobWork->work_station_id;
                // $ab->previous_balance = $previousB;
                // $ab->transfer_balance = $job->job_work_price;
                // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
                // $ab->type = 'work_done';
                // $ab->last = true;
                // $ab->save();



                //balance transfer created for work done

                $bt = new BalanceTransaction;
                $bt->subscriber_id = $freelancejobWork->subscriber_id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'work_done';
                $bt->user_id = $freelancejobWork->user_id;
                $bt->previous_balance = $sOldbalance;

                $bt->moved_balance = $job->job_work_price; // work price
                $bt->new_balance = $sNewBalance;
                $bt->type = 'App\Models\FreelanceJobWork'; //work
                $bt->type_id = $freelancejobWork->id;
                $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work (work id: {$freelancejobWork->id}) approved. usfjc:953";

                $bt->addedby_id = $me->id;
                $bt->save();

                // return back()->with('success','Work is approved');

                return redirect()->route('subscriber.subscriptionPostedJob', ['subscription' => $subscription->subscription_code])->with('success', 'Work is approved.');
            } else {

                if (($request->ratting > 5) or ($request->ratting < 0)) {
                    return back()->with('error', 'Ratting should be out of 5');
                } else {
                    $freelancejobWork->ratting = $request->ratting;
                }
                $freelancejobWork->job_owner_note = $request->comment;
                $freelancejobWork->status = 'claimed';
                $freelancejobWork->rejected_at = now();
                $freelancejobWork->editedby_id = Auth::id();
                // dd($freelancejobWork);
                $freelancejobWork->save();


                $job->status = null;
                $job->save();


                $job->work_done = $job->worksCountWithoutReject();
                $job->save();

                return redirect()->route('subscriber.subscriptionPostedJob', ['subscription' => $subscription->subscription_code])->with('success', 'Work is claimed and successfully submited to system-admin for review.');
            }
        }
    }

    public function subscriptionSubmittedWorkStatus(FreelanceJobWork $freelancejobWork)
    {
        $request = request();
        $status = $request->status;
        //dd($status);
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        dd($subscription);
        if (!$subscription) {
            abort(404);
        }

        $me = Auth::user();
        $job = FreelancerJob::find($freelancejobWork->freelancer_job_id);

        if ($me->id != $job->user_id) {
            abort(401);
        }
        if ($status == 'claimed') {
            // dd(5);
            return view('subscriber.work.reviewsWork', [
                'subscription' => $subscription,
                'freelancejobWork' => $freelancejobWork,
                'status' => $status
            ]);
        } else {
            // $freelancejobWork->status = 'approved';
            // $freelancejobWork->job_owner_note = $request->comment;
            // $freelancejobWork->approved_at = now();
            // $freelancejobWork->distributed_at = now();
            // $freelancejobWork->editedby_id = Auth::id();
            // $freelancejobWork->save();

            // $job->work_done = $job->worksCountWithoutReject();
            // $job->save();

            // // AdminBalance::where('work_station_id',$freelancejobWork->work_station_id)->where('type','work_done')->where('last',true)->update([
            // //     'last' => 0
            // // ]);

            // // $adminBalance = AdminBalance::where('work_station_id',$freelancejobWork->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

            // // if($adminBalance)
            // // {
            // //     $previousB = $adminBalance->new_balance;
            // // }
            // // else
            // // {
            // //     $previousB = 0;
            // // }

            // // $ab = new AdminBalance;

            // // $ab->work_station_id = $freelancejobWork->work_station_id;
            // // $ab->previous_balance = $previousB;
            // // $ab->transfer_balance = $job->job_work_price;
            // // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
            // // $ab->type = 'work_done';
            // // $ab->last = true;
            // // $ab->save();

            // // worker balance added
            // $subscriberWorker = $freelancejobWork->subscriber;
            // $sOldbalance = $subscriberWorker->balance;
            // $sNewBalance = $subscriberWorker->balance + $job->job_work_price ;
            // $subscriberWorker->balance =   $sNewBalance;
            // $subscriberWorker->save();

            // //balance transfer created for work done

            // $bt = new BalanceTransaction;
            // $bt->subscriber_id = $freelancejobWork->subscriber_id;
            // $bt->from = 'admin';
            // $bt->to = 'subscriber';
            // $bt->purpose = 'work_done';
            // $bt->user_id = $freelancejobWork->user_id;
            // $bt->previous_balance = $sOldbalance;

            // $bt->moved_balance = $job->job_work_price; // work price
            // $bt->new_balance = $sNewBalance ;
            // $bt->type = 'App\Models\FreelanceJobWork'; //work
            // $bt->type_id = $freelancejobWork->id;
            // $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work approved.";

            // $bt->addedby_id = $me->id;
            // $bt->save();

            // return back()->with('success','Work is approved');

            return view('subscriber.work.approveWork', [
                'subscription' => $subscription,
                'freelancejobWork' => $freelancejobWork,
                'status' => $status
            ]);
        }
    }

    public function actionChange()
    {
        $request = request();
        // dd($request->all());
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();


        if (!$subscription) {
            abort(404);
        }
        // dd($request->freelanceJob);
        $freelanceJob = FreelancerJob::find($request->freelanceJob);

        // $freelanceJobWorks = FreelanceJobWork::where('work_station_id',$freelanceJob->work_station_id)->where('freelancer_job_id',$freelanceJob->id)->where('status', 'pending')->get();



        FreelanceJobWork::where('work_station_id', $freelanceJob->work_station_id)->where('freelancer_job_id', $freelanceJob->id)->where('status', 'pending')->update([
            'status' => 'approved',
            'approved_at' => now(),
            'distributed_at' => null,
            'job_owner_note' => $request->comment,
            'editedby_id' => Auth::id()
        ]);






        // foreach($freelanceJobWorks as $work)
        // {

        //     $work->status = 'approved';
        //     $workDone->approved_at = now();
        //     $workDone->save();
        //     $paidAmount = $freelanceJob->job_work_price;

        //     $type = 'work_done';

        //     $this->updateAdBalance($paidAmount,$workDone,$type);

        // }

        $freelanceJob->work_done = $freelanceJob->worksCountWithoutReject();
        if ($freelanceJob->total_worker <= $freelanceJob->work_done) {
            if ($freelanceJob->status != 'completed') {
                // $freelanceJob->status = 'completed';
                if ($freelanceJob->lockedWorksCount()) {
                    $freelanceJob->status = null;
                } else {
                    $freelanceJob->status = 'completed';
                }
            }
        }
        $freelanceJob->save();

        return back()->with('success', 'All works approved Successfully.');
    }

    public function updateAdBlnc($amount, $workstation_id, $type)
    {

        AdminBalance::where('work_station_id', $workstation_id)->where('type', $type)->where('last', true)->update([
            'last' => 0
        ]);

        $adminBalance = AdminBalance::where('work_station_id', $workstation_id)->where('type', $type)->orderBy('id', 'desc')->first();



        if ($adminBalance) {
            $previousB = $adminBalance->new_balance;
        } else {
            $previousB = 0;
        }

        $ab = new AdminBalance;



        $ab->work_station_id = $workstation_id;
        $ab->previous_balance = $previousB;
        $ab->transfer_balance = $amount;
        $ab->new_balance = $ab->previous_balance + $ab->transfer_balance;
        $ab->type = $type;
        $ab->last = true;
        $ab->save();
    }

    public function updateAdBalance($paidAmount, $work, $type)
    {

        // AdminBalance::where('work_station_id',$work->work_station_id)->where('type',$type)->where('last',true)->update([
        //         'last' => 0
        //     ]);

        // $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)->where('type',$type)->orderBy('id','desc')->first();

        // if($adminBalance)
        // {
        //     $previousB = $adminBalance->new_balance;
        // }
        // else
        // {
        //     $previousB = 0;
        // }
        // $ab = new AdminBalance;

        // $ab->work_station_id = $work->work_station_id;
        // $ab->previous_balance = $previousB;
        // $ab->transfer_balance = $paidAmount;
        // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
        // $ab->type = 'work_done';
        // $ab->last = true;

        // $ab->save();

        // worker balance added

        // $subscriberWorker = $work->subscriber;

        // $sOldbalance = $subscriberWorker->balance;
        // $sNewBalance = $subscriberWorker->balance + $paidAmount ;
        // $subscriberWorker->balance =   $sNewBalance;
        // $subscriberWorker->save();


        // //balance transfer created for work done

        // $bt = new BalanceTransaction;
        // $bt->subscriber_id = $work->subscriber_id;
        // $bt->from = 'admin';
        // $bt->to = 'subscriber';
        // $bt->purpose = 'work_done';
        // $bt->user_id = $subscriberWorker->user_id;
        // $bt->previous_balance = $sOldbalance;

        // $bt->moved_balance = $paidAmount; // work price
        // $bt->new_balance = $sNewBalance ;
        // $bt->type = 'App\Models\FreelanceJobWork'; //work
        // $bt->type_id = $work->id;
        // $bt->details = "balance {$paidAmount} TK transfer to subscriber for work approved. usfjc:1251";

        // $bt->addedby_id = $work->user_id;
        // $bt->save();


        // worker balance added

        $subscriberWorker = $work->subscriber;

        $sOldbalance = $subscriberWorker->balance;
        $sNewBalance = $subscriberWorker->balance + $paidAmount;
        $subscriberWorker->balance =   $sNewBalance;
        $subscriberWorker->save();


        //balance transfer created for work done

        $bt = new BalanceTransaction;
        $bt->subscriber_id = $work->subscriber_id;
        $bt->from = 'admin';
        $bt->to = 'subscriber';
        $bt->purpose = 'work_done';
        $bt->user_id = $subscriberWorker->user_id;
        $bt->previous_balance = $sOldbalance;

        $bt->moved_balance = $paidAmount; // work price
        $bt->new_balance = $sNewBalance;
        $bt->type = 'App\Models\FreelanceJobWork'; //work
        $bt->type_id = $work->id;
        $bt->details = "balance {$paidAmount} TK transfer to subscriber for work (work id {$work->id}) approved. usfjc:303";

        $bt->addedby_id = $work->user_id;
        $bt->save();

        if ($bt->id) {
            if ($work->status != 'approved') {
                $work->status = 'approved';
                $work->approved_at = now();
            }

            $work->distributed_at = now();
            $work->save();
        }
    }

    public function subscriptionPostBusinessProfile(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        // dd($subscription);
        if (!$subscription) {
            abort(404);
        }
        
        $service_profile_infos = ServiceProfileInfo::where('category_id', $subscription->category_id)
            ->where('type', 'business')
            ->select('id', 'field_type', 'profile_info_key', 'access_type')
            ->get();

        menuSubmenu('job', 'postBusinessProfile');
        return view('subscriber.profile.subscriptionPostProfile', [
            'subscription' => $subscription,
            'serviceProfileInfos' => $service_profile_infos

        ]);
    }

    public function subscriptionPostPersonalProfile(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        // dd($subscription);
        // dd($service_profile_infos);
        if (!$subscription) {
            abort(404);
        }

        $service_profile_infos = ServiceProfileInfo::where('category_id', $subscription->category_id)
            ->where('type', 'personal')
            ->select('id', 'field_type', 'profile_info_key', 'access_type')
            ->get();
        // dd($service_profile_infos);
        menuSubmenu('job', 'postPersonalProfile');

        return view('subscriber.profile.subscriptionPostPersonalProfile', [
            'subscription' => $subscription,
            'serviceProfileInfos' => $service_profile_infos
        ]);
    }

    public function postProfileService(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        $me = Auth::user();
        if (!$subscription) {
            abort(404);
        }
       
        $oldProfile = ServiceProfile::where('user_id', $subscription->user_id)
            ->where('workstation_id', $subscription->work_station_id)
            ->where('ws_cat_id', $subscription->category_id)
            ->where('profile_type', $request->profile_type)
            ->where('status', false)
            ->first();

            if ($request->profile_type == 'business') {
                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => ['required', 'string', 'max:255', 'min:4'],
                        // 'email' => ['required'],
                        // 'mobile' => ['required','numeric'],
                        'location' => ['required'],
                        'img' => ['required'],
                        'fixed_location' => ['nullable']
                    ]
                );
                if (!$request->location) {
                    return back()->with('error', 'Must Need Location input');
                }
            }else {
                $validation = Validator::make(
                    $request->all(),
                    [
                        'name' => ['required', 'string', 'max:255', 'min:4'],
                        // 'email' => ['required'],
                        // 'mobile' => ['required','numeric'],
                        'img' => ['required'],
                        'fixed_location' => ['nullable']
                    ]
                );
            }
        
        if ($validation->fails()) {
            return back()
                ->withInput()
                ->withErrors($validation);
        }



        if ($oldProfile) {
            $moreTalk = $oldProfile->status == true ? '' : ' Please, wait until approve it';
            return back()->with('error', 'Already submitted a profile.' . $moreTalk)->withInput();
        }

        if ($request->profile_type == 'business') {
            if ($me->balance < $subscription->category->sp_create_charge) {
                return redirect()->back()->with('warning', 'Your balance less then ' . $subscription->category->sp_create_charge . ' ! Please recharge balance and try again');
            }
            $bt = new BalanceTransaction;
            $bt->subscriber_id = $subscription->id;
            $bt->from = 'user';
            $bt->to = 'admin';
            $bt->purpose = 'sp_create_charge';
            $bt->user_id = $me->id;
            $bt->previous_balance = $me->balance;  // user old balance
            $bt->moved_balance = $subscription->category->sp_create_charge; // job cost
            $bt->new_balance =  $bt->previous_balance - $bt->moved_balance; // user new balance (uob-jobcost)
            $bt->type = 'service_profile';
            $bt->details = "{$bt->moved_balance} TK deducted from my balance for creating business profile.";
            $bt->type_id = $subscription->category->id;
            $bt->addedby_id = Auth::id();
            $bt->save();
            $me->decrement('balance', $bt->moved_balance);
        }

        $profile = new ServiceProfile;
        $profile->user_id = $subscription->user_id;
        $profile->subscriber_id = $subscription->id;
        $profile->workstation_id = $subscription->work_station_id;
        $profile->ws_cat_id = $subscription->category_id;
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->mobile = $request->mobile;
        $profile->profile_type = $request->profile_type == 'business' ? $request->profile_type : 'personal';
        if ($request->profile_type == 'business') {
            $profile->address = $request->location;
            $profile->location = $request->location;
        }
        
        $profile->lat = $request->lat;
        $profile->lng = $request->lng;
        $profile->short_bio = $request->bio;
        $profile->zip_code = $request->zip_code;
        $profile->home_delivery = $request->home_delivery ? 1 : 0;
        $profile->online_sale = $request->online_sale ? 1 : 0;
        $profile->offline_sale = $request->offline_sale ? 1 : 0;
        $profile->fixed_location = $request->fixed_location ? 1 : 0;
        $profile->city = $request->city;
        $profile->country = $request->country;
        $profile->status = false;

        if ($subscription->free_account) {
            $profile->expired_at = Carbon::now()->addDay(60);
        }else {
            $profile->expired_at = null;
        }
        $profile->addedby_id = Auth::user()->id;

        $profile->save();
        if ($cp = $request->img) {
            $f = 'user/profile/' . $profile->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/profile/' . $randomFileName, File::get($cp));

            $profile->img_name = $randomFileName;
            $profile->save();
        }

        if ($cp = $request->cover_image) {
            $f = 'user/profile/cover/' . $profile->cover_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/profile/cover/' . $randomFileName, File::get($cp));

            $profile->cover_image = $randomFileName;
            $profile->save();
        }
        $profile->save();
        // dd(json_decode($request->key_values));
        foreach (json_decode($request->key_values) as $key => $value) {


            $keyv = 'key_' . $value;
            // return $request[$keyv];
            if ($request[$keyv] != null) {
                $info = ServiceProfileInfo::where('id', $value)->first();
                if ($info) {
                    $serviceProfileValue = new ServiceProfileInfoValue;
                    $serviceProfileValue->workstation_id = $subscription->work_station_id;
                    $serviceProfileValue->ws_cat_id = $subscription->work_station_id;
                    $serviceProfileValue->subscriber_id = $subscription->category_id;
                    $serviceProfileValue->user_id = $subscription->user_id;

                    $serviceProfileValue->service_profile_id = $profile->id;

                    $serviceProfileValue->service_profile_info_id = $info->id;

                    $serviceProfileValue->profile_info_key = $info->profile_info_key;
                    $serviceProfileValue->field_type = $info->field_type;
                    $serviceProfileValue->access_type = $info->access_type;
                    $serviceProfileValue->profile_card_display = $info->profile_card_display;
                    if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {

                        if ($request->file($keyv)) {

                            $ctp = $request->file($keyv);
                            $ext = strtolower($ctp->getClientOriginalExtension());
                            $ctpn = $profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                            $ctpn = strtolower($ctpn);

                            if ($info->field_type == 'image') {
                                $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }
                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload image file in image field');
                                }
                            }


                            if ($info->field_type == 'doc') {
                                $os = array("doc", "docx");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }

                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                }
                            }

                            if ($info->field_type == 'pdf') {
                                $os = array("pdf");
                                if (!in_array($ext, $os)) {

                                    $f = 'user/profile/' . $profile->img_name;
                                    if (Storage::disk('public')->exists($f)) {
                                        Storage::disk('public')->delete($f);
                                    }

                                    $profile->serviceProfileValues()->delete();
                                    $profile->delete();

                                    return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                }
                            }

                            Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                            $serviceProfileValue->profile_info_value = $ctpn;
                        }
                    } else {
                        $serviceProfileValue->profile_info_value = trim($request[$keyv]);
                    }

                    $serviceProfileValue->active = false;
                    $serviceProfileValue->addedby_id = $subscription->user_id;

                    $serviceProfileValue->save();
                }
            }
        }
        return back()->with('success', 'Profile Submitted Successfully.');
    }

    public function subscriptionfindProfile(Request $request)
    {
// return "OK";
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        $pp = ServiceProfile::where('profile_type', 'personal')
            ->where('ws_cat_id', $subscription->category_id)
            ->first();

        if ($pp and ($pp->status == false)) {
            return back()->with('info', 'Your personal profile is pending. Please wait...');
        }

        // if (!$pp) {
        //     return redirect()->route('subscriber.subscriptionPostPersonalProfile', $subscription->subscription_code)->with('warning', 'Please create a personal profile here and try again');
        // }

        menuSubmenu('job', 'findProfile');
        $profiles = ServiceProfile::where('status', true)
            ->where('profile_type', 'business')
            ->where('ws_cat_id', $subscription->category_id)
            ->where(function($q){
                $q->where('expired_at','>=',Carbon::now()->today());
                $q->orWhere('expired_at',null);
            })
            ->latest()
            ->paginate(25);
        return view('subscriber.profile.subscriptionfindProfile', [
            'subscription' => $subscription,
            'profiles' => $profiles
        ]);
    }

    public function findProfileDetails(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        $profile = ServiceProfile::where('id', $request->profile)->where('status', 1)->where('profile_type', 'business')->first();

        if (!$subscription) {
            abort(404);
        }

        $service_profile_visitor = ServiceProfileVisitor::where('user_id', $subscription->user_id)
            ->where('ws_cat_id', $subscription->category_id)
            ->where('service_profile_id', $profile->id)
            ->first();

        //Check if this yousers have personal profile Start
        if ($service_profile_visitor) {
            $personal_profile = ServiceProfile::where('user_id', Auth::id())
                // ->where('status', 1)
                ->where('profile_type', 'personal')
                ->where('ws_cat_id', $subscription->category->id)
                ->first();

            if ((!$personal_profile) and $service_profile_visitor->full_paid) {
                return redirect()->route('subscriber.subscriptionPostPersonalProfile', ['subscription' => $subscription->subscription_code])->with('warning', 'Please Update your Personal Profile!!');
            }

            // return "Already Exist";
            $service_profile_visitor->increment('visit_count');
        } else {
            // return "New Created";
            $service_profile_visitor = new ServiceProfileVisitor;
            $service_profile_visitor->workstation_id = $subscription->work_station_id;
            $service_profile_visitor->ws_cat_id = $subscription->category_id;
            $service_profile_visitor->subscriber_id = $subscription->id;
            $service_profile_visitor->user_id = Auth::id();
            $service_profile_visitor->service_profile_id = $profile->id;
            $service_profile_visitor->visit_count = 1;
            $service_profile_visitor->addedby_id = Auth::id();
            $service_profile_visitor->save();
        }

        $service_product = ServiceProfileProduct::where('service_profile_id', $profile->id)->where('status', 'approved')->where('active', true)->orderBy('id', 'DESC')->paginate(20);

        $cart = ServiceProductCart::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->sum('quantity');
        $my_orders = ServiceProductOrder::where('user_id', Auth::id())->where('service_profile_id', $profile->id)->get();


        return view('subscriber.profile.findProfileDetails', [
            'subscription' => $subscription,
            'profile' => $profile,
            'visitor' => $service_profile_visitor,
            'service_product' => $service_product,
            'cart' => $cart,
            'my_orders' => $my_orders
        ]);
    }

    public function profilePaidPortionView(Request $request)
    {

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        $profile = ServiceProfile::where('id', $request->profile)->where('status', '1')->where('profile_type', 'business')->first();
        $biz_profile_owner_subscription = $profile->ownerSubscription;
        // dd($biz_profile_owner_subscription);
        // dd($profile->freeValues());

        if (!$subscription) {
            abort(404);
        }
        $me = Auth::user();
        $oldBalance = $me->balance;


        if ($request->paid_type == 'short_paid') {
            if ($me->balance < $profile->category->sp_short_price) {
                return back()->with('error', "Balance Less Then " . $profile->category->sp_short_price . " Taka. Please Recharge ");
            }

            $spv = ServiceProfileVisitor::where('service_profile_id', $profile->id)->where('user_id', Auth::id())->where('ws_cat_id', $profile->ws_cat_id)
                ->where('short_paid', 0)
                ->first();
            // dd($spv);
            if ($spv) {
                $spv->short_paid = 1;
                $spv->save();
                $me->decrement('balance', $profile->category->sp_short_price);
                //balance transfer  created here for amount deducted from user balance
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $subscription->id;
                $bt->from = 'user';
                $bt->to = 'admin';
                $bt->purpose = 'short_price';
                $bt->user_id = $me->id;
                $bt->previous_balance = $oldBalance;  // user old balance
                $bt->moved_balance = $profile->category->sp_short_price; // job cost
                $bt->new_balance = $oldBalance - $bt->moved_balance; // user new balance (uob-jobcost)
                $bt->type = 'service_profile';
                $bt->details = "{$bt->moved_balance} TK deducted from my balance for visiting business profile.";
                $bt->type_id = $profile->id;
                $bt->addedby_id = Auth::id();
                $bt->save();
                //Percentae Calculation For Short Paid  Start
                if ($profile->category->sp_short_price_owner_com > 0) {
                    $business_owner_get_percent = ($profile->category->sp_short_price_owner_com * $profile->category->sp_short_price) / 100;

                    $oldBalance = $biz_profile_owner_subscription->balance;
                    $biz_profile_owner_subscription->increment('balance', $business_owner_get_percent); //Bussiness owner get the percentage
                    $bt = new BalanceTransaction;
                    $bt->subscriber_id = $biz_profile_owner_subscription->id;
                    $bt->from = 'admin';
                    $bt->to = 'subscriber';
                    $bt->purpose = 'short_price_percentage';
                    $bt->user_id = $biz_profile_owner_subscription->user_id;
                    $bt->previous_balance = $oldBalance;  // user old balance
                    $bt->moved_balance =  $business_owner_get_percent; // job cost
                    $bt->new_balance = $oldBalance + $bt->moved_balance; // user new balance (uob-jobcost)
                    $bt->type = 'service_profile';
                    $bt->details = "{$bt->moved_balance} TK Commision added from admin for visiting short price part of business profile.";
                    $bt->type_id = $profile->id;
                    $bt->addedby_id = Auth::id();
                    $bt->save();
                }
                //Percentae Calculation For Short Paid End
                return back()->with('success', 'Your query information of this service profile is visible now');
            } else {
                return back()->with('warning', 'Something Went Worng');
            }
        }

        $spvf = ServiceProfileVisitor::where('service_profile_id', $profile->id)
            ->where('user_id', Auth::id())
            ->where('ws_cat_id', $profile->ws_cat_id)
            ->where('full_paid', 0)
            ->first();


        if ($spvf and ($request->paid_type == 'full_paid') and ($spvf->short_paid == 1)) {
            if ($me->balance < $profile->category->sp_full_price) {
                return back()->with('error', "Balance Less Then " . $profile->category->sp_full_price . " Taka. Please Recharge ");
            }
            $me->decrement('balance', $profile->category->sp_full_price);
            $spvf->full_paid = 1;
            $spvf->save();
            //balance transfer  created here for amount deducted from user balance
            $bt = new BalanceTransaction;
            $bt->subscriber_id = $subscription->id;
            $bt->from = 'user';
            $bt->to = 'admin';
            $bt->purpose = 'full_price';
            $bt->user_id = $me->id;
            $bt->previous_balance = $oldBalance;  // user old balance
            $bt->moved_balance = $profile->category->sp_full_price; // job cost
            $bt->new_balance = $oldBalance + $bt->moved_balance; // user new balance (uob-jobcost)
            $bt->type = 'service_profile';
            $bt->details = "{$bt->moved_balance} TK deducted from my balance for visiting your business profile.";
            $bt->type_id = $profile->id;
            $bt->addedby_id = Auth::id();
            $bt->save();

            //Percentae Calculation for Full Paid Start
            if ($profile->category->sp_full_price_owner_com > 0) {
                $business_owner_get_percent = ($profile->category->sp_full_price_owner_com * $profile->category->sp_full_price) / 100;

                $oldBalance = $biz_profile_owner_subscription->balance;
                $subscription->increment('balance', $business_owner_get_percent); //Bussiness owner get the percentage
                $bt = new BalanceTransaction;
                $bt->subscriber_id = $biz_profile_owner_subscription->id;
                $bt->from = 'admin';
                $bt->to = 'subscriber';
                $bt->purpose = 'full_price_percentage';
                $bt->user_id = $biz_profile_owner_subscription->user_id;
                $bt->previous_balance = $oldBalance;  // user old balance
                $bt->moved_balance =  $business_owner_get_percent; // job cost
                $bt->new_balance = $oldBalance + $bt->moved_balance; // user new balance (uob-jobcost)
                $bt->type = 'service_profile';
                $bt->details = "{$bt->moved_balance} TK Commision added from admin for visiting full price part of business profile";
                $bt->type_id = $profile->id;
                $bt->addedby_id = Auth::id();
                $bt->save();
            }
            //Percentae Calculation for Full Paid  Start

            $myPersonalProfile = ServiceProfile::where('user_id', Auth::id())->where('profile_type', 'personal')->where('ws_cat_id', $subscription->category_id)->first();

            if ($myPersonalProfile) {
                return back()->with('success', 'Your query information of this service profile is visible now');
            }

            return redirect()->route('subscriber.subscriptionPostPersonalProfile', ['subscription' => $subscription->subscription_code])->with('success', 'Your query information of this service profile is visible now. Please Update your Personal Profile');
        }
    }

    public function myProfileDetails(Request $request)
    {

       
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        //dd($subscription);

        if($request->worker_id !=null){
            $worker= ServiceProfileWorker::where('id', $request->worker_id)
            ->where('worker_user_id', Auth::id())
            ->where('status', true)
            ->where('edate', '>=', Carbon::now()->today())
            ->first();
            if(!$worker){
                return redirect()->back()->with('warning', "You Have No Permission To Access This Profile.Please Contact Profile Owner.");

            }
           
          

        }

        if($request->id !=null){
            $profile = ServiceProfile::where('workstation_id', $subscription->work_station_id)
                ->where('ws_cat_id', $subscription->category_id)
                ->where('profile_type', $request->profile_type)
               // ->where('user_id', Auth::id())
                ->where('id',$request->id)
                ->first();

        }else{
            $profile = ServiceProfile::where('workstation_id', $subscription->work_station_id)
                ->where('ws_cat_id', $subscription->category_id)
                ->where('profile_type', $request->profile_type)
                ->where('user_id', Auth::id())
                ->first();

        }


      //dd($profile);
            

        menuSubmenu('job', 'myProfileDetails' . $request->profile_type);

        if (!$profile) {
            if ($request->profile_type == 'business') {
                return redirect()->route('subscriber.subscriptionPostBusinessProfile', $subscription->subscription_code)->with('warning', "You have no {$subscription->category->sp_title}. Please post a {$subscription->category->sp_title}");
            }

            if ($request->profile_type == 'personal') {
                return redirect()->route('subscriber.subscriptionPostPersonalProfile', $subscription->subscription_code)->with('warning', "You have no {$subscription->category->pp_title}. Please post a {$subscription->category->pp_title}");
            }
        };

        $visitors = ServiceProfileVisitor::where('service_profile_id', $profile->id)->paginate(20);


        $total_visitor = ServiceProfileVisitor::where('service_profile_id', $profile->id)->get();
        return view('subscriber.profile.myProfileDetails', [
            'subscription' => $subscription,
            'profile' => $profile,
            'visitors' => $visitors,
            'total_visitor' => $total_visitor
        ]);
    }

    public function ShopQrcode(Request $request)
    {
                $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
                if (!$subscription) {
                    abort(404);
                }

                $worker= ServiceProfileWorker::where('profile_id', $request->profile)->where('worker_user_id', Auth::id())->first();
                if($worker){
                    $profile = ServiceProfile::where('id', $request->profile)->first();

                }else{
                    $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();

                }

            menuSubmenu('job', 'qrcode');

            
        return view('subscriber.profile.profileqrcode', [
            'subscription' => $subscription,
            'profile' => $profile
        ]);
    }

    public function CustomerList(Request $request)
    {
        menuSubmenu('job', 'customerlist');
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }

        $worker= ServiceProfileWorker::where('profile_id', $request->profile)->where('worker_user_id', Auth::id())->first();

        if($worker){
            $profile = ServiceProfile::where('id', $request->profile)->first();

        }else{
            $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();

        }

        if (!$profile) {
            return redirect()->back()->with('warning', 'You are not able to see another Subscriber Customer');
            }
        $customers = ServiceProductOrder::where('service_profile_id', $profile->id)
        ->groupBy('user_id')
        ->paginate(20);

        //dd( $customers);

        return view('subscriber.profile.profilecustomer', [
            'subscription' => $subscription,
            'profile' => $profile,
            'customers' => $customers
        ]);
    }

    public function myProfileEdit(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        $serviceProfileInfos = ServiceProfileInfo::where('category_id', $subscription->category_id)
            ->where('type', 'business')
            ->select('id', 'field_type', 'profile_info_key', 'access_type')
            ->get();

        $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();
        if ($profile) {
            return view('subscriber.profile.myProfileEdit', compact(
                'subscription',
                'profile',
                'serviceProfileInfos'
            ));
        } else {
            return redirect()->back()->with('error', 'You are not able to edit another user account!!');
        }



        //Preview Start
        // $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();
        // if ($profile) {

        //     return view('subscriber.profile.myProfileEdit', compact(
        //         'subscription',
        //         'profile'
        //     ));
        // } else {
        //     return redirect()->back()->with('error', 'You are not able to edit another user account!!');
        // }
    }

    public function myProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:4'],
            // 'email' => ['required'],
            //'mobile' => ['required','numeric'],
            //'location' => ['required'],
            'fixed_location' => ['nullable']
        ]);
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        // $profile = ServiceProfile::where('id', $request->profile_id)->where('status', 1)->first();
        if (!$subscription) {
            abort(404);
        }
        $service_profile = ServiceProfile::where('id', $request->profile_id)->where('user_id', Auth::id())->first();
        $service_profile->name = $request->name;
        if( $request->location){
            $service_profile->location = $request->location;
            if($request->lat){
            $service_profile->lat = $request->lat;
            $service_profile->lng = $request->lng;
            }
        }
        
        $service_profile->short_bio = $request->bio;
        $service_profile->zip_code = $request->zip_code;
        $service_profile->city = $request->city;
        $service_profile->fixed_location = $request->fixed_location ? 1 : 0;
        $service_profile->country = $request->country;
        $service_profile->home_delivery = $request->home_delivery ? 1 : 0;
        $service_profile->online_sale = $request->online_sale ? 1 : 0;
        $service_profile->offline_sale = $request->offline_sale ? 1 : 0;
        $service_profile->open = $request->open ? 1 : 0;
        $service_profile->website_link = $request->website_link;

        if ($cp = $request->img) {
            $f = 'user/profile/' . $service_profile->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $service_profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/profile/' . $randomFileName, File::get($cp));

            $service_profile->img_name = $randomFileName;
        }
        if ($cp = $request->cover_image) {
            $f = 'user/profile/cover/' . $service_profile->cover_image;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $service_profile->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            list($width, $height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size = $cp->getSize();

            $originalName = strtolower($cp->getClientOriginalName());

            Storage::disk('public')->put('user/profile/cover/' . $randomFileName, File::get($cp));

            $service_profile->cover_image = $randomFileName;
        }
        $service_profile->save();

        foreach (json_decode($request->key_values) as $key => $value) {

            $keyv = 'key_' . $value;
            if ($request[$keyv] != null) {
                $info = ServiceProfileInfo::where('id', $value)->first();
                $service_profile_value = ServiceProfileInfoValue::where('service_profile_info_id', $value)->where('service_profile_id', $service_profile->id)->first();
                if ($service_profile_value) {
                    // dd($service_profile_value->user_id);
                    if ($info) {
                        if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                            if ($request->file($keyv)) {
                                $ctp = $request->file($keyv);
                                $ext = strtolower($ctp->getClientOriginalExtension());
                                $ctpn = $service_profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                                $ctpn = strtolower($ctpn);

                                if ($info->field_type == 'image') {
                                    $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload image file in image field');
                                    }
                                }


                                if ($info->field_type == 'doc') {
                                    $os = array("doc", "docx");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                    }
                                }

                                if ($info->field_type == 'pdf') {
                                    $os = array("pdf");
                                    if (!in_array($ext, $os)) {
                                        return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                    }
                                }

                                $f = 'service/profile/' . $service_profile_value->profile_info_value;
                                if (Storage::disk('public')->exists($f)) {
                                    Storage::disk('public')->delete($f);
                                }
                                Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                                $service_profile_value->profile_info_value = $ctpn;
                            }
                        } else {
                            $service_profile_value->profile_info_value = trim($request[$keyv]);
                        }
                        $service_profile_value->save();
                    }
                } else {
                    $serviceProfileValue = new ServiceProfileInfoValue;
                    $serviceProfileValue->workstation_id = $subscription->work_station_id;
                    $serviceProfileValue->ws_cat_id = $subscription->work_station_id;
                    $serviceProfileValue->subscriber_id = $subscription->category_id;
                    $serviceProfileValue->user_id = $subscription->user_id;

                    $serviceProfileValue->service_profile_id = $request->profile_id;

                    $serviceProfileValue->service_profile_info_id = $info->id;
                    $serviceProfileValue->profile_info_key = $info->profile_info_key;
                    $serviceProfileValue->field_type = $info->field_type;
                    $serviceProfileValue->access_type = $info->access_type;
                    $serviceProfileValue->profile_card_display = $info->profile_card_display;
                    if (($info->field_type == 'image') or ($info->field_type == 'pdf') or ($info->field_type == 'doc')) {
                        if ($request->file($keyv)) {
                            $ctp = $request->file($keyv);
                            $ext = strtolower($ctp->getClientOriginalExtension());
                            $ctpn = $service_profile->id . $info->field_type . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $ext;
                            $ctpn = strtolower($ctpn);

                            if ($info->field_type == 'image') {
                                $os = array("png", "bmp", "jpg", "jpeg", "gif");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload image file in image field');
                                }
                            }


                            if ($info->field_type == 'doc') {
                                $os = array("doc", "docx");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload doc (msword) file in doc field');
                                }
                            }

                            if ($info->field_type == 'pdf') {
                                $os = array("pdf");
                                if (!in_array($ext, $os)) {
                                    return back()->with('error', 'Sorry, you did not upload pdf file in pdf field');
                                }
                            }

                            Storage::disk('public')->put('service/profile/' . $ctpn, File::get($ctp));
                            $serviceProfileValue->profile_info_value = $ctpn;
                        }
                    } else {
                        $serviceProfileValue->profile_info_value = trim($request[$keyv]);
                    }
                    $serviceProfileValue->active = false;
                    $serviceProfileValue->addedby_id = $subscription->user_id;
                    $serviceProfileValue->save();
                }
            }
        }
        return back()->with('success', 'Profile Successfully Updated');
    }


    public function visitorProfileDetails(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        // return $subscription->id;
        // $profile = ServiceProfile::where('user_id',$subscription->id)
        // ->where('workstation_id',$subscription->work_station_id)
        // ->where('ws_cat_id',$subscription->category_id)
        // ->where('profile_type','personal')
        // // ->where('status',false)
        // ->first();
        // // return $profile;

        $visitor = ServiceProfileVisitor::where('id', $request->visitor)->first();

        $profile = $visitor->personal_profile;


        // menuSubmenu('job','myProfileDetails'.$request->profile_type);

        if (!$profile) {
            abort(404);
        }



        return view('subscriber.profile.visitorProfileDetails', [
            'subscription' => $subscription,
            'profile' => $profile
        ]);
    }


    public function myPersonalProfile(Request $request)
    {

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();


        if (!$subscription) {
            abort(404);
        }

        $profile = ServiceProfile::where('id', $request->profile)->where('status', '1')->where('profile_type', 'personal')->first();

        if (!$profile) {
            abort(404);
        }

        return view('subscriber.profile.visitorProfileDetails', [
            'subscription' => $subscription,
            'profile' => $profile,
            'visitors' => $visitors
        ]);
        return $profile;
    }


    public function profileDetails(Request $request)
    {


        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        $profile = ServiceProfile::where('id', $request->profile)->where('status', '1')
            // ->where('profile_type','personal')
            ->first();

        if (!$profile) {
            abort(404);
        }
        return view('subscriber.profile.visitorProfileDetails', [
            'subscription' => $subscription,
            'profile' => $profile,
            // 'visitors'=>$visitors
        ]);
        return $profile;
    }

    //Service Item Start
public function newService(Request $request)
{
    $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }
        $profile = ServiceProfile::where('id', $request->profile)->first();

        $spi = ServiceProfileProduct::where('ws_cat_id', $profile->ws_cat_id)
            ->where('service_profile_id', $profile->id)
            ->where('user_id', $profile->user_id)
            ->where('status', 'temp')
            ->first();
        if (!$spi) {
            $spi = new ServiceProfileProduct;
            $spi->service_profile_id = $profile->id;
            $spi->workstation_id = $profile->workstation_id;
            $spi->ws_cat_id = $profile->ws_cat_id;
            $spi->subscriber_id = $profile->subscriber_id;
            $spi->user_id = $profile->user_id;
            $spi->status = 'temp';
            $spi->save();
        }
        return view('subscriber.serviceItems.addServiceItems',['service_item' => $spi->id, 'subscription' => $request->subscription]);
        // return redirect()->route('subscriber', ['product' => $spp->id, 'subscription' => $request->subscription]);
}
    //Service Item End

    //User Shop Product Create START
    public function newProfileProduct(Request $request)
    {
        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'newProfileProduct']);

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();

        if (!$subscription) {
            abort(404);
        }

        $profile = ServiceProfile::where('id', $request->profile)->first();

        $spp = ServiceProfileProduct::where('ws_cat_id', $profile->ws_cat_id)
            ->where('service_profile_id', $profile->id)
            ->where('user_id', $profile->user_id)
            ->where('status', 'temp')
            ->first();
        if (!$spp) {
            $spp = new ServiceProfileProduct;
            $spp->service_profile_id = $profile->id;
            $spp->workstation_id = $profile->workstation_id;
            $spp->ws_cat_id = $profile->ws_cat_id;
            $spp->subscriber_id = $profile->subscriber_id;
            $spp->user_id = $profile->user_id;
            $spp->status = 'temp';
            $spp->save();
        }
        // dd($request->subscription);
        return redirect()->route('subscriber.editProfileServiceProduct', ['product' => $spp->id,'profile' => $profile->id,'subscription' => $request->subscription]);
        // return view('subscriber.order.newOrder', compact('subscription', 'order'));
    }
    public function editProfileServiceProduct(Request $request)
    {
       
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        $profile = ServiceProfile::where('id', $request->profile)->first();
        $units = Unit::where('cat_id',$profile->ws_cat_id)->get();
        $colors = Color::get();
        $sizes = Size::where('cat_id',$profile->ws_cat_id)->get();


        $product = ServiceProfileProduct::where('id', $request->product)->first();
        return view('subscriber.product.newServiceProfileProduct', compact('subscription', 'product','profile','units','colors','sizes'));
    }

    public function createServiceProduct(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'purchase_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'deleted_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'sale_price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'required',
            'active' => 'nullable',
            'description' => 'required|min:20',
            'max_delivery_days' => 'nullable|numeric'
        ]);



        $spp = ServiceProfileProduct::where('id', $request->service_product_id)->first();

        if (!$spp) {
            return redirect()->back()->with('error', 'You haven\'t Service Profile');
        }
       
        if($spp->name==null){
            $profile = ServiceProfile::where('id', $request->service_profile_id)->first();
            $product = ServiceProfileProduct::where('service_profile_id', $profile->id)->count();
            if($product<=8 && $profile->paystatus==1){
                $me = Auth::user();
                $me->increment('ad_balance', 50);
                //dd($product);
            }

        }
        //dd($spp);
       

        // dd($order);
        $spp->name = $request->name;
        $spp->description = $request->description;
        $spp->purchase_price = $request->purchase_price ?? null;
        $spp->deleted_price = $request->deleted_price ?? null;
        $spp->sale_price = $request->sale_price ?? null;
        $spp->stock = $request->stock ?? 0;
        $spp->unit = $request->unit;
        $spp->variation = $request->variation ? 1 : 0;
        $spp->max_delivery_days = $request->max_delivery_days ?? null;
        $spp->status = $request->status;
        $spp->replace_guaranty = $request->replace_guaranty ? 1 : 0;
        $spp->active = $request->active ? 1 : 0;
        $spp->web_link = $request->web_link;

        if ($cp = $request->feature_image_name) {
            $f = 'product/serviceproduct/' . $spp->feature_image_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $spp->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            //Storage::disk('upload')->put('product/serviceproduct/' . $randomFileName, File::get($cp));
            Image::make($cp)->fit(630, 630, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/product/serviceproduct/' . $randomFileName));

            $spp->feature_image_name = $randomFileName;
        }
        $spp->save();
        $answers=[];
        if($request->variation==1){
            ServiceProductVariation::where('proid',$spp->id)->delete();

            
            for ($i = 0; $i < count($request->stkqty); $i++) {
                if($request->stkqty[$i] !=null){
                    $answers[] = [
                        'proid' => $spp->id,
                        'stkqty' => $request->stkqty[$i],
                        'colid' => $request->color[$i],
                        'sizid' => $request->size[$i]
                    ];

                }
                
            }
            ServiceProductVariation::insert($answers);

        }

        
        if ($gimages = $request->file('gallery_image')) {

            $image_limit = 4;
            $image_count = count($gimages);
            if ($image_count > $image_limit) {
                return redirect()->back()->with('warning', 'Image langth must be less then 5');
            }

            $from_database_image_count = count($spp->galary_image);

            if ($from_database_image_count >= $image_limit) {
                return redirect()->back()->with('warning', 'You have already ' . $from_database_image_count . ' Galary Image in our system. First delete some Galary image and try again');
            }

            if (($image_count + $from_database_image_count) > 4) {
                return redirect()->back()->with('warning', 'We receive only ' . $image_limit . ' Galary image for eatch service product. You have already ' . $from_database_image_count . ' images you able to upload only ' . ($image_limit - $from_database_image_count) . ' Image');
            }


            foreach ($gimages as $cp) {
                // $f = 'product/serviceproduct/galary/' . $spp->feature_image_name;
                // if (Storage::disk('public')->exists($f)) {
                //     Storage::disk('public')->delete($f);
                // }
                $extension = strtolower($cp->getClientOriginalExtension());

                $randomFileName = $spp->id . '_img_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

               // Storage::disk('upload')->put('product/serviceproduct/galary/' . $randomFileName, File::get($cp));

               Image::make($cp)->fit(630, 630, function ($constraint) {
                $constraint->aspectRatio();
                })->save(storage_path('app/public/product/serviceproduct/galary/' . $randomFileName));

                $gi = new ServiceProductImage;
                $gi->product_id = $spp->id;
                $gi->img_name = $randomFileName;
                $gi->addedby_id = Auth::id();
                $gi->editedby_id = Auth::id();
                $gi->save();
            }
        }
        



        return back()->with('success', 'Service Product Added Successfully');
    }

    public function deleteServiceProductImages(Request $request)
    {

        try {
            $image = ServiceProductImage::where('id', $request->image)->first();
            $f = 'product/serviceproduct/galary/' . $image->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
            $image->delete();
            return redirect()->back()->with('success', 'Service Product Image Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something Worng');
        }
    }

    public function myAllServiceProfileProducts(Request $request)
    {
        // return "DD";

        $request = request();
        $request->session()->forget(['lsbm', 'lsbsm']);
        $request->session()->put(['lsbm' => 'job', 'lsbsm' => 'myAllServiceProfileProducts']);

        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }

        $worker= ServiceProfileWorker::where('profile_id', $request->profile)->where('worker_user_id', Auth::id())->first();

        if($worker){
            $profile = ServiceProfile::where('id', $request->profile)->first();

        }else{
            $profile = ServiceProfile::where('id', $request->profile)->where('user_id', Auth::id())->first();

        }

       
        if (!$profile) {
            return redirect()->back()->with('warning', 'You are not able to see other subscriber products!!');
        }
        $my_service_products = ServiceProfileProduct::where('service_profile_id', $request->profile)->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(100);
        return view('subscriber.product.myAllServiceProfileProducts', compact('subscription', 'my_service_products', 'profile'));
    }

    public function viewServiceProfileProduct(Request $request)
    {
        $subscription = Subscriber::where('subscription_code', $request->subscription)->first();
        if (!$subscription) {
            abort(404);
        }
        $product = ServiceProfileProduct::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
        if (!$product) {
            return back();
        }
        // return $product->isMyWishlisted();
        $related_product = ServiceProfileProduct::where('workstation_id', $product->workstation_id)->where('service_profile_id', $product->service_profile_id)->where('status', 'approved')->where('active', true)->where('id', '!=', $request->product)->get();

        // dd($related_product);

        return view('subscriber.product.viewServiceProfileProduct', compact('subscription', 'product', 'related_product'));
    }
    public function deleteServiceProfileProduct(Request $request)
    {
        // return "OK";
        $spp = ServiceProfileProduct::where('id', $request->product)->first();
        if (!$spp) {
            return back()->with('warning', 'Product Not Found');
        }
        if ($spp->user_id != Auth::id()) {
            return back()->with('warning', 'You are not able to Delete Another User Product');
        }
        if ($spp->status != 'temp' or $spp->status != 'pending') {
            return back()->with('warning', 'Your Product is approved. You are not able to delete this product. if you want to delete this product then Contact with admin');
        }
        if ($spp->feature_image_name) {
            $f = 'product/serviceproduct/' . $spp->feature_image_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }
        }
        if ($images = $spp->galary_image) {
            foreach ($images as $img) {
                $f = 'product/serviceproduct/galary/' . $img->name;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
                $images->delete($img->id);
            }
        }
        $spp->delete();

        return redirect()->back()->with('success', 'Product Successfully Deleted');
    }
    //User Order Create START

    //Wishlist Start
    public function WishlistServiceProfileProduct(Request $request)
    {
        $user = Auth::user();
        $wishlists = ServiceProfileProductWishlist::where('user_id', Auth::id())->paginate(24);
        return view('subscriber.product.myWishlistOfServiceProduct', compact('wishlists', 'user'));
    }

    public function addWishlistServiceProfileProduct(Request $request)
    {
        $product = ServiceProfileProduct::where('id', $request->product)->where('status', 'approved')->where('active', true)->first();
        if (!$product) {
            return redirect()->back()->with('warning', 'Something Worng');
        }
        if ($product->user_id == Auth::id()) {
            return redirect()->back()->with('warning', 'You cannot wishlist your own product');
        }
        $isWishlisted = ServiceProfileProductWishlist::where('user_id', Auth::id())->where('service_product_id', $product->id)->first();
        if ($isWishlisted) {
            $isWishlisted->delete();
            return redirect()->back()->with('warning', 'This Product Removed From Your Wishlist');
        }
        $wishlist = new ServiceProfileProductWishlist;
        $wishlist->user_id = Auth::id();
        $wishlist->service_product_id = $product->id;
        $wishlist->service_profile_id = $product->service_profile_id;
        $wishlist->ws_cat_id = $product->ws_cat_id;
        $wishlist->workstation_id = $product->workstation_id;
        $wishlist->addedby_id = Auth::id();
        $wishlist->save();

        return redirect()->back()->with('success', 'Product Added to Wishlist');
    }
    //Wishlist End

    public function cartsServiceProfileProduct(Request $request)
    {
        $user = Auth::user();
        $carts = ServiceProductCart::where('user_id', $user->id)->latest()->paginate(20);
        return view('subscriber.product.cartsOfServiceProfile', compact('user', 'carts'));
    }
    // public function newServiceItem()
    // {
    //     return "OPKJ";
    // }
}
