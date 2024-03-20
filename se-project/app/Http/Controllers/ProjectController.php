<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Laravel\Pulse\Facades\Pulse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:project-list|project-create|project-edit|project-delete'], ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:project-list'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:project-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:project-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:project-delete'], ['only' => ['destroy']]);
    }

    function index(){
        $totalProjects = Project::count();
        $completeStatus = Project::where('status_id','3')->count();
        $pendingStatus = Project::where('status_id','2')->count();
        $processStatus = Project::where('status_id','1')->count();
        $data = DB::table('projects')
        ->join('project_status', 'status_id', '=', 'project_status.id')
        ->join('customers', 'customer_id', '=', 'customers.id')
        ->join('users', 'assistant_id', '=', 'users.id')
        ->select('projects.*','project_status.status','customers.cus_id','customers.name'/*,'users.name' */)
        ->orderByRaw('id , start_date ASC')
        ->get();
        return view('projects.index', compact('data','totalProjects','completeStatus','pendingStatus','processStatus'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('project.create', compact('permission'));
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }
}
