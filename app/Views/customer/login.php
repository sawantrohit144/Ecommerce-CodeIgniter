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
                                  <span class="breadcrumb-item active">Login</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
    					<div class="col-md-6">
    						<div class="contact-form-wrap mt--60">
    							<div class="col-xs-12">
    								<div class="contact-title">
    									<h2 class="title__line--6">Login</h2>
    								</div>
    							</div>
    							<div class="col-xs-12">
    								<form id="contact-form" action="<?= site_url('customeruser/login') ?>" method="post">
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="text" name="email" placeholder="Your Email*" style="width:100%" required>
    										</div>
    									</div>
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="password" name="password" placeholder="Your Password*" style="width:100%" required>
    										</div>
    									</div>

    									<div class="contact-btn">
    										<button type="submit" class="fv-btn">Login</button>
    									</div>
                      <div class="field_error">
                        <?php if (session()->has('usererror')): ?>
                            <?= session('usererror') ?>
                        <?php endif; ?>
                      </div>
    								</form>
    								<div class="form-output">
    									<p class="form-messege"></p>
    								</div>
    							</div>
    						</div>
    				</div>
    				<div class="col-md-6">
    						<div class="contact-form-wrap mt--60">
    							<div class="col-xs-12">
    								<div class="contact-title">
    									<h2 class="title__line--6">Register</h2>
    								</div>
    							</div>
    							<div class="col-xs-12">
    								<form id="contact-form" action="<?= site_url('customeruser/registration') ?>" method="post">
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="text" name="name" placeholder="Your Name*" style="width:100%" required>
    										</div>
    									</div>
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="email" name="email" placeholder="Your Email*" style="width:100%" required>
    										</div>
    									</div>
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="number" name="mobile" placeholder="Your Mobile*" style="width:100%" required>
    										</div>
    									</div>
    									<div class="single-contact-form">
    										<div class="contact-box name">
    											<input type="password" name="password" placeholder="Your Password*" style="width:100%" required>
    										</div>
    									</div>

    									<div class="contact-btn">
    										<button type="submit" class="fv-btn">Register</button>
    									</div>
                      <div class="field_error">
                        <?php if (session()->has('error')): ?>
                            <?= session('error') ?>
                        <?php endif; ?>
                        <?php if (session()->has('success')): ?>
                            <?= session('success') ?>
                        <?php endif; ?>
                      </div>
    								</form>
    								<div class="form-output">
    									<p class="form-messege"></p>
    								</div>
    							</div>
    						</div>
				    </div>
				  </div>
        </section>
        <!-- End Contact Area -->
