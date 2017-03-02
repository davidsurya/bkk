<?php $bg = random_int(1, 4); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bursa Kerja Khusus SMK Negeri 2 Wonosari">
    <meta name="author" content="">

    <title>Bursa Kerja Khusus SMK N 2 Wonosari</title>

    <!-- Bootstrap 3.3.6 -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ asset('css/creative.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .bgimage {          
          position: relative;
          width: 100%;
          min-height: 10%;  
          background-position: center;

          /* filtering */
          -moz-filter: brightness(0.1) blur(1px);
          -webkit-filter: brightness(0.1) blur(1px);
          -o-filter: brightness(0.1) blur(1px);
          filter: brightness(0.1) blur(1px);
      }
  </style>
</head>

<body id="page-top">
    @include('homepage.navbar')

    <header>
        <img src="{{ url('/image/static/'.$bg.'.jpg') }}" class="bgimage" />
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Selamat datang<br>di BKK SMK Negeri 2 Wonosari</h1>
                <hr>
                <p>Portal pusat informasi lowongan kerja untuk siswa/alumni SMK N 2 Wonosari</p>
                <a href="{{ url('/login') }}" class="btn btn-primary btn-xl page-scroll">Masuk <span class="fa fa-sign-in"></span></a>
            </div>
        </div>
    </header>
    @include('homepage.about')
    @include('homepage.contact')    

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ asset('vendor/scrollreveal/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Theme JavaScript -->
    <script src="{{ asset('js/creative.min.js') }}"></script>

</body>

</html>
