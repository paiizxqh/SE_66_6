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
                    <h2>คลังอุปกรณ์</h2>
                </div>

                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> เพิ่มรายการอุปกรณ์ </a>
                </div>

            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-striped table-hover">
                <tr>
                    <th>ภาพ</th>
                    <th>รายการอุปกรณ์</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>หมวดหมู่</th>
                    <th> </th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->image) }}" alt="Product Image" style="max-width: 100px;">
                        </td>
                        <td>{{ $product->name }} {{ $product->description }}</td>
                        <td>
                            @if ($product->remain <= $product->minimum)
                                <div style="display: flex; align-items: center;">
                                    <span style="color:orange; font-weight:bold;">{{ $product->remain }} </span>
                                    <form action="{{ route('products.show', $product->id) }}" method="POST"
                                        style="margin-left: 10px;">
                                        @csrf
                                        @method('POST')
                                        @can('product-edit')
                                            <a class="btn btn-warning"
                                                href="{{ route('products.show', $product->id) }}">เพิ่มสต็อก</a>
                                        @endcan
                                    </form>
                                </div>
                            @else
                                {{ $product->remain }}
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">แก้ไข</a>
                                @csrf
                                @method('DELETE')
                                    <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger"
                                        data-confirm-delete="true">ลบ</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    @include('sweetalert::alert')
</x-app-layout>
