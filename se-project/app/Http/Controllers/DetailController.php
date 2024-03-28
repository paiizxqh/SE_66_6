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
        $projectId = 1; // Change this to the appropriate project ID
        $parameters = Parameter::all();
        $project = Project::findOrFail($projectId);

        // Retrieve customers
        $customers = Customer::where('id', $project->customer_id)->firstOrFail();


        // Fetch checkpoints and parameters associated with each checkpoint
        $checkpoints = Checkpoint::where('projects_id', $projectId)->get();
        $parametersInCheckpoint = [];
 
        #$parametersInCheckpoint = ParameterInCheckpoint::where('checkpoint_id',$checkpoint->id)->get();


        // Get the latest sample ID
        $latestSample = ParameterInCheckpoint::orderBy('sample_id', 'DESC')->first();
        if ($latestSample) {
            $newSampleId = 'SMP' . str_pad((intval(substr($latestSample->sample_id, 3)) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $newSampleId = 'SMP001';
        }

        return view('detail.detail', compact('customers', 'project', 'parameters', 'newSampleId', 'checkpoints', 'parametersInCheckpoint'));
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
}
