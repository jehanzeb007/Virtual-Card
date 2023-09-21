@section('page_script')
@if (session()->has('success'))
    <script>
        $('document').ready(function () {
            swal('Success!','{{ session('success') }}','success')
        })
    </script>
    {{--<div class="alert alert-success fade in">
		<div class="container">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('success') }}
			</div>
    </div>--}}
@endif

@if (session()->has('error'))
    <script>
        $('document').ready(function () {
            swal('Error!','{{ session('error') }}','error')
        })
    </script>
    {{--<div class="alert alert-danger fade in">
		<div class="container">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('error') }}
		</div>
    </div>--}}
@endif
@endsection
