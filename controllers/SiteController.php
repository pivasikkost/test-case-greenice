<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\AreasForm;
use app\models\Area;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays areas page.
     *
     * @return Response|string
     */
    public function actionAreas()
    {
        $model = new AreasForm();
        $area = null;
        if ($model->load(Yii::$app->request->post())) {
            $area = $model->address;
        }

        return $this->render('areas', [
            'model' => $model,
            'areas' => Area::getList($area)
        ]);
    }
}
