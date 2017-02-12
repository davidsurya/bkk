<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-1 col-lg-2">
	<input type="text" class="form-control" placeholder="Tingkat" name="level" value="{{ $education->level }}" disabled />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3 col-lg-2">
	<input type="text" class="form-control" placeholder="Nama Instansi" name="institute" value="{{ $education->institute }}" disabled/>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control" placeholder="Tahun Masuk" name="entrance" value="{{ $education->entrance }}" disabled/>
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control" placeholder="Tahun Lulus" name="graduate" value="{{ $education->graduate }}" disabled/>
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun lulus</i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1 col-lg-1">
	<button type="button" class="form-control btn btn-success btn-flat btnedit" data-id="{{ $education->id }}"><i class="fa fa-edit"></i>
	</button>
	<span class="help-block hidden-md hidden-lg"><i><br></i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1 col-lg-1">
	<button type="button" class="form-control btn btn-danger btn-flat btnhapus" data-id="{{ $education->id }}"><i class="fa fa-trash"></i>
	</button>
	<span class="help-block hidden-md hidden-lg"><i><br></i></span>
</div>
<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
	<span class="form-control" style="border: none;"></span>
	<span class="help-block"><br></span>
</div>