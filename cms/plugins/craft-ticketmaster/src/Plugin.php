<?php
/**
 * Plugin.php
 */

namespace bitsandbytes\ticketmaster;

use bitsandbytes\ticketmaster\models\SettingsModel;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSection = true;
    public $hasCpSettings = true;

    public function init()
    {
        /**
         * @var SettingsModel $settings
         */
        $settings = $this->getSettings();
        $this->hasCpSection = $settings->showSection;
    }

    protected function createSettingsModel()
    {
        return new SettingsModel();
    }

    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('ticketmaster/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}