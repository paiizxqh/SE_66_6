@section('title', 'รายการอุปกรณ์')
<x-app-layout>
    <x-slot name="head">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </x-slot>

    <body>
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12 margin-tb mb-4">
                    <div class="pull-left">
                        <h2>Products</h2>
                    </div>
                    <div class="float-end">
                        @can('product-create')
                            <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                        @endcan
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Details</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->detail }}</td>
                            <td>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                    @can('product-edit')
                                        <a class="btn btn-primary"
                                            href="{{ route('products.edit', $product->id) }}">Edit</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('product-delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</x-app-layout>
