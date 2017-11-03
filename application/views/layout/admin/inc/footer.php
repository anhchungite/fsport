
 </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-ui-1.10.4.min.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="<?php echo TEMPLATES_ADMIN ?>/assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="<?php echo TEMPLATES_ADMIN ?>/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/calendar-custom.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.customSelect.min.js" ></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/sparkline-chart.js"></script>
    <script src="<?php echo TEMPLATES_ADMIN ?>/js/easy-pie-chart.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/xcharts.min.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.autosize.min.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.placeholder.min.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/gdp-data.js"></script>	
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/morris.min.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/sparklines.js"></script>	
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/charts.js"></script>
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/jquery.slimscroll.min.js"></script>

	<!-- Select -->
	<script src="<?php echo TEMPLATES_ADMIN ?>/js/bootstrap-select.min.js"></script>
	<!-- <script src="<?php //echo TEMPLATES_ADMIN ?>/js/i18n/defaults-*.min.js"></script> -->

	
	<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/lib/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/lib/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo TEMPLATES_ADMIN ?>/js/app.js""></script>
	<script type="text/javascript">
	            var ckeditor_config = {
	                base_url : "<?php echo base_url()?>",
	                html_path : "admin/admin_ckfinder",
	                connector_path : "admin/admin_ckfinder/connector"
	            }
	</script>

  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>
  </body>
</html>
