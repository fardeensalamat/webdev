<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\AdminBalance;
use App\Models\Subscriber;
use App\Models\FreelancerJob;
use App\Models\WorkStation;
use App\Models\FreelanceJobWork;
use Illuminate\Http\Request;
use App\Models\BalanceTransaction;
use App\Http\Controllers\Controller;

class AdminReportController extends Controller
{
    public function report(Request $request)
    {
        $type = $request->type;
        $request->session()->forget(['lsbm','lsbsm']);
        $request->session()->put(['lsbm'=>'report','lsbsm'=>'report'.$type]);
        $ws = WorkStation::all();
        return view('admin.reports.allReports',[
           'type' => $type,
           'workstations' => $ws
        ]);
    }

    public function reportsGetByDate(Request $request)
    {
        $date = $request->date;
        $type = $request->type;
        // dd($type);
        if($date == 'today')
        {
            if($type == 'Tenant')
            {
                $reports = User::whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();                
            }
            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();
            }

            if($type == 'MoveWallet')
            {
                $reports = BalanceTransaction::where('purpose','move_to_wallet')
                ->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get(); 
            }

            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')
                ->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();
            }

            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')
                ->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();
            }

            if($type == 'PF')
            {
                $reports = Subscriber::whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();             
            }
            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status',null)->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();
            }
            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')->whereDate('created_at',Carbon::today()->toDateString())->orderBy('id','desc')->get();                
            }
        }
        elseif($date == 'yesterday')
        {
            if($type == 'Tenant')
            {
                $reports = User::whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')->get();
            }
            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get();
            }

            if($type == 'MoveWallet')
            {
                $reports = BalanceTransaction::where('purpose','move_to_wallet')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get(); 
            }

            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get(); 
            }

            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get(); 
            }

            if($type == 'PF')
            {
                $reports = Subscriber::whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get(); 
                            
            }

            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status','completed')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get();                
            }

            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')
                ->whereDate('created_at',Carbon::yesterday()->toDateString())->orderBy('id','desc')
                ->get(); 
                                
            }
        }
        elseif($date == 7)
        {
            $end = Carbon::now()->toDateString();
            $start = Carbon::now()->subDays(6)->toDateString();
            
            if($type == 'Tenant')
            {
                $reports = User::whereBetween('created_at',[$start,$end])->get();
            }
            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if($type == 'MoveWallet')
            {
                $reports = BalanceTransaction::where('purpose','move_to_wallet')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if($type == 'PF')
            {
                $reports = Subscriber::whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();                         
            }

            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status','completed')
                ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
                
            }

            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')
                ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();         
            }
        }

        elseif($date == 30)
        {
            $end = Carbon::now()->toDateString();
            $start = Carbon::now()->subDays(29)->toDateString();
            if($type == 'Tenant')
            {
                $reports = User::whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
                
            }
            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }
            if($type == 'MoveWallet')
            {
                $reports = BalanceTransaction::where('purpose','move_to_wallet')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
            }

            if($type == 'PF')
            {
                $reports = Subscriber::whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();                        
            }

            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status','completed')
                ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
                
            }

            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')
                ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();         
            }
        }
        elseif($date == 'this_month')
        {
           
            if($type == 'Tenant')
            {
                $reports = User::whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')
                ->get();                
            }
            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')->get();
            }
            if($type == 'MoveWallet')
            {
                $reports = BalanceTransaction::where('purpose','move_to_wallet')->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')->get();
            }
            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')->get();
            }
            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')->whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')->get();
            }
            if($type == 'PF')
            {
                $reports = Subscriber::whereYear('created_at',date('Y'))->whereMonth('created_at', date('m'))->orderBy('id','desc')->get();                      
            }

            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status','completed')
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at', date('m'))
                ->orderBy('id','desc')->get();
                
            }

            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')
                ->whereYear('created_at',date('Y'))
                ->whereMonth('created_at', date('m'))
                ->orderBy('id','desc')->get();        
            }
        }
        elseif($date == 'last_month')
        {
            $previous =  Carbon::now()->subMonth(); 
            $lastMonthYear =  $previous->format('Y'); 
            $lastMonth =  $previous->format('m'); 
            
            if($type == 'Tenant')
            {

                $reports = User::whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();                
            }

            if($type == 'Withdraw')
            {
                $reports = BalanceTransaction::where('purpose','withdraw')->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();
            }

            if($type == 'MoveWallet')
            {
                // dd($type);
                $reports = BalanceTransaction::where('purpose','move_to_wallet')->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();
            }

            if( $type == 'Honorarium')
            {
                $reports = BalanceTransaction::where('purpose','honorarium')->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();
            }
            if( $type == 'Deposit')
            {
                $reports = BalanceTransaction::where('purpose','deposit')->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();
            }    
            if($type == 'PF')
            {
                $reports = Subscriber::whereYear('created_at',$lastMonthYear)
                ->whereMonth('created_at',  $lastMonth)
                ->orderBy('id','desc')->get();                                   
            }
            if($type == 'Jobs')
            {
                $reports = FreelancerJob::where('status','completed')
                ->whereYear('created_at',$lastMonthYear)->whereMonth('created_at',  $lastMonth)->orderBy('id','desc')->get();
            } 

            if($type == 'Works')
            {
                $reports = FreelanceJobWork::where('status','approved')
                ->whereYear('created_at',$lastMonthYear)
                ->whereMonth('created_at',  $lastMonth)
                ->orderBy('id','desc')
                ->get();   
            }

        }
        // dd($reports);
        
        return view('admin.reports.allReports',[
            'reports' => $reports,
            'type' => $type
        ]);
    }

    public function reportsGetByDateInterval(Request $request)
    {        
        $start = $request->date_from;
        $end = $request->date_to;
        $type = $request->type; 
        
        if($type == 'Works')
        {
            $reports = FreelanceJobWork::where('status',$request->workStatus)
            ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();         
        }

        if($type == 'Jobs')
        {
            $reports = FreelancerJob::where('status',$request->jobStatus)
            ->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
        } 

        if($type == 'PF')
        {
            $reports = Subscriber::where('work_station_id',$request->ws)->whereBetween('created_at',[$start,$end])
            ->orderBy('id','desc')->get();                   
        }
        if( $type == 'Deposit')
        {
            $reports = BalanceTransaction::where('purpose','deposit')
            ->whereBetween('created_at',[$start,$end])
            ->orderBy('id','desc')->get();
        } 

        if($type == 'MoveWallet')
        {
            $reports = BalanceTransaction::where('purpose','move_to_wallet')->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();
        }

        if( $type == 'Honorarium')
        {
            $reports = BalanceTransaction::where('purpose','honorarium')
            ->whereBetween('created_at',[$start,$end])
            ->orderBy('id','desc')->get();
        }

        if($type == 'Withdraw')
        {
            $reports = BalanceTransaction::where('purpose','withdraw')
            ->where('type',$request->method)
            ->whereBetween('created_at',[$start,$end])
            ->orderBy('id','desc')->get();
        }

        if($type == 'Tenant')
        {
            $reports = User::where('active',$request->active)->whereBetween('created_at',[$start,$end])->orderBy('id','desc')->get();                
        }

        // other parameter
        if($type == 'PF')
        {
            $ws = WorkStation::all();
            
        }
        else
        {
            $ws = [];
        }
        
        return view('admin.reports.allReports',[
            'reports' => $reports,
            'type' => $type,
            'workstations' => $ws 
        ]);
        
    }
}
