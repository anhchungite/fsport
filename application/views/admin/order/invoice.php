
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="UTF-8"/>
<title><?php if (isset($title))echo $title?></title>
<link href="http://demo.opencart.com/admin/view/javascript/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"/>
<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN?>/js/bootstrap.min.js"></script>
<link href="<?php echo TEMPLATES_ADMIN?>/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
<link type="text/css" href="http://demo.opencart.com/admin/view/stylesheet/stylesheet.css" rel="stylesheet" media="screen"/>
</head>
<body>
<div class="container">
<div style="page-break-after: always;">
<h1>Đơn hàng #3068</h1>
<table class="table table-bordered">
<thead>
<tr>
<td colspan="2">Chi tiết đơn hàng</td>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 50%;"><address>
<strong>Thời trang thể thao F4Sport</strong><br/>
14 Hùng Vương, Đà Nẵng </address>
<b>Số điện thoại:</b> 0511.722.722<br/>
<b>E-Mail:</b> contact@f4sport.org<br/>
<b>Website:</b> <a href="<?php echo base_url()?>"><?php echo base_url()?></a></td>
<td style="width: 50%;"><b>Ngày lập:</b> 08/09/2016<br/>
<b>Mã đơn hàng:</b> 3068<br/>
<b>Phương thức thanh toán:</b> Ngân lượng<br/>
</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<td style="width: 50%;"><b>Đến</b></td>
<td style="width: 50%;"><b>Vận chuyển đến</b></td>
</tr>
</thead>
<tbody>
<tr>
<td><address>
Nguyễn Thanh<br/>68 Điện Biên Phủ<br/>Đà Nẵng, VN </address></td>
<td><address>
Nguyễn Thanh<br/>68 Điện Biên Phủ<br/>Đà Nẵng, VN </address></td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<td><b>Sản phẩm</b></td>
<td class="text-right"><b>Số lượng</b></td>
<td class="text-right"><b>Đơn giá</b></td>
<td class="text-right"><b>Tổng</b></td>

</tr>
</thead>
<tbody>
<tr>
<td>Áo chạy bộ nam <br/>
</td>
<td class="text-right">2</td>
<td class="text-right"><?php echo number_format(150000)?></td>
<td class="text-right"><?php echo number_format(300000)?></td>

</tr>
<tr>
<td class="text-right" colspan="3"><b>Phí vận chuyển</b></td>
<td class="text-right"><?php echo number_format(25000)?></td>
</tr>
<tr>
<td class="text-right" colspan="3"><b>Tổng</b></td>
<td class="text-right"><?php echo number_format(305000)?></td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
      <thead>
        <tr>
          <td><b>Ghi chú:</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Không có ghi chú</td>
        </tr>
      </tbody>
    </table>
</div>
</div>
</body>
</html>