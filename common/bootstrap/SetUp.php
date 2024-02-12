<?php

namespace common\bootstrap;

use frontend\services\auth\PasswordResetService;
use Yii;

class SetUp implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;
//        $container->setSingleton(PasswordResetService::class, function () use ($app) {
//            return new PasswordResetService([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']);
//        });
        $container->setSingleton(PasswordResetService::class, [], [
            [Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'],
            $app->mailer
        ]);
    }
}