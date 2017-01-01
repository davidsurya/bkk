@extends('layouts.app')

@section('htmlheader_title', 'Profil')

@section('contentheader_title', 'Profil')

@section('contentheader_description', 'Update Profil')	

@section('customheader')
<!--link rel="stylesheet" type="text/css" href="{{ asset('/css/cropper.min.css') }}"-->
<link rel="stylesheet" type="text/css" href="{{ asset('css/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.drag-n-crop.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/toastr.min.css') }}"/>
@stop

@section('main-content')
<div class="box box-warning">
	<div class="box-header">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#profil" aria-controls="profil" role="tab" data-toggle="tab">Data Pribadi</a></li>
			<li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Ubah Password</a></li>
			@if(Auth::user()->is('alumni'))
			<li role="presentation"><a href="#cv" aria-controls="cv" role="tab" data-toggle="tab">Curriculum Vitae</a></li>
			<li role="presentation"><a href="#score" aria-controls="cv" role="tab" data-toggle="tab">Nilai</a></li>
			<div class="form-group pull-right">					
				<a href="{{ url('/alumni/download-cv') }}" class="btn btn-danger btn-flat">Download CV <i class="fa fa-file-pdf-o"></i></a>
			</div>
			@endif
		</ul>
	</div>
	<div class="box-body register-box-body">		
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="profil">				
				@if(Auth::user()->is('admin'))
				{!! Form::model($user, ['method' => 'PUT', 'url' => '/admin/profil', 'files' => 'true', 'autocomplete' => 'off']) !!}
				@else
				{!! Form::model($user, ['method' => 'PUT', 'url' => '/alumni/profil', 'files' => 'true', 'autocomplete' => 'off']) !!}
				@endif
				{!! Form::file('image', ['id' => 'image', 'accept' => 'image/jpeg, image/png']) !!}
				{!! Form::text('offsetX', null, ['id' => 'offsetX', 'hidden']) !!}
				{!! Form::text('offsetY', null, ['id' => 'offsetY', 'hidden']) !!}
				<div id="profil" style="width: 200px; height:200px">
					<img id="photo" src="{{ asset($user->img) }}" name="img" width="100%" />		
				</div>
				<br>
				@include('user.partials.form')
				<div class="form-group pull-right">
					<button type="submit" class="btn btn-success btn-flat">Update <i class="fa fa-save"></i></button>
					<a href="{{ url('/') }}" class="btn btn-danger btn-flat">Batal</a>
				</div>				
				{!! Form::close() !!}				
			</div>
			<div role="tabpanel" class="tab-pane" id="password">
				@if(Auth::user()->is('admin'))
				{!! Form::open(['method' => 'PUT', 'url' => '/admin/password-reset']) !!}
				@else
				{!! Form::open(['method' => 'PUT', 'url' => '/alumni/password-reset']) !!}
				@endif
				<div class="form-group has-feedback col-xs-12 col-sm-offset-3 col-sm-6">
					<input type="password" class="form-control" name="old_password" placeholder="Password Lama" />
				</div>

				<div class="form-group has-feedback col-xs-12 col-sm-offset-3 col-sm-6">
					<input type="password" class="form-control" name="password" placeholder="Password Baru" />
				</div>

				<div class="form-group has-feedback col-xs-12 col-sm-offset-3 col-sm-6">
					<input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password Baru" />
				</div>

				<div class="form-group col-xs-offset-3 col-sm-offset-4 col-sm-4 col-md-offset-5 ">
					<button type="submit" class="btn btn-success btn-flat">Update <i class="fa fa-save"></i></button>
					<a href="{{ url('/') }}" class="btn btn-danger btn-flat">Batal</a>
				</div>
				{!! Form::close() !!}
			</div>
			@if(Auth::user()->is('alumni'))
			<div role="tabpanel" class="row tab-pane" id="cv">
				<center><h4><b>Riwayat Pendidikan Formal</b></h4></center><br>
				{!! Form::open(['method' => 'PUT', 'url' => '/alumni/updatecv']) !!}
				<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-2" id="track_education">
					@include('user.partials.education')
				</div>

				<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-lg-offset-2" id="job_record">
					<hr>
					<center><h4><b>Riwayat Pekerjaan</b></h4></center><br>
					@include('user.partials.job')
				</div>
				<div class="form-group col-xs-offset-3 col-sm-offset-4 col-sm-4 col-md-offset-5">
					<button type="submit" class="btn btn-success btn-flat">Update <i class="fa fa-save"></i></button>
					<a href="{{ url('/') }}" class="btn btn-danger btn-flat">Batal</a>
				</div>
				{!! Form::close() !!}
			</div>

			<div role="tabpanel" class="row tab-pane" id="score">
				<center><h4><b>Daftar Nilai</b></h4></center><br>
				{!! Form::open(['method' => 'PUT', 'url' => '/alumni/updatescore']) !!}
				<div class="form-group has-feedback col-md-offset-2 col-md-8">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai rata-rata raport" name="raport" value="{{ !empty($score)? $score->raport:null }}" />
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai rata-rata UN" name="un" value="{{ !empty($score)? $score->un:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai UN matematika" name="un_mtk" value="{{ !empty($score)? $score->un_mtk:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai kejuruan" name="kejuruan" value="{{ !empty($score)? $score->kejuruan:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 1" name="sem1" value="{{ !empty($score)? $score->sem1:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 2" name="sem2" value="{{ !empty($score)? $score->sem2:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 3" name="sem3" value="{{ !empty($score)? $score->sem3:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 4" name="sem4" value="{{ !empty($score)? $score->sem4:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 5" name="sem5" value="{{ !empty($score)? $score->sem5:null }}"/>
					</div>
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Nilai matematika semester 6" name="sem6" value="{{ !empty($score)? $score->sem6:null }}"/>
					</div>
					<div class="pull-right">
						<button type="submit" class="btn btn-flat btn-success">Update <i class="fa fa-save"></i></button>
						<a href="{{ url('/alumni/profil') }}" class="btn btn-flat btn-danger">Batal</a>
					</div>
				{!! Form::close() !!}
				</div>				
			</div>
			@endif
		</div>
	</div>
</div>
@stop

@section('scripts')
@include('layouts.partials.scripts')	
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>	
<script src="{{ asset('js/imagesloaded.js') }}"></script>	
<script src="{{ asset('/js/jquery.drag-n-crop.js') }}"></script>
<!--script type="text/javascript" src="{{ asset('/js/cropper.min.js') }}"></script-->
<script type="text/javascript" charset="utf8" src="{{ asset('/js/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/flatpickr.l10n.id.min.js') }}"></script>
<script type="text/javascript">		
	$('#image').change(function(){
		var reader = new FileReader();			

		reader.onload = (function(e){				
			$('#photo').attr('src', e.target.result);
			$('#photo').removeAttr("width");
			$('#photo').dragncrop({					
				instruction: true,
				instructionText: 'Drag gambar',
				centered: true,
				overlay: true,
				overflow: true,					
			});				
				// $('#photo').cropper({
				// 	aspectRatio: 1 / 1,
				// 	autoCropArea: 1,
				// 	guides: true,
				// 	dragMode: 'move',					
				// 	zoomable: false,
				// 	viewMode: 3,
				// });
			});			
		reader.readAsDataURL(this.files[0]);				
	});
	$('#update').click(function(){
		$('#offsetX').val($('#photo').position().left);
		$('#offsetY').val($('#photo').position().top);		
	});
	$('#graduation option:first').attr('disabled', true);

	$(".btnsekolah").click(function () {
		baru = '<div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2"> <input type="text" class="form-control level" placeholder="Tingkat" name="level[]" /> </div> <div class="form-group has-feedback col-xs-12 col-sm-4 col-md-3 col-lg-3"> <input type="text" class="form-control institute" placeholder="Nama Instansi" name="institute[]" /> </div> <div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2"> <input type="text" class="form-control entrance" placeholder="Tahun Masuk" name="entrance[]" /> <span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span> </div> <div class="form-group has-feedback col-xs-12 col-sm-2 col-md-2 col-lg-2"> <input type="text" class="form-control graduate" placeholder="Tahun Lulus" name="graduate[]" /> <span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun lulus</i></span> </div> <div class="form-group col-xs-12 col-sm-1 col-md-1 col-lg-1"> <button type="button" class="form-control btn btn-danger btn-flat btnhapus"><i class="fa fa-trash"></i> </button> <span class="help-block hidden-md hidden-lg"><i><br></i></span> </div> <div class="hidden-xs col-sm-1 col-md-2 col-lg-2"> <span class="form-control" style="border: none;"></span> <span class="help-block"><br></span> </div>';
		$("#track_education").append(baru);
	});
    $("#job_record").on('click', '.btnhapuskerja', function(){
    	var index = $(".btnhapuskerja").index(this) + 1;    	
    	var index2 = index * 4;    	

    	var i = 0;

    	while(i < 4){
    		$("#job_record").find("div").eq(index2).remove();
    		++i;
    	}
    });

    $(".btnkerja").click(function(){
    	baru = '<div class="form-group has-feedback col-xs-12 col-sm-4 col-md-5"> <input type="text" class="form-control institute" placeholder="Nama Instansi" name="institute2[]" /> </div> <div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3"> <input type="text" class="form-control entrance" placeholder="Tahun Masuk" name="entrance2[]" /> <span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun masuk</i></span> </div> <div class="form-group has-feedback col-xs-12 col-sm-3 col-md-3"> <input type="text" class="form-control graduate" placeholder="Tahun Keluar" name="graduate2[]" /> <span class="help-block hidden-xs hidden-md hidden-lg"><i>Tahun keluar</i></span> </div> <div class="form-group col-xs-12 col-sm-1 col-md-1"> <button type="button" class="form-control btn btn-danger btn-flat btnhapuskerja"><i class="fa fa-trash"></i> </button></div>';
    	$("#job_record").append(baru);
    });

    $("#track_education").on('click', '.btnhapus', function(){
    	var index = $(".btnhapus").index(this) + 1;    	
    	var index2 = index * 6;    	

    	var i = 0;

    	while(i < 6){
    		$("#track_education").find("div").eq(index2).remove();
    		++i;
    	}
    });

	toastr.options = {
  		"closeButton": true,
  	}
	
	@if (Session::has('msgInfo'))

		toastr.success("{{ Session::get('msgInfo') }}");

	@elseif(Session::has('msgError'))

		toastr.error("{{ Session::get('msgError') }}");
		
	@endif
  	
  	@if (count($errors) > 0)

		@foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach

	@endif

	$(".flatpickr-input").flatpickr({
        allowInput: true            
    });
    $(".flatpickr-input").removeAttr("readonly");
</script>
@stop