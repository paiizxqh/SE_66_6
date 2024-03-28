
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
                        <form method="POST" action="{{ route('update', ['id' => $project->id]) }}" enctype="multipart/form-data">
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
                                    <input type="file" name="map" class="form-control" placeholder="Upload image">
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
                        <form method="POST" action="{{ route('update2', ['id' => $project->id]) }}" enctype="multipart/form-data"> 
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
                                    placeholder="กรอกรหัสลูกค้า"value={{ $project->customer_id}} name="customer_id">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันที่เริ่มโครงการ</label>
                                <input class="form-control" type="date"
                                    placeholder="กรอกวันที่เริ่มโครงการ"value={{ $project->start_date}}
                                    name="start_date">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">วันนัดตรวจ</label>
                                <input class="form-control" type="date"
                                    placeholder="กรอกวันนัดตรวจ"value={{ $project->area_date}} name="area_date">
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
                            <button class="btn btn-primary" type="submit">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">ตารางแสดงรายละเอียด</div>
            <div class="card-body p-0">
                <div class="table-responsive table-billing-history">
                    <form method="POST" action="{{route('createCheckpoint',['id' => $project->id]) }}" enctype="multipart/form-data">
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
                                <th><button class="btn btn-primary btn-add-row" type="button"
                                        name="add">add</button></th>
                            </tr>
                        </thead>
                        <tbody>
                                <td>
                                    <input class="form-control " type="name" placeholder="กรอกรหัสตัวอย่าง"
                                        name="sample_id[]" value={{$newSampleId}} >
                                </td>
                                <td>
                                    <input class="form-control" type="int" placeholder="กรอกจุดเก็บ"
                                        name="number[]" value=1>
                                </td>
                                <td>
                                    <select class="form-control" aria-label="Default select example" name="parameter_id[]">
                                        <option selected>select parameter</option>
                                        @foreach ($parameters as $parameter)
                                            <option value="{{$parameter->id}}">
                                                {{$parameter->parameter_shortname}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" type="datetime-local"
                                        placeholder="เลือกวันที่/เวลาเก็บตัวอย่าง" name="sample_date_time[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name" placeholder="กรอกค่าพารามิเตอร์"
                                        name="sample_value[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name"
                                        placeholder="กรอกชื่อผู้เก็บตัวอย่าง"name="surveyor_id[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name"
                                        placeholder="กรอกชื่อผู้ทดลอง"name="academician_id[]">
                                </td>
                                <td>
                                    <input class="form-control" type="name"
                                        placeholder="กรอกหมายเหตุ"name="remark[]">
                                </td>
                        </tbody>
                    </table>
                    <button class="btn btn-primary mb-1" type="submit">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var i = 1;
            $(document).ready(function() {
                $('button[name="add"]').click(function() {
                    var newSampleId = '{{ $newSampleId }}';
                    newSampleId = 'SMP' + ('000' + (parseInt(newSampleId.substring(3)) + i)).slice(-3);
                    ++i;
                    $('table  tbody').append(
                        `<tr>
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
                                            <option value="{{$parameter->id}}">
                                                {{$parameter->parameter_shortname}}</option>
                                        @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="form-control" type="datetime-local" placeholder="เลือกวันที่/เวลาเก็บตัวอย่าง"name="sample_date_time[]">
                            </td>
                            <td>
                                <input class="form-control" type="name" placeholder="กรอกค่าพารามิเตอร์"name="sample_value[]">
                            </td>
                            <td>
                                <input class="form-control" type="name" placeholder="กรอกชื่อผู้เก็บตัวอย่าง" name="surveyor_id[]">
                            </td>
                            <td>
                                <input class="form-control" type="name" placeholder="กรอกชื่อผู้ทดลอง"name="academician_id[]">
                            </td>
                            <td>
                                <input class="form-control" type="name" placeholder="กรอกหมายเหตุ"placeholder="กรอกหมายเหตุ"name="remark[]">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </td>
                        </tr>`
                    );
                    
                });
            });

            $(document).on('click','.remove-row', function() { 
                $(this).parents('tr').remove();
                --i;
            });
        </script>
    </div>

    </body>

</x-app-layout>
