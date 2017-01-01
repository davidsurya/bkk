@extends('layouts.app')
<?php $url='/' ?>
@section('htmlheader_title')
    403
@endsection

@section('contentheader_title')
    Halaman 403
@endsection

@section('contentheader_description')
	Akses ditolak
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Akses ditolak.</h3>
        <p>
            Maaf, Anda tidak dapat membuka halaman ini. Silahkan <a href='{{ url('/') }}'>kembali ke beranda</a> 
        </p>        
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection