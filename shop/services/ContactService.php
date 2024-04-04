<?php

namespace shop\services;

use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $supportEmail;
    private $adminEmail;
    private MailerInterface $mailer;

    public function __construct($supportEmail, $adminEmail, MailerInterface $mailer)
    {
        $this->supportEmail = $supportEmail;
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function sendEmail(ContactForm $form): void
    {
        $sent = $this->mailer->compose()
            ->setTo($this->adminEmail)
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