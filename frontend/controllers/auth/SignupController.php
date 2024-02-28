<?php

namespace frontend\controllers\auth;

use shop\forms\SignupForm;
use shop\services\auth\SignupService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignupController extends Controller
{
    private $signupService;

    public function __construct($id, $module, SignupService $signupService, array $config = [])
    {

        $this->signupService = $signupService;
        parent::__construct($id, $module, $config);

    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
//                $user = (new SignupService())->signup($form);
                $user = $this->signupService->signup($form);
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('@frontend/views/auth/signup', [
            'model' => $form,
        ]);
    }

}