@section('title', 'เพิ่มโครงการ')
<x-app-layout>
    <x-slot name="header">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
                                id="projectForm">
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
                                    value="{{ $PJ }}" placeholder="กรอกรหัสโครงการ" disabled>
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
                            {{-- <div class="mb-3">
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
                            </div> --}}
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
                                    <th><button class="btn btn-primary btn-add-row" type="button"
                                            name="add">add</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>
                                    <input class="form-control " type="name" placeholder="กรอกรหัสตัวอย่าง"
                                        name="sample_id[]" value={{ $newSampleId }}>
                                </td>
                                <td>
                                    <input class="form-control" type="int" placeholder="กรอกจุดเก็บ"
                                        name="number[]" value=1>
                                </td>
                                <td>
                                    <select class="form-control" aria-label="Default select example"
                                        name="parameter_id[]">
                                        <option selected>select parameter</option>
                                        @foreach ($parameters as $parameter)
                                            <option value="{{ $parameter->id }}">
                                                {{ $parameter->parameter_shortname }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="datetime-local" disabled
                                        placeholder="เลือกวันที่/เวลาเก็บตัวอย่าง" name="sample_date_time[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name" placeholder="กรอกค่าพารามิเตอร์"
                                        disabled name="sample_value[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name" disabled
                                        placeholder="กรอกชื่อผู้เก็บตัวอย่าง"name="surveyor_id[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name" disabled
                                        placeholder="กรอกชื่อผู้ทดลอง"name="academician_id[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name" disabled
                                        placeholder="กรอกหมายเหตุ"name="remark[]">
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 mb-5 pull-right">
                <a href="{{ route('projects.index') }}" class="btn btn-primary" type="button">ย้อนกลับ</a>
                <button id="submitForm" class="btn btn-primary" type="button">บันทึก</button>
            </div>
            </form>
        </div>
    </body>
    <script>
        var i = 1;
        $(document).ready(function() {
            // สร้างแถวใหม่เมื่อคลิกที่ปุ่ม Add
            $('button[name="add"]').click(function() {
                var newSampleId = '{{ $newSampleId }}';
                newSampleId = 'SMP' + ('000' + (parseInt(newSampleId.substring(3)) + i)).slice(-3);
                ++i;
                var newRow = `<tr>
                    <td>
                        <input class="form-control" type="name" placeholder="กรอกรหัสตัวอย่าง" value='${newSampleId}'  name="sample_id[]">
                    </td>
                    <td>
                        <input class="form-control" type="int" placeholder="กรอกจุดเก็บ" value='${i}' name="number[]">
                    </td>
                    <td>
                        <select class="form-control" aria-label="Default select example" name="parameter_id[]">
                                <option selected>select parameter</option>
                                @foreach ($parameters as $parameter)
                                    <option value="{{ $parameter->id }}">
                                        {{ $parameter->parameter_shortname }}</option>
                                @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" type="datetime-local" placeholder="เลือกวันที่/เวลาเก็บตัวอย่าง" name="sample_date_time[]" disabled>
                    </td>
                    <td>
                        <input class="form-control" type="name" placeholder="กรอกค่าพารามิเตอร์" name="sample_value[]" disabled>
                    </td>
                    <td>
                        <input class="form-control" type="name" placeholder="กรอกชื่อผู้เก็บตัวอย่าง" name="surveyor_id[]" disabled>
                    </td>
                    <td>
                        <input class="form-control" type="name" placeholder="กรอกชื่อผู้ทดลอง" name="academician_id[]" disabled>
                    </td>
                    <td>
                        <input class="form-control" type="name" placeholder="กรอกหมายเหตุ" name="remark[]" disabled>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                    </td>
                </tr>`;
                $('table tbody').append(newRow);
                disableFieldsInLastRowExceptFirstThree
                    (); // เรียกใช้ฟังก์ชันเพื่อปิดการใช้งานฟิลด์ในแถวล่าสุด
                // ส่งข้อมูลในแถวใหม่ไปยังเซิร์ฟเวอร์เพื่อบันทึกลงในฐานข้อมูล
                var rowData = {
                    sample_id: newSampleId,
                    number: i,
                    parameter_id: $('select[name="parameter_id[]"]').last()
                        .val() // หาค่า parameter_id ของแถวใหม่ที่เพิ่งเพิ่ม
                    // เพิ่มฟิลด์อื่น ๆ ตามต้องการ...
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ url('projects.store') }}",
                    data: rowData,
                    success: function(response) {
                        // ถ้าสำเร็จในการบันทึกข้อมูล
                        alert('บันทึกข้อมูลสำเร็จ');
                        // เพิ่มโค้ดเพื่อรีโหลดหน้าหลังจากการเพิ่มโครงการอัพเดทล่าสุด
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // ถ้าเกิดข้อผิดพลาดในการบันทึกข้อมูล
                        alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                    }
                });

            });

            // ลบแถวเมื่อคลิกที่ปุ่ม Remove
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
                disableFieldsInLastRowExceptFirstThree();
                --i;
            });

            // ส่งข้อมูลเมื่อคลิกที่ปุ่ม Submit
            $('#submitForm').click(function() {
                $('#projectForm').submit();

            });

            // ฟังก์ชันเพื่อปิดการใช้งานฟิลด์ในแถวล่าสุด
            function disableFieldsInLastRowExceptFirstThree() {
                var lastRow = $('table tbody tr:last');
                lastRow.find('input, select').prop('disabled', true);
                lastRow.find(
                        'input[name="sample_id[]"], input[name="number[]"], select[name="parameter_id[]"]'
                    )
                    .prop('disabled', false);
            }
        });
    </script>
    @include('sweetalert::alert')
</x-app-layout>
