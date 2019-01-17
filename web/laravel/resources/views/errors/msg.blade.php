@if (Session::has('gagal'))
	<div class="alert alert-danger cust-alert"> {{ Session::get('gagal') }}</div>
@elseif(Session::has('sukses'))
	<div class="alert alert-success cust-alert"> {{ Session::get('sukses') }}</div>
@endif