@foreach(['error','warning','success'] as $msg)
    @if(session()->has($msg))
        <script>toastr.{{ $msg }}("{{ session()->get($msg) }}")</script>
    @endif
@endforeach