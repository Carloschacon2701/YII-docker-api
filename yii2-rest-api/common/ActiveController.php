<?php
// common/ActiveController.php
namespace app\common;

use Yii;
use yii\rest\ActiveController as YiiActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * @param \yii\base\Action $action
 * @param mixed $result
 * @return array|mixed
 */
class ActiveController extends YiiActiveController
{

    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return array|mixed
     */

    public function afterAction($action, $result): mixed
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (is_array($result)) {
            return [
                'status' => 'success',
                'data' => $result,
            ];
        } else {
            return parent::afterAction($action, $result);
        }
    }
}
