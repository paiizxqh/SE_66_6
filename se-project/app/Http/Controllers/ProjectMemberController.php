<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ,$id)
    {

        $project_members = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('project_members', 'project_members.user_id', '=', 'users.id')
            ->select('user_id', 'employee_id', 'roles.name as role', 'users.name as username', 'project_id')
            ->where('project_members.project_id', $id)
            ->orderBy('users.id', 'ASC')
            ->get();
        $depart_em = DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.id as user_id', 'employee_id', 'roles.name as role', 'users.name as username',)
            ->orderBy('users.id', 'ASC')
            ->get();
        return view('projectsmember.manage', compact('project_members', 'depart_em', 'id'));
    }

    public function handleFormSubmission(Request $request)
    {

        $selectedEmployees = $request->input('selectedEmployees');
        $id = $request->input('projectId');
        $employeeIds = [];
        $departmentNames = [];
        $notinem = [];
        $project_members = DB::table('users')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
    ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
    ->join('project_members', 'project_members.user_id', '=', 'users.id')
    ->select('user_id','employee_id', 'roles.name as role', 'users.name as username','project_id')
        ->where('project_members.project_id', $projectId)
        ->orderBy('users.id', 'ASC')
        ->get();

        foreach ($selectedEmployees as $employee) {
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('project_members', 'project_members.user_id', '=', 'users.id')
            ->select('user_id', 'employee_id', 'roles.name as role', 'users.name as username', 'project_id')
            ->where('project_members.project_id', $id)
            ->orderBy('users.id', 'ASC')
            ->get();

        foreach ($selectedEmployees as $employee) {
            $employeeIds[] = $employee['employeeId'];
            $departmentNames[] = $employee['departmentName'];
        }

        foreach ($project_members as $projectMember) {
            if ($projectMember->role != $departmentNames[0]) {
                $notinem[] = $projectMember->user_id;
            }
        }









        projectMember::where('project_id', $id)->whereNotIn('user_id', $employeeIds)
            ->delete();


        foreach ($employeeIds as $employee) {
            projectMember::updateOrInsert(
                ['project_id' => $id, 'user_id' =>  $employee]
            );
        }
        foreach ($notinem as $employee) {
            projectMember::updateOrInsert(
                ['project_id' => $id, 'user_id' =>  $employee]
            );
        }

    }
    public function test()
    {
        $id = DB::table('projects')->get();
        return view('projectsmember.test', compact('projectId'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(projectMember $projectMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(projectMember $projectMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(projectMember $projectMember)
    {
        //
    }
}
