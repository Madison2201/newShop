<?php

namespace frontend\controllers;

use shop\forms\ContactForm;
use shop\services\ContactService;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
{
    private $contactService;

    public function __construct($id, $module, ContactService $contactService, array $config = [])
    {
        $this->contactService = $contactService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->contactService->sendEmail($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
//                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);
    }

}