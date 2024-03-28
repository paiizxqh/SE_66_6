@section('title', 'เพิ่มโครงการ')
<x-app-layout>
    <x-slot name="header">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">เพิ่มโครงการ</h2>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/detail.css') }}" rel="stylesheet">
    </x-slot>

    <body>
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">ข้อมูลโครงการสำหรับลูกค้า</div>
                        <div class="card-body">
                            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="small mb-1" for="customer_name">ชื่อลูกค้า</label>
                                    <input class="form-control" name="customer_name" id="customer_name" type="text"
                                        disabled>
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="address">ที่อยู่</label>
                                    <input class="form-control" name="address" id="address" type="text" disabled>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="phonenumber">เบอร์โทรศัพท์</label>
                                    <input class="form-control" name="phonenumber" id="phonenumber" type="text"
                                        disabled>
                                    @error('phonenumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="customers-contact-name">ชื่อผู้ติดต่อ</label>
                                    <input class="form-control" name="customers_contact_name"
                                        id="customers-contact-name" type="text" placeholder="กรอกชื่อผู้ติดต่อ">
                                    @error('customers_contact_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="customers-contact-phone">เบอร์ผู้ติดต่อ</label>
                                    <input class="form-control" name="customers_contact_phone"
                                        id="customers-contact-phone" type="text" placeholder="กรอกเบอร์ผู้ติดต่อ">
                                    @error('customers_contact_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="map">แผนที่จุดเก็บ</label>
                                    <div class="input-group">
                                        <input type="file" name="map" id="map" class="form-control"
                                            accept=".jpg, .jpeg, .png, .pdf">
                                        @error('map')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- เพิ่มส่วนของข้อมูลโครงการสำหรับบริษัท หรือส่วนอื่น ๆ ตามที่ต้องการ -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">ข้อมูลโครงการสำหรับบริษัท</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="project_id">รหัสโครงการ</label>
                                <input class="form-control" id="project_id" name="project_id" type="text"
                                    value="{{ $newProjectId }}" placeholder="กรอกรหัสโครงการ" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="customer_id">รหัสลูกค้า</label>
                                <select class="form-select" id="customer_id" name="customer_id">
                                    <option selected disabled>กรุณาเลือกลูกค้า</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->cus_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="start_date">วันที่เริ่มโครงการ</label>
                                <input class="form-control" id="start_date" name="start_date" type="date"
                                    placeholder="กรอกวันที่เริ่มโครงการ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="area_date">วันนัดตรวจ</label>
                                <input class="form-control" id="area_date" name="area_date" type="date"
                                    placeholder="กรอกวันนัดตรวจ">
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
                                                        <p class="mb-0 text-muted">วิศวกรรมคอมพิวเตอร์</p>
                                                    </div>
                                                    <div class="flex-shrink-0 text-end">
                                                        <span>ตำแหน่ง Query มานะงับเตง</span>
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
            <div class="col-xs-12 mb-5 pull-right">
                <a href="{{ url('projects.indedx') }}" class="btn btn-primary" type="button">ย้อนกลับ</a>
                <button href="{{ url('projects.store') }}" class="btn btn-primary" type="submit">บันทึก</button>
            </div>
            </form>
        </div>
    </body>
    @include('sweetalert::alert')
</x-app-layout>
