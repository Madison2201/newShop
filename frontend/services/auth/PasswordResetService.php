<?php

namespace frontend\services\auth;

use common\entities\User;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $supportEmail;
    private $mailer;

    public function __construct($supportEmail, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->supportEmail = $supportEmail;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        /* @var $user User */
        $this->getByEmail($form->email);

        if (!$user) {
            throw new \DomainException('User is not found');
        }

        $user->requestPasswordReset();

        $this->save($user);

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

        if (!User::findByPasswordResetToken($token)) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form)
    {
        $user = $this->existByPasswordResetToken($token);
        if ($user) {
            throw new InvalidArgumentException('User not found.');
        }
        $user->resetPassword($form->password);
        $this->save($user);

    }

    private function getByEmail($email): User
    {
        if (!$user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $email,
        ])) {
            throw new \DomainException('User is not found');
        }
        return $user;

    }

    private function existByPasswordResetToken(string $token): User
    {
        return User::findByPasswordResetToken($token);
    }

    private function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
    }
}