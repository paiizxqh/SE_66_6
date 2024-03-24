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
                    <h2>แก้ไขข้อมูลพนักงาน</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('users.index') }}">ย้อนกลับ</a>
                </div>
            </div>
        </div>


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


        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รหัสพนักงาน:</strong>
                        <input type="text" value="{{ $user->employee_id }}" name="employee_id" class="form-control"
                            placeholder="รหัสพนักงาน" readonly>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>ชื่อ-สกุล:</strong>
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                            placeholder="ชื่อ-สกุล">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                            placeholder="Email">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รหัสผ่าน:</strong>
                        <input type="password" name="password" value="{{ $user->password }}" class="form-control"
                            placeholder="รหัสผ่าน">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>ยืนยันรหัสผ่าน:</strong>
                        <input type="password" name="confirm-password" value="{{ $user->password }}"
                            class="form-control" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Role:</strong>
                        <select class="form-control multiple" multiple name="roles[]">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-xs-12 mb-3 text-center">
                    <button class="btn btn-primary">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
