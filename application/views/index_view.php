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
            <a href="http://twitter.com/dieterarno" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a>
            <a href="http://csstemplateheaven.com/csstemplateheaven" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
            <a href="http://csstemplateheaven.com/csstemplateheaven" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
            <a href="http://twitter.com/dieterarno" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
        </div>

    </div>

</footer>

<!-- ######################## Scripts ######################## -->

<!-- Included JS Files (Compressed) -->
<script src="<?=base_url();?>public/javascripts/foundation.min.js" type="text/javascript"></script>
<!-- Initialize JS Plugins -->
<script src="<?=base_url();?>public/javascripts/app.js" type="text/javascript"></script>
</body>
</html>
