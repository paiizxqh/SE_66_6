<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:user-list|user-create|user-edit|user-delete'], ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:user-list'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:user-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:user-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:user-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //$data = User::latest()->paginate(5);
        $data = User::orderBy('employee_id', 'ASC')->get();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('users.index', compact('data'));
    }

    public function create()
    {
        // ดึง employee_id ที่มีค่ามากที่สุดจากฐานข้อมูล
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
        $roles = Role::pluck('name', 'name')->all();

        // ส่ง employee_id ใหม่และรายการบทบาทไปยังหน้าสร้างผู้ใช้
        return view('users.create', compact('newEmployeeId', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[^\d]+$/',
            'employee_id' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password|min:8',
            'roles' => 'required'
        ], [
            'name.regex' => 'The name field must not contain any numbers.',
            'password.min' => 'The password must be at least 8 characters.'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[^\d]+$/',
            'employee_id' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password|min:8',
            'roles' => 'required'
        ], [
            'name.regex' => 'The name field must not contain any numbers.',
            'password.min' => 'The password must be at least 8 characters.'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
