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
                    <h2>เพิ่มข้อมูลบทบาท</h2>
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

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>บทบาทพนักงาน</strong>
                        <input type="text" name="name" class="form-control" placeholder="บทบาทพนักงาน">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>รายการอนุญาต:</strong>
                        <br />
                        <div class="row">
                            <div class="col-md-2">
                                @foreach ($permission as $value)
                                    @if (strpos($value->name, 'user') !== false)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                class="name">
                                            {{ $value->name }}
                                        </label><br />
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-2">
                                @foreach ($permission as $value)
                                    @if (strpos($value->name, 'role') !== false)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                class="name">
                                            {{ $value->name }}
                                        </label><br />
                                    @endif
                                @endforeach
                            </div>

                            <div class="col-md-2">
                                @foreach ($permission as $value)
                                    @if (strpos($value->name, 'project') !== false)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                class="name">
                                            {{ $value->name }}
                                        </label><br />
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-2">
                                @foreach ($permission as $value)
                                    @if (strpos($value->name, 'product') !== false)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                class="name">
                                            {{ $value->name }}
                                        </label><br />
                                    @endif
                                @endforeach
                                <br />
                            </div>
                            <div class="col-md-2">
                                @foreach ($permission as $value)
                                    @if (strpos($value->name, 'customer') !== false)
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->name }}"
                                                class="name">
                                            {{ $value->name }}
                                        </label><br />
                                    @endif
                                @endforeach
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button class="btn btn-primary">ยืนยัน</button>
                </div>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
