<?php

namespace frontend\services\contact;

use frontend\forms\ContactForm;
use Yii;

class ContactService
{
    private $supportEmail;
    private $adminEmail;

    public function __construct($supportEmail, $adminEmail)
    {
        $this->supportEmail = $supportEmail;
        $this->adminEmail = $adminEmail;
    }

    public function sendEmail(ContactForm $form): void
    {
        $sent = Yii::$app->mailer->compose()
            ->setTo($this->adminEmail)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setFrom($this->supportEmail)
            ->setReplyTo([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }

}