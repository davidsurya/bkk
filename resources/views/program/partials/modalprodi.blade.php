<!-- Modal Prodi -->
<div id="tambahprodi" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Jurusan</h4>
			</div>
			<div class="register-box-body">
				<div class="modal-body">					
					{!! Form::open(['class' => 'frm', 'method' => 'POST']) !!}
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nama Jurusan" name="name"/>
						<span class="glyphicon glyphicon-education form-control-feedback"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>	
</div>

<div id="editprodi" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Data Jurusan</h4>
			</div>
			<div class="register-box-body">
				<div class="modal-body">
					{!! Form::open(['class' => 'frm', 'method' => 'PUT']) !!}
					<div class="form-group has-feedback">
						<input id="namaprodi" type="text" class="form-control" placeholder="Nama" name="name"/>
						<span class="glyphicon glyphicon-education form-control-feedback"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-flat">Update
					<i class="fa fa-save"></i>
					</button>
					{!! Form::close() !!}
				</div>					
			</div>
		</div>		
	</div>	
</div>

<div id="hapusprodi" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Hapus Data Jurusan</h4>
			</div>
			<div class="modal-body">
				<p>Hapus jurusan <span id="nama"><b></b></span> ??</p>
			</div>
			<div class="modal-footer">
				{!! Form::open(['class' => 'frm', 'method' => 'DELETE']) !!}
				{!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-flat']) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>