@section('title', 'รายการโครงการ')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายการโครงการ</h2>
        <link rel="stylesheet" href="{{ asset('assets/css/project.css') }}">
        <script src="{{ asset('assets/js/project.js') }}"></script>
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
                            <form action="{{ route('projects.search') }}" method="GET">
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="ค้นหาที่นี่ ...">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn--s btn--inline">ค้นหา</button>
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
                            </form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive project-list">
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
                                                                <td>
                                                                    <div class="action">
                                                                        <!-- ปุ่มแก้ไข -->
                                                                        <a href="#"
                                                                            class="text-success mr-4 edit-modal-btn"
                                                                            data-toggle="modal"
                                                                            data-target="#editModal{{ $projects->id }}">
                                                                            <i class="fa fa-pencil h5 m-0"></i>
                                                                        </a>
                                                                        <!-- ปุ่มลบ -->
                                                                        <a href="#"
                                                                            class="text-danger delete-modal-btn"
                                                                            data-toggle="modal"
                                                                            data-target="#deleteModal{{ $projects->id }}">
                                                                            <i class="fa fa-remove h5 m-0"></i>
                                                                        </a>

                                                                    </div>

                                                                    <!-- แก้ไขโมดัล -->
                                                                    <div class="modal fade"
                                                                        id="editModal{{ $projects->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="editModalLabel{{ $projects->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="editModalLabel{{ $projects->id }}">
                                                                                        แก้ไขโครงการ</h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <!-- ส่วนเนื้อหาแก้ไข -->
                                                                                    <!-- ใส่ฟอร์มแก้ไขโครงการไว้ที่นี่ -->
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">ยกเลิก</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-primary">บันทึกการแก้ไข</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- ลบโมดัล -->
                                                                    <div class="modal fade"
                                                                        id="deleteModal{{ $projects->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="deleteModalLabel{{ $projects->id }}"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="deleteModalLabel{{ $projects->id }}">
                                                                                        ลบโครงการ</h5>
                                                                                    <button type="button"
                                                                                        class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <!-- ส่วนเนื้อหาลบ -->
                                                                                    <p>คุณแน่ใจหรือไม่ที่ต้องการลบโครงการนี้?
                                                                                    </p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">ยกเลิก</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-danger">ลบโครงการ</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
</x-app-layout>
<script>
    // เมื่อเอกสารโหลดเสร็จสมบูรณ์
    $(document).ready(function() {
        // เมื่อคลิกที่ปุ่มแก้ไข
        $('.edit-modal-btn').click(function() {
            var target = $(this).data('target');
            $(target).modal('show');
        });

        // เมื่อคลิกที่ปุ่มลบ
        $('.delete-modal-btn').click(function() {
            var target = $(this).data('target');
            $(target).modal('show');
        });
    });
</script>
