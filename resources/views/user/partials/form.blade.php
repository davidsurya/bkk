<div class="form-group has-feedback">
	<input type="text" id="username" name="username" class="form-control" placeholder="Username" disabled value="{{ Form::getValueAttribute('username') }}">	
	<span class="glyphicon glyphicon-tag form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
	<input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ Form::getValueAttribute('name') }}">
	<span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
	<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ Form::getValueAttribute('email') }}">	
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
	<input type="text" id="phone" name="phone" class="form-control" placeholder="Telepon" value="{{ Form::getValueAttribute('phone') }}">	
	<span class="fa fa-phone form-control-feedback"></span>
</div>

<div class="form-group has-feedback">
	<input type="date" id="birthday" name="birthday" class="form-control flatpickr-input" placeholder="Tanggal Lahir" value="{{ Form::getValueAttribute('birthday') }}" data-date-format="Y-m-d" readonly="false">	
	<span class="fa fa-calendar form-control-feedback"></span>
</div>

@if(!Auth::user()->is('Admin'))
<?php $current_year = \Carbon\Carbon::now()->year; ?>
<div class="form-group has-feedback">
	<select class="form-control" name="graduation" id="graduation">
		<option selected disabled>Tahun Angkatan</option>
		@for($i = 2013; $i <= $current_year; $i++)
		<option value="{{ $i }}" {{ !empty($user->graduation) && $user->graduation == $i? "selected":null }}>{{ $i }}</option>
		@endfor
	</select>
</div>
@endif

<div class="form-group has-feedback">	
	<select class="form-control" name="sex" id="sex">
		<option selected disabled>Jenis Kelamin</option>
		<option value="L" {{ !empty($user->sex) && $user->sex == "L"? "selected":null }}>Laki-Laki</option>
		<option value="P" {{ !empty($user->sex) && $user->sex == "P"? "selected":null }}>Perempuan</option>
	</select>
</div>

@if(Auth::user()->is('Alumni'))
<div class="form-group has-feedback {{ !empty($errors->first('department_id'))? "has-error":null }}">
	<select id="subdepartment" class="form-control" name="department_id">
		<option selected disabled>-- Jurusan --</option>
		@foreach($departments as $department)
		<option value="{{ $department->id }}" {{ $user->department_id == $department->id? "selected":null }}>{{ $department->name }}</option>
		@endforeach
	</select>
	<span class="help-block">{{ $errors->first('department_id') }}</span>
</div>

<div class="form-group has-feedback">
	<input type="text" id="height" name="height" class="form-control" placeholder="Tinggi badan (cm)" value="{{ Form::getValueAttribute('height') == 0 ? null:Form::getValueAttribute('height') }}" />
	<span class="fa fa-user form-control-feedback"></span>	
</div>

<div class="form-group has-feedback">
	<input type="text" id="weight" name="weight" class="form-control" placeholder="Berat badan (kg)" value="{{ Form::getValueAttribute('weight') == 0 ? null:Form::getValueAttribute('weight') }}" />
	<span class="fa fa-user form-control-feedback"></span>	
</div>

<div class="form-group has-feedback">
	<input type="text" name="skill" class="form-control" placeholder="Keahlian" value="{{ Form::getValueAttribute('skill') }}" />
	<span class="fa fa-user form-control-feedback"></span>
	<span class="help-block">Jika lebih dari 1 pisahkan dengan tanda koma.</span>
</div>

<div class="form-group has-feedback">
	<input type="text" name="location" class="form-control" placeholder="Lokasi minat kerja. Cth: Yogyakarta, Bali" value="{{ Form::getValueAttribute('location') }}">
	<span class="fa fa-map-marker form-control-feedback"></span>
	<span class="help-block">Jika lebih dari 1 pisahkan dengan tanda koma.</span>
</div>
@endif

<div class="form-group has-feedback">
	<textarea id="address" class="form-control" placeholder="Alamat" name="address" rows="4">{{  Form::getValueAttribute('address') }}</textarea>
	<span class="fa fa-road form-control-feedback"></span>
</div>