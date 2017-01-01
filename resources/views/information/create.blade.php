@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', 'Tambah data informasi')	

@section('contentheader_title', 'Manajemen Informasi')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
@stop

@section('main-content')
<div class="box box-success">
	<div class="register-box-body">
		{!! Form::open(['url' => '/admin/tambah-informasi/', 'method'=>'POST', 'files' => true, 'autocomplete' => 'off']) !!}
		@include('information.partials.newform')
		{!! Form::submit('Lanjut', ['class'=>'btn btn-primary btn-flat']) !!}
		{!! Form::close() !!}
	</div>
</div>
@stop

@section('scripts')    
@include('layouts.partials.scripts')
<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
<script type="text/javascript">
	$(".btnsyarat").click(function () {	
		baru = '<div class="form-group has-feedback col-xs-11">';
		baru += '<input type="text" class="form-control requirement" placeholder="Persyaratan Umum" name="requirement[]" />';
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
    /*$("#lanjut").click(function(){
    	$("#perusahaan").val($('#countries option:selected').data('value'));
    });*/

    toastr.options = {
        "closeButton": true,
    }

    @if (Session::has('msgInfo'))

    toastr.success("{{ Session::get('msgInfo') }}");

    @elseif(Session::has('msgError'))

    toastr.error("{{ Session::get('msgError') }}");

    @endif

    $(".flatpickr-input").flatpickr({
        allowInput: true
    });
    $(".flatpickr-input").removeAttr("readonly");    
</script>
@stop