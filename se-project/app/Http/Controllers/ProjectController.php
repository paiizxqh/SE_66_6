<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use App\Models\ParameterInCheckpoint;
use App\Models\Checkpoint;
use App\Models\Parameter;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Laravel\Pulse\Facades\Pulse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



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

    public function index(Request $request){
        $title = 'Delete Project!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        // ตรวจสอบว่าผู้ใช้มีสิทธิ์ในการดูโครงการทั้งหมดหรือไม่
        if (auth()->user()->can('view-all-projects')) {
            // ตรวจสอบว่าผู้ใช้มีสิทธิ์ในการดูโครงการทั้งหมดหรือไม่
        if (auth()->user()->can('DeveloperRole') || auth()->user()->can('ManagerRole') || auth()->user()->can('SalesRole')) {
            // ดึงข้อมูลโครงการทั้งหมด
            $project = Project::paginate(5);
        } elseif (auth()->user()->can('view-assigned-projects')) {
            // ผู้ใช้มีสิทธิ์ดูเฉพาะโครงการที่เข้าร่วม
            $project = Auth::user()->project()->paginate(50);
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
}
    public function show($id){
        $parameters = Parameter::all();
        $project = Project::findOrFail($id);
        $customers = Customer::where('id', $project->customer_id)->firstOrFail();

        $checkpoints = Checkpoint::where('projects_id', $id)->get();

        $checkpointsIds = [];// กำหนดให้ $a เป็นอาร์เรย์เปล่าๆ
        foreach ($checkpoints as $checkpoint) {
            $checkpointsIds[$checkpoint->id] = $checkpoint->id; // กำหนดค่าของอาร์เรย์ $a โดยใช้ checkpoint->id เป็นคีย์และค่า
        }
        $parameterInCheckpoints = ParameterInCheckpoint::whereIn('checkpoint_id', $checkpointsIds)->get();

        return view('projects.detail', compact('project','customers','parameterInCheckpoints','checkpoints','parameters'));
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
        $latestProject = Project::orderBy('id', 'DESC')->first();
        // echo $latestProject;
        // ตรวจสอบว่ามีโครงการล่าสุดหรือไม่
        // $latestProjectId = $latestProject ? $latestProject->id : null;
        $PJ = 'PJ' . strval($latestProject->id + 1);
        // if ($latestProject) {
        // // สร้างรหัสโครงการใหม่โดยเพิ่มค่าจากโครงการล่าสุด
        //     $newProjectId = 'PJ' . str_pad((intval(substr($latestProject->id, 2)) + 1), 3, '0', STR_PAD_LEFT);
        // } else {
        //     $newProjectId = 'PJ001';
        // }

        // ดึงข้อมูลลูกค้าจากตาราง Customer
        $customers = Customer::all();
        // echo $newProjectId;
        return view('projects.create', compact('newSampleId', 'customers', 'parameters', 'latestProject','PJ'))
        ->with('success', 'Project created successfully');
    }

    public function store(Request $request){
    // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
    $request->validate([
        'customers_contact_name' => 'required|string',
        'customers_contact_phone' => 'required|string',
        'map' => 'required|image|mimes:jpg,jpeg,png,pdf',
        'customer_id' => 'required',
        'start_date' => 'required|date',
        'area_date' => 'required|date',
        'sample_id' => 'required|array',
        'number' => 'required|array',
        'parameter_id' => 'required|array',
        'sample_id.*' => 'required',
        'number.*' => 'required',
        'parameter_id.*' => 'required',
    ], [
        'start_date.required' => 'The start date field is required.',
        'start_date.date' => 'The start date must be a valid date format.',
        'area_date.required' => 'The area date field is required.',
        'area_date.date' => 'The area date must be a valid date format.',
        'customers_contact_name.required' => 'The customers contact name field is required.',
        'customers_contact_phone.required' => 'The customers contact phone field is required.',
        'sample_id.required' => 'The sample id field is required.',
        'number.required' => 'The number field is required.',
        'parameter_id.required' => 'The parameter id field is required.',
    ]);

    try {
        DB::beginTransaction();

        // บันทึกข้อมูลโครงการ
        $project = new Project();
        $lastProject = Project::orderBy('id', 'DESC')->first();
        $project->project_id = 'PJ' . strval($lastProject->id + 1);
        $project->customers_contact_name = $request->customers_contact_name;
        $project->customers_contact_phone = $request->customers_contact_phone;
        $project->customer_id = $request->customer_id;
        $project->start_date = $request->start_date;
        $project->area_date = $request->area_date;
        $project->status_id = 2; // กำหนดสถานะโครงการเป็น "ยังไม่ดำเนินการ"

        // ตรวจสอบว่ามีไฟล์แนบหรือไม่ก่อนทำการบันทึก
        if ($request->hasFile('map')) {
            $image = $request->file('map');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = 'images/maps/';
            $image->move($path, $filename);
            $project->map = $path . $filename;
        }

        $project->save();

        // บันทึกข้อมูลตัวอย่าง
        foreach ($request->sample_id as $index => $sample_id) {
            $checkpoint = new Checkpoint();
            $checkpoint->number = $request->number[$index];
            $checkpoint->projects_id = $project->id;
            $checkpoint->save();

            $parameterInCheckpoint = new ParameterInCheckpoint();
            $parameterInCheckpoint->sample_id = $sample_id;
            $parameterInCheckpoint->checkpoint_id = $checkpoint->id;
            $parameterInCheckpoint->parameter_id = $request->parameter_id[$index];
            $parameterInCheckpoint->save();
        }

        DB::commit();

            return redirect()->route('projects.index')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /* public function store(Request $request){
    // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
    $request->validate([
        'customers_contact_name' => 'required|string',
        'customers_contact_phone' => 'required|string',
        'map' => 'required|image|mimes:jpg,jpeg,png,pdf',
        'customer_id' => 'required',
        'start_date' => 'required|date',
        'area_date' => 'required|date',
    ], [
        'start_date.required' => 'The start date field is required.',
        'start_date.date' => 'The start date must be a valid date format.',
        'area_date.required' => 'The area date field is required.',
        'area_date.date' => 'The area date must be a valid date format.',
        'customers_contact_name.required' => 'The customers contact name field is required.',
        'customers_contact_phone.required' => 'The customers contact phone field is required.',
    ]);

    try {
        DB::beginTransaction();

        // บันทึกข้อมูลโครงการ
        $project = new Project();
        $last = Project::orderBy('id', 'DESC')->first();
        $project->project_id = 'PJ' . strval($last->id + 1); // ระบุค่า project_id ก่อนทำการบันทึก
        $project->customers_contact_name = $request->customers_contact_name;
        $project->customers_contact_phone = $request->customers_contact_phone;
        $project->customer_id = $request->customer_id;
        $project->start_date = $request->start_date;
        $project->area_date = $request->area_date;
        $project->status_id = 2; // กำหนดสถานะโครงการเป็น "ยังไม่ดำเนินการ"

        // ตรวจสอบว่ามีไฟล์แนบหรือไม่ก่อนทำการบันทึก
        if ($request->has('map')) {
            $image = $request->file('map');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/maps/';
            $image->move($path, $filename);
            $project->map =  $path . $filename;
        }
        $project->save();

        // บันทึกข้อมูลตัวอย่าง
        foreach ($request->sample_id as $index => $sample_id) {
            $checkpoint = new Checkpoint();
            $checkpoint->number = $request->number[$index];
            $checkpoint->projects_id = $project->id;
            $checkpoint->save();

            $parameterInCheckpoint = new ParameterInCheckpoint();
            $parameterInCheckpoint->sample_id = $sample_id;
            $parameterInCheckpoint->checkpoint_id = $checkpoint->id;
            $parameterInCheckpoint->parameter_id = $request->parameter_id[$index];
            $parameterInCheckpoint->save();
        }

            DB::commit();

            return redirect()->route('projects.index')->with('success', 'Project created successfully');
            } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    } */

    /* public function store(Request $request ){
        // ตรวจสอบความถูกต้องของข้อมูลที่ส่งมาจากแบบฟอร์ม
        // dd($request);
        $request->validate([
            'customers_contact_name' => 'required|string',
            'customers_contact_phone' => 'required|string',
            'map' => 'required|file|mimes:jpg,jpeg,png,pdf',

        ], [
            'project_id.required' => 'The project ID field is required.',
            'map' => 'required|image|mimes:jpg,jpeg,png,pdf',
            'customer_id' => 'required',
            'start_date' => 'required|date',
            'area_date' => 'required|date',
        ], [
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'The start date must be a valid date format.',
            'area_date.required' => 'The area date field is required.',
            'area_date.date' => 'The area date must be a valid date format.',
            'customers_contact_name.required' => 'The customers contact name field is required.',
            'customers_contact_phone.required' => 'The customers contact phone field is required.',
        ]);

        $project = new Project();
        $last = Project::orderBy('id', 'DESC')->first();
        echo $last->id;
        // $lastID = $last->id;
        $project->project_id = 'PJ' . strval($last->id + 1);
        // echo $project->project_id;
        $project->customers_contact_name = $request->customers_contact_name;
        $project->customers_contact_phone = $request->customers_contact_phone;
        $project->customer_id = $request->customer_id;
        $project->start_date = $request->start_date;
        $project->area_date = $request->area_date;
        $project->status_id = 2; // กำหนดสถานะโครงการเป็น "ยังไม่ดำเนินการ"
        if ($request->has('map')) {
            $image = $request->file('map');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/maps/';
            $image->move($path, $filename);
            $project->map =  $path . $filename;
        }

        $project->save();

        $this->validate($request, [
            'sample_id' => 'required|array',
            // 'sample_id.' => 'required',
            'number' => 'required|array',
            // 'number.' => 'required',
            'parameter_id' => 'required|array',
            'parameter_id.*' => 'required',
            'sample_date_time',
            'sample_value',
            'surveyor_id',
            'academician_id',
            'remark'
        ]);
        foreach ($request->sample_id as $index => $sample_id) {
            $checkpoint = new Checkpoint();
            $checkpoint->number = $request->number[$index];
            $checkpoint->projects_id = $project->id;
            $checkpoint->save();

            $parameterInCheckpoint = new ParameterInCheckpoint();
            $parameterInCheckpoint->sample_id = $sample_id;
            $parameterInCheckpoint->checkpoint_id = $checkpoint->id; // ใช้ primary key ของ Checkpoint ที่บันทึกไว้ในตาราง Checkpoints
            $parameterInCheckpoint->parameter_id = $request->parameter_id[$index];
            // $parameterInCheckpoint->sample_value = $request->sample_value[$index];
            // $parameterInCheckpoint->sample_date_time = $request->sample_date_time[$index];
            // $parameterInCheckpoint->surveyor_id =  $request->surveyor_id[$index];
            // $parameterInCheckpoint->academician_id = $request->academician_id[$index];
            // $parameterInCheckpoint->remark = $request->remark[$index];
            $parameterInCheckpoint->save();
        }
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    } */


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

    public function destroyPIC($id,$checkpoint_id)
    {
        ParameterInCheckpoint::find($id)->delete();
        Checkpoint::find($checkpoint_id)->delete();

        return redirect()->route('detail.index')
            ->with('success', 'checkpoint deleted successfully');
    }
    public function createCheckpoint(Request $request, $id)
    {
        $this->validate($request, [
            'sample_id' => 'required|array',
            'sample_id.*' => 'required',
            'number' => 'required|array',
            'number.*' => 'required',
            'parameter_id' => 'required|array',
            'parameter_id.*' => 'required',
            'sample_date_time',
            'sample_value',
            'surveyor_id',
            'academician_id',
            'remark'
        ]);

        foreach ($request->sample_id as $index => $sample_id) {
            $checkpoint = new Checkpoint();
            $checkpoint->number = $request->number[$index];
            $checkpoint->projects_id = $id;
            $checkpoint->save();

            $parameterInCheckpoint = new ParameterInCheckpoint();
            $parameterInCheckpoint->sample_id = $sample_id;
            $parameterInCheckpoint->checkpoint_id = $checkpoint->id; // ใช้ primary key ของ Checkpoint ที่บันทึกไว้ในตาราง Checkpoints
            $parameterInCheckpoint->parameter_id = $request->parameter_id[$index];
            $parameterInCheckpoint->sample_value = $request->sample_value[$index];
            $parameterInCheckpoint->sample_date_time = $request->sample_date_time[$index];
            $parameterInCheckpoint->surveyor_id =  $request->surveyor_id[$index];
            $parameterInCheckpoint->academician_id = $request->academician_id[$index];
            $parameterInCheckpoint->remark = $request->remark[$index];
            $parameterInCheckpoint->save();
        }
        return redirect()->route('detail.index');
    }

    public function update1(Request $request, $id)
    {
        $projects = Project::findOrFail($id);

        if ($request->map == null) {
            $this->validate($request, [
                'customers_contact_name',
                'customers_contact_phone',
            ]);
        } else {
            $this->validate($request, [
                'customers_contact_name',
                'customers_contact_phone',
                'map' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
            ]);
        }
        $projects->customers_contact_name = $request->customers_contact_name;
        $projects->customers_contact_phone = $request->customers_contact_phone;

        if ($request->map != null) {
            $projects->map = $request->map;
            if ($request->hasFile('map')) {
                $image = $request->file('map');
                $extension = $image->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'images/maps/';
                $image->move($path, $filename);
                $projects->map =  $path . $filename;
            }
        }
        $projects->save();
        return redirect()->route('projects.show',compact('id'));
    }

    public function update2(Request $request, $id)
    {
        $data = $request->only([
            'project_id',
            'start_date',
            'area_date',
            'customer_id',
        ]);

        $item = Project::findOrFail($id);
        $item->update($data);
        return redirect()->route('projects.show',compact('id'));
    }
}
