<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecommerce</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/bootstrap.min.css'); ?>">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('user/css/owl.theme.default.min.css'); ?>">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/core.css'); ?>">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/shortcode/shortcodes.css'); ?>">
    <!-- Theme main style -->
    <link rel="stylesheet" href="<?php echo base_url('user/style.css'); ?>">
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/responsive.css'); ?>">
    <!-- User style -->
    <link rel="stylesheet" href="<?php echo base_url('user/css/custom.css'); ?>">


    <!-- Modernizr JS -->
    <script src="<?php echo base_url('user/js/vendor/modernizr-3.5.0.min.js'); ?>"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                     <a href="index.html"><img src="<?php echo base_url('user/images/logo/4.png'); ?>" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="<?= site_url('customerdash/dash'); ?>">Home</a></li>
                                        <?php foreach ($categorydata as $category): ?>
                                        <li class="drop"><a href="<?= site_url('customerdash/productbycategory/' . $category['id']); ?>"><?= $category['categories']; ?></a></li>
                                        <?php endforeach; ?>
                                        <li><a href="<?= site_url('customerdash/contactus'); ?>">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="<?= site_url('customerdash/dash'); ?>">Home</a></li>
                                            <?php foreach ($categorydata as $category): ?>
                                            <li class="drop"><a href="<?= site_url('customerdash/productbycategory/' . $category['id']); ?>"><?= $category['categories']; ?></a></li>
                                            <?php endforeach; ?>
                                            <li><a href="<?= site_url('customerdash/contactus'); ?>">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                  <div class="header__search search search__open">
                                    <a href="#"><i class="icon-magnifier icons"></i></a>
                                  </div>
                                    <div class="header__account">
                                      <?php if (session()->has('user_id')): ?>
                                        <a href="<?= site_url('customeruser/logout'); ?>">Logout</a>
                                      <?php else: ?>
                                        <a href="<?= site_url('customeruser/login'); ?>">Login/Register</a>
                                      <?php endif; ?>
                                    </div>
                                    <div class="header__account">
                                      <?php if (session()->has('user_id')): ?>
                                      <a href="<?= site_url('CustomerDash/order'); ?>">Orders</a>
                                      <?php endif; ?>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="<?= site_url('CustomerDash/cart'); ?>"><i class="icon-handbag icons"></i></a>
                                        <a href="<?= site_url('CustomerDash/cart'); ?>"><span class="htc__qua"><?= session()->get('cart_count', 0) ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12" >
                            <div class="search__inner">
                                <form action="<?= site_url('CustomerDash/search') ?>" method="post">
                                    <input name="search" placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
        </div>
