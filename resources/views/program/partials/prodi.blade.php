<div class="box-header">
	<i class="fa fa-list"></i>
	<h3 class="box-title">Daftar Jurusan</h3>
	<div class="box-tools pull-right">
		<button id="btntambahprodi" class="btn btn-info btn-flat">Tambah Jurusan
			<i class="fa fa-plus"></i>
		</button>
	</div>
</div>
<?php $no = 1; ?>
<div class="box-body">
	<table id="tabel_prodi" class="display table table-striped table-bordered" cellspacing="0">	
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Jurusan</th>				
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($prodis as $prodi)			
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $prodi->name }}</td>				
				<td>
					<span title="Ubah"><a href="#" class="btn btn-success editprodi"
						data-id="{{ $prodi->id }}"						
						data-name="{{ $prodi->name }}"
						data-subdepartment="{{ $prodi->subdepartment }}">
						<i class="glyphicon glyphicon-edit"></i></a>
					</span>				
					<span title="Hapus"><a href="#" class="btn btn-danger hapusprodi"
						data-id="{{ $prodi->id }}"
						data-name="{{ $prodi->name }}">
						<i class="glyphicon glyphicon-trash"></i></a>
					</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>