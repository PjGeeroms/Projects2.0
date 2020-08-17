<?php
/**
 * CaseOrganizerController.php
 */

namespace bitsandbytes\contactForm\controllers;

use bitsandbytes\contactForm\models\SettingsModel;
use bitsandbytes\contactForm\Plugin;
use Craft;
use craft\web\Controller;

/**
 * ContactFormController
 */
class ContactFormController extends Controller
{

    protected $allowAnonymous = true;

    public function actionSendForm() {
        $request = Craft::$app->getRequest();

        $name = $request->getBodyParam("name");
        $email = $request->getBodyParam("email");
        $tel = $request->getBodyParam("tel", "Niet opgegeven");
        $description = $request->getBodyParam("description");
        $isNewProject = $request->getBodyParam("isNew");
        $isExistingProject = $request->getBodyParam('isExisting');
        $projectUrl = $request->getBodyParam('projectUrl', "Niet opgegeven");

        // Validate the form by some basic rules.
        $validFields = new \stdClass();
        $validFields->name = false;
        $validFields->email = false;
        $validFields->description = false;

        // We use the same validation rules as in the frontend
        if (strlen($name) >= 2) {
            $validFields->name = true;
        }

        if (strlen($email) >= 5) {
            $validFields->email = true;
        }

        if (strlen($description) >= 10) {
            $validFields->description = true;
        }

        $isValid = $validFields->name && $validFields->email && $validFields->description;

        if (!$isValid) {
            return $this->asJson(["error" => "Niet alle vereiste velden werden ingevuld"]);
        }

        // At this point we can send the mail
        /** @var SettingsModel $settings */
        $settings = Plugin::getInstance()->getSettings();

        $body = "Het contactformulier werd ingevuld!<br>";
        $body .= "Naam: " . $name . "<br>";
        $body .= "Email: " . $email . "<br>";
        $body .= "Telefoon: " . $tel . "<br><br>";
        $body .= $isNewProject ? "Het gaat om een nieuw project" : "Het gaat om een bestaand project";
        $body .= "<br>";
        $body .= $projectUrl ?: '';
        $body .= "<br>";
        $body .= "Omschrijving: <br>" . $description . "<br>";

        $mailer = Craft::$app->getMailer();
        $message = $mailer->compose()
            ->setFrom($settings->fromEmail)
            ->setTo($settings->toEmail)
            ->setSubject($settings->subject)
            ->setHtmlBody($body);

        $success = $message->send();

        if ($success) {
            return $this->asJson(["success" => "Het contact formulier werd goed ontvangen!"]);
        }

        return $this->asJson(["error" => "Er is een technische fout opgetreden"]);
    }


}