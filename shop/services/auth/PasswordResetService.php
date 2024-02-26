<?php

namespace shop\services\auth;

use shop\forms\PasswordResetRequestForm;
use shop\forms\ResetPasswordForm;
use shop\repositories\UserRepository;
use Yii;
use yii\base\InvalidArgumentException;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $supportEmail;
    private $mailer;
    private $users;

    public function __construct($supportEmail, MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->supportEmail = $supportEmail;
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);

        if (!$user) {
            throw new \DomainException('User is not found');
        }

        $user->requestPasswordReset();

        $this->users->save($user);

        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom($this->supportEmail)
            ->setTo($form->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error');
        }
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }

        if (!$this->users->existByPasswordResetToken($token)) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form)
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }


}