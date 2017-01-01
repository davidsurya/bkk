<!DOCTYPE html>
<html>
<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
		h4, h5{
    		padding: 0px;
    		margin: 6px;
		}
	</style>
</head>
<body>
<center>
<table width="80%">
  <tr>
    <th><img src="{{ asset('/img/Logo.png') }}" width="85px" /></th>
    <th style="text-align: center;">
    	<h4>PEMERINTAH KABUPATEN GUNUNG KIDUL</h4>
    	<h4>DINAS PENDIDIKAN DAN KEBUDAYAAN</h4>
    	<h4>SMK NEGERI 2 WONOSARI</h4>		
    </th>    
  </tr>
</table>
<h5>Jalan KH. Agus Salim, Ledoksari, Kepek, Wonosari, Gunung Kidul, Yogyakarta. 55813</h5>
		<h5>Telp. (0274) 391019</h5>
</center>
<hr>
	<center>
		<h4><u>INFORMASI LOWONGAN KERJA</u></h4>
		<h3><b>{{ $information->title }}</b></h3>
	</center>
	<br>
	<h4><b>Nama Industri :</b></h4>
	<p>{{ $information->industry->name }}</p><br>

	<h4><b>Deadline :</b></h4>
	<p>{{ date('d F Y', strtotime($information->deadline)) }}</p><br>

	<h4><b>Gambaran Umum :</b></h4>
	<p>{{ $information->definition == null? "--":$information->definition }}</p><br>

	<h4><b>Persyaratan Umum :</b></h4>
	<?php $no = 1 ?>
	@foreach(explode(',',$information->requirement) as $requirement)
	<p>{{ $requirement == null? "--":$no++.'. '.$requirement }}</p>
	@endforeach
	<br>

	<h4><b>Posisi yang dibutuhkan :</b></h4>
	<?php $nomor = 1 ?>
	@foreach($information->position as $position)				
	<h4><b>{{ $nomor++.'. '.$position->name }}</b></h4>

	<p style="margin-left: 20px;">Keahlian yang dibutuhkan : {{ $position->skill }}</p>

	<div style="margin-left: 20px; padding: 0px;">
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
	<p>{{ $information->other == null? "--":$information->other }}</p><hr>

	<div class="pull-right">
		<h5><b><i>{{ $information->industry->name }}</i></b></h5>
		<h5><b><i>{{ $information->industry->address }}</i></b></h5>

		@if($information->industry->email_published == 1)
		<h5><b><i class="fa fa-envelope"> {{ $information->industry->email }}</i></b></h5>
		@endif

		@if($information->industry->phone_published == 1)
		<h5><b><i class="fa fa-phone"> {{ $information->industry->phone }}</i></b></h5>
		@endif
	</div>			
</div>
</body>
</html>