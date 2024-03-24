@section('title', 'บทบาทพนักงาน')
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
                    <h2>บทบาทพนักงาน</h2>
                </div>
                <div class="pull-right">
                    @can('role-create')
                        <a class="btn btn-success" href="{{ route('roles.create') }}">เพิ่มข้อมูลบทบาท</a>
                    @endcan
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-striped table-hover">
            <tr>
                <th>บทบาทพนักงาน</th>
                <th width="280px"> </th>
            </tr>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">รายละเอียด</a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">แก้ไข</a>
                            @endcan

                            @csrf
                            @method('DELETE')
                            <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-danger" data-confirm-delete="true">ลบ</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $roles->render() !!}
    </div>
    @include('sweetalert::alert')

</x-app-layout>
