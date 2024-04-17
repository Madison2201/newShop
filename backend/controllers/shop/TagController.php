<?php

namespace backend\controllers\shop;

use backend\forms\Shop\TagSearch;
use DomainException;
use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\TagForm;
use shop\services\manage\Shop\TagManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TagController extends Controller
{
    private TagManageService $service;

    public function __construct($id, $module, TagManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string|Response
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string|Response
    {
        return $this->render('view', [
            'tag' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $form = new TagForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $brand = $this->service->create($form);
                return $this->redirect(['view', 'id' => $brand->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): string|Response
    {
        $brand = $this->findModel($id);
        $form = new TagForm($brand);
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $this->service->edit($brand->id, $form);
                return $this->redirect(['view', 'id' => $brand->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }

        return $this->render('update', [
            'model' => $form,
            'brand' => $brand,
        ]);
    }


    public function actionDelete(int $id): Response
    {
        try {
            $this->service->remove($id);
        } catch (DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }


    /**
     * @throws NotFoundHttpException
     */
    protected function findModel($id): ?Tag
    {
        if (($model = Tag::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}