<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use RequestModel;

use App\RequestHistoric;

use App\User;

use App\Project;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $month = Date('m');
        $year = Date('Y');

        switch(Auth::user()->type)
        {
            case 'administrador': 
            case 'parceiro':
            
                $functionPoints = RequestModel::where('status', 'feita')
                ->whereRaw('MONTH(updated_at) = '. $month)
                ->whereRaw('YEAR(updated_at) = '. $year)
                ->sum('function_points');

                $functionPointsByProject = RequestModel::with('project')
                ->select(DB::raw('project_id, sum(function_points) as sum'))
                ->where('status', 'feita') 
                ->whereRaw('MONTH(updated_at) = '. $month)
                ->whereRaw('YEAR(updated_at) = '. $year)
                ->groupBy('project_id')
                ->get();

                $totalRequests = RequestModel::whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->count();

                $totalRequestsByUser = RequestModel::with('user')
                ->select(DB::raw('user_id, count(id) as sum'))
                ->whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->groupBy('user_id')
                ->get();
                            
                $requestsByType = RequestModel::select(DB::raw('type, count(id) as sum'))
                ->whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->groupBy('type')
                ->get();

                $requestsByPriority = RequestModel::select(DB::raw('priority, count(id) as sum'))
                ->whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->groupBy('priority')
                ->get();

                $requestsByDelivery = RequestModel::select(DB::raw('delivered, count(id) as sum'))
                ->where('status', 'feita')
                ->whereRaw('MONTH(updated_at) = '. $month)
                ->whereRaw('YEAR(updated_at) = '. $year)
                ->groupBy('delivered')
                ->get();

                $requestHistorics = RequestHistoric::with(['request', 'user'])
                ->whereRaw('MONTH(action_datetime) = '. $month)
                ->orderBy('action_datetime', 'desc')
                ->get();

                return view(Auth::user()->type.'.home', compact('functionPoints', 'functionPointsByProject', 'totalRequests', 'totalRequestsByUser', 'requestsByType', 'requestsByPriority', 'requestsByDelivery', 'requestHistorics'));
                break;

            case 'solicitante':
                $institution = Auth::user()->institution_id;
                $users = User::where('institution_id',$institution)->get()->pluck('id'); 
                $requests = RequestModel::where('user_id', $users)->get()->pluck('id');
				if($requests != null){
					$requestHistorics = 0;
				}else{
					$requestHistorics = RequestHistoric::with('request')
						->with('user')
						->where('request_id', $requests)
						->whereRaw('MONTH(action_datetime) = '. $month)
						->orderBy('action_datetime', 'desc')
						->get();
				}
                

                return view('requester.home', compact('requestHistorics'));
                break;

        }
    }
}
