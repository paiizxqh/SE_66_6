<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:customer-list|user-create|user-edit|user-delete'], ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware(['permission:customer-list'], ['only' => ['index']]);
        $this->middleware(['permission:customer-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:customer-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:customer-delete'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        
        $data=DB::table('customers')->get();
        return view('customers.index',compact('data'));
    }

    public function create()
    {
        $latestCustomer = DB::table('customers')->max('cus_id');
        if (!$latestCustomer) {
            $nextCustomerId = 'C67001';
        } else {
            // ดึงตัวเลขจากรหัสลูกค้าล่าสุดและเพิ่มค่าไปอีก 1
            $latestCustomerIdNumber = intval(substr($latestCustomer, 1)); // ตัดอักขระ 'C' และแปลงเป็นจำนวนเต็ม
            $nextCustomerIdNumber = $latestCustomerIdNumber + 1;
    
            // สร้างรหัสลูกค้าใหม่โดยเพิ่มเลขที่ได้ไปยังตัวอักษร 'C'
            $nextCustomerId = 'C' . str_pad($nextCustomerIdNumber, 5, '0', STR_PAD_LEFT);
        }
        return view('customers.create', ['nextCustomerId' => $nextCustomerId]);
    }

public function store(Request $request)
{
    // ตรวจสอบและ validate ข้อมูล
    $validatedData = $request->validate([
        'cus_id' => 'required|unique:customers',
        'name' => 'required|numeric', 
        'address' => 'required',
        'phone' => 'required',
        'regis_date' => 'required|date', // กำหนดให้ 'regis_date' เป็นวันที่
    ]);

    // ดึงค่า 'regis_date' จาก $request
    $regis_date = Carbon::parse($request->regis_date)->toDateString();

    // สร้างข้อมูลที่จะบันทึกลงในฐานข้อมูล
    $input = $request->except('_token');
    $input['regis_date'] = $regis_date;

    // บันทึกข้อมูลลงในฐานข้อมูล
    DB::table('customers')->insert($input);

    // ส่งกลับไปยังหน้าแสดงรายการลูกค้าพร้อมกับข้อความแจ้งเตือน
    return redirect()->route('customers.index')->with('success', 'สร้างข้อมูลลูกค้าเรียบร้อยแล้ว');
}


    public function show($id)
    {
        $customers = DB::table('customers')->where('id',$id)->first();
        return view('customers.show', compact('customers'));
    }

    public function edit($id)
    {
        $customers = DB::table('customers')->where('id',$id)->first();
        return view('customers.edit', compact('customers'));
    }

    public function update(Request $request, $id)
{
    // ตรวจสอบและ validate ข้อมูล
    $validatedData = $request->validate([
        'name' => 'required', 
        'address' => 'required',
        'phone' => 'required',
        'regis_date' => 'required',
    ]);
    
    // สร้างตัวแปร customer โดยใช้คำสั่ง SQL เพื่อค้นหาข้อมูลของลูกค้า
    $customer = DB::table('customers')->where('id', $id)->first();

    // ถ้าไม่พบข้อมูลลูกค้า ให้แสดงหน้า 404 Not Found
    if (!$customer) {
        abort(404); 
    }

    // ใช้คำสั่ง SQL เพื่ออัปเดตข้อมูลลูกค้าด้วยข้อมูลที่ถูก validate แล้ว
    DB::table('customers')->where('id', $id)->update($validatedData);

    // ส่งกลับไปยังหน้าแสดงรายการลูกค้าพร้อมกับข้อความแจ้งเตือนว่าอัปเดตข้อมูลเรียบร้อย
    return redirect()->route('customers.index')->with('success', 'อัปเดตข้อมูลลูกค้าเรียบร้อยแล้ว');
}

    public function destroy($id)
    {
        DB::table('customers')->where('id',$id)->delete();
        return redirect()->route('customers.index')->with('success', 'ลบข้อมูลลูกค้าเรียบร้อยแล้ว');
    }
}
