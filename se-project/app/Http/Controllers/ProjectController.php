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

    /* function search(Request $request){
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
    } */

    /* function show($id){
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
    } */

    public function create(){
        $project = Project::all();
            /* dd($project); */
             /* // ดึง employee_id ที่มีค่ามากที่สุดจากฐานข้อมูล
        $latestEmployee = User::orderBy('employee_id', 'DESC')->first();

        // ตรวจสอบว่ามี employee_id ในฐานข้อมูลหรือไม่
        if ($latestEmployee) {
            // สร้าง employee_id ใหม่โดยเพิ่มค่าขึ้น 1 จาก employee_id ที่มีค่ามากที่สุด
            $newEmployeeId = 'EMP' . str_pad((intval(substr($latestEmployee->employee_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            // ถ้าไม่มี employee_id ในฐานข้อมูล ให้เริ่มต้นด้วย 'EMP001'
            $newEmployeeId = 'EMP001';
        }

        // ดึงรายการบทบาททั้งหมดเพื่อใช้ในการสร้างผู้ใช้ใหม่
        $roles = Role::pluck('name', 'name')->all(); */
        return view('projects.detail', compact('project'));
    }

    public function store(Request $request){
        $request->validate([
            // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
            'customer-name' => 'required|string',
            'address' => 'required|string',
            'phonenumber' => 'required|string',
            'customers_contact_name' => 'required|string',
            'customers_contact_phone' => 'required|string',
            /* 'map' => 'required|file', // สำหรับไฟล์แผนที่ */
            'map' => 'required|file|mimes:jpg,jpeg,png,pdf',

        ],[
            'project_id.required' => 'The project ID field is required.',
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date format.',
            'area_date.required' => 'The area date field is required.',
            'area_date.date' => 'The area date must be a valid date format.',
            'map.required' => 'The map field is required.',
            'customers_contact_name.required' => 'The customers contact name field is required.',
            'customers_contact_phone.required' => 'The customers contact phone field is required.',
        ]);

        // สร้างโครงการใหม่และบันทึกข้อมูลลงในฐานข้อมูล
        $project = new Project();
        $project->customer_name = $request->input('customer-name');
        $project->address = $request->input('address');
        $project->phonenumber = $request->input('phonenumber');
        $project->customers_contact_name = $request->input('customers_contact_name');
        $project->customers_contact_phone = $request->input('customers_contact_phone');

        // การจัดเก็บไฟล์อาจต้องใช้เทคนิคอื่น เช่น Storage
        if ($request->hasFile('map')) {
            $file = $request->file('map');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('maps', $fileName); // บันทึกไฟล์ลงใน storage/maps โดยใช้ชื่อที่กำหนด
            $project->map = $fileName; // บันทึกชื่อไฟล์ลงในฐานข้อมูล
        }

        $project->save(); // บันทึกโครงการใหม่
        /* dd($request->all()); */
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    public function destroy($id){
        $project = Project::findOrFail($id); // ค้นหาโครงการตาม ID ที่ระบุ

        // ทำการลบไฟล์แผนที่ (ถ้ามี)
        if (!empty($project->map)) {
            Storage::delete('maps/' . $project->map);
        }

        // ทำการลบโครงการ
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
