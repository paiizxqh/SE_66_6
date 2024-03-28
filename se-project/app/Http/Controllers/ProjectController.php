<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\Parameter;
use App\Models\Customer;
use App\Models\ParameterInCheckpoint;
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

    public function index(Request $request){
        $title = 'Delete Project!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

            // ตรวจสอบว่าผู้ใช้มีสิทธิ์ในการดูโครงการทั้งหมดหรือไม่
        if (auth()->user()->can('DeveloperRole') || auth()->user()->can('ManagerRole') || auth()->user()->can('SalesRole')) {
            // ดึงข้อมูลโครงการทั้งหมด
            $project = Project::paginate(5);
        } else {
            // ผู้ใช้ทั่วไปเห็นเฉพาะโครงการที่มีสถานะดำเนินการเสร็จสิ้น
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

    public function show($id){
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function create(){
        $parameters = Parameter::all();
        // ดึง SMP ตัวล่าสุด
        $latestSample = ParameterInCheckpoint::orderBy('sample_id', 'DESC')->first();

        if ($latestSample) {
            $newSampleId = 'SMP' . str_pad((intval(substr($latestSample->sample_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $newSampleId = 'SMP001';
        }

        // ดึงโครงการล่าสุด
        $latestProject = Project::orderBy('project_id', 'DESC')->first();

        // ตรวจสอบว่ามีโครงการล่าสุดหรือไม่
        $latestProjectId = $latestProject ? $latestProject->project_id : null;

        if ($latestProject) {
        // สร้างรหัสโครงการใหม่โดยเพิ่มค่าจากโครงการล่าสุด
            $newProjectId = 'PJ' . str_pad((intval(substr($latestProject->project_id, 2)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $newProjectId = 'PJ001';
        }

        // ดึงข้อมูลลูกค้าจากตาราง Customer
        $customers = Customer::all();

        return view('projects.create', compact('newSampleId', 'newProjectId', 'customers', 'parameters'));
    }

    public function store(Request $request){
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
        dd($request);
        $request->validate([
            'project_id' => 'required|string',
            'customers_contact_name' => 'required|string',
            'customers_contact_phone' => 'required|string',
            'map' => 'nullable|image|mimes:jpg,jpeg,png,pdf',
            'customer_id' => 'required',
            'start_date' => 'required|date',
            'area_date ' => 'required|date',
        ], [
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date format.',
            'area_date.required' => 'The area date field is required.',
            'area_date.date' => 'The area date must be a valid date format.',
            'customers_contact_name.required' => 'The customers contact name field is required.',
            'customers_contact_phone.required' => 'The customers contact phone field is required.',
        ]);

        $project = new Project();
        $project->project_id = $request->project_id;
        $project->customers_contact_name = $request->customers_contact_name;
        $project->customers_contact_phone = $request->customers_contact_phone;
        $project->customer_id = $request->customer_id;
        $project->start_date = $request->start_date;
        $project->area_date = $request->area_date;
        if ($request->has('map')) {
            $image = $request->file('map');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/maps/';
            $image->move($path, $filename);
            $inventory->map =  $path . $filename;
        }

        $projects->save();

/*         // สร้างโครงการใหม่และบันทึกข้อมูลลงในฐานข้อมูล
        $project = Project::create([
            'project_id' => $request->input('project_id'),
            'customer_name' => $request->input('customer_name'),
            'address' => $request->input('address'),
            'phonenumber' => $request->input('phonenumber'),
            'customers_contact_name' => $request->input('customers_contact_name'),
            'customers_contact_phone' => $request->input('customers_contact_phone'),
            'status_id' => 2, // กำหนดสถานะโครงการเป็น "ยังไม่ดำเนินการ"
            'customer_id' => $request->input('customer_id'),
            'start_date' => $request->input('start_date'), // เพิ่มบรรทัดนี้
            'area_date' => $request->input('area_date'), // เพิ่มบรรทัดนี้
        ]);

        // บันทึกไฟล์แผนที่
        if ($request->hasFile('map')) {
            $fileName = time() . '_' . $request->file('map')->getClientOriginalName();
            $request->file('map')->storeAs('maps', $fileName);
            $project->map = $fileName;
            $project->save();
        }
        dd($request); */
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    public function destroy($id){
        $title = 'Delete Project!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

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
