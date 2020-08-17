<?php
/**
 * FeedbackController.php
 */

namespace bitsandbytes\ticketmaster\controllers;

use craft\web\Controller;

class FeedbackController extends Controller
{
    public function actionSend() {
        $request = \Craft::$app->getRequest();
        $subject = $request->getRequiredParam('subject');
        $topic = $request->getRequiredParam('topic');
        $body = $request->getRequiredParam('message');

        $user = \Craft::$app->getUser()->getIdentity();
        $mailer = \Craft::$app->getMailer();
        $message = $mailer->compose()
            ->setSubject($subject)
            ->setFrom($user->email)
            ->setTo("77cec0495a-e5db86@inbox.mailtrap.io")
            ->setHtmlBody($body);

        $success = $message->send();

        if ($success) {
            \Craft::$app->getSession()->setNotice("Message sent");
        } else {
            \Craft::$app->getSession()->setError("An error occured");
        }
    }
}