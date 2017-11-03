<?php if($this->session->flashdata('flash_ss')){?>
   <div class="alert alert-success fade in">
      <strong>Success!</strong> <?php echo $this->session->flashdata('flash_ss')?>.
   </div>
<?php }?>
<?php if($this->session->flashdata('flash_er')){?>
   <div class="alert alert-danger fade in">
      <strong>Error!</strong> <?php echo $this->session->flashdata('flash_er')?>.
   </div>
<?php }?>
<div class="row">
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box blue-bg">
         <i class="fa fa-newspaper-o"></i>
         <div class="count"><?php //if(isset($count_product))echo $count_product?></div>
         <div class="title">Sản phẩm</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box brown-bg">
         <i class="fa fa-users"></i>
         <div class="count"><?php //if(isset($count_user))echo $count_user?></div>
         <div class="title">Thành viên</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->	
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box dark-bg">
         <i class="fa fa-cart-plus"></i>
         <div class="count">2</div>
         <div class="title">Tổng đơn hàng</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
   <?php 
//   $strDataPost 	= "";
//   $strDataVisit 	= "";
//   $strDataOrder	= "100,200,300,400,500,600,650,655,660,665,670,680";
//   $strDataDT		= "10000000,15000000,20000000,25000000,30000000,35000000,40000000,45000000,50000000,55000000,60000000,65000000";
//   $totalVisit 		= 0;
//   if(isset($count_visit))
//   {
//
//	foreach ($count_visit as $key => $value)
//	{
//		//$strDataPost 	.= $value['num_post'].',';
//		$strDataVisit 	.= $value['num_visit'].',';
//		$totalVisit += $value['num_visit'];
//	}
	
//}?>
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="info-box green-bg">
         <i class="fa fa-globe"></i>
         <div class="count"><?php //echo $totalVisit?></div>
         <div class="title">Tổng lượt truy cập</div>
      </div>
      <!--/.info-box-->			
   </div>
   <!--/.col-->
</div>
<!--/.row-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
<canvas id="myChart" width="auto" height="100px">Trình duyệt của bạn không hỗ trợ</canvas>
<script>
var ctx = document.getElementById("myChart");
var data = {
	    labels: ["Thg 1", "Thg 2", "Thg 3", "Thg 4", "Thg 5", "Thg 6", "Thg 7", "Thg 8", "Thg 9", "Thg 10", "Thg 11", "Thg 12"],
	    datasets: [
	        
	        {
	            label: "Lượt truy cập",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(240, 154, 5,0.4)",
	            borderColor: "rgba(240, 154, 5,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(240, 154, 5,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(240, 154, 5,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php //echo $strDataVisit?>],
	            spanGaps: false,
	        },
	        {
	            label: "Đơn hàng",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(75,192,192,0.4)",
	            borderColor: "rgba(75,192,192,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(75,192,192,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(75,192,192,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php //echo $strDataOrder?>],
	            spanGaps: false,
	        },
	        {
	            label: "Doanh thu",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(147,183,76,0.4)",
	            borderColor: "rgba(147,183,76,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(147,183,76,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(147,183,76,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: [<?php echo $strDataDT?>],
	            spanGaps: false,
	        }
	    ]
	};
var myChart = new Chart(ctx, {
    type: 'line',
    data:data,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
 <!-- <div class="row">
<div class="col-lg-12">
<section class="panel">
   <header class="panel-heading">
      THỐNG KÊ
   </header>
   <div class="panel-body">
   <div class="col-lg-3">
      <div class="btn-group add-btn">
         <button type="button" class="btn btn-default">Ngày</button>
         <button type="button" class="btn btn-default">Tuần</button>
         <button type="button" class="btn btn-default">Tháng</button>
         <button type="button" class="btn btn-default">Năm</button>
      </div>
   </div>
  <div class="col-lg-3">
      <select id="select_cat" class="form-control m-bot15" name="danhmuc" required="">
      							<option value="all">Tất cả người dùng</option>
      														<option value="56">Tin Tức Giải Trí</option>
      														<option value="67">Du Học Nhật Bản</option>
      													</select>
      												
      													</div>
      							  <table class="table table-striped table-advance table-hover">
      							   <tbody>
      								  <tr>
      									 <th>STT</th>
      									 <th>ID</th>
      									 <th>Tiêu đề</th>
      									 <th>Danh mục</th>
      									 <th>Trạng thái</th>
      									 <th>Lượt xem</th>
      								  </tr>
      								  <tr>
      									 <td class="col-lg-1"></td>
      									 <td class="col-lg-1"></td>
      									 <td class="col-lg-3"></td>
      									 <td class="col-lg-2"></td>
      									 <td class="col-lg-2"></td>
      									 <td class="col-lg-1"></td>
      								  </tr>
      							   </tbody>
      							</table>
      						</div>
                            </section>
                        </div>
                    </div> -->
</section>
</section>
<!--main content end-->
