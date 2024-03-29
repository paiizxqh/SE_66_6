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
                    <h2>ข้อมูลลูกค้า:</h2>
                    {{ $customers->cus_id }}
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>รหัสลูกค้า:</strong>{{ $customers->cus_id }}
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ชื่อ:</strong>
                    {{ $customers->name }}
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>ที่อยู่:</strong>
                    {{ $customers->address }}
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>วันที่ลงทะเบียน:</strong>
                    {{ $customers->regis_date }}
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>เบอร์โทรศัพท์:</strong>
                    {{ $customers->phone }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
