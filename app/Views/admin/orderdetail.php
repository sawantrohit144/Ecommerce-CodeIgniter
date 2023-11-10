
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order Detail</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Quantity</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-price">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($orderDetails as $orderDetail): ?>
                                      <tr>
                                          <td class="product-name"><?= $orderDetail['product_name']; ?></td>
                                          <td class="product-name"><img src="<?= site_url('uploads/' . $orderDetail['product_image']) ?>" alt="product images"></td>
                                          <td class="product-name"><?= $orderDetail['qty']; ?></td>
                                          <td class="product-name"><?= $orderDetail['price']; ?></td>
                                          <td class="product-name"><?= $orderDetail['price'] * $orderDetail['qty']; ?></td>
                                      </tr>
                                  <?php endforeach; ?>
                                  <tr>
                                    <td colspan="3"></td>
                                    <td class="product-name">Total Price</td>
                                    <td class="product-name"><?= $totalPrice; ?></td>
                                  </tr>
                                </tbody>
                              </table>
                              <div id="address_details" class="ml-2 mb-3 pr-3">
                                <strong>Address: </strong><?= $address; ?>, <?= $pincode; ?><br>
                                <strong >Order Status: </strong><?= $orderStatus; ?><br>
                                <div class="">
                                  <form method="post" action="">
                                    <select class="form-control" name="update_order_status">
                                      <?php foreach ($orderStatusOptions as $statusOption): ?>
                                          <option value="<?= $statusOption['id'] ?>"><?= $statusOption['name'] ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <br>
                                    <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount" name="submit">Submit</span>
                                    </button>
                                  </form>
                                </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>
