@section('title', 'รายละเอียดโครงการ')
<x-app-layout>
    <x-slot name="header">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายละเอียดโครงการ</h2>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/detail.css') }}" rel="stylesheet">
    </x-slot>

    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">ข้อมูลโครงการสำหรับลูกค้า</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="small mb-1">ชื่อลูกค้า</label>
                                <input class="form-control" type="name" placeholder="กรอกชื่อลูกค้า">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">ที่อยู่</label>
                                <input class="form-control" type="address" placeholder="กรอกที่อยู่">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">เบอร์โทรศัพท์</label>
                                <input class="form-control" type="name" placeholder="กรอกเบอร์โทรศัพท์">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">ชื่อผู้ติดต่อ</label>
                                <input class="form-control" type="name" placeholder="กรอกชื่อผู้ติดต่อ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">เบอร์ผู้ติดต่อ</label>
                                <input class="form-control" type="name" placeholder="กรอกเบอร์ผู้ติดต่อ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">แผนที่จุดเก็บ</label>
                                <div class="input-group">
                                    <input type="file" class="form-control">
                                    <button class="btn btn-outline-secondary" type="button">อัพโหลดไฟล์</button>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">ข้อมูลโครงการสำหรับบริษัท</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="small mb-1">รหัสโครงการ</label>
                                <input class="form-control" type="name" placeholder="กรอกรหัสโครงการ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">รหัสลูกค้า</label>
                                <input class="form-control" type="name" placeholder="กรอกรหัสลูกค้า">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันที่เริ่มโครงการ</label>
                                <input class="form-control" type="name" placeholder="กรอกวันที่เริ่มโครงการ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันนัดตรวจ</label>
                                <input class="form-control" type="name" placeholder="กรอกวันนัดตรวจ">
                            </div>
                            <div class="mb-3">
                                <div class="card">
                                    <div class="d-flex card-header justify-content-between">
                                        <h5 class="me-3 mb-0">รายชื่อผู้รับผิดชอบโครงการ</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item pt-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                            alt="" class="avatar rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">นางสาวอรกัญญา ชัยทัพ</h6>
                                                        <p class="mb-0 text-muted">Computer Engineering</p>
                                                    </div>
                                                    <div class="flex-shrink-0 text-end">
                                                        <span>
                                                            ตำแหน่ง Query มานะงับเตง
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">ตารางแสดงรายละเอียด</div>
            <div class="card-body p-0">
                <div class="table-responsive table-billing-history">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="border-gray-200" scope="col">รหัสตัวอย่าง</th>
                                <th class="border-gray-200" scope="col">จุดเก็บ</th>
                                <th class="border-gray-200" scope="col">พารามิเตอร์</th>
                                <th class="border-gray-200" scope="col">วันที่/เวลาเก็บตัวอย่าง</th>
                                {{-- <th class="border-gray-200" scope="col">เวลาที่เก็บตัวอย่าง</th> --}}
                                <th class="border-gray-200" scope="col">ค่าพารามิเตอร์</th>
                                <th class="border-gray-200" scope="col">ชื่อผู้เก็บตัวอย่าง</th>
                                <th class="border-gray-200" scope="col">ชื่อผู้ทดลอง</th>
                                <th class="border-gray-200" scope="col">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('project-create')
                                @foreach ($project as $projects)
                                    <tr>
                                        <td>{{ $projects->parameter_id }}</td>
                                        <td>{{ $projects->checkpoint_number }}</td>
                                        <td>{{ $projects->parameter_shortname }}</td>
                                        <td>{{ $projects->sample_date_time }}</td>
                                        <td>{{ $projects->sample_value }}</td>
                                        <td>{{ $projects->surveyor.name }}</td>
                                        <td>{{ $projects->name }}</td>
                                        <td><span class="badge bg-light text-dark">Pending</span></td>
                                        <td><span class="badge bg-success">Paid</span></td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </body>
</x-app-layout>
