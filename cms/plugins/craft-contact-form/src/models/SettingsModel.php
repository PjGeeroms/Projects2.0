<?php
/**
 * SettingsModel.php
 */

namespace bitsandbytes\contactForm\models;

use craft\base\Model;
use craft\elements\Entry;
use craft\fields\Date;

class SettingsModel extends Model
{
    public $fromEmail = "";
    public $toEmail = "";
    public $subject = "";
    public $redirectUrl;
}