@section('title', 'ข้อมูลลูกค้า')
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
                    <h2>ข้อมูลลูกค้า</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('customers.create') }}">เพิ่มข้อมูลลูกค้า</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success my-2">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อ</th>
                <th>ที่อยู่</th>
                <th>วันที่ลงทะเบียน</th>
                <th>โทรศัพท์</th>
                <th width="280px">จัดการ</th>
            </tr>
            @foreach ($data as $key => $customers)
                <tr>
                    <td>{{ $customers->cus_id }}</td>
                    <td>{{ $customers->name }}</td>
                    <td>{{ $customers->address }}</td>
                    <td>{{ $customers->regis_date }}</td>
                    <td>{{ $customers->phone }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('customers.show', $customers->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('customers.edit', $customers->id) }}">Edit</a>
                        <form id="delete-form-{{ $customers->id }}" action="{{ route('customers.destroy', $customers->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="btn btn-danger" href="#" onclick="event.preventDefault(); confirmDelete('{{ $customers->id }}');">Delete</a>
                          
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>       
    @include('sweetalert::alert')
</x-app-layout>
