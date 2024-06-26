@php
  
@endphp
@section('title', 'รายละเอียดโครงการ')
<x-app-layout>
    <x-slot name="header">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายละเอียดโครงการ</h2>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/detail.css') }}" rel="stylesheet">
    </x-slot>
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-6">
                @can('NOAcademicianRole')
                    <div class="card mb-4">
                        <div class="card-header">ข้อมูลโครงการสำหรับลูกค้า</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update1', ['id' => $project->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label class="small mb-1">ชื่อลูกค้า</label>
                                    <input class="form-control" type="text" name="customers_contact_name"
                                        placeholder="กรอกชื่อลูกค้า" value="{{ $customers->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">ที่อยู่</label>
                                    <input class="form-control" type="text" name="address" placeholder="กรอกที่อยู่"
                                        value="{{ $customers->address }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">เบอร์โทรศัพท์</label>
                                    <input class="form-control" type="text" name="phone"
                                        placeholder="กรอกเบอร์โทรศัพท์"value="{{ $customers->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">ชื่อผู้ติดต่อ</label>
                                    <input class="form-control" type="text" name="customers_contact_name"
                                        placeholder="กรอกชื่อผู้ติดต่อ" value={{ $project->customers_contact_name }}>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">เบอร์ผู้ติดต่อ</label>
                                    <input class="form-control" type="numberic" name="customers_contact_phone"
                                        placeholder="กรอกเบอร์ผู้ติดต่อ"value={{ $project->customers_contact_phone }}>
                                </div>
                                <div class="col-xs-12 mb-3">
                                    <div class="form-group">
                                        <strong>แผนที่จุดเก็บ</strong>
                                        <input type="file" name="map" class="form-control"
                                            placeholder="Upload image">
                                        @if ($project->map)
                                            <div class="text-center mt-3">
                                                <img src="{{ asset($project->map) }}" class="rounded" alt="project map">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">บันทึก</button>
                            </form>
                        </div>
                    </div>
                @endcan
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">ข้อมูลโครงการสำหรับบริษัท</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update2', ['id' => $project->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="small mb-1">รหัสโครงการ</label>
                                <input class="form-control" type="name" placeholder="กรอกรหัสโครงการ"
                                    value={{ $project->project_id }} name="project_id">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">รหัสลูกค้า</label>
                                <input class="form-control" type="bigint"
                                    placeholder="กรอกรหัสลูกค้า"value={{ $project->customer_id }} name="customer_id">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันที่เริ่มโครงการ</label>
                                <input class="form-control" type="date"
                                    placeholder="กรอกวันที่เริ่มโครงการ"value={{ $project->start_date }}
                                    name="start_date">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันนัดตรวจ</label>
                                <input class="form-control" type="date"
                                    placeholder="กรอกวันนัดตรวจ"value={{ $project->area_date }} name="area_date">
                            </div>
                            <button class="btn btn-primary mb-2" type="submit">บันทึก</button>
                        </form>
                        <div class="mb-3">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between">
                                    <h5 class="me-3 mb-0">ผู้รับผิดชอบโครงการ</h5>
                                </div>

                            </div>
                        </div>
                        <form method="GET" action="{{ route('manage', ['id' => $project->id]) }}"
                            enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{ $project->id }}">
                            @csrf
                            @method('POST')
                            <button class="btn btn-primary mb-1" type="submit">เลือกทีม</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">ตารางแสดงรายละเอียด</div>
            <div class="card-body p-0">
                <div class="table-responsive table-billing-history">
                    <form method="POST" action="{{ route('update3', ['id' => $project->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <table class="table mb-0" name="ff">
                            <thead>
                                <tr>
                                    <th class="border-gray-200" scope="col">รหัสตัวอย่าง</th>
                                    <th class="border-gray-200" scope="col">จุดเก็บ</th>
                                    <th class="border-gray-200" scope="col">พารามิเตอร์</th>
                                    <th class="border-gray-200" scope="col">วันที่/เวลาเก็บตัวอย่าง</th>
                                    <th class="border-gray-200" scope="col">ค่าพารามิเตอร์</th>
                                    <th class="border-gray-200" scope="col">ชื่อผู้เก็บตัวอย่าง</th>
                                    <th class="border-gray-200" scope="col">ชื่อผู้ทดลอง</th>
                                    <th class="border-gray-200" scope="col">หมายเหตุ</th>
                                    <th class="border-gray-200" scope="col">บันทึก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parameterInCheckpoints as $pic)
                                    @can('NOAcademicianRole')
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" placeholder="รหัสตัวอย่าง"
                                                    name="id"value="{{ $pic->id }}" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="จุดเก็บ"
                                                    name="number"
                                                    value="{{ $checkpoints->where('id', $pic->checkpoint_id)->first()->number }}"
                                                    disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="พารามิเตอร์"
                                                    name="parameter"
                                                    value="{{ $parameters->where('id', $pic->parameter_id)->first()->parameter_shortname }}"disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="datetime-local"
                                                    placeholder="วันที่/เวลาเก็บตัวอย่าง" name="sample_date_time"
                                                    value="{{ $pic->sample_date_time }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="ค่าพารามิเตอร์"
                                                    name="sample_value" value="{{ $pic->sample_value }}">
                                            </td>
                                            <td>
                                                <select class="form-control" aria-label="Default select example"
                                                    name="surveyor_id">
                                                    <option selected>select surveyor</option>
                                                    @foreach ($surveyor as $member)
                                                        <option value="{{ $member->user_id }}">
                                                            {{ $member->employee_id }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" aria-label="Default select example"
                                                    name="academician_id">
                                                    <option selected>select academician</option>
                                                    @foreach ($academician as $member)
                                                        <option value="{{ $member->user_id }}">
                                                            {{ $member->employee_id }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="หมายเหตุ"
                                                    name="remark" value="{{ $pic->remark }}">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary mb-2" type="submit">บันทึก</button>
                                            </td>


                                            {{-- <td>
                                                <form
                                                    action="{{ route('projects.destroyPIC', ['id' => $pic->id, 'checkpoint_id' => $checkpoints->where('id', $pic->checkpoint_id)->first()->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">ลบ</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endcan

                                    @can('AcademicianRole')
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" placeholder="รหัสตัวอย่าง"
                                                    name="sample_id[]" value="{{ $pic->sample_id }}" disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="จุดเก็บ"
                                                    name="number[]"
                                                    value="{{ $checkpoints->where('id', $pic->checkpoint_id)->first()->number }}"
                                                    disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="พารามิเตอร์"
                                                    name="parameter[]"
                                                    value="{{ $parameters->where('id', $pic->parameter_id)->first()->parameter_shortname }}"disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text"
                                                    placeholder="วันที่/เวลาเก็บตัวอย่าง" name="sample_date_time[]"
                                                    value="{{ $pic->sample_date_time }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="ค่าพารามิเตอร์"
                                                    name="sample_value[]" value="{{ $pic->sample_value }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text"
                                                    placeholder="ชื่อผู้เก็บตัวอย่าง" name="surveyor_id[]"
                                                    value="{{ $pic->surveyor_id }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="ชื่อผู้ทดลอง"
                                                    name="academician_id[]" value="{{ $pic->academician_id }}">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="หมายเหตุ"
                                                    name="remark[]" value="{{ $pic->remark }}">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary mb-2" type="submit">บันทึก</button>
                                            </td>

                                        </tr>
                                    @endcan
                                @endforeach

                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                // ให้ลบแถวที่ปุ่ม "ลบ" อยู่หน้าตาราง
                $(document).on('click', '.remove-row', function() {
                    $(this).closest('tr').remove();
                });
            });
        </script>
    </div>

    </body>

</x-app-layout>
