<?php

namespace app\controllers;

use app\Factory\BookFactory;
use app\models\BookSearch;
use Yii;
use app\common\ActiveController;
// use yii\rest\ActiveController;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';
    private BookFactory $bookFactory;

    public function beforeAction($action): bool
    {
            $this->bookFactory = new BookFactory();
            return parent::beforeAction($action);
    }

    public  function actions(): array
    {
        $actions = parent::actions();
        // Disable the default actions to customize them
        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }

    public function actionIndex(): array
    {
        Yii::info('BookController::actionIndex() called', __METHOD__);
        return $this->bookFactory->getAllBooks();
    }

    public function actionCreate(): array
    {
        Yii::info('BookController::actionCreate() called', __METHOD__);
        $this->bookFactory->createBook(Yii::$app->request->post());
    }
}
