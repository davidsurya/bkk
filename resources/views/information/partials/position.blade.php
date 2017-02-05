<div class="form-group has-feedback {{ !empty($errors->first('name'))? "has-error":null }}">
	<input type="text" class="form-control position" placeholder="Posisi/Jabatan" name="name" value="{{ !empty($position)? $position->name: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-tasks form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('name') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('definition'))? "has-error": null }}">
	<textarea type="text" class="form-control definition" placeholder="Gambaran untuk jabatan ini" name="definition" rows="4" {{ !empty($position) && empty($status)? "disabled": null }}>{{ Form::getValueAttribute('definition') }}</textarea>
	<span class="fa fa-file-text-o form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('definition') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('skill'))? "has-error":null }}">
	<input type="text" class="form-control" data-role="tagsinput" placeholder="Keahlian" name="skill" value="{{ !empty($position)? $position->skill: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="help-block">{{ $errors->first('skill') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('sex'))? "has-error":null }}">
	<select class="form-control" name="sex" {{ !empty($position) && empty($status)? "disabled": null }}>
		<option selected disabled>Jenis Kelamin</option>
		<option value="L" {{ !empty($position) && $position->sex == "L" ? "selected": null }}>Laki-Laki</option>
		<option value="P" {{ !empty($position) && $position->sex == "P" ? "selected": null }}>Perempuan</option>
		<option value="L/P" {{ !empty($position) && $position->sex == "L/P" ? "selected": null }}>Laki-Laki dan Perempuan</option>
	</select>
	<span class="help-block">{{ $errors->first('sex') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('height'))? "has-error":null }}">
	<input type="text" name="height" class="form-control" placeholder="Tinggi badan minimal (cm)" value="{{ !empty($position)? $position->height: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('height') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('weight'))? "has-error":null }}">
	<input type="text" name="weight" class="form-control" placeholder="Berat badan maksimal (kg)" value="{{ !empty($position)? $position->weight: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('weight') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('score'))? "has-error":null }}">
	<input type="text" name="score" class="form-control" placeholder="Nilai akhir minimal" value="{{ !empty($position)? $position->score: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('score') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('total'))? "has-error":null }}">
	<input type="text" class="form-control" placeholder="Jumlah yang dibutuhkan" name="total" value="{{ !empty($position)? $position->total: null }}" {{ !empty($position) && empty($status)? "disabled": null }}>
	<span class="fa fa-users form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('total') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('min_age'))? "has-error":null }}">
	<input type="text" class="form-control min_age" placeholder="Usia Minimal. Diisi angka saja." name="min_age" value="{{ !empty($position)? $position->min_age: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('min_age') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('max_age'))? "has-error":null }}">
	<input type="text" class="form-control max_age" placeholder="Usia Maksimal. Diisi angka saja." name="max_age" value="{{ !empty($position)? $position->max_age: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('max_age') }}</span>
</div>

<div class="form-group has-feedback {{ !empty($errors->first('location'))? "has-error":null }}">
	<input type="text" class="form-control location" placeholder="Lokasi penempatan kerja" name="location" value="{{ !empty($position)? $position->max_age: null }}" {{ !empty($position) && empty($status)? "disabled": null }}/>
	<span class="fa fa-map-marker form-control-feedback"></span>
	<span class="help-block">{{ $errors->first('location') }}</span>
</div>

<div class="row" id="{{ !empty($position) && empty($status)? null: "requirement" }}">
	@if(!empty($position))

	<?php $requirements = explode(',', $position->requirement); ?>
	@foreach($requirements as $requirement)
	<div class="form-group has-feedback {{ !empty($position) && empty($status)? "col-xs-12": "col-xs-10 col-md-11" }} ">
		<input type="text" class="form-control requirement" placeholder="Persyaratan Khusus" name="requirement[]" value="{{ $requirement }}" {{ !empty($position) && empty($status)? "disabled": null }} />
	</div>
	@if(!empty($status))
	<div class="form-group col-xs-2 col-md-1">
		<button type="button" class="form-control btn {{ $requirement == reset($requirements)? "btn-primary btnsyarat": "btn-danger btnhapus"}} btn-flat"><i class="fa {{ $requirement == reset($requirements)? "fa-plus": "fa-trash"}}"></i>
		</button>
	</div>
	@endif
	@endforeach

	@else
	<div class="form-group has-feedback {{ !empty($position)? "col-xs-12": "col-xs-10 col-md-11" }} ">
		<input type="text" class="form-control requirement" placeholder="Persyaratan Khusus" name="requirement[]" value="{{ !empty($position)? $requirement: null }}" />
	</div>
	<div class="form-group col-xs-2 col-md-1">
		<button type="button" class="form-control btn btn-info btn-flat btnsyarat"><i class="fa fa-plus"></i>
		</button>
	</div>
	@endif
</div>