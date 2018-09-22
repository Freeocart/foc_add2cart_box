<?php
class ControllerExtensionModuleFocAdd2cartBox extends Controller {

  public function __construct ($registry) {
    $parentResult = parent::__construct($registry);
    $this->load->model('extension/module/foc_add2cart_box');

    return $parentResult;
	}

	public function install () {
		$this->model_extension_module_foc_add2cart_box->install();
	}

	public function uninstall () {
		$this->model_extension_module_foc_add2cart_box->uninstall();
	}

  private function isOpencart3 () {
    $version_chars = explode('.', VERSION);
    return (int)$version_chars[0] === 3;
  }

  private function getTokenParam () {
    if (isset($this->session->data['user_token'])) {
      return 'user_token=' . $this->session->data['user_token'];
    }
    else {
      return 'token=' . $this->session->data['token'];
    }
  }

  private function createUrl ($url) {
    return $this->url->link($url, $this->getTokenParam(), 'SSL');
  }

	public function index () {
		$this->language->load('extension/module/foc_add2cart_box');
		$this->load->model('localisation/language');

		$validKeys = array_keys($this->model_extension_module_foc_add2cart_box->defaultSettingsItem());

		$data = array();
		$data['heading_title'] = $this->language->get('heading_title');
		$data['breadcrumbs'] = $this->breadcrumbs();
		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');
		$data['column_left'] = $this->load->controller('common/column_left');

		$data['languages'] = $this->model_localisation_language->getLanguages();
    $data['language_id'] = $this->config->get('config_language_id');

		$data['button_cancel'] = $this->language->get('cancel');
		$data['button_save'] = $this->language->get('save');

		$data['fa2cb_settings'] = $this->model_extension_module_foc_add2cart_box->getSettings();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$post = $this->request->post;

			if (isset($post['foc_add2cart_box'])) {
				foreach ($post['foc_add2cart_box'] as $lang_id => $meta_data) {
					foreach ($meta_data as $key => $value) {
						$data['fa2cb_settings'][$lang_id][$key] = $value;
					}
				}

				$this->model_extension_module_foc_add2cart_box->saveSettings($data['fa2cb_settings']);

				$this->response->redirect($this->createUrl('extension/module/foc_add2cart_box/index'));
				// $this->response->redirect($this->url->link('extension/module/foc_add2cart_box/index', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}


		$data['labels'] = array();
		$data['tooltips'] = array();

    foreach ($validKeys as $key) {
			$data['labels'][$key] = $this->language->get('label_' . $key);
			$data['tooltips'][$key] = $this->language->get('tooltip_' . $key);
    }

		return $this->response->setOutput($this->load->view('extension/module/foc_add2cart_box', $data));
	}

  private function breadcrumbs () {
    $breadcrumbs = array();

    $breadcrumbs[] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->createUrl('common/home'),
			'separator' => false
    );
    $breadcrumbs[] = array(
      'text'      => $this->language->get('text_extension'),
      'href'      => $this->createUrl('extension/extension'),
      'separator' => ' :: '
    );
		$breadcrumbs[] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->createUrl('extension/module/foc_add2cart_box'),
			'separator' => ' :: '
    );

    return $breadcrumbs;
  }
}