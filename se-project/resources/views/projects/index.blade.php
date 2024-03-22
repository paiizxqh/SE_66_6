@section('title', 'รายการโครงการ')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายชื่อโครงการ</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
    </x-slot>

    <body>
        <div class="py-12">
            <div class="container">
                <div class="row">
                    {{-- @foreach ($data as $projects) --}}
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-archive text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1">{{ $totalProjects }}
                                </h5>
                                <p class="text-muted mb-0">โครงการทั้งหมด</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-th text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1">{{ $completeStatus }}</h5>
                                <p class="text-muted mb-0">โครงการที่เสร็จสิ้น</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-file text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1">{{ $pendingStatus }}</h5>
                                <p class="text-muted mb-0">โครงการที่ยังไม่ดำเนินการ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-file text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1">{{ $processStatus }}</h5>
                                <p class="text-muted mb-0">โครงการที่กำลังดำเนินการ</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('projects.search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="ค้นหา..."
                                        aria-label="ค้นหา..." aria-describedby="button-search">
                                    <button class="btn btn-primary" type="submit" id="button-search">ค้นหา</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive project-list">
                                        <table class="table project-table table-centered table-nowrap">
                                            <thead>
                                                <tr>
                                                    {{-- <th scope="col">ลำดับที่</th> --}}
                                                    <th scope="col">รหัสลูกค้า</th>
                                                    <th scope="col">ชื่อลูกค้า</th>
                                                    <th scope="col">วันที่เริ่มโครงการ</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($data->count() > 0)
                                                    @foreach ($data as $projects)
                                                        <tr>
                                                            <td>{{ $projects->cus_id }}</td>
                                                            <td>
                                                                <div class="team">
                                                                    <a href="javascript:void(0);" class="team-member"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Reggie James">
                                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                                            class="rounded-circle avatar-xs"
                                                                            alt="" />{{ $projects->name }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>{{ $projects->start_date }}</td>
                                                            <td>
                                                                @php
                                                                    $statusId = $projects->status_id;
                                                                    $statusText = $projects->status;
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
                                                                <button
                                                                    class="btn {{ $buttonClass }}">{{ $statusText }}</button>
                                                            </td>
                                                            <td>
                                                                <div class="action">
                                                                    <a href="#" class="text-success mr-4"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Edit">
                                                                        <i class="fa fa-pencil h5 m-0"></i>
                                                                    </a>
                                                                    <a href="#" class="text-danger"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Close">
                                                                        <i class="fa fa-remove h5 m-0"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <!-- แสดงข้อความว่าไม่พบข้อมูล -->
                                                    <tr>
                                                        <td colspan="5">ไม่พบข้อมูล</td>
                                                    </tr>
                                                @endif
                                            </tbody>


                                            {{-- <tbody>
                                                @foreach ($data as $projects)
                                                    @if (isset($projects->search_matched) && $projects->search_matched)
                                                        <tr>                                            <td>{{ $projects->cus_id }}</td>
                                            <td>
                                                <div class="team">
                                                    <a href="javascript: void(0);" class="team-member"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Reggie James">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                            class="rounded-circle avatar-xs"
                                                            alt="" />{{ $projects->name }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $projects->start_date }}</td>
                                            <td>
                                                @php
                                                    $statusId = $projects->status_id;
                                                    $statusText = $projects->status;
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

                                            <td>
                                                <div class="action">
                                                    <a href="#" class="text-success mr-4" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil h5 m-0"></i></a>
                                                    <a href="#" class="text-danger" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Close">
                                                        <i class="fa fa-remove h5 m-0"></i></a>
                                                </div>
                                            </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            </tbody> --}}

                                            {{-- <tbody>
                                                @foreach ($data as $projects)
                                                    <tr>
                                                        <td>{{ $projects->cus_id }}</td>
                                                        <td>
                                                            <div class="team">
                                                                <a href="javascript: void(0);" class="team-member"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="" data-original-title="Reggie James">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                                        class="rounded-circle avatar-xs"
                                                                        alt="" />{{ $projects->name }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $projects->start_date }}</td>
                                                        <td>
                                                            @php
                                                                $statusId = $projects->status_id;
                                                                $statusText = $projects->status;
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
                                                            <button
                                                                class="btn {{ $buttonClass }}">{{ $statusText }}</button>
                                                        </td>
                                                        {{-- ต้นแบบ
                                                            <td>
                                                            <span class="text-success font-12"><i
                                                                    class="mdi mdi-checkbox-blank-circle mr-1"></i>
                                                                {{ $projects->status }}</span>
                                                        </td>
                                            <td>
                                                <div class="action">
                                                    <a href="#" class="text-success mr-4" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil h5 m-0"></i></a>
                                                    <a href="#" class="text-danger" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Close">
                                                        <i class="fa fa-remove h5 m-0"></i></a>
                                                </div>
                                            </td>
                                            </tr>
                                            @endforeach
                                            </tbody> --}}
                                        </table>
                                    </div>

                                    <!-- end project-list pagination -->
                                    <div class="pt-3">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{ $data->links('pagination::bootstrap-5') }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
