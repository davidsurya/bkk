@extends('layouts.app')

@section('htmlheader_title', 'Pengaturan')

@section('contentheader_title', 'Pengaturan')

@section('customheader')	
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-switch.min.css') }}"/>
@stop

@section('main-content')
	<h4>Maintenance mode</h4>
	<p>Aktifkan ini jika ada perbaikan website. Jika mode ini aktif, website akan down untuk sementara.</p>
	@if($maintenance == true)
		<input id="maintenance-button" data-size="normal" type="checkbox" checked>
	@else
		<input id="maintenance-button" data-size="normal" type="checkbox">
	@endif
	<br><br>
	<h4>Kirim email peringatan</h4>
	<p>Merupakan fitur mengirim email peringatan kepada siswa/alumni yang terdaftar untuk meng<i>update</i> data diri. Gunakan tombol kirim email di bawah ini untuk mengirim email sekarang juga.</p>	
	<a href="#" class="btn btn-warning btn-flat" id="btnkirim">Kirim email</a>

	<div id="kirim" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Email peringatan</h4>
			</div>			
			<div class="modal-body">
				<p>Kirim email peringatan untuk update profil ke semua pengguna ??</p>
			</div>
			<div class="modal-footer">
				<a href="{{ url('/admin/send-mail') }}" class="btn btn-primary btn-flat">Kirim <i class="fa fa-envelope-o"></i></a>
				<a href="#" class="btn btn-danger btn-flat" data-dismiss="modal">Batal</a>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" charset="utf8" src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
	<script>		
		$('#maintenance-button').bootstrapSwitch('onSwitchChange', function (event, state) {
    		// alert($(this).data('on-text'));
    		if($(this).bootstrapSwitch('state')){    			
    			$.get("{{ url('/admin/down') }}", function(data, status){    				
    			});
    		}else{    			
    			$.get("{{ url('/admin/up') }}", function(data, status){    				
    			});
    		}
		});

		$('#btnkirim').click(function(){
			$('#kirim').modal('show');
		});
	</script>
@stop