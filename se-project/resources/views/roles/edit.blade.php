@section('title', 'บทบาทพนักงาน')
<x-app-layout>
    <x-slot name="head">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </x-slot>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>แก้ไขข้อมูลบทบาท</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">ย้อนกลับ</a>
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

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>บทบาทพนักงาน:</strong>
                        <input type="text" value="{{ $role->name }}" name="name" class="form-control"
                            placeholder="บทบาทพนักงาน">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รายการอนุญาต:</strong>
                        <br />
                        <div class="row">
                            @php
                                $permissionTypes = ['user', 'role', 'project', 'product', 'customer', 'team'];
                            @endphp

                            @foreach ($permissionTypes as $type)
                                <div class="col-md-2">
                                    @foreach ($permission as $value)
                                        @if (strpos($value->name, $type) !== false)
                                            <label>
                                                <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif
                                                    name="permission[]" value="{{ $value->name }}" class="name">
                                                {{ $value->name }}</label>
                                            </label><br />
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
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
