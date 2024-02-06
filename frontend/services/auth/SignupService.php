<?php

namespace frontend\services\auth;

use common\entities\User;
use frontend\forms\SignupForm;
use Yii;

class SignupService
{
    public function signup(SignupForm $form): User
    {
        if (User::find()->andWhere(['username' => $form->username])) {
            throw new \DomainException('Username is already exist');
        }
        if (User::find()->andWhere(['email' => $form->email])) {
            throw new \DomainException('Email is already exist');
        }

        $user = User::signup($form->username, $form->email, $form->password);
        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
        if (!$this->sendEmail($user)) {
            throw new \RuntimeException('Send email error');
        }
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($user->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}