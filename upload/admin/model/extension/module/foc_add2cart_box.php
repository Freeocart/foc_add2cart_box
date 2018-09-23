<?php
class ModelExtensionModuleFocAdd2cartBox extends Model {

  const SETTINGS_GROUP     = 'foc_add2cart_box';
  const SETTINGS_GROUP_KEY = 'foc_add2cart_box_data';

  public function __construct ($registry) {
    parent::__construct($registry);
    $this->load->model('setting/setting');
  }

  public function defaultSettingsItem () {
    return array(
      self::SETTINGS_GROUP . '_title' => '',
      self::SETTINGS_GROUP . '_content' => '',
      self::SETTINGS_GROUP . '_continue_label' => '',
      self::SETTINGS_GROUP . '_continue_css_class' => '',
      self::SETTINGS_GROUP . '_autoclose_time' => 0,
      self::SETTINGS_GROUP . '_status' => 0
    );
  }

  public function defaultSettings () {
    $default = array();
    $this->load->model('localisation/language');

    $languages = $this->model_localisation_language->getLanguages();

    foreach ($languages as $language) {
      $default[$language['language_id']] = $this->defaultSettingsItem();
    }

    return $default;
  }

  public function install () {
    $this->model_setting_setting->editSetting(
      self::SETTINGS_GROUP,
      array(
        self::SETTINGS_GROUP_KEY => $this->defaultSettings()
      )
    );
  }

  public function uninstall () {
    $this->model_setting_setting->deleteSetting(self::SETTINGS_GROUP);
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

  public function saveSettings ($settings) {
    $settings = array_replace_recursive($this->defaultSettings(), $settings);

    $this->model_setting_setting->editSettingValue(
      self::SETTINGS_GROUP,
      self::SETTINGS_GROUP_KEY,
      $settings
    );
  }
}