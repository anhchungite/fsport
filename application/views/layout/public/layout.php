<?php
$class = $this->router->fetch_class();
$arrClass = explode("_", $class);
$data['controller'] = $controller = strtolower($arrClass[0]);
$name = $arrClass[1];
$data['method'] = $method = $this->router->fetch_method();
?>
<?php $this->load->view('layout/public/inc/header', $data)?>

<?php
	$this->load->view("{$name}/{$controller}/{$method}");
?>

<?php $this->load->view('layout/public/inc/footer')?>