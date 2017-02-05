@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', 'Tambah data informasi')	

@section('contentheader_title', 'Manajemen Informasi')

@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
@stop

@section('main-content')
@if($show_view == 'info')
<div class="box box-success">
	<div class="register-box-body">
		{!! Form::model($information,['url' => '/admin/edit-informasi/'.$information->id, 'method'=>'PUT', 'files' => true, 'autocomplete' => 'off']) !!}
		@include('information.partials.newform')
        <div class="has-feedback">            
            <button type="submit" name="save" id="lanjut" class="btn btn-success btn-flat" value="save">Simpan & Lanjutkan <i class="glyphicon glyphicon-floppy-disk"></i></button>
            <a href="{{ url('/admin/edit-informasi/'.$information->id.'/posisi') }}" class="btn btn-warning btn-flat">Lewati <i class="fa fa-chevron-right"></i></a>            
            <a href="{{ url('/admin/informasi/') }}" class="btn btn-danger btn-flat">Batal</a>
        </div>
		
		{!! Form::close() !!}
	</div>
</div>
@else
<a href="{{ url('/admin/tambah-posisi/'.$information->id) }}" class="btn btn-info btn-flat">Tambah Posisi <i class="fa fa-plus"></i></a><br><br>
{!! Form::model($information,['url' => '/admin/edit-posisi/'.$information->id, 'method'=>'PUT', 'files' => true, 'autocomplete' => 'off']) !!}
@foreach($information->position as $position)
<div class="box box-success">
    <div class="register-box-body">    
        @include('information.partials.position')
        <a href="{{ url('/admin/edit-posisi/'.$position->id) }}" class="btn btn-success btn-flat">Edit Posisi <i class="fa fa-edit"></i></a>
        <button type="button" class="btn btn-danger btn-flat hapusposisi"
        data-id="{{ $position->id }}"
        data-name="{{ $position->name }}">Hapus Posisi <i class="fa fa-trash"></i></button>        
    </div>
</div>
@endforeach
{{-- <button type="submit" class="btn btn-success btn-flat">Simpan <i class="glyphicon glyphicon-floppy-disk"></i></button> --}}
{!! Form::close() !!}
@endif

<div id="hapusmodal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data Posisi</h4>
            </div>          
            <div class="modal-body">
                <p>Hapus posisi <span id="nama"><b></b></span> ??</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['class' => 'frm', 'method' => 'DELETE']) !!}
                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-flat']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')    
@include('layouts.partials.scripts')	
<script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
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
    $(".hapusposisi").click(function(){
        $("#hapusmodal").modal('show');
        $("#nama b").html($(this).data('name'));
        $(".frm").attr('action', '{{ url('/admin/hapus-posisi/') }}/'+$(this).data('id'));
    });
    /*$("#lanjut").click(function(){
        $("#perusahaan").val($('#countries option:selected').data('value'));        
    });*/
    $(".flatpickr-input").flatpickr({
        allowInput: true            
    });
    $(".flatpickr-input").removeAttr("readonly");

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