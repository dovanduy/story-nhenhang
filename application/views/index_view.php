<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8" />
    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" href="<?=base_url()?>public/images/logo.jpg">
    <title>
        <?=isset($title)?$title:'Nhenhang.com, truyện ngắn,
    truyện ngôn tình, truyện kiếm hiệp, truyện sắc hiệp, truyện kinh dị';?>
    </title>

    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="<?=base_url();?>public/stylesheets/foundation.min.css">
    <link rel="stylesheet" href="<?=base_url();?>public/stylesheets/main.css">
    <link rel="stylesheet" href="<?=base_url();?>public/stylesheets/app.css">
    <script src="<?=base_url();?>public/javascripts/jquery.js"></script>
    <script src="<?=base_url();?>public/javascripts/modernizr.foundation.js"></script>

    

    <link rel="stylesheet" href="<?=base_url();?>public/ligature.css">

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        .twelve{
            background: #24436d;
        }
        .nav-bar li{
            float:left;
        }
        .nav-bar li a{
            color:white;
        }
        .navbar-fixed-top{
            top: 0;
            border-width: 0 0 1px;
            position: fixed;
            right: 0;
            left: 0;
            z-index: 1030;
        }
    </style>
</head>

<body>

<!-- ######################## Main Menu ######################## -->

<nav style="margin-bottom: 15px;">

    <div class="twelve columns header_nav navbar-fixed-top">


            <ul id="menu-header" class="nav-bar horizontal">

                <li class="active"><a href="<?=base_url()?>">Trang chủ</a></li>
                <li><a href="<?=base_url()?>truyen-ngan.html">Truyện ngắn</a></li>
                <li><a href="<?=base_url()?>ngon-tinh.html">Ngôn tình</a></li>
                <li><a href="<?=base_url()?>kiem-hiep.html">Kiếm Hiệp</a></li>
                <li><a href="<?=base_url()?>tien-hiep.html">Tiên Hiệp</a></li>
                <li><a href="<?=base_url()?>truyen-teen.html">Truyện teen</a></li>
                <li><a href="<?=base_url()?>trinh-tham.html">Trinh thám</a></li>
                <li><a href="<?=base_url()?>truyen-ma.html">Truyện ma</a></li>



            </ul>




    </div>

</nav>


<!-- ######################## Header ######################## -->
<br>
<div>
    <?=$this->load->view($view);?>
</div>

<!-- ######################## Footer ######################## -->

<footer>

    <div class="row">

        <div class="twelve columns footer">
            <a target="_blank" href="https://twitter.com/tienn2t" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a>
            <a target="_blank" href="https://www.facebook.com/tienn2t?fref=ts" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
            <a target="_blank" href="https://www.pinterest.com/tienthanh3386" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
            <a target="_blank" href="https://www.flickr.com" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
        </div>

    </div>

</footer>
<div id="my-modal-for-loading" data-backdrop="static" data-keyboard="false" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="loading" style="padding: 10px 0px;">
                <div class="loading-img text-center">
                    <img src="http://appdaily.vn/public/images/loading50.gif">
                </div>
                <p class="text-center">Vui lòng chờ trong giây lát</p>
            </div>
        </div>
    </div>
</div>
<!-- ######################## Scripts ######################## -->

<!-- Included JS Files (Compressed) -->
<script src="<?=base_url();?>public/javascripts/foundation.min.js" type="text/javascript"></script>
<!-- Initialize JS Plugins -->
<script src="<?=base_url();?>public/javascripts/app.js" type="text/javascript"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-54146556-1', 'auto');
    ga('send', 'pageview');

</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1597299333836183&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
