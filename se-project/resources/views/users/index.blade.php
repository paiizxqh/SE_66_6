@section('title', 'ข้อมูลพนักงาน')
<x-app-layout>
    <x-slot name="head">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </x-slot>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>ข้อมูลพนักงาน</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('users.create') }}">เพิ่มข้อมูลพนักงาน</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success my-2">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อ-สกุล</th>
                <th>Email</th>
                <th>บทบาทพนักงาน</th>
                <th width="280px"> </th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ $user->employee_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge badge-secondary text-dark">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">รายละเอียด</a>
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">แก้ไข</a>
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger" data-confirm-delete="true">ลบ</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
