@extends('layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('customheader')    
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/flatpickr.min.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
<style>
    .bgimage{
        position: fixed; 
        top: 0; 
        left: 0; 
        z-index: -1;

        /* Preserve aspet ratio */
        min-width: 100%;
        min-height: 100%;

        /* filtering */
        -moz-filter: blur(4px);
        -webkit-filter: blur(4px);
        filter: blur(4px);

        -moz-filter: brightness(0.3);
        -webkit-filter: brightness(0.3);
        filter: brightness(0.3);
    }
</style>
@stop

@section('content')
<body class="hold-transition register-page">
    <?php $bg = random_int(1, 4); ?>
    <img src="{{ url('/image/static/'.$bg.'.jpg') }}" class="bgimage" />
    <div class="register-box" style="margin-top: 5px;">
        <div class="register-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/image/static/logo.png') }}" width="40%" />
            </a>
        </div>

        <div class="box-header" style="border-top-left-radius: 3px;border-top-right-radius: 3px;background-color: lightseagreen; color: white;">
            <center><h4>BKK SMK N 2 Wonosari</h4></center>
        </div>
        
        <div class="register-box-body">            
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
                <div class="row">
                    <div class="col-xs-7">
                        Sudah punya akun? <a href="{{ url('/login') }}" class="text-center">Login</a>
                    </div>                    
                    <div class="col-xs-5 pull-right">
                        <button type="submit" class="btn btnlogin btn-block btn-flat">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
    {{-- <script src="{{ asset('/js/flatpickr.min.js') }}" ></script> --}}
    <script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
    <script type="text/javascript">
           
        $(".flatpickr-input").flatpickr({
            allowInput: true            
        });
        $(".flatpickr-input").removeAttr("readonly");

        
    </script>
    </body>

@endsection
