<x-app-layout>
    <x-slot name="head">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
        </script>
        <link rel ="stylesheet"
            href ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel ="stylesheet"
            href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </x-slot>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb mb-4">
                <div class="pull-left">
                    <h2>เพิ่มข้อมูลลูกค้ารายใหม่</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
                </div>
            </div>
        </div>

        {{-- @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="cus_id" class="form-label">รหัสลูกค้า:</label>
                <input type="text" name="cus_id" value="{{ $nextCustomerId }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="ชื่อลูกค้า">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">เบอร์โทรศัพท์:</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="เบอร์โทรศัพท์">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่:</label>
                <input type="textarea" name="address" class="form-control" placeholder="ที่อยู่">
            </div>

            <div class="mb-3">
                <label for="regis_date" class="form-label">วันที่ลงทะเบียน:</label>
                <div class="input-group date" id="regis_date">
                    <input type="date" name="regis_date" class="form-control" />
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
