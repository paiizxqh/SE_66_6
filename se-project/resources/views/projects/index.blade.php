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
                    {{-- @foreach ($data as $detail) --}}
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

                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="form-group mb-0">
                                    {{-- <div class="col-lg-6">
                                        <div class="selection-widget">
                                            <select class="form-select" data-trigger="true"
                                                name="choices-single-filter-orderby" id="choices-single-filter-orderby"
                                                aria-label="Default select example">
                                                <option value="df">Default</option>
                                                <option value="ne">Newest</option>
                                                <option value="od">Oldest</option>
                                                <option value="rd">Random</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <label>Search</label>
                                    {{-- <div class="input-group mb-0">
                                        <input type="text" class="form-control" placeholder="Search..."
                                            aria-describedby="project-search-addon" />
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" id="project-search-addon"><i
                                                    class="fa fa-search search-icon font-12"></i></button>
                                        </div>
                                    </div> --}}
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
                                                    <th scope="col">ลำดับที่</th>
                                                    <th scope="col">รหัสลูกค้า</th>
                                                    <th scope="col">ชื่อลูกค้า</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col">วันที่เริ่มโครงการ</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $detail)
                                                    <tr>
                                                        <th scope="row">{{ $detail->id }}</th>
                                                        <td>{{ $detail->cus_id }}</td>
                                                        <td>
                                                            <div class="team">
                                                                <a href="javascript: void(0);" class="team-member"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="" data-original-title="Reggie James">
                                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                                        class="rounded-circle avatar-xs"
                                                                        alt="" />{{ $detail->name }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-success font-12"><i
                                                                    class="mdi mdi-checkbox-blank-circle mr-1"></i>
                                                                {{ $detail->status }}</span>
                                                        </td>
                                                        <td>{{ $detail->start_date }}</td>
                                                        {{-- <td>
                                                            <p class="mb-0">Progress<span
                                                                    class="float-right">100%</span>
                                                            </p>
                                                            <div class="progress mt-2" style="height: 5px;">
                                                                <div class="progress-bar bg-success"
                                                                    role="progressbar" style="width: 100%;"
                                                                    aria-valuenow="100" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </td> --}}
                                                        <td>
                                                            <div class="action">
                                                                <a href="#" class="text-success mr-4"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="" data-original-title="Edit"> <i
                                                                        class="fa fa-pencil h5 m-0"></i></a>
                                                                <a href="#" class="text-danger"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="" data-original-title="Close"> <i
                                                                        class="fa fa-remove h5 m-0"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end project-list -->

                                    <div class="pt-3">
                                        <ul class="pagination justify-content-end mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="/home" tabindex="-1"
                                                    aria-disabled="true">ย้อนกลับ</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="/project">1</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="/inventory">2</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="/inventory">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="/home">ถัดไป</a>
                                            </li>
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
