@section('title', 'รายการโครงการ')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายการโครงการ</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </x-slot>

    <body>
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
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

                <div class="candidate-list-widgets mb-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- แบบฟอร์มค้นหา -->
                            <form {{-- action="{{ route('projects.search') }}" method="GET" --}}>
                            {{-- <form {{-- action="{{ route('projects.search') }}" method="GET" >
                            <div class="row mb-4">
                                <div class="col">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="ค้นหาที่นี่ ...">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary btn--s btn--inline">ค้นหา</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('projects.create') }}"
                                        class="btn btn-success btn--s btn--inline">เพิ่มโครงการ</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">เลือกสถานะ</option>
                                    <option value="1">กำลังดำเนินการ</option>
                                    <option value="2">ยังไม่ดำเนินการ</option>
                                    <option value="3">ดำเนินการเสร็จสิ้น</option>
                                </select>
                            </div>
                            </form> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive project-list">
                                                <div class="col-md-2 pull-right">
                                                    <a href="{{ route('projects.create') }}"
                                                        class="btn btn-success btn--s btn--inline">เพิ่มโครงการ</a>
                                                </div>
                                                <table class="table project-table table-centered table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">รหัสลูกค้า</th>
                                                            <th scope="col">ชื่อลูกค้า</th>
                                                            <th scope="col">วันที่เริ่มโครงการ</th>
                                                            <th scope="col">สถานะ</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($data as $projects)
                                                            <tr>
                                                                <td>{{ $projects->cus_id }}</td>
                                                                <td>
                                                                    <div class="team">
                                                                        <a href="javascript:void(0);"
                                                                            class="team-member" data-toggle="tooltip"
                                                                            data-placement="top" title="Reggie James">
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
                                                                {{-- Buttone Delete for Manager --}}
                                                                @can('ManagerRole')
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('projects.destroy', $projects->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a href="{{ route('projects.destroy', $projects->id) }}"
                                                                                class="btn btn-danger"
                                                                                data-confirm-delete="true">ลบ</a>
                                                                        </form>
                                                                    </td>
                                                                @endcan
                                                                {{-- Buttone Delete for Developer --}}
                                                                @can('DeveloperRole')
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('projects.destroy', $projects->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a href="{{ route('projects.destroy', $projects->id) }}"
                                                                                class="btn btn-danger"
                                                                                data-confirm-delete="true">ลบ</a>
                                                                        </form>
                                                                    </td>
                                                                @endcan
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5">ไม่พบข้อมูล</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
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
            </div>
        </div>
    </body>
    @include('sweetalert::alert')
</x-app-layout>
