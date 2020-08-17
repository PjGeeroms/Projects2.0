<?php
/**
 * Plugin.php
 */

namespace bitsandbytes\contactForm;

use bitsandbytes\contactForm\models\SettingsModel;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSettings = true;

    public function init() {
        $settings = $this->getSettings();
    }

    protected function createSettingsModel()
    {
        return new SettingsModel();
    }

    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('contact-form/settings', [
            'settings' => $this->getSettings()
        ]);
    }

}