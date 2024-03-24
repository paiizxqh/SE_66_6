@section('title', 'รายละเอียดโครงการ')
<x-app-layout>
    <x-slot name="header">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายละเอียดโครงการ</h2>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/detail.css') }}" rel="stylesheet">
    </x-slot>

    <body>
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                {{-- @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">ข้อมูลโครงการสำหรับลูกค้า</div>
                        <div class="card-body">
                            @can('project-edit')
                                <form action="{{ url('projects/create') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="small mb-1">ชื่อลูกค้า</label>
                                        <input class="form-control" name="customer-name" type="text"
                                            placeholder="กรอกชื่อลูกค้า">
                                        @error('customer-name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1">ที่อยู่</label>
                                        <input class="form-control" name="address" type="text" placeholder="กรอกที่อยู่">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1">เบอร์โทรศัพท์</label>
                                        <input class="form-control" name="phonenumber" type="text"
                                            placeholder="กรอกเบอร์โทรศัพท์">
                                        @error('phonenumber')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1">ชื่อผู้ติดต่อ</label>
                                        <input class="form-control" name="customers_contact_name" type="text"
                                            placeholder="กรอกชื่อผู้ติดต่อ">
                                        @error('customers_contact_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1">เบอร์ผู้ติดต่อ</label>
                                        <input class="form-control" name="customers_contact_phone" type="text"
                                            placeholder="กรอกเบอร์ผู้ติดต่อ">
                                        @error('customers_contact_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1">แผนที่จุดเก็บ</label>
                                        <div class="input-group">
                                            <input type="file" name="map" class="form-control">
                                            @error('map')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">ข้อมูลโครงการสำหรับบริษัท</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1">รหัสโครงการ</label>
                                    <input class="form-control" type="project-id" placeholder="กรอกรหัสโครงการ">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">รหัสลูกค้า</label>
                                    <input class="form-control" type="customer-id" placeholder="กรอกรหัสลูกค้า">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">วันที่เริ่มโครงการ</label>
                                    <input class="form-control" type="start-date" placeholder="กรอกวันที่เริ่มโครงการ">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">วันนัดตรวจ</label>
                                    <input class="form-control" type="sample-date" placeholder="กรอกวันนัดตรวจ">
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
                                        {{-- @foreach ($project as $projects) --}}
                                        <tr>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td><span class="badge bg-light text-dark">Pending</span></td>
                                            {{-- <td><span class="badge bg-success">Paid</span></td> --}}
                                        </tr>
                                        {{-- @endforeach --}}
                                    @endcan
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 mb-5 pull-right">
                    <a href="{{ url('projects') }}" class="btn btn-primary" type="button">ย้อนกลับ</a>
                    <button class="btn btn-primary">ยืนยัน</button>
                </div>
            @endcan
        </div>
    </body>
</x-app-layout>
