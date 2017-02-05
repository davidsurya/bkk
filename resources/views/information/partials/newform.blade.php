<div class="form-group has-feedback {{ !empty($errors->first('title'))? "has-error": null }}">	
	<input type="text" class="form-control title" placeholder="Judul Informasi" name="title" value="{{ Form::getValueAttribute('title') }}"/>
	<span class="fa fa-tasks form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('title') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('industry_id'))? "has-error": null }}">
	<input type="text" id="perusahaan" list="industry" class="form-control industry" placeholder="Perusahaan" name="industry_id" value="{{ Form::getValueAttribute('industry[name]') }}" />
	<span class="fa fa-industry form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('industry_id') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('definition'))? "has-error": null }}">
	<textarea type="text" class="form-control definition" placeholder="Gambaran Umum Lowongan Kerja" name="definition" rows="4">{{ Form::getValueAttribute('definition') }}</textarea>
	<span class="fa fa-file-text-o form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('definition') }}</span>
</div>

@if(!empty($information))
<div class="row" id="requirement">
	<?php $requirements = explode(',', $information->requirement); ?>
	@foreach($requirements as $requirement)
	<div class="form-group has-feedback col-xs-10 col-md-11">
		<input type="text" class="form-control requirement" placeholder="Persyaratan Umum" name="requirement[]" value="{{ $requirement }}" />
	</div>
	<div class="form-group col-xs-2 col-md-1">
		<button type="button" class="form-control btn {{ $requirement == reset($requirements)? "btn-primary btnsyarat": "btn-danger btnhapus"}} btn-flat"><i class="fa {{ $requirement == reset($requirements)? "fa-plus": "fa-trash"}}"></i>
		</button>
	</div>
	@endforeach
</div>
@else
<div class="row" id="requirement">	
	<div class="form-group has-feedback col-xs-10 col-md-11">
		<input type="text" class="form-control requirement" placeholder="Persyaratan Umum" name="requirement[]" />
	</div>
	<div class="form-group col-xs-2 col-md-1">
		<button type="button" class="form-control btn btn-primary btn-flat btnsyarat"><i class="fa fa-plus"></i>
		</button>
	</div>
</div>
@endif

<div class="form-group has-feedback {{ !empty($errors->first('deadline'))? "has-error": null }}">	
	<input class="form-control flatpickr-input" id="flatpickr-dateline" placeholder="Batas Akhir" name="deadline" data-date-format="Y-m-d" readonly="false" data-min-date="today" data-default-date="{{ Form::getValueAttribute('deadline') }}">
	<span class="fa fa-calendar form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('deadline') }}</span>
</div>

<div class="form-group has-feedback">
	<label>Foto / Gambar</label>
	<input type="file" placeholder="Upload" name="img">	
</div>

<div class="form-group has-feedback">
	<textarea type="text" class="form-control other" placeholder="Info Lainnya" name="other" rows="4">{{ Form::getValueAttribute('other') }}</textarea>
	<span class="fa fa-file-text-o form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
	<select class="form-control" name="hidden">
		<option selected disabled>Tampilkan Informasi</option>
		<option value="0" {{ !empty($information->hidden) == 0? "selected":null }}>Tampilkan</option>
		<option value="1" {{ !empty($information->hidden) == 1? "selected":null }}>Sembunyikan</option>
	</select>	
</div>

<datalist id="industry">
	<select>
		@foreach($industries as $industry)
		<option>{{ $industry->name }}</option>
		@endforeach
	</select>
</datalist>