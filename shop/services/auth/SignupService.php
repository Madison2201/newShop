<?php

namespace shop\services\auth;

use common\repositories\UserRepository;
use frontend\forms\SignupForm;
use shop\entities\User;
use Yii;

class SignupService
{
    private $users;
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function signup(SignupForm $form): User
    {
        if (User::find()->andWhere(['username' => $form->username])) {
            throw new \DomainException('Username is already exist');
        }
        if ($this->users->getByEmail($form->email)) {
            throw new \DomainException('Email is already exist');
        }

        $user = User::signup($form->username, $form->email, $form->password);
        $this->users->save($user);
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

//    public function confirm($token): void
//    {
//        if (empty($token)){
//            throw new \DomainException('Empty confirm token.');
//        }
//        $user = $this->getByEmailConfirmToken($token);
//    }
//
//


}