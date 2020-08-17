<?php
/**
 * Plugin.php
 */

namespace bitsandbytes\caseOrganizer;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSection = true;

    public function init() {
        $settings = $this->getSettings();
    }


}