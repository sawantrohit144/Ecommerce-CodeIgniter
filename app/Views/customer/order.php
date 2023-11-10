<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('user/images/bg/7.png'); ?>) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="<?= site_url('customerdash/dash'); ?>">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Thank You</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

        <!-- wishlist-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order ID</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr">Address</span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderHistory as $order): ?>
                                              <?php foreach ($order['product_ids'] as $product_id): ?>
                                              <tr>
                                                  <td class="product-add-to-cart"><a href="<?= site_url('customerdash/orderdetail/'. $order['id'] . '/' . $product_id); ?>"><?= $product_id ?></a></td>
                                                  <td class="product-name"><?= $order['added_on'] ?></td>
                                                  <td class="product-name"><?= $order['address'] ?></td>
                                                  <td class="product-name"><?= $order['payment_type'] ?></td>
                                                  <td class="product-price"><span class="amount"><?= $order['payment_status'] ?></span></td>
                                                  <td class="product-stock-status"><span class="wishlist-in-stock"><?= $order['order_status'] ?></span></td>
                                              </tr>
                                             <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist-area end -->
