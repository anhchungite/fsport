
<?php $this->load->view("layout/admin/inc/header"); ?>

<?php $this->load->view("layout/admin/inc/leftbar"); ?>

<?php
	$class 		= $this->router->fetch_class();
	$arrClass 	= explode('_', $class);
	$controller = array_pop($arrClass);
	$method		= $this->router->fetch_method();
	$this->load->view("admin/{$controller}/{$method}"); 
?>
<?php $this->load->view("layout/admin/inc/footer"); ?>
