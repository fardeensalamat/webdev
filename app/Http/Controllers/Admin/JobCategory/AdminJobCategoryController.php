<?php

namespace App\Http\Controllers\Admin\JobCategory;

use DB;
use Auth;
use Cache;
use Validator;
use App\Models\JobCategory;
use App\Models\AdminBalance;
use App\Models\FreelancerJob;
use App\Models\FreelanceJobWork;
use App\Models\BalanceTransaction;
use App\Models\JobSubcategory;
use App\Models\WorkStation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJobCategoryController extends Controller
{
    public function jobCategory()
    {
        if(!Auth::user()->hasPermission('obsb_setting'))
        {
            abort(401);
        }

        menuSubmenu('obsb','jobcategory');

        $categories=JobCategory::latest()->paginate(30);

        return view('admin.jobcategories.addNewCategory',[
            'categories' => $categories,
        ]);
    }

    public function addNewJobCategory(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }
        $cat = new JobCategory;
        $cat->title = $request->name;
        $cat->description = $request->description;
        $cat->editedby_id = Auth::id();

        $cat->save();

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.jobcategories.includes.forms.categorySingleForm',[
                    'cat' => $cat,
                ])->render()
            ]);
        }


        return back()->with('success','Category Successfully Added.');
    }

    public function jobSubcategory(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
            'job_post_price' => 'numeric',
            'job_work_price' => 'numeric',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $category = JobCategory::find($request->category);
        // dd($request->admin_approve);
        $subcategory = new JobSubcategory;

        $subcategory->admin_approve = $request->admin_approve ? true : false;
        $subcategory->work_link = $request->work_link ? true : false;
        $subcategory->title = $request->name;
        $subcategory->instraction = $request->instraction;

        $subcategory->job_category_id = $category->id;

        $subcategory->job_post_price = $request->job_post_price;

        $subcategory->job_work_price = $request->job_work_price;

        $subcategory->screenshot = $request->screenshot ? $request->screenshot : 1;

        $subcategory->description = $request->description;

        $subcategory->addedby_id = Auth::id();
        // dd($subcategory);
        $subcategory->save();

        if($request->ajax())
        {
          return Response()->json([
            'success' => true,
            'page'=>View('admin.jobcategories.ajax.subcatTable',[
                'category' => $category
            ])->render(),
          ]);


        }
        return back()->with('success','Subcategory Successfully Added.');
    }

    public function jobcategoryEdit(JobCategory $cat)
    {
        menuSubmenu('obsb','category');
        return view('admin.jobcategories.editCategories',[
            'cat' => $cat
        ]);
    }

    public function jobcategoryUpdatePost(JobCategory $cat, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
        ]);

        if($validation->fails())
        {
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $cat->title = $request->name;
        $cat->description = $request->description;
        $cat->editedby_id = Auth::id();
        $cat->save();

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.categories.includes.forms.categorySingleForm',[
                    'cat' => $cat,
                ])->render()
            ]);
        }


        return back()->with('success','Category Update Successfully.');
    }

    public function jobsubcategoryEdit(JobSubcategory $subcat, Request $request)
    {

        $categories= JobCategory::all();
        // dd($categories);
        return view('admin.jobsubcategories.editSubcategories',[
            'cat' => $subcat,
            'categories' => $categories
        ]);
    }

    public function jobsubcategoryUpdatePost(JobSubcategory $subcat, Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
            'job_post_price' => 'numeric',
            'job_work_price' => 'numeric',

        ]);

        if($validation->fails())
        {

            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');
        }

        $subcat->title = $request->name;

        if($request->category != null)
        {
            $subcat->job_category_id = $request->category;
        }
        $subcat->description = $request->description;
        $subcat->job_post_price = $request->job_post_price;
        $subcat->job_work_price = $request->job_work_price;
        $subcat->screenshot = $request->screenshot;
        $subcat->instraction = $request->instraction;
        $subcat->admin_approve = $request->admin_approve ? true : false;
        $subcat->work_link = $request->work_link ? true : false;
        $subcat->editedby_id = Auth::id();

        $subcat->save();



        return back()->with('success','Subcategory Update Successfully.');
    }

    public function jobcategoryDelete($catagory)
    {
        if(!Auth::user()->hasPermission('obsb_setting'))
        {
            abort(401);
        }

      
        $cat = JobCategory::find($catagory);

        if(!$cat){
        Session()->flash('error','Category Are Not found');
        return back();
        }
        if($cat->id == 20 || $cat->id == 22 || $cat->id == 24){
            return back()->with('warning', 'This category is special.Cant delete it.');

        }

        $cat->subcategories()->delete();

        $cat->delete();

        return back()->with('success', 'Category successfully Deleted');

    }

    public function jobsubcategoryDelete($subcatagory)
    {
        // dd($subcatagory);
        $cat = JobSubcategory::find($subcatagory);
        if(!$cat){
        Session()->flash('error','Subcategory Are Not found');
        return back();
        }

        $cat->delete();

        return back()->with('success', 'JobSubcategory successfully Deleted');

    }

    public function pendingJobs(Request $request)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }

        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            menuSubmenu('job','pendingJobs');

        $jobs = FreelancerJob::where('status','pending')->latest()->paginate(15);

        return view('admin.job.pendingJobs',[
            'jobs'=> $jobs
        ]);
        }
        else
        {
            abort(401);
        }

    }

    public function pendingJobDetails(FreelancerJob $job)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            return view('admin.job.pendingJobDetails',[
                'job'=> $job
            ]);
        }
        else
        {
            abort(401);

        }

    }

    public function pendingJobDescriptionUpdate(FreelancerJob $job)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            $job->description = request()->description;
            $job->editedby_id = Auth::id();
            $job->save();
            return back()->with('success', 'Job Description successfully updated.');
        }
        else
        {
            abort(401);

        }


    }

    public function editJobPostWorkerNum(FreelancerJob $job)
    {

        $complete = request()->full_complete;
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }

        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            if($job->admin_custom_job_status != null)
            {
                return back()->with('error', 'Sorry, Can not change it to admin modified.Already post as custom work.');
            }
            if($complete == 'on')
            {
                $job->admin_given_workers = request()->admin_given_workers;
                $job->status = 'completed';
                $job->editedby_id = Auth::id();
                $job->save();
                return back()->with('success', 'Job is completed successfully.');
            }
            if(request()->admin_given_workers > $job->total_worker)
            {

                return back()->with('error', 'Invalid worker Numbers. Please check the total workers number.');

            }
            else
            {
                if(($job->admin_given_workers > 0) )
                {
                    // dd($job->admin_given_workers);
                    if($job->admin_given_workers >= request()->admin_given_workers)
                    {
                        return back()->with('error', 'Invalid worker Numbers. Please input more than '.$job->admin_given_workers);

                    }
                    else
                    {
                        $job->admin_given_workers = request()->admin_given_workers;
                        $job->admin_completed_status = null;
                        if($complete == 'on')
                        {
                            $job->status = 'completed';
                        }
                        $job->editedby_id = Auth::id();
                        $job->save();
                        return back()->with('success', 'Job Admin Worker Number successfully updated.');
                    }
                }
                else
                {
                    $job->admin_given_workers = request()->admin_given_workers;
                    $job->admin_completed_status = null;
                    $job->status == null;
                    if($complete == 'on')
                    {
                        $job->status = 'completed';
                    }
                    $job->editedby_id = Auth::id();
                    $job->save();
                    return back()->with('success', 'Job Admin Worker Number successfully updated.');
                }
            }
        }
        else
        {
            abort(401);

        }


    }

    public function makeJobRemote(FreelancerJob $job,Request $request)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            if($job->admin_given_workers > 0 )
        {
            return back()->with('error', 'Sorry, Can not change it to custom work.Already post as admin modified.');

        }
        else
        {
            $status = $request->remote_status;

            if($job->admin_custom_job_status!= 'completed')
            {
                $job->admin_custom_job_status = $status;
                $job->status = null;
                $job->save();
                return back()->with('success', 'Successfully Saved Job as custom work.');
            }
            if(($job->admin_custom_job_status == 'ongoing') and $status == 'completed')
            {
                $job->admin_custom_job_status = 'completed';
                $job->status = 'completed';
                $job->save();

                return back()->with('success', 'Job is completed Successfully.');

            }
        }
        }
        else
        {
            abort(401);

        }


    }

    public function approvedJob(FreelancerJob $job)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            $job->status = null;
            $job->save();
            return back()->with('success','Posted Job Approved Successfully.');
        }
        else
        {
            abort(401);

        }

    }

    public function suspendJob(FreelancerJob $job)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            $job->status = 'cancel';
        $job->save();

        return back()->with('warning','Posted Job Approved Successfully.');
        }
        else
        {
            abort(401);

        }

    }

    public function allPostedJob(Request $request)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            menuSubmenu('job','allPostedJob');

            $jobs = FreelancerJob::orderBy('status')->paginate(15);

            return view('admin.job.allJobList',[
                'jobs'=> $jobs
            ]);
        }
        else
        {
            abort(401);

        }

    }

    public function allPostedlatestJob(Request $request)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }
        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            menuSubmenu('job','allPostedlatestJob');
        $jobs = FreelancerJob::orderBy('id','desc')->latest()->paginate(15);

        return view('admin.job.allJobList',[
            'jobs'=> $jobs
        ]);
        }
        else
        {
            abort(401);

        }

    }

    public function allPostedJobModifiedByAdmin(Request $request)
    {


        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work'))
            or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            $type = 'allPostedJobModifiedByAdmin';
        menuSubmenu('job','allPostedJobModifiedByAdmin');
        $jobs = FreelancerJob::where('admin_given_workers','>' ,0)->orderBy('status')->latest()->paginate(15);
        // dd($jobs);
        return view('admin.job.allPostedJobModifiedByAdmin',[
            'jobs'=> $jobs,
            'type'=>$type
        ]);
        }
        else
        {
            abort(401);
        }

    }

    public function allPostedCustomJobModifiedByAdmin(Request $request)
    {
        // if(!Auth::user()->hasPermission('jobs_work'))
        // {
        //     abort(401);
        // }

        if((Auth::user()->hasPermission('all_pending_jobs')) or (Auth::user()->hasPermission('all_posted_jobs')) or (Auth::user()->hasPermission('jobs_work')) or (Auth::user()->hasPermission('all_admin_modified_jobs')) or (Auth::user()->hasPermission('all_admin_custom_jobs'))
        )
        {
            $type = 'allPostedCustomJobModifiedByAdmin';
            // dd($type);
            menuSubmenu('job','allPostedCustomJobModifiedByAdmin');
            $jobs = FreelancerJob::where('admin_given_workers','=',0)->where('admin_custom_job_status','<>',null)->orderBy('status')->latest()->paginate(15);
            // dd($jobs);
            return view('admin.job.allPostedJobModifiedByAdmin',[
                'jobs'=> $jobs,
                'type'=>$type
            ]);
        }
        else
        {
            abort(401);
        }

    }

    public function allWorksOfJob(Request $request, FreelancerJob $job)
    {

        // $works = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //       $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // // ->take(50)
        // ->count();

        // dd($works);

        // $works = FreelanceJobWork::where(function ($query) {
        //       $query->where(function ($qqq){
        //         $qqq->where('status', 'approved');
        //         // $qqq->whereDate('distributed_at', '=', '2021-04-07');
        //         // $qqq->whereDate('pending_at', '<', now()->subDays(2));
        //     });
        //       $query->orWhere(function ($q){

        //         // $q->whereDate('created_at', '<', now()->subDays(2));
        //         // $q->where('status', 'pending');

        //       });
        //   })

        // ->with('job')
        // ->latest()
        // // ->take(50)
        // // ->get();
        // ->count();

        // dd($works);




        // $bt = BalanceTransaction::where('user_id', 1063)
        // ->where('purpose', 'work_done')
        // ->get();

        // dd($bt);

        // $wrks = FreelanceJobWork::where('status', 'approved')
        // ->where('user_id', 1063)
        // ->doesntHave('bt')
        // // ->with('bt')


        // ->get();

        // dd($wrks);



        // $users = DB::table('users')->where('id', '<', 200)->orderBy('id')->get();

        // DB::table('users')->where('id', '<', 200)->orderBy('id')->chunk(100, function ($users) {
        //     foreach ($users as $user) {



        //         $wrks = FreelanceJobWork::where('status', 'approved')
        //         ->where('user_id', $user->id)
        //         ->doesntHave('bt')
        //         // ->with('bt')


        //         ->get();


        //         foreach($wrks as $wrk)
        //         {
        //             $bt = BalanceTransaction::where('user_id', $wrk->user_id)
        //             ->where('purpose', 'work_done')
        //             ->where('type_id', null)
        //             ->first();

        //             // dd($wrk->id);

        //             // dd($bt);

        //             if($bt){



        //                 $bt->type = 'APP\Models\FreelanceJobWork';
        //                 $bt->type_id = $wrk->id;
        //                 $bt->save();
        //             }
        //         }

        //     }
        // });

        // $works = FreelanceJobWork::doesntHave('bt')
        // ->where(function ($query) {
        //       $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // // ->take(50)
        // ->count();

        // dd($works);

        // $wrks = FreelanceJobWork::where('status', 'approved')
        // // ->where('user_id', 1063)
        // ->has('bt')
        // // ->with('bt')


        // ->count();


        // foreach($wrks as $wrk)
        // {
        //     $bt = BalanceTransaction::where('user_id', $wrk->user_id)
        //     ->where('purpose', 'work_done')
        //     ->where('type_id', null)
        //     ->first();

        //     // dd($wrk->id);

        //     // dd($bt);

        //     if($bt){



        //         $bt->type = 'APP\Models\FreelanceJobWork';
        //         $bt->type_id = $wrk->id;
        //         $bt->save();
        //     }
        // }

        // dd($wrks);



        // $works = FreelanceJobWork::whereHas('balanceTransactions', function($qq){
        //     // $qq->whereIn('user_id', [1063]);
        //     $qq->where('user_id', 1063);
        //     // $qq->whereIn('user_id', [1300,90,1188,1146]);
        //     $qq->where('purpose', 'work_done');
        // })
        // ->where(function ($query) {
        //       $query->where('status', 'approved');
        //       $query->orWhere(function ($q){
        //         // $q->whereDate('created_at', '<', now()->subDays(2));
        //         // $q->where('status', 'pending');

        //       });
        //   })
        // ->with('job')
        // ->latest()
        // ->count();



        // dd($works);

        // $c = BalanceTransaction::whereIn('user_id', [1300,90,1188,1146])->count();

        // dd($c);

        // $works = FreelanceJobWork::doesntHave('balanceTransactions')
        // ->where(function ($query) {
        //         $query->where('status', 'approved');
        //         $query->orWhere(function ($q){
        //         $q->whereDate('created_at', '<', now()->subDays(2));
        //         $q->where('status', 'pending');

        //         });
        //     })
        // ->with('job')
        // ->latest()
        // ->take(50)
        // ->get();

        // dd($works);


        // $works = FreelanceJobWork::doesntHave('balanceTransactions')
        // ->where('status', 'approved')
        // ->with('job')
        // // ->latest()
        // ->take(10)
        // ->get();

        // // dd($works);

        // foreach($works as $work)
        // {
        //     dd($work);
        // }

        // menuSubmenu('job','allWorksOfJob');

        // $works = $job->works()->where('status', $request->status)->paginate(15);
        // $works = FreelanceJobWork::doesntHave('balanceTransactions')
        // ->where('status', $request->status)
        // ->where('freelancer_job_id', $job->id)
        // // ->with('job')
        // ->paginate(15);



        if($request->status == 'claimed')
        {
            $works = FreelanceJobWork::where('freelancer_job_id', $job->id)
            ->where('status', $request->status)
            ->with('job')
            ->paginate(15);
        }
        else
        {
            $works = FreelanceJobWork::where('freelancer_job_id', $job->id)
            // ->where('freelancer_job_id', $job->id)
            // ->where('status', $request->status)
            // ->where('freelancer_job_id', $job->id)
            ->orderBy('id', 'desc')
            ->with('job')
            ->paginate(15);
        }





        return view('admin.job.allWorksOfJob',[
            'job'=> $job,
            'works' => $works,
            'status' => $request->status
        ]);
    }

    public function jobWorkStatusUpdate(Request $request, FreelanceJobWork $work)
    {
        $status = $request->status;

        if($status == 'approved')
        {
            return view('admin.job.approvedJobWithRatting',['work'=>$work,'status'=>$status]);

            // $work->status = 'approved';
            // $work->approved_at = now();
            // $work->distributed_at = now();
            // $work->editedby_id = Auth::id();
            // $work->save();
            // $job = $work->job;
            // $job->work_done = $job->worksCountWithoutReject();

            // if($job->total_worker <= $job->work_done)
            // {
            //     if($job->status != 'completed')
            //     {
            //         // $job->status = 'completed';
            //         if($job->lockedWorksCount())
            //         {
            //         $job->status = null;

            //         }
            //         else
            //         {
            //         $job->status = 'completed';

            //         }

            //     }
            // }

            // $job->save();

            // // dd($work);
            // // AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->where('last',true)->update([
            // //     'last' => 0
            // // ]);

            // // $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

            // // if($adminBalance)
            // // {
            // //     $previousB = $adminBalance->new_balance;
            // // }
            // // else
            // // {
            // //     $previousB = 0;
            // // }

            // // $ab = new AdminBalance;

            // // $ab->work_station_id = $work->work_station_id;
            // // $ab->previous_balance = $previousB;
            // // $ab->transfer_balance = $job->job_work_price;
            // // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
            // // $ab->type = 'work_done';
            // // $ab->last = true;
            // // $ab->save();

            // // worker balance added
            // $subscriberWorker = $work->subscriber;
            // $sOldbalance = $subscriberWorker->balance;
            // $sNewBalance = $subscriberWorker->balance + $job->job_work_price ;
            // $subscriberWorker->balance =   $sNewBalance;
            // $subscriberWorker->save();

            // //balance transfer created for work done

            // $bt = new BalanceTransaction;
            // $bt->subscriber_id = $work->subscriber_id;
            // $bt->from = 'admin';
            // $bt->to = 'subscriber';
            // $bt->purpose = 'work_done';
            // $bt->user_id = $work->user_id;
            // $bt->previous_balance = $sOldbalance;

            // $bt->moved_balance = $job->job_work_price; // work price
            // $bt->new_balance = $sNewBalance ;
            // $bt->type = 'App\Models\FreelanceJobWork'; //work
            // $bt->type_id = $work->id;
            // $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work approved.";

            // $bt->addedby_id = Auth::id();
            // $bt->save();


            // #### cron job start ###

            // // AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->where('last',true)->update([
            // //     'last' => 0
            // // ]);

            // // $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

            // // if($adminBalance)
            // // {
            // //     $previousB = $adminBalance->new_balance;
            // // }
            // // else
            // // {
            // //     $previousB = 0;
            // // }

            // // $ab = new AdminBalance;

            // // $ab->work_station_id = $work->work_station_id;
            // // $ab->previous_balance = $previousB;
            // // $ab->transfer_balance = $job->job_work_price;
            // // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
            // // $ab->type = 'work_done';
            // // $ab->last = true;
            // // $ab->save();

            // // // worker balance added
            // // $subscriberWorker = $work->subscriber;
            // // $sOldbalance = $subscriberWorker->balance;
            // // $sNewBalance = $subscriberWorker->balance + $job->job_work_price ;
            // // $subscriberWorker->balance =   $sNewBalance;
            // // $subscriberWorker->save();

            // // //balance transfer created for work done

            // // $bt = new BalanceTransaction;
            // // $bt->subscriber_id = $work->subscriber_id;
            // // $bt->from = 'admin';
            // // $bt->to = 'subscriber';
            // // $bt->purpose = 'work_done';
            // // $bt->user_id = $work->user_id;
            // // $bt->previous_balance = $sOldbalance;

            // // $bt->moved_balance = $job->job_work_price; // work price
            // // $bt->new_balance = $sNewBalance ;
            // // $bt->type = 'work_done';
            // // $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work approved.";

            // // $bt->addedby_id = Auth::id();
            // // $bt->save();


            // return back()->with('success', 'Work status successfully updated as approved and honorarium successfully distributed');

        }
        elseif($status == 'rejected')
        {
            // $work->status = 'rejected';
            // $work->rejected_at = now();
            // $work->editedby_id = Auth::id();
            // $work->save();
            // $job = $work->job;
            // $job->work_done = $job->worksCountWithoutReject();
            // $job->status = null;
            // $job->save();
            // return back()->with('success', 'Work status successfully updated as rejected');
            // dd($work);
            return view('admin.job.suspendJobWithCause',['work'=>$work,'status'=>$status]);

        }

        return back();
    }

    public function rejectReason(FreelanceJobWork $work, Request $request)
    {
        $status = $request->status;

        // dd($request->all());

        if( ($work->status == 'approved') and ($status == 'approved'))
        {
            return back()->with('warning','this work is already approved'); 
        }

        if($status == 'approved')
        {
            if(($request->ratting > 5) or ($request->ratting < 0))
            {
                return back()->with('error','Ratting should be out of 5');
            }
            else
            {
                if($request->ratting == null)
                {
                    $work->ratting = $work->ratting;
                }
                else
                {
                    $work->ratting = $request->ratting;

                }

            }

            $job = $work->job;

            $work->admin_note  = $request->reason;
            $work->status = 'approved';
            $work->approved_at = now();
            $work->distributed_at = now();
            $work->editedby_id = Auth::id();
            $work->save();

            // worker balance added
            $subscriberWorker = $work->subscriber;
            $sOldbalance = $subscriberWorker->balance;
            $sNewBalance = $subscriberWorker->balance + $job->job_work_price;
            $subscriberWorker->balance =   $sNewBalance;
            $subscriberWorker->save();



            $job->work_done = $job->worksCountWithoutReject();

            if($job->total_worker <= $job->work_done)
            {
                if($job->status != 'completed')
                {
                    // $job->status = 'completed';
                    if($job->lockedWorksCount())
                    {
                    $job->status = null;

                    }
                    else
                    {
                    $job->status = 'completed';

                    }

                }
            }

            $job->save();

            //balance transfer created for work done

            $bt = new BalanceTransaction;
            $bt->subscriber_id = $work->subscriber_id;
            $bt->from = 'admin';
            $bt->to = 'subscriber';
            $bt->purpose = 'work_done';
            $bt->user_id = $work->user_id;
            $bt->previous_balance = $sOldbalance;

            $bt->moved_balance = $job->job_work_price; // work price
            $bt->new_balance = $sNewBalance ;
            $bt->type = 'App\Models\FreelanceJobWork'; //work
            $bt->type_id = $work->id;
            $bt->details = "Balance {$job->job_work_price} TK transfer to subscriber for work (work id {$work->id}) approved ajcc:1157";

            $bt->addedby_id = Auth::id();
            $bt->save();


            #### cron job start ###

            // AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->where('last',true)->update([
            //     'last' => 0
            // ]);

            // $adminBalance = AdminBalance::where('work_station_id',$work->work_station_id)->where('type','work_done')->orderBy('id','desc')->first();

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
            // $ab->transfer_balance = $job->job_work_price;
            // $ab->new_balance = $ab->previous_balance - $ab->transfer_balance;
            // $ab->type = 'work_done';
            // $ab->last = true;
            // $ab->save();

            // // worker balance added
            // $subscriberWorker = $work->subscriber;
            // $sOldbalance = $subscriberWorker->balance;
            // $sNewBalance = $subscriberWorker->balance + $job->job_work_price ;
            // $subscriberWorker->balance =   $sNewBalance;
            // $subscriberWorker->save();

            // //balance transfer created for work done

            // $bt = new BalanceTransaction;
            // $bt->subscriber_id = $work->subscriber_id;
            // $bt->from = 'admin';
            // $bt->to = 'subscriber';
            // $bt->purpose = 'work_done';
            // $bt->user_id = $work->user_id;
            // $bt->previous_balance = $sOldbalance;

            // $bt->moved_balance = $job->job_work_price; // work price
            // $bt->new_balance = $sNewBalance ;
            // $bt->type = 'work_done';
            // $bt->details = "balance {$job->job_work_price} TK transfer to subscriber for work approved.";

            // $bt->addedby_id = Auth::id();
            // $bt->save();


            // return back()->with('success', 'Work status successfully updated as approved and honorarium successfully distributed');
            return redirect()->route('admin.allWorksOfJob',['job'=>$job->id,'status'=> 'claimed'])->with('success','Work status successfully updated as approved and honorarium successfully distributed.');

        }
        else
        {
            // reject
            if(($request->ratting > 5) or ($request->ratting < 0))
            {
                return back()->with('error','Ratting should be out of 5');
            }
            else
            {
                if($request->ratting == null)
                {
                    $work->ratting = $work->ratting;
                }
                else
                {
                    $work->ratting = $request->ratting;

                }

            }

            $work->status = 'rejected';
            $work->admin_note  = $request->reason;
            $work->rejected_at = now();
            $work->editedby_id = Auth::id();
            $work->save();

            $job = $work->job;
            $job->work_done = $job->worksCountWithoutReject();
            $job->status = null;
            $job->save();

            // return back()->with('success', 'Work status successfully updated as rejected');
            return redirect()->route('admin.allWorksOfJob',['job'=>$job->id,'status'=> 'claimed'])->with('success','Work reject successfully.');
        }
    }

    public function jobWorkDetails(FreelanceJobWork $work)
    {
        return view('admin.job.WorkOfJobDetails',[
            'freelancejobWork' => $work,
        ]);
    }
}
