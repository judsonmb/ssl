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
	
	public function index()
	{
		
		$month = Date('m');
		$year = Date('Y');
		
		switch(Auth::user()->type)
        {
            case 'administrador': 
            case 'parceiro':
				
				$blocked = RequestModel::where('status', 'bloqueada')->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$todo = RequestModel::where('status', 'a fazer')->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$doing = RequestModel::where('status', 'fazendo')->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$done = RequestModel::where('status', 'feita')
				->whereRaw('MONTH(updated_at) = '. $month)
                ->whereRaw('YEAR(updated_at) = '. $year)
				->orderBy('deadline', 'asc')
				->orderby('created_at')->get();
		
				break;
		
			case 'solicitante':
			
				$institution = Auth::user()->institution_id;
			
				$blocked = RequestModel::where('status', 'bloqueada')->wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$todo = RequestModel::where('status', 'a fazer')->wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$doing = RequestModel::where('status', 'fazendo')->wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				$done = RequestModel::where('status', 'feita')
				->whereRaw('MONTH(updated_at) = '. $month)
                ->whereRaw('YEAR(updated_at) = '. $year)
				->wherehas('user', function($query) use ($institution){
                    $query->where('institution_id', '=', $institution);
                })->orderBy('deadline', 'asc')->orderby('created_at')->get();
		
				break;
		}
		
		return view('home', compact('blocked', 'todo', 'doing', 'done'));
	}	

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {	
		if($request->input('month') != null){
			$monthYear = explode("-", $request->input('month'));
			$month = $monthYear[1];
			$year = $monthYear[0];
		}else{
			$month = Date('m');
			$year = Date('Y');
		}
		
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

                $totalRequestsByProject = RequestModel::with('project')
                ->select(DB::raw('project_id, count(id) as sum'))
                ->whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->groupBy('project_id')
                ->get();

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

                $requestsByDelivery =  RequestModel::select(DB::raw('delivered, count(id) as sum'))
                ->whereRaw('MONTH(created_at) = '. $month)
                ->whereRaw('YEAR(created_at) = '. $year)
                ->groupBy('delivered')
                ->get();

                $requestHistorics = RequestHistoric::with(['request', 'user'])
                ->whereRaw('MONTH(created_at) = '. $month)
				->whereRaw('YEAR(created_at) = '. $year)
                ->orderBy('created_at', 'desc')
                ->get();
                 
				 
				 
                return view(Auth::user()->type.'.dashboard', compact('functionPoints', 'functionPointsByProject', 'totalRequests', 'totalRequestsByProject', 'totalRequestsByUser', 'requestsByType', 'requestsByPriority', 'requestsByDelivery', 'requestHistorics'))
				->with('month', $month)
				->with('year', $year);
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
						->whereRaw('MONTH(created_at) = '. $month)
						->whereRaw('YEAR(created_at) = '. $year)
						->orderBy('created_at', 'desc')
						->get();
				}
				
				return view(Auth::user()->type.'.home', compact('requestHistorics'))
				->with('month', $month)
				->with('year', $year);
                break;

        }
    }
}
