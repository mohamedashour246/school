<style>
    .alertcontainer{
        position: fixed;
        z-index:99999999;
        left: 20px;
        bottom:20px;
    }
</style>
<div class="text-center alertcontainer">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>
    @endif
</div>
<div class="text-center alertcontainer">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul style="list-style:none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
{{--@section('script')--}}
<script>
    setTimeout(function() {
        $(".alertcontainer").fadeOut();
    },4000);
</script>
{{--@endsection--}}
