<?php

namespace backend\controllers\shop;

use backend\forms\Shop\CategorySearch;
use DomainException;
use shop\entities\Shop\Category;
use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\CategoryForm;
use shop\forms\manage\Shop\TagForm;
use shop\services\manage\Shop\CategoryManageService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CategoryController extends Controller
{
    private CategoryManageService $service;

    public function __construct($id, $module, CategoryManageService $service, $config = [])
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
                    'move-up' => ['POST'],
                    'move-down' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string|Response
    {
        $searchModel = new CategorySearch();
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
            'category' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): string|Response
    {
        $form = new CategoryForm();
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
        $category = $this->findModel($id);
        $form = new CategoryForm($category);
        if ($form->load($this->request->post()) && $form->validate()) {
            try {
                $this->service->edit($category->id, $form);
                return $this->redirect(['view', 'id' => $category->id]);
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }

        return $this->render('update', [
            'model' => $form,
            'category' => $category,
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
    protected function findModel($id): ?Category
    {
        if (($model = Category::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMoveUp(int $id): Response
    {
        $this->service->moveUp($id);
        return $this->redirect(['index']);
    }

    public function actionMoveDown(int $id): Response
    {
        $this->service->moveDown($id);
        return $this->redirect(['index']);
    }
}