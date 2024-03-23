<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Laravel\Pulse\Facades\Pulse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function __construct(){
        $this->middleware(['permission:project-list|project-create|project-edit|project-delete'], ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:project-list'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:project-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:project-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:project-delete'], ['only' => ['destroy']]);
    }

    function index(Request $request){
        $sort = $request->input('sort', 'start_date');

    // ตรวจสอบว่าค่า sort ที่ถูกส่งมาถูกต้องหรือไม่
    $validSortOptions = ['start_date', 'status'];
    if (!in_array($sort, $validSortOptions)) {
        // ในกรณีที่ค่า sort ไม่ถูกต้อง กำหนดให้เรียงตามวันที่เป็นค่าเริ่มต้น
        $sort = 'start_date';
    }
        $totalProjects = Project::count();
        $completeStatus = Project::where('status_id','3')->count();
        $pendingStatus = Project::where('status_id','2')->count();
        $processStatus = Project::where('status_id','1')->count();
        $data = DB::table('projects')
        ->join('project_status', 'status_id', '=', 'project_status.id')
        ->join('customers', 'customer_id', '=', 'customers.id')
        ->join('users', 'assistant_id', '=', 'users.id')
        ->select('projects.*','project_status.status','customers.cus_id','customers.name'/*,'users.name' */)
        //->orderByRaw('start_date, project_status.status')
        ->paginate(10);
        /* ->get(); -- ถ้าจะใช้ paginate(0) ต้องเอาบรรทัดนี้ออกด้วย */
        return view('projects.index', compact('data','totalProjects','completeStatus','pendingStatus','processStatus'));
    }

    function search(Request $request){
        $search = $request->input('search');

        $data = Project::join('project_status', 'projects.status_id', '=', 'project_status.id')
                        ->join('customers', 'projects.customer_id', '=', 'customers.id')
                        ->select('projects.*', 'project_status.status', 'customers.cus_id', 'customers.name')
                        ->where('customers.cus_id', 'LIKE', '%' . $search . '%')
                        ->orWhere('customers.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('projects.start_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('project_status.status', 'LIKE', '%' . $search . '%')
                        ->paginate(10);

        // ตรวจสอบว่ามีข้อมูลที่ตรงกับการค้นหาหรือไม่
        $search_matched = $data->count() > 0;

        // ส่งข้อมูลไปยังหน้า index พร้อมกับค่า search_matched
        return view('projects.index', compact('data', 'search_matched'));
    }

    function show($id){
        $project = Project::findOrFail($id);
        $data = Project::join('project_status', 'projects.status_id', '=', 'project_status.id')
                        ->join('customers', 'projects.customer_id', '=', 'customers.id')
                        ->select('projects.*', 'project_status.status', 'customers.cus_id', 'customers.name')
                        ->where('customers.cus_id', 'LIKE', '%' . $search . '%')
                        ->orWhere('customers.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('projects.start_date', 'LIKE', '%' . $search . '%')
                        ->orWhere('project_status.status', 'LIKE', '%' . $search . '%')
                        ->paginate(10);
        return view('projects.show', compact('data', 'project'));
    }

}
