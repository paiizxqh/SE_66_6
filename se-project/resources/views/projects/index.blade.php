@section('title', 'รายการโครงการ')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายการโครงการ</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
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
                            <h5 class="font-size-20 mt-0 pt-1">{{ $totalProject }}</h5>
                            <p class="text-muted mb-0">โครงการทั้งหมด</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pattern">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-archive text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1">{{ $projectCounts['ดำเนินการเสร็จสิ้น'] }}</h5>
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
                            <h5 class="font-size-20 mt-0 pt-1">{{ $projectCounts['ยังไม่ดำเนินการ'] }}</h5>
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
                            <h5 class="font-size-20 mt-0 pt-1">{{ $projectCounts['กำลังดำเนินการ'] }}</h5>
                            <p class="text-muted mb-0">โครงการที่กำลังดำเนินการ</p>
                        </div>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="candidate-list-widgets mb-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-md-12 text-end">
                                                <a href="{{ route('projects.create') }}"
                                                    class="btn btn-success btn-sm">เพิ่มโครงการ</a>
                                            </div>
                                        </div>
                                        <table class="table project-table table-centered table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 20%">รหัสลูกค้า</th>
                                                    <th scope="col" style="width: 20%">ชื่อลูกค้า</th>
                                                    <th scope="col" style="width: 20%">วันที่เริ่มโครงการ</th>
                                                    <th scope="col" style="width: 20%">สถานะ</th>
                                                    <th scope="col" style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($project as $projects)
                                                    <tr>
                                                        <td>{{ $projects->customer->cus_id }}</td>
                                                        <td>
                                                            <div class="team">
                                                                <a href="{{ route('projects.show', $projects->id) }}"
                                                                    class="team-member" data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    title="{{ $projects->customer->name }}">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                                        class="rounded-circle avatar-xs"
                                                                        alt="" />{{ $projects->customer->name }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $projects->start_date }}</td>
                                                        <td>
                                                            @if ($projects->status_id == 1)
                                                                <span class="badge btn-warning">กำลังดำเนินการ</span>
                                                            @elseif ($projects->status_id == 2)
                                                                <span class="badge btn-danger">ยังไม่ดำเนินการ</span>
                                                            @elseif ($projects->status_id == 3)
                                                                <span
                                                                    class="badge btn-success">ดำเนินการเสร็จสิ้น</span>
                                                            @endif
                                                        <td>
                                                            <form
                                                                action="{{ route('projects.destroy', $projects->id) }}"
                                                                method="POST">
                                                                @can('ManagerRole')
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm"
                                                                        data-confirm-delete="true">
                                                                        <i class="fa fa-trash"></i> ลบ
                                                                    </button>
                                                                @endcan
                                                                <a href="{{ route('projects.show', $projects->id) }}"
                                                                    class="btn btn-primary btn-sm">
                                                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                                                    รายละเอียด
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">ไม่พบข้อมูล</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="pt-3">
                                        <ul class="pagination justify-content-end mb-0">
                                            {{ $project->links('pagination::bootstrap-5') }}
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
    @include('sweetalert::alert')
</x-app-layout>
