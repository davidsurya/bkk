@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Informasi')

@section('contentheader_description', 'Mengatur isi informasi yang ditampilkan')	

@section('contentheader_title', 'Manajemen Informasi')
@section('customheader')
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
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
<div class="box box-warning">
	<div class="box-header">
		<i class="fa fa-list"></i>
		<h3 class="box-title">{{ $information->title }}</h3>
		<?php $date = new Date($information->created_at); ?>
		<p><i>{{ $date->format('d F Y') }}</i> oleh <i>{{ $information->user->name }}</i></p>
		<div class="box-tools pull-right">
			<a href="{{ url('/admin/download-pdf/'.$information->id) }}">
			<button class="btn btn-danger btn-flat">Download PDF <i class="fa fa-file-pdf-o"></i></button></a>
		</div>
	</div>

	<div class="box-body">
		<p><b>Nama Industri :</b></p>
		<p>{{ $information->industry->name }}</p><br>

		<p><b>Deadline :</b></p>
		<?php $date = new Date($information->deadline); ?>
		<p>{{ $date->format('d F Y') }}</p><br>		

		<p><b>Gambaran Umum :</b></p>
		<p>{{ $information->definition == null? "--":$information->definition }}</p><br>

		<p><b>Persyaratan Umum :</b></p>
		<?php $no = 1 ?>
		@foreach(explode(',',$information->requirement) as $requirement)
			<p>{{ $requirement == null? "--":$no++.'. '.$requirement }}</p>
		@endforeach
		<br>

		<p><b>Posisi yang dibutuhkan :</b></p>
		@foreach($information->position as $position)
		<p><b>{{ $position->name }}</b></p>
		
		<ol><li>Keahlian yang dibutuhkan : </li>
		@foreach(explode(',', $position->skill) as $skill)
			<li><span class="label label-info">{{ $skill }}</span></li>
		@endforeach
		</ol><br>
		
		<p>Jumlah : {{ $position->total }} orang</p>
		<p>Usia : {{ $position->min_age }} - {{ $position->max_age }} tahun</p>

		<p><b>Penempatan : </b>{{ $position->location }}</p><br>
		
		<p><b>Persyaratan Khusus : </b></p>
		<?php $no = 1 ?>
		@foreach(explode(',', $position->requirement) as $requirement)
			<p>{{ $requirement == null? "--":$no++.'. '.$requirement }}</p>
		@endforeach
		<br>
		@endforeach
		<p><b>Informasi lain :</b></p>
		<p>{{ $information->other == null? "--":$information->other }}</p>		
	</div>
</div>
@stop

@section('scripts')    
	@include('layouts.partials.scripts')
	<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>  
@stop