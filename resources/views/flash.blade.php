@if ($message = Session::get('success'))
<div class="alert alert-success font-weight-bold text-white" role="alert">
	<strong style="color: green;">Success! </strong> <span style="color: green;">{{ $message }}</span>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger font-weight-bold text-white" role="alert">
	<strong style="color: #d70000;">Error! </strong> <span style="color: #d70000;">{{ $message }}</span>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning font-weight-bold text-white" role="alert">
	<strong>Warning! </strong>{{$message}}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info font-weight-bold text-white" role="alert">
	<strong>Info!</strong>{{$message}}
</div>
@endif

@if ($errors->any())
<div class="alert alert-dark font-weight-bold text-white" role="alert">
	<strong style="color: #d70000;">Please check enter details</strong>
</div>
@endif