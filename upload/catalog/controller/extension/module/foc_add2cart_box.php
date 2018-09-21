<?php
class ControllerExtensionModuleFocAdd2cartBox extends Controller {
	public function index () {
		$this->language->load('extension/module/foc_add2cart_box');
		$data = array();
		$data['heading_title'] = $this->language->get('heading_title');
		$data['breadcrumbs'] = array();
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');
		return $this->response->setOutput($this->load->view('extension/module/foc_add2cart_box', $data));
	}
}