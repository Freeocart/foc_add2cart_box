<?php
class ModelExtensionModuleFocAdd2cartBox extends Model {
  const SETTINGS_GROUP     = 'foc_add2cart_box';
  const SETTINGS_GROUP_KEY = 'foc_add2cart_box_data';

  private $__settings_loaded = false;
  private $__settings = null;

  public function __construct ($registry) {
    parent::__construct($registry);
    $this->load->model('setting/setting');
  }

  public function getSettings () {
    $this->load->model('setting/setting');
    $language_id = $this->config->get('config_language_id');

    $settings = $this->model_setting_setting->getSetting(self::SETTINGS_GROUP);

    if (!is_null($settings)
        && isset($settings[self::SETTINGS_GROUP_KEY])
        && isset($settings[self::SETTINGS_GROUP_KEY][$language_id])
    ) {
      $this->__settings = $settings[self::SETTINGS_GROUP_KEY][$language_id];
      $this->__settings_loaded = true;
    }

    return $this->__settings;
  }

  public function getByKey ($key) {
    if (!$this->__settings_loaded) {
      $this->getSettings();
    }
    $key = self::SETTINGS_GROUP . '_' . $key;

    if (isset($this->__settings[$key])) {
      return $this->__settings[$key];
    }

    return null;
  }

  public function processTemplate ($key, $data) {
    $result = html_entity_decode($this->getByKey($key));
    $continue_label = $this->getByKey('continue_label');

    if (trim($continue_label) !== '') {
      $continue_css_classes = $this->getByKey('continue_css_class');
      $data['continue_btn'] = '<a class="popup-modal-dismiss ' . $continue_css_classes . '" href="#">' . html_entity_decode($continue_label) . '</a>';
    }

    foreach ($data as $variable => $value) {
      $result = str_replace('{{' . $variable . '}}', $value, $result);
    }

    return $result;
  }

  public function getModalTitle ($data) {
    return $this->processTemplate('title', $data);
  }

  public function getModalContent ($data) {
    return $this->processTemplate('content', $data);
  }

  public function getAutocloseTime () {
    return $this->getByKey('autoclose_time');
  }

  public function isEnabled () {
    return (bool) $this->getByKey('status');
  }

}