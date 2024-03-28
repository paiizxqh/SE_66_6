<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Support\Facades\Storage;
use Laravel\Pulse\Facades\Pulse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
    function __construct(){
        $this->middleware(['permission:project-list|project-create|project-edit|project-delete'], ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:project-list'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:project-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:project-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:project-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = 'Delete Project!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

            // ตรวจสอบว่าผู้ใช้มีสิทธิ์ในการดูโครงการทั้งหมดหรือไม่
        if (auth()->user()->can('view-all-projects')) {
            // ดึงข้อมูลโครงการทั้งหมด
            $project = Project::paginate(5);
        } elseif (auth()->user()->can('view-assigned-projects')) {
            // ผู้ใช้มีสิทธิ์ดูเฉพาะโครงการที่เข้าร่วม
            $project = Auth::user()->projects()->paginate(50);
        } else {
            // ผู้ใช้มีสิทธิ์เฉพาะในการดูโครงการที่เสร็จสิ้นเท่านั้น
            $project = Project::where('status_id', 3)->paginate(50);
        }

        // คำนวณข้อมูลสถิติอื่น ๆ
        $totalProject = Project::count();
        $totalStatus = Status::all();

        // สร้าง array เพื่อเก็บจำนวนโครงการตามสถานะ
        $projectCounts = [];
        foreach ($totalStatus as $status) {
            $projectCounts[$status->name] = Project::where('status_id', $status->id)->count();
        }
        

        // คืนค่าข้อมูลไปยังหน้าจอ
        return view('projects.index', compact('project', 'totalProject', 'totalStatus', 'projectCounts'));
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

    public function show($id){
        $project = Project::findOrFail($id);
        return view('projects.detail', compact('project'));
    }


    public function create(){
        $project = Project::all();
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
