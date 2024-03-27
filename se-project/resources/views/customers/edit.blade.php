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
                    <h2>แก้ไขข้อมูลลูกค้า</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
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


        <form action="{{ route('customers.update', $customers->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รหัสลูกค้า:</strong>{{ $customers->cus_id }}
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>ชื่อ:</strong>
                        <input type="text" value="{{ $customers->name }}" name="name" class="form-control"
                            placeholder="ชื่อ">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>เบอร์โทรศัพท์:</strong>
                        <input type="text" name="phone" value="{{ $customers->phone }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>ที่อยู่:</strong>
                        <input type="textarea" name="address" value="{{ $customers->address }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>วันที่ลงทะเบียน:</strong>
                        <input type="date" name="regis_date" id="regis_date" value="{{ $customers->regis_date }}" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 mb-3 text-center">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
