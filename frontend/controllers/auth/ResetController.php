<?php

namespace frontend\controllers\auth;

use shop\forms\PasswordResetRequestForm;
use shop\forms\ResetPasswordForm;
use shop\services\auth\PasswordResetService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ResetController extends Controller
{
    private $passwordResetService;

    public function __construct($id, $module, PasswordResetService $passwordResetService, array $config = [])
    {

        $this->passwordResetService = $passwordResetService;
        parent::__construct($id, $module, $config);

    }

    public function actionRequest()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->passwordResetService->request($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }


        }

        return $this->render('@frontend/views/auth/requestPasswordResetToken', [
            'model' => $form,
        ]);
    }


    public function actionConfirm($token)
    {
        $service = $this->passwordResetService;
        try {
            $service->validateToken($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $service->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }


        }

        return $this->render('@frontend/views/auth/resetPassword', [
            'model' => $form,
        ]);
    }
}