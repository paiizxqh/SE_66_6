@foreach ($project_members as $item)
    @if ($item->role == $role)
        <p class="mb-0"><span style="white-space: pre; margin: 0;">{{$item->employee_id}}    {{$item->username}}</span></p>
    @endif
@endforeach