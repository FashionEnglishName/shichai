@if (count($errors) > 0)
    <script>
        @foreach($errors->all() as $error)
            toastr.error('$error');
        @endforeach
    </script>
@endif