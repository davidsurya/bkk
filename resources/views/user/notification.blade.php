@extends('layouts.app')

@section('htmlheader_title', 'Pemberitahuan')

@section('contentheader_title', 'Pemberitahuan')

@section('main-content')
<div class="box box-success">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">Pemberitahuan</h3>
	</div>
	<div class="box-body">
		@if(count($notifs) == 0)
		<p><span class="fa fa-bell" style="color: lightseagreen;"></span> Anda tidak memiliki pemberitahuan{{ $param == null? ' baru.':'.' }}</p><hr>
		@endif
		@foreach($notifs as $notif)
		<?php $date = new Date($notif->pivot->updated_at); ?>
		@if($notif->pivot->status == 'Diterima')
		@if($notif->pivot->confirm == 1)
		<p><span class="fa fa-bell" style="color: lightseagreen;"></span> Anda <b>diterima</b> di lowongan <a href="{{ url('/alumni/informasi/'.$notif->pivot->information_id) }}" target="_blank">{{ $notif->title }}</a> dan Anda <b>telah bersedia</b> untuk bekerja di {{ $notif->industry->name }}.
		</p>
		@elseif($notif->pivot->confirm == 2)
		<p><span class="fa fa-bell" style="color: indianred;"></span> Anda <b>diterima</b> di lowongan <a href="{{ url('/alumni/informasi/'.$notif->pivot->information_id) }}" target="_blank">{{ $notif->title }}</a> namun Anda <b>tidak bersedia</b> untuk bekerja di {{ $notif->industry->name }}.
		</p>
		@else
		<p><span class="fa fa-bell" style="color: lightseagreen;"></span> Anda <b>diterima</b> di lowongan <a href="{{ url('/alumni/informasi/'.$notif->pivot->information_id) }}" target="_blank">{{ $notif->title }}</a>. Apakah anda <b>bersedia untuk bekerja</b> di {{ $notif->industry->name }}?
		</p>
		<h4>
			<a href="{{ url('/alumni/konfirmasi/'.$notif->pivot->information_id) }}" class="label label-primary">Ya</a>
			<a href="{{ url('/alumni/tolak/'.$notif->pivot->information_id) }}" class="label label-danger">Tidak</a>
		</h4>
		@endif
		<small>{{ $date->diffForHumans() }}</small><hr>
		@else
		<p><span class="fa fa-exclamation-triangle" style="color: indianred;"></span> Maaf, Anda <b>belum diterima</b> pada lowongan <a href="{{ url('/alumni/informasi/'.$notif->pivot->information_id) }}" target="_blank">{{ $notif->title }}</a>. Semoga diterima di lain waktu.</p>
		<small>{{ $date->diffForHumans() }}</small><hr>
		@endif
		@endforeach
		@if($param == null)

		<p><a href="{{ url('/alumni/pemberitahuan/semua') }}">Lihat semua pemberitahuan</a></p>	

		@endif
	</div>
</div>
@endsection