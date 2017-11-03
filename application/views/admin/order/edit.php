<?php
$id = "";
$user = "";
$user_email = "";
$user_phone = "";
$total = 0;
$status = -1;
$pur_date = "";
$chan_date = "";
$cost = 0;
$orderNote = "";

$pay_name = "";
$pay_addr = "";
$pay_phone = "";
$pay_city = "";
$pay_method = "";

$ship_name = "";
$ship_phone = "";
$ship_addr = "";
$ship_city = "";

if(isset($arrOrder)){
    $id = $arrOrder['orderID'];
    $user = $arrOrder['userFullName'];
    $user_email = $arrOrder['userEmail'];
    $user_phone = $arrOrder['userPhone'];
    $total =$arrOrder['total'];
    $status = $arrOrder['orderStatusID'];
    $pur_date = $arrOrder['purchaseDate'];
    $chan_date = $arrOrder['changeDate'];
    $cost = $arrOrder['cost'];
    $note = $arrOrder['orderNote'];

    $pay_name = $arrOrder['payName'];
    $pay_addr = $arrOrder['payAddress'];
    $pay_dist = $arrOrder['payDistrict'];
    $pay_phone = $arrOrder['payPhone'];
    $pay_email = $arrOrder['payEmail'];
    $pay_city = $arrOrder['payCity'];
    $pay_method = $arrOrder['payMethod'];

    $ship_name = $arrOrder['shipName'];
    $ship_phone = $arrOrder['shipPhone'];
    $ship_addr = $arrOrder['shipAddress'];
    $ship_dist = $arrOrder['shipDistrict'];
    $ship_city = $arrOrder['shipCity'];

}
pr_r($arrOrder);
pr_r($arrOrderProduct);
echo '<pre>';
print_r(get_attr(52,'size'));
echo '</pre>';
?>
<div class="row">
   <div class="col-lg-12">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php if(isset($title))echo $title?></h3>
         </div>
         <div class="panel-body">
             <ul class="form_error"
                 style="margin-bottom: 20px">
                 <?php echo form_error('pay_name', '<li>', '</li>') ?>
                 <?php echo form_error('pay_phone', '<li>', '</li>') ?>
                 <?php echo form_error('pay_email', '<li>', '</li>') ?>
                 <?php echo form_error('pay_addr', '<li>', '</li>') ?>
                 <?php echo form_error('pay_dist', '<li>', '</li>') ?>
                 <?php echo form_error('pay_city', '<li>', '</li>') ?>
                 <?php echo form_error('ship_name', '<li>', '</li>') ?>
                 <?php echo form_error('ship_phone', '<li>', '</li>') ?>
                 <?php echo form_error('ship_addr', '<li>', '</li>') ?>
                 <?php echo form_error('ship_dist', '<li>', '</li>') ?>
                 <?php echo form_error('ship_city', '<li>', '</li>') ?>
                 <?php echo form_error('pay_method', '<li>', '</li>') ?>
                 <?php echo form_error('order_status', '<li>', '</li>') ?>
                 <?php echo form_error('product[quantity][]', '<li>', '</li>') ?>
                 <?php echo form_error('product[size][]', '<li>', '</li>') ?>
                 <?php echo form_error('product[color][]', '<li>', '</li>') ?>
             </ul>
            <form class="form-horizontal" method="post" action="">
               <ul id="order" class="nav nav-tabs">
                  <li class="active"><a href="#tab-customer" data-toggle="tab" aria-expanded="true">Đơn hàng</a></li>
                  <li class=""><a href="#tab-cart" data-toggle="tab" aria-expanded="false">Sản phẩm</a></li>
                  <li class=""><a href="#tab-payment" data-toggle="tab" aria-expanded="false">Thanh toán</a></li>
                  <li class=""><a href="#tab-shipping" data-toggle="tab">Giao hàng</a></li>
                   <span class="col-lg-3 pull-right text-right">
                       <button type="reset" value="Nhập lại" class="btn btn-default"><i class="fa fa-refresh"></i> Nhập lại</button>
                       <button type="submit" value="Lưu" name="btn_save" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
                   </span>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab-customer">
                     <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-customer">Khách hàng:</label>
                        <div class="col-sm-10">
                           <input type="text" value="<?php echo $user?>" placeholder="Khách hàng:" id="input-customer" class="form-control" disabled>
                        </div>
                     </div>

                     <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email">E-Mail:</label>
                        <div class="col-sm-10">
                           <input type="text" value="<?php echo $user_email?>" id="input-email" class="form-control" disabled>
                        </div>
                     </div>
                     <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-telephone">Điện thoại:</label>
                        <div class="col-sm-10">
                           <input type="text" value="<?php echo $user_phone?>" id="input-telephone" class="form-control" disabled>
                        </div>
                     </div>
                      <fieldset>
                          <legend></legend>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Phương thức thanh toán</label>
                              <div class="col-sm-10">
                                  <select name="pay_method" class="form-control">
                                      <option value=""> --- Chọn --- </option>
                                      <option value="cod" <?= set_value('pay_method', $pay_method) == 'cod'? "selected":""?>>Giao hàng và thu tiền tận nơi</option>
                                      <option value="ck" <?= set_value('pay_method', $pay_method) == 'ck'? "selected":""?>>Chuyển khoản</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Tình trạng đơn hàng:</label>
                              <div class="col-sm-10">
                                  <select name="order_status" class="form-control">
                                      <option value=""> --- Chọn --- </option>
                                      <?php
                                      $arrOrderStatus = get_order_status();
                                      if(isset($arrOrderStatus)){
                                        foreach ($arrOrderStatus as $key => $value){
                                        ?>
                                            <option value="<?= $value['orderStatusID']?>" <?= set_value('order_status', $status) == $value['orderStatusID']?'selected':''?>><?= $value['orderStatusDes']?></option>
                                      <?php
                                        }
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Ghi chú:</label>
                              <div class="col-sm-10">
                                  <textarea name="order_note" rows="5" class="form-control"><?= set_value('order_note', $note)?></textarea>
                              </div>
                          </div>

                      </fieldset>
                  </div>
                  <div class="tab-pane" id="tab-cart">
                     <div class="table-responsive">
                        <table class="table table-bordered order-product">
                           <thead>
                              <tr>
                                 <td class="text-left">Sản phẩm</td>
                                 <td class="text-right">Kích cỡ</td>
                                 <td class="text-right">Màu sắc</td>
                                 <td class="text-right" style="width: 10%">Số lượng</td>
                                 <td class="text-right">Đơn giá</td>
                                 <td class="text-right">Tổng</td>
                                 <td class="text-center"></td>
                              </tr>
                           </thead>
                           <tbody id="cart">
                           <?php
                           if(isset($arrOrderProduct)){
                               foreach ($arrOrderProduct as $key => $value){
                                   $key = $value['orderProductID'];
                                   ?>
                                   <input type="hidden" name="product[delete][<?= $value['orderProductID']?>]" value="0">
                              <tr class="product product<?= $key?>">

                                 <td class="text-left"><?= $value['productName']?></td>

                                 <td class="text-right">
                                    <select name="product[size][<?= $value['orderProductID']?>]" class="form-control">
                                        <?php foreach (get_attr($value['productID'],'size') as $item_size):?>

                                            <option value="<?= $item_size?>" <?php echo set_value("product[size][{$value['orderProductID']}]", $value['productSize']) == $item_size? 'selected':''?>><?= $item_size?></option>
                                        <?php endforeach;?>
                                    </select>
                                 </td>
                                  <td class="text-right">
                                      <select name="product[color][<?= $value['orderProductID']?>]" class="form-control">
                                          <?php foreach (get_attr($value['productID'],'color') as $item_color):?>
                                              <option value="<?= $item_color?>" <?= set_value("product[color][{$value['orderProductID']}]", $value['productColor']) == $item_color? 'selected':''?>><?= $item_color?></option>
                                          <?php endforeach;?>
                                      </select>
                                  </td>
                                  <td class="text-right">
                                      <input type="number" min="1" onblur="updateTotal(<?= $value['orderProductID']?>)" name="product[quantity][<?= $value['orderProductID']?>]" value="<?= set_value("product[quantity][{$key}]", $value['productQuantity'])?>" class="form-control in-quantity">
                                  </td>
                                 <td class="text-right"><?= number_format($value['productPrice'])?><input class="in-price" type="hidden" value="<?= $value['productPrice']?>"></td>
                                 <td class="text-right td-total"><?= number_format($value['productQuantity'] * $value['productPrice'])?></td>
                                 <td class="text-center">
                                     <button type="button" value="" class="btn btn-danger" onclick="removeProduct(<?= $key?>)"><i class="fa fa-minus-circle"></i></button>
                                 </td>
                              </tr>
                              <?php
                              }
                              }

                              ?>
                           </tbody>
                        </table>
                     </div>

                    
                    
                  </div>
                  <div class="tab-pane" id="tab-payment">

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Họ và tên:</label>
                        <div class="col-sm-10">
                           <input type="text" name="pay_name" value="<?= set_value('pay_name',$pay_name)?>" class="form-control">
                        </div>
                     </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Số điện thoại:</label>
                          <div class="col-sm-10">
                              <input type="text" name="pay_phone" value="<?= set_value('pay_phone',$pay_phone)?>" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Email:</label>
                          <div class="col-sm-10">
                              <input type="text" name="pay_email" value="<?= set_value('pay_email',$pay_email)?>" class="form-control">
                          </div>
                      </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Địa chỉ:</label>
                        <div class="col-sm-10">
                           <input type="text" name="pay_addr" value="<?= set_value('pay_addr',$pay_addr)?>" class="form-control">
                        </div>
                     </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Quận / Huyện:</label>
                          <div class="col-sm-10">
                              <input type="text" name="pay_dist" value="<?= set_value('pay_dist',$pay_dist)?>" class="form-control">
                          </div>
                      </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Thành phố:</label>
                        <div class="col-sm-10">
                            <select name="pay_city" class="form-control">
                                <option value=""> --- Chọn --- </option>
                                <?php
                                $arrCity = get_city();
                                if(isset($arrCity)){
                                    foreach ($arrCity as $key => $value){
                                        ?>
                                        <option value="<?= $value['cityID']?>" <?= set_value('pay_city', $pay_city) == $value['cityID']?"selected":""?>><?= $value['cityName']?></option>
                                        <?php
                                    }
                                }

                                ?>
                            </select>
                        </div>
                     </div>

                  </div>
                  <div class="tab-pane" id="tab-shipping">
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Họ và tên:</label>
                          <div class="col-sm-10">
                              <input type="text" name="ship_name" value="<?= set_value('ship_name',$ship_name)?>" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Số điện thoại:</label>
                          <div class="col-sm-10">
                              <input type="text" name="ship_phone" value="<?= set_value('ship_phone',$ship_phone)?>" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Địa chỉ:</label>
                          <div class="col-sm-10">
                              <input type="text" name="ship_addr" value="<?= set_value('ship_addr',$ship_addr)?>" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Quận / Huyện:</label>
                          <div class="col-sm-10">
                              <input type="text" name="ship_dist" value="<?= set_value('ship_dist',$ship_dist)?>" class="form-control">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Thành phố:</label>
                          <div class="col-sm-10">
                              <select name="ship_city" class="form-control">
                                  <option value=""> --- Chọn --- </option>
                                  <?php
                                  $arrCity = get_city();
                                  if(isset($arrCity)){
                                      foreach ($arrCity as $key => $value){
                                          ?>
                                          <option value="<?= $value['cityID']?>" <?= set_value('ship_city', $ship_city) == $value['cityID']?"selected":""?>><?= $value['cityName']?></option>
                                          <?php
                                      }
                                  }

                                  ?>
                              </select>

                          </div>
                      </div>
                  </div>

               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</section>
</section>
<!--main content end-->