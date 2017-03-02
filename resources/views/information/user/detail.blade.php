@extends('layouts.app')

@section('htmlheader_title', 'Informasi Lowongan')

@section('contentheader_title', 'Informasi Lowongan')

@section('customheader')
<style type="text/css">
ol{
	padding-left: 0px;
	padding-bottom: 6px;
	list-style-type: none;
}
ol li {
	float:left;	
	padding-right: 4px;
}
</style>
@stop

@section('main-content')
<br>
<div class="row">
	<div class="col-sm-8">
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">{{ $informations->title }}</h3>
				<p><i>{{ $informations->created_at }}</i> oleh <i>{{ $informations->user->name }}</i></p>
				<div class="box-tools">
					@if($informations->deadline <= date('Y-m-d'))
					<a href="#">
					<button class="btn btn-warning btn-flat hidden-xs hidden-sm" disabled>Melebihi deadline <i class="fa fa-cancel"></i></button></a>					

					@elseif($informations->applicant->contains(Auth::user()))
					<a href="#">
					<button class="btn btn-success btn-flat hidden-xs hidden-sm">Telah melamar <i class="fa fa-check"></i></button></a>					
					
					@else
					<a href="#">
					<button id="btnlamar" class="btn btn-primary btn-flat hidden-sm">Lamar lowongan <i class="fa fa-hand-o-up"></i></button></a>
					<a href="#" class="btn btn-primary visible-xs"><i class="fa fa-hand-o-up"></i></a>
					@endif					
					<a href="{{ url('/alumni/download-pdf/'.$informations->id) }}">
					<button class="btn btn-danger btn-flat hidden-xs hidden-sm">Download PDF <i class="fa fa-file-pdf-o"></i></button></a>					
				</div>

				@if($informations->deadline <= date('Y-m-d'))
				<a href="#"><button class="btn btn-warning btn-flat visible-xs visible-sm" disabled>Melebihi deadline <i class="fa fa-cancel"></i></button></a>					

				@elseif($informations->deadline <= date('Y-m-d') && $informations->applicant->contains(Auth::user()))
				<a href="#"><button class="btn btn-success btn-flat visible-xs visible-sm">Telah melamar <i class="fa fa-check"></i></button></a>

				@else
				<a href="#" class="btn btn-primary visible-xs visible-sm">Lamar lowongan<i class="fa fa-hand-o-up"></i></a>
				@endif

				<a href="{{ url('/alumni/download-pdf/'.$informations->id) }}"><button class="btn btn-danger btn-flat visible-xs visible-sm">Download PDF <i class="fa fa-file-pdf-o"></i></button></a>
			</div>
			
			<div class="box-body">
				<h4><b>Nama Industri :</b></h4>
				<p>{{ $informations->industry->name }}</p><br>

				<h4><b>Deadline :</b></h4>
				<?php $date = new Date($informations->deadline); ?>
				<p>{{ $date->format('d F Y') }}</p><br>				

				<h4><b>Gambaran Umum :</b></h4>
				<p>{{ $informations->definition == null? "--":$informations->definition }}</p><br>

				<h4><b>Persyaratan Umum :</b></h4>
				<?php $no = 1 ?>
				@foreach(explode(',',$informations->requirement) as $requirement)
				<p>{{ $requirement == null? "--":$no++.'. '.$requirement }}</p>
				@endforeach
				<br>

				<h4><b>Posisi yang dibutuhkan :</b></h4>
				<?php $nomor = 1 ?>
				@foreach($informations->position as $position)				
				<h4><b>{{ $nomor++.'. '.$position->name }}</b></h4>

				<ol style="margin-left: 20px;"><li>Keahlian yang dibutuhkan : </li>
					@foreach(explode(',', $position->skill) as $skill)
					<li><span class="label label-info">{{ $skill }}</span></li>
					@endforeach
				</ol><br>

				<div style="margin-left: 20px;">
					<p>Jumlah : {{ $position->total }} orang</p>
					<p>Usia : {{ $position->min_age }} - {{ $position->max_age }} tahun</p>
					<p>Jenis Kelamin : {{ $position->sex  }}</p>
				</div>
				
				<p style="margin-left: 20px;"><b>Penempatan : </b>{{ $position->location }}</p>
				
				<p style="margin-left: 20px;"><b>Persyaratan Khusus : </b></p>
				<?php $no = 1 ?>
				@foreach(explode(',', $position->requirement) as $requirement)
				<p style="margin-left: 20px;">{{ $requirement == null? "--":$no++.'. '.$requirement }}</p>
				@endforeach
				<br>				
				@endforeach
				<h4><b>Informasi lain :</b></h4>
				<p>{{ $informations->other == null? "--":$informations->other }}</p><hr>

				<div class="pull-right">
					<h5><b><i>{{ $informations->industry->name }}</i></b></h5>
					<h5><b><i>{{ $informations->industry->address }}</i></b></h5>
					
					@if($informations->industry->email_published == 1)
					<h5><b><i class="fa fa-envelope"> {{ $informations->industry->email }}</i></b></h5>
					@endif

					@if($informations->industry->phone_published == 1)
					<h5><b><i class="fa fa-phone"> {{ $informations->industry->phone }}</i></b></h5>
					@endif
				</div>			
			</div>
		</div>		
	</div>

	<div class="col-sm-4">
		<div class="box box-warning">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">Tentang Perusahaan</h3>
			</div>
			<div class="box-body">
				<p>Nama : {{ $industry->name }}</p>
				<p>Alamat : {{ $industry->address }}</p>
				<p>Website : <a href="{{ $industry->website }}" target="_blank">{{ $industry->website }}</a></p>
				@if($industry->email_published == 1)
				<p>Email : <a href="mailto:{{ $industry->email }}">{{ $industry->email }}</a></p>
				@endif
				@if($industry->phone_published == 1)
				<p>Telepon : {{ $industry->phone }}</p>
				@endif
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="box box-warning">
			<div class="box-header">
				<i class="fa fa-list"></i>
				<h3 class="box-title">Rekomendasi</h3>
			</div>
			<div class="box-body">
				@foreach($recommends as $recommend)
					<a href="{{ url('/alumni/informasi/'.$recommend->information->id) }}"><p>{{ $recommend->information->title }}</p></a>
				@endforeach
			</div>
		</div>
	</div>
</div>

<div id="lamar" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Lamar Lowongan Kerja</h4>
			</div>			
			<div class="modal-body">
				<h4>Lamar lowongan <span class="nama"><b>{{ $informations->title }}</b></span> ??</h4>
			</div>
			<div class="modal-footer">
				{!! Form::open(['url' => '/alumni/lamar/'.$informations->id, 'class' => 'frm', 'method' => 'POST']) !!}
					<button type="submit" class="btn btn-primary btn-flat">Lamar <i class="fa fa-hand-o-up"></i></button>
					<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Batal</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
@include('layouts.partials.scripts')
<script type="text/javascript">
	$('#btnlamar').click(function() {
		$('#lamar').modal('show');
	});
</script>
@stop