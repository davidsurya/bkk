
@extends('layouts.app')

@section('contentheader_title', 'Beranda')

@section('htmlheader_title', 'Beranda')

@section('main-content')
<div class="row">
	<div class="col-md-3">
		<div class="info-box">
			<!-- Apply any bg-* class to to the icon to color it -->
			<span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Siswa/Alumni</span>
				<span class="info-box-number">{{ $student }}</span>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="info-box">
			<!-- Apply any bg-* class to to the icon to color it -->
			<span class="info-box-icon bg-blue"><i class="fa fa-info"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Informasi Lowongan</span>
				<span class="info-box-number">{{ $information }}</span>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="info-box">
			<!-- Apply any bg-* class to to the icon to color it -->
			<span class="info-box-icon bg-green"><i class="fa fa-university"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Jurusan</span>
				<span class="info-box-number">{{ $department }}</span>
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="info-box">
			<!-- Apply any bg-* class to to the icon to color it -->
			<span class="info-box-icon bg-yellow"><i class="fa fa-industry"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Industri</span>
				<span class="info-box-number">{{ $industry }}</span>
			</div>
		</div>
	</div>	
</div>
@endsection