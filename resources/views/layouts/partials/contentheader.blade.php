<!-- Content Header (Page header) -->
@if(!isset($url))
    <?php $url = ''; ?>
@endif
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
    	<?php $url = explode('/', $url); ?>
        <li class="fa fa-home"></li>
    	@foreach($url as $uri)
		<li @if ($uri == end($url)) class="active" 	@endif>{{ ucfirst($uri) }}</li>
		@endforeach        
    </ol>
</section>