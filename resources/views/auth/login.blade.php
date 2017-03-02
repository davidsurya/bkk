@extends('layouts.auth')

@section('htmlheader_title')
Log in
@endsection

@section('customheader')
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
        -o-filter: blur(4px);
        filter: blur(4px);

        -moz-filter: brightness(0.3);
        -webkit-filter: brightness(0.3);
        -o-filter: brightness(0.3);
        filter: brightness(0.3);
    }
</style>
@endsection

@section('content')
<body class="hold-transition login-page">
    <?php $bg = random_int(1, 4); ?>
    <img src="{{ url('/image/static/'.$bg.'.jpg') }}" class="bgimage" />

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <img src="{{ url('/image/static/logo.png') }}" width="40%">
            </a>
        </div><!-- /.login-logo -->    

        <div class="box-header" style="border-top-left-radius: 3px;border-top-right-radius: 3px;background-color: lightseagreen; color: white;">
            <center><h4>BKK SMK N 2 Wonosari</h4></center>
        </div>

        <div class="login-box-body">    
            @if (count($errors) > 0)
            <div class="alert alert-danger">            
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                <div class="col-xs-6">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Ingat Saya
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" class="btn btnlogin btn-block btn-flat">Masuk</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/password/reset') }}">Lupa password</a><br>
            <a href="{{ url('/register') }}" class="text-center">Daftar anggota baru</a>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

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
</body>

@endsection