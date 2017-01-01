@if(!empty($education))
<?php
	$levels = explode(',', $education->level);
	$institutes = explode(',', $education->institute);
	$entrances = explode(',', $education->entrance);
	$graduates = explode(',', $education->graduate);
	$jml = count($levels);
	$i = 0;
?>
@while($i < $jml)
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control level" placeholder="Tingkat" name="level[]" value="{{ $levels[$i] }}" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-3 col-lg-3">
	<input type="text" class="form-control institute" placeholder="Nama Instansi" name="institute[]" value="{{ $institutes[$i]}}" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control entrance" placeholder="Tahun Masuk" name="entrance[]" value="{{ $entrances[$i]}}"/>
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control graduate" placeholder="Tahun Lulus" name="graduate[]" value="{{ $graduates[$i]}}" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun lulus</i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1 col-lg-1">
	<button type="button" class="form-control btn {{ $i > 0 ? "btn-danger btnhapus":"btn-primary btnsekolah" }} btn-flat"><i class="fa {{ $i > 0 ? "fa-trash":"fa-plus" }}"></i>
	</button>
	<span class="help-block hidden-md hidden-lg"><i><br></i></span>
</div>
<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
	<span class="form-control" style="border: none;"></span>
	<span class="help-block"><br></span>
</div>
<?php $i++; ?>
@endwhile
@else
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control level" placeholder="Tingkat" name="level[]" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-3 col-lg-3">
	<input type="text" class="form-control institute" placeholder="Nama Instansi" name="institute[]" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control entrance" placeholder="Tahun Masuk" name="entrance[]" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2">
	<input type="text" class="form-control graduate" placeholder="Tahun Lulus" name="graduate[]" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun lulus</i></span>
</div>

<div class="form-group col-xs-12 col-sm-1 col-md-1 col-lg-1">
	<button type="button" class="form-control btn btn-primary btn-flat btnsekolah"><i class="fa fa-plus"></i>
	</button>
	<span class="help-block hidden-md hidden-lg"><i><br></i></span>
</div>
<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
	<span class="form-control" style="border: none;"></span>
	<span class="help-block"><br></span>
</div>
@endif