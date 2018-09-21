<?php
class ModelExtensionModuleFocAdd2cartBox extends Model {
  const SETTINGS_GROUP     = 'foc_add2cart_box';
  const SETTINGS_GROUP_KEY = 'foc_add2cart_box_data';

  public function __construct ($registry) {
    parent::__construct($registry);
    $this->load->model('setting/setting');
  }

  public function getSettings () {
    $settings = $this->model_setting_setting->getSetting(self::SETTINGS_GROUP);

    if (is_null($settings) || !isset($settings[self::SETTINGS_GROUP_KEY])) {
      return $this->defaultSettings();
    }
    else {
      return array_replace_recursive($this->defaultSettings(), $settings[self::SETTINGS_GROUP_KEY]);
    }
  }
}