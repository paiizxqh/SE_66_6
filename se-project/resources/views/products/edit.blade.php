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
                    <h2>แก้ไขรายการอุปกรณ์</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back </a>
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

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>ภาพ</strong>
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" value="{{ $product->name }}" name="name" class="form-control"
                            placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" value="{{ $product->description }}" name="description" class="form-control"
                            placeholder="Description">
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
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
