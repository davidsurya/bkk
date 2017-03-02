@extends('layouts.app')

@section('htmlheader_title')
    Halaman Tidak Ditemukan
@endsection

@section('contentheader_title')
    Error 404
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Halaman tidak ditemukan</h3>
        <p>
            Maaf halaman yang Anda cari tidak ditemukan. Silahkan kembali ke halaman <a href="{{ url('/dashboard') }}">dashboard.</a>
        </p>        
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection