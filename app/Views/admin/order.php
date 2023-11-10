
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Order Master</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
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
                                   <?php foreach ($orders as $order): ?>
                                         <tr>
                                             <td class="product-add-to-cart"><a href="<?= site_url('dashboard/orderdetail/'. $order['id']); ?>"><?= $order['id']; ?></a></td>
                                             <td class="product-name"><?= $order['added_on']; ?></td>
                                             <td class="product-name"><?= $order['address']; ?></td>
                                             <td class="product-name"><?= $order['payment_type']; ?></td>
                                             <td class="product-price"><?= $order['payment_status']; ?></td>
                                             <td class="product-stock-status"><?= $order['order_status']; ?></td>
                                         </tr>
                                   <?php endforeach; ?>
                                   </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
         <div class="clearfix"></div>
