<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(<?php echo base_url('user/images/bg/4.jpg'); ?>) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                          <a class="breadcrumb-item" href="<?= site_url('customerdash/dash'); ?>">Home</a>
                          <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                          <span class="breadcrumb-item active">shopping cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $product): ?>
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="<?= site_url('uploads/' . $product['image']) ?>" alt="product img" /></a></td>
                                    <td class="product-name"><a href="#"><?= $product['name']; ?></a>
                                        <ul  class="pro__prize">
                                            <li class="old__prize"><?= $product['mrp']; ?></li>
                                            <li><?= $product['price']; ?></li>
                                        </ul>
                                    </td>
                                    <td class="product-price"><span class="amount"><?= $product['price']; ?></span></td>
                                    <td class="product-quantity">
                                      <input type="text" name="new_qty" value="<?= $product['qty']; ?>" />
                                      <a class="btns" data-product-id="<?= $product['id'] ?>" href="<?= site_url("CustomerDash/updateproduct/".$product['id']) ?>">Update</a>
                                    </td>
                                    <td class="product-subtotal">
                                      <?php
                                        // Calculate the subtotal for the product
                                        $subtotal = $product['price'] * $product['qty'];
                                        echo $subtotal; // Display the subtotal
                                      ?>
                                    </td>
                                    <td class="product-remove"><a href="<?= site_url("CustomerDash/removeproduct/".$product['id']) ?>"><i class="icon-trash icons"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                        document.querySelectorAll(".btns").forEach(function(button) {
                            button.addEventListener("click", function(event) {
                                event.preventDefault();
                                var newQuantity = this.parentElement.querySelector('input[name="new_qty"]').value;
                                var productID = this.getAttribute("data-product-id");
                                var cartURL = "<?= site_url('CustomerDash/updateproduct/') ?>" + productID + "/" + newQuantity;

                                console.log("newQuantity:", newQuantity);
                                console.log("productID:", productID);
                                console.log("cartURL:", cartURL);

                                window.location.href = cartURL;
                            });
                        });
                    </script>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?= site_url("CustomerDash/dash") ?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="<?= site_url("CustomerDash/checkout") ?>">checkout</a>
                                </div>
                            </div>
                            <?php
                            if (session()->getFlashdata('error')) {
                                echo '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
