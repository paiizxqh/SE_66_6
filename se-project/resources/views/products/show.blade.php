@section('title', 'คลังอุปกรณ์')
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
                    <h2>เพิ่มจำนวนอุปกรณ์</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('products.index') }}">ย้อนกลับ</a>
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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 mb-3 text-center">
                    <div class="form-group">
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" alt="Product Image" style="max-width: 100px; display: inline-block;">
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>รายการอุปกรณ์:</strong>
                        <input type="text" value="{{ $product->name }} {{ $product->description }}" name="name" class="form-control"
                            placeholder="รายการอุปกรณ์" readonly>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>จำนวนอุปกรณ์คงเหลือ:</strong>
                        <input type="text" value="{{ $product->remain }}" name="remain" class="form-control"
                            placeholder="จำนวนคงเหลือ"readonly>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>เพิ่มจำนวนอุปกรณ์:</strong>
                        <input type="text" name="add" class="form-control"
                            placeholder="จำนวนเติมสต๊อก">
                    </div>
                </div>
                <div class="col-xs-12 mb-3 text-center">
                    <button class="btn btn-primary">ยืนยัน</button>
                </div>
            </div>
        </form>
        @include('sweetalert::alert')
    </div>
</x-app-layout>
