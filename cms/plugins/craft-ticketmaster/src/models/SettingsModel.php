<?php
/**
 * SettingsModel.php
 */

namespace bitsandbytes\ticketmaster\models;

use craft\base\Model;
use craft\fields\Date;

class SettingsModel extends Model
{
    public $apiKey = 'Test';
    public $showSection = true;
    public $textColor = '#222222';
    public $countries = ["be" => "Belgium", "nl" => "Netherlands", "af" => "Africa"];
    public $description = "Some description that has been set";
    public $time = "24:00";

}