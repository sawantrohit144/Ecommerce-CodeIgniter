<div class="body__overlay"></div>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('user/images/bg/7.png'); ?>) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="<?= site_url('customerdash/dash'); ?>">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">Search</span>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active"><?= $search; ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <!-- Start Single Category -->
                                <?php foreach ($productdata as $product): ?>
                                <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                    <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="<?= site_url('CustomerDash/productdetail/' . $product['id']) ?>">
                                                <img src="<?= site_url('uploads/' . $product['image']) ?>" alt="product images">
                                            </a>
                                        </div>

                                        <div class="fr__product__inner">
                                            <h4><a href="product-details.html"><?= $product['name']; ?></a></h4>
                                            <ul class="fr__pro__prize">
                                                <li class="old__prize"><?= $product['mrp']; ?></li>
                                                <li><?= $product['price']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <!-- End Single Category -->
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Grid -->
