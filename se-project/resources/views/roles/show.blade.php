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
                    <h2>ข้อมูลบทบาท</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">ย้อนกลับ</a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>บทบาทพนักงาน:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>รายการอนุญาต:</strong>
                    @if (!empty($rolePermissions))
                        @foreach ($rolePermissions as $v)
                            <label class="label label-secondary text-dark">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
