@section('title', 'แสดงข้อมูลโครงการ(ค้นหา)')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายละเอียดโครงการ</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
    </x-slot>

    <body>
        <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive project-list">
                                    <table class="table project-table table-centered table-nowrap">
                                        <tbody>
                                            <tr>
                                                <th scope="row">รหัสลูกค้า</th>
                                                <td>{{ $project->cus_id }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ชื่อลูกค้า</th>
                                                <td>{{ $project->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">วันที่เริ่มโครงการ</th>
                                                <td>{{ $project->start_date }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">สถานะ</th>
                                                <td>
                                                    @php
                                                        $statusId = $project->status_id;
                                                        $statusText = $project->status;
                                                        $buttonClass = '';

                                                        switch ($statusId) {
                                                            case 1:
                                                                $buttonClass = 'btn-warning'; // สีเหลืองสำหรับ "กำลังดำเนินการ"
                                                                break;
                                                            case 2:
                                                                $buttonClass = 'btn-danger'; // สีแดงสำหรับ "ยังไม่ดำเนินการ"
                                                                break;
                                                            case 3:
                                                                $buttonClass = 'btn-success'; // สีเขียวสำหรับ "ดำเนินการเสร็จสิ้น"
                                                                break;
                                                            default:
                                                                $buttonClass = 'btn-secondary'; // สีเทาสำหรับสถานะอื่นๆ
                                                                break;
                                                        }
                                                    @endphp
                                                    <button class="btn {{ $buttonClass }}">{{ $statusText }}</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
