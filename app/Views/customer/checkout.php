<link rel="stylesheet" href="<?php echo base_url('user/style.css'); ?>">
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
                           <span class="breadcrumb-item active">checkout</span>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Bradcaump area -->
 <!-- cart-main-area start -->
 <div class="checkout-wrap ptb--100">
     <div class="container">
         <div class="row">
             <div class="col-md-8">
                 <div class="checkout__inner">
                     <div class="accordion-list">
                         <div class="accordion">
                             <?php if (empty($loggedIn)) : ?>
                             <div class="accordion__title">
                                 Checkout Method
                             </div>
                             <div class="accordion__body">
                                 <div class="accordion__body__form">
                                     <div class="row">
                                         <div class="col-md-6">
                                             <div class="checkout-method__login">
                                                 <form method="post" action="<?= site_url('customerdash/login') ?>">
                                                     <h5 class="checkout-method__title">Login</h5>
                                                     <div class="single-input">
                                                         <label for="user-email">Email Address</label>
                                                         <input type="email" name="email" placeholder="Enter your email" required>
                                                     </div>
                                                     <div class="single-input">
                                                         <label for="user-pass">Password</label>
                                                         <input type="password" name="password" placeholder="Enter your password" required>
                                                     </div>
                                                     <p class="require">* Required fields</p>
                                                     <div class="dark-btn">
                                                         <button type="submit" class="fv-btn" class="checkout_btn">Login</button>
                                                     </div>
                                                     <div class="p-3 mt-2 text-danger" >
                                                       <?php if (session()->has('usererror')): ?>
                                                           <?= session('usererror') ?>
                                                       <?php endif; ?>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="checkout-method__login">
                                                 <form method="post" action="<?= site_url('customerdash/register') ?>">
                                                     <h5 class="checkout-method__title">Register</h5>
                                                     <div class="single-input">
                                                         <label for="user-email">Name</label>
                                                         <input type="text" name="name" placeholder="Enter your name" required>
                                                     </div>
                                                     <div class="single-input">
                                                         <label for="user-email">Email Address</label>
                                                         <input type="email" name="email" placeholder="Enter your email" required>
                                                     </div>
                                                     <div class="single-input">
                                                         <label for="user-email">Mobile</label>
                                                         <input type="number" name="mobile" placeholder="Enter your number" required>
                                                     </div>
                                                     <div class="single-input">
                                                         <label for="user-pass">Password</label>
                                                         <input type="password" name="password" placeholder="Enter password" required>
                                                     </div>
                                                     <div class="dark-btn">
                                                         <button type="submit" class="fv-btn">Register</button>
                                                     </div>
                                                     <div class="p-3 mt-2 text-danger" >
                                                       <?php if (session()->has('error')): ?>
                                                           <?= session('error') ?>
                                                       <?php endif; ?>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <?php endif; ?>

                             <div class="accordion__title" style="background: #f4f4f4; height: 65px; line-height: 65px; display: flex;
                                                                 align-items: center; padding: 0 30px; position: relative;
                                                                 font-size: 16px; font-weight: 600; letter-spacing: 1px;
                                                                 text-transform: uppercase; margin-bottom: 10px; font-family: "Poppins";
                                                                 cursor: pointer;">
                                 Address Information
                             </div>
                             <?php if (!empty($loggedIn)) : ?>
                             <form method="post" action="<?= site_url('customerdash/info') ?>">
                               <div class="accordion__body">
                                   <div class="bilinfo">
                                           <div class="row">
                                               <div class="col-md-12">
                                                   <div class="single-input">
                                                       <input type="text" name="address" placeholder="Street Address" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="single-input">
                                                       <input type="text" name="city" placeholder="City/State" required>
                                                   </div>
                                               </div>
                                               <div class="col-md-6">
                                                   <div class="single-input">
                                                       <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                   </div>
                                               </div>
                                           </div>
                                   </div>
                               </div>
                               <div class="accordion__title" style="background: #f4f4f4; height: 65px; line-height: 65px; display: flex;
                                                                   align-items: center; padding: 0 30px; position: relative;
                                                                   font-size: 16px; font-weight: 600; letter-spacing: 1px;
                                                                   text-transform: uppercase; margin-bottom: 10px; font-family: "Poppins";
                                                                   cursor: pointer;">
                                   payment information
                               </div>
                               <div class="accordion__body">
                                   <div class="paymentinfo">
                                       <div class="single-method">
                                           COD<input type="radio" name="payment_type" value="COD">&nbsp;&nbsp;
                                           PayU<input type="radio" name="payment_type" value="PayU">
                                       </div>
                                   </div>
                               </div>
                               <input type="submit" name="submit">
                             </form>
                             <?php endif; ?>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="order-details">
                     <h5 class="order-details__title">Your Order</h5>
                     <div class="order-details__item">
                         <?php foreach ($cart as $product): ?>
                         <div class="single-item">
                             <div class="single-item__thumb">
                                 <img src="<?= site_url('uploads/' . $product['image']) ?>" alt="ordered item">
                             </div>
                             <div class="single-item__content">
                                 <a href="#"><?= $product['name']; ?></a>
                                 <span class="price"><?= $product['price']; ?></span>
                             </div>
                             <div class="single-item__remove">
                                 <a href="<?= site_url("CustomerDash/removeproduct/".$product['id']) ?>"><i class="zmdi zmdi-delete"></i></a>
                             </div>
                         </div>
                         <?php endforeach; ?>
                     </div>
                     <div class="ordre-details__total">
                         <h5>Order total</h5>
                         <span class="price"><?= $total; ?></span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- cart-main-area end -->
