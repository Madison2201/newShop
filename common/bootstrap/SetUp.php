<?php

namespace common\bootstrap;

use frontend\services\auth\PasswordResetService;
use frontend\services\contact\ContactService;
use Yii;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;
//        $container->setSingleton(PasswordResetService::class, function () use ($app) {
//            return new PasswordResetService([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']);
//        });
        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });
        $container->setSingleton(PasswordResetService::class, [], [
            [Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'],
        ]);
        $container->setSingleton(ContactService::class, [], [
            [Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']],
            Yii::$app->params['adminEmail'],
        ]);
    }
}