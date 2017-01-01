<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<?php $url='Maintenance' ?>
<body class="skin-blue sidebar-mini">
<center>
    <div class="error-page" style="display: table-cell; vertical-align: middle;">
        <h2 class="headline text-red">503</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Maintenance Mode</h3>
            <p>
                Maaf, website sedang dalam perbaikan. Coba akses dalam waktu beberapa saat lagi.<br><br>
                <b>~ Tim Pengembang Website SMK Negeri 2 Wonosari ~</b>
            </p>            
        </div>
    </div><!-- /.error-page -->
</center>
</body>
</html>