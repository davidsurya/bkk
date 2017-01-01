@if(!empty($job))
<?php	
	$institutes = explode(',', $job->institute);
	$entrances = explode(',', $job->entrance);
	$graduates = explode(',', $job->out);
	$jml = count($institutes);
	$i = 0;
?>
@while($i < $jml)
<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-5">
	<input type="text" class="form-control institute2" placeholder="Nama Instansi" name="institute2[]" value="{{ $institutes[$i]}}" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control entrance2" placeholder="Tahun Masuk" name="entrance2[]" value="{{ $entrances[$i]}}"/>
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control graduate2" placeholder="Tahun Keluar" name="graduate2[]" value="{{ $graduates[$i]}}" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun keluar</i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1">
	<button type="button" class="form-control btn btn-primary btn-flat {{ $i > 0 ? "btn-danger btnhapuskerja":"btn-primary btnkerja" }}"><i class="fa {{ $i > 0 ? "fa-trash":"fa-plus" }}"></i>
	</button>
</div>
<?php $i++; ?>
@endwhile
@else
<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-5">
	<input type="text" class="form-control institute2" placeholder="Nama Instansi" name="institute2[]" />
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control entrance2" placeholder="Tahun Masuk" name="entrance2[]" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span>
</div>
<div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3">
	<input type="text" class="form-control graduate2" placeholder="Tahun Keluar" name="graduate2[]" />
	<span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun keluar</i></span>
</div>
<div class="form-group col-xs-12 col-sm-1 col-md-1">
	<button type="button" class="form-control btn btn-primary btn-flat btnkerja"><i class="fa fa-plus"></i>
	</button>
</div>
@endif