<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-5">
	<input type="text" class="form-control" placeholder="Nama Instansi" name="institute2" value="{{ $job->institute }}" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control" placeholder="Tahun Masuk" name="entrance2" value="{{ $job->entrance }}"/>
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control" placeholder="Tahun Keluar" name="out" value="{{ $job->out }}" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun keluar</i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1">
	<button type="button" class="form-control btn btn-flat btn-danger btnhapuskerja" data-id="{{ $job->id }}"><i class="fa fa-trash"></i>
	</button>
</div>