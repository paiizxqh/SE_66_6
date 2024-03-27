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
                    <h2>เพิ่มข้อมูลพนักงาน</h2>
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

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">รหัสพนักงาน:</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control"
                placeholder="รหัสพนักงาน" value="{{ $newEmployeeId }}">         
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ-สกุล:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อ-สกุล">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน">
            </div>

            <div class="mb-3">
                <label for="confirm-password" class="form-label">ยืนยันรหัสผ่าน:</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control"
                    placeholder="ยืนยันรหัสผ่าน">
            </div>

            <div class="mb-3">
                <label for="roles" class="form-label">บทบาทพนักงาน:</label>
                <select id="roles" class="form-control multiple" multiple name="roles[]">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach

                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-primary">ยืนยัน</button>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
