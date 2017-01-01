@extends('layouts.app')

@section('htmlheader_title', 'Manajemen Alumni')

@section('contentheader_title', 'Manajemen Alumni')

@section('contentheader_description', 'Tambah Alumni')

@section('customheader')    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
@stop

@section('main-content')
<div class="box box-warning">
    <div class="box-header">
        <i class="fa fa-list"></i>
        <h3 class="box-title">Tambah Alumni</h3>
    </div>

    <div class="box-body">
        <form action="{{ url('/register') }}" method="post" autocomplete="off">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback {{ !empty($errors->first('username'))? "has-error":null }}">
                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}"/>
                <span class="glyphicon glyphicon-tag form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('username') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('name'))? "has-error":null }}">
                <input type="text" class="form-control" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('email'))? "has-error":null }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('phone'))? "has-error":null }}">
                <input class="form-control" placeholder="Nomor Telepon" name="phone" value="{{ old('phone') }}" />
                <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('phone') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('birthday'))? "has-error":null }}">
                <input class="form-control flatpickr-input" id="flatpickr-birth" placeholder="Tanggal Lahir" name="birthday" data-date-format="Y-m-d" readonly="false">
                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('birthday') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('department_id'))? "has-error":null }}">
                <select id="subdepartment" class="form-control" name="department_id">
                    <option selected disabled>-- Jurusan --</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ $errors->first('department_id') }}</span>
            </div>
            <?php $current_year = \Carbon\Carbon::now()->year; ?>
            <div class="form-group has-feedback {{ !empty($errors->first('graduation'))? "has-error":null }}">
                <select class="form-control" name="graduation">
                    <option selected disabled>-- Tahun Lulus --</option>
                    @for($i = 2013; $i <= $current_year; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor                        
                </select>
                <span class="help-block">{{ $errors->first('graduation') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('sex'))? "has-error":null }}">
                <select class="form-control" id="sex" name="sex">
                    <option selected disabled>-- Jenis Kelamin --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <span class="help-block">{{ $errors->first('sex') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('password'))? "has-error":null }}">
                <input type="password" class="form-control" placeholder="Password" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="help-block">{{ $errors->first('password') }}</span>
            </div>
            <div class="form-group has-feedback {{ !empty($errors->first('password_confirmation'))? "has-error":null }}">
                <input type="password" class="form-control" placeholder="Ulangi Password" name="password_confirmation"/>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-flat btn-primary">Tambah <i class="fa fa-plus"></i></button>
                <a href="{{ url('/admin/alumni') }}" class="btn btn-flat btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('scripts')
@include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
    <script type="text/javascript">
        $(".flatpickr-input").flatpickr({
            allowInput: true            
        });
        $(".flatpickr-input").removeAttr("readonly");
    </script>
@stop