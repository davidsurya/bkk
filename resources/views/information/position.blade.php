@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', empty($status)? 'Tambah data informasi':'Edit data informasi')

@section('contentheader_title', 'Manajemen Informasi')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@stop

@section('main-content')
<div class="box box-success">
	<div class="register-box-body">
	@if(empty($status))
		{!! Form::open(['url' => '/admin/tambah-posisi/'.$id, 'method'=>'POST', 'class' => 'frm']) !!}
	@else
		{!! Form::model($position,['url' => '/admin/edit-posisi/'.$position->id, 'method'=>'PUT', 'class' => 'frm']) !!}
	@endif
		@include('information.partials.position')
		<div class="form-group has-feedback">
		{!! Form::submit('Simpan & Tambah Posisi', ['class'=>'btn btn-info btn-flat', 'id' => 'lanjut', 'name' => 'save']) !!}
		{!! Form::submit('Selesai', ['class'=>'btn btn-success btn-flat', 'id' => 'selesai', 'name'=>'done']) !!}
		{!! Form::close() !!}		
		</div>
	</div>	
</div>
@stop

@section('scripts')    
@include('layouts.partials.scripts')
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script>
	$(".btnsyarat").click(function () {	
		baru = '<div class="form-group has-feedback col-xs-11">';
		baru += '<input type="text" class="form-control requirement" placeholder="Persyaratan Khusus" name="requirement[]" />';
		baru += '</div>';

		baru += '<div class="form-group col-xs-1">';
		baru += '<button type="button" class="form-control btn btn-danger btn-flat btnhapus"><i class="fa fa-trash"></i></button>';
		baru += '</div>';

		$("#requirement").append(baru);    	
	});
	$("#requirement").on('click', '.btnhapus', function(){
		var index = $("button").index(this);
		var index2 = index * 2;
    	$("#requirement").find("div").eq(index2).remove();
    	$("#requirement").find("div").eq(index2).remove();    	
    });	

	toastr.options = {
		"closeButton": true,
	}

	@if (Session::has('msgInfo'))

	toastr.success("{{ Session::get('msgInfo') }}");

	@elseif(Session::has('msgError'))

	toastr.error("{{ Session::get('msgError') }}");

	@endif

	@if (count($errors) > 0)

	@foreach ($errors->all() as $error)
	toastr.error("{{ $error }}");
	@endforeach

	@endif
</script>
@stop