<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ParameterInCheckpoint;
use App\Models\Parameter;
use App\Models\Checkpoint;

class DetailController extends Controller
{

    public function index(Request $request)
    {
        $projectId = 1;
        $parameters = Parameter::all();
        $project = Project::findOrFail($projectId);

        // Retrieve customers
        $customers = Customer::where('id', $project->customer_id)->firstOrFail();

        // Fetch checkpoints and parameters associated with each checkpoint
        $checkpoints = Checkpoint::where('projects_id', $projectId)->get();
       
        $checkpointsIds = [];// กำหนดให้ $a เป็นอาร์เรย์เปล่าๆ
        foreach ($checkpoints as $checkpoint) {
            $checkpointsIds[$checkpoint->id] = $checkpoint->id; // กำหนดค่าของอาร์เรย์ $a โดยใช้ checkpoint->id เป็นคีย์และค่า
        }
        $parameterInCheckpoints = ParameterInCheckpoint::whereIn('checkpoint_id', $checkpointsIds)->get();

        // $parametersInCheckpoints = // กำหนดให้ $parametersInCheckpoints เป็นอาร์เรย์เพื่อเก็บข้อมูล ParameterInCheckpoint ของแต่ละ checkpoint
        // Get the latest sample ID
        $latestSample = ParameterInCheckpoint::orderBy('sample_id', 'DESC')->first();

        if ($latestSample) {
            $newSampleId = 'SMP' . str_pad((intval(substr($latestSample->sample_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $newSampleId = 'SMP001';
        }

        return view('detail.detail', compact('customers', 'project', 'parameters', 'newSampleId', 'checkpoints','parameterInCheckpoints'));
    }

    public function update(Request $request, $id)
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
        return redirect()->route('detail.index');
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
        return redirect()->route('detail.index');
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


    public function destroy($id,$checkpoint_id)
    {
        ParameterInCheckpoint::find($id)->delete();
        Checkpoint::find($checkpoint_id)->delete();

        return redirect()->route('detail.index')
            ->with('success', 'checkpoint deleted successfully');
    }
}
