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
		<h4><u>CURICULUM VITAE</u></h4>		
	</center>
	<br>
	<img src="{{ asset($user->img) }}" width="100px" />
	<br><br>
	<table width="100%">
		<tr>
			<th>Nama Lengkap</th>
			<td>: {{ $user->name }}</td>
		</tr>
		<tr>		
			<th>Email</th>
			<td>: {{ $user->email }}</td>
		</tr>
		<tr>		
			<th>No. Telp</th>
			<td>: {{ $user->phone }}</td>
		</tr>
		<tr>
			<th>Tanggal lahir</th>
			<?php $date = new Date($user->birthday); ?>
			<td>: {{ $date->format('d F Y') }}</td>
		</tr>
		<tr>
			<th>Jenis kelamin</th>
			<td>: {{ $user->sex == 'L'? 'Laki-laki':'Perempuan' }}</td>
		</tr>
		<tr>
			<th>Tinggi badan</th>
			<td>: {{ $user->height }} cm</td>
		</tr>
		<tr>
			<th>Berat badan</th>
			<td>: {{ $user->weight }} kg</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>: {{ $user->address }}</td>
		</tr>
	</table>
	<br>

	<!-- Riwayat pendidikan-->
	<table width="100%">
		<tr>
			<th>Riwayat Pendidikan :</th>
		</tr>	
	</table>
	<table width="100%" border="2px">
		<tr>			
			<th>Tingkat</th>
			<th>Nama Institusi</th>
			<th>Waktu / Tahun</th>
			@foreach($educations as $education)
			<tr>
				<td>{{ $education->level }}</td>
				<td>{{ $education->institute }}</td>
				<td>{{ $education->entrance }} - {{ $education->graduate }}</td>
			</tr>			
			@endforeach
		</tr>
	</table>	
	<br>

	<!-- Riwayat kerja-->
	<table width="100%">
		<tr>
			<th>Pengalaman Kerja :</th>
		</tr>	
	</table>

	<table width="100%" border="2px">
		<tr>						
			<th>Nama Institusi</th>
			<th>Waktu / Tahun</th>
			@foreach($jobs as $job)
			<tr>					
				<td>{{ $job->institute }}</td>
				<td>{{ $job->entrance }} - {{ $job->out }}</td>
			</tr>			
			@endforeach
		</tr>
	</table>	
</body>
</html>