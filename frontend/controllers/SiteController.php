<?php

namespace frontend\controllers;


use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\CadastreForm;

/**
 * Site controller
 */
class SiteController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $model = new CadastreForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $cadastralData = Yii::$app->CadastreReader->getData($model->number);
            if (!is_null($cadastralData[0])) {
                foreach ($cadastralData as $data) {
                    $data['price'] = Yii::$app->formatter->asCurrency($data['price']);
                    $data['area'] = Yii::$app->formatter->asDecimal($data['area']).' м³';
                }
            }
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $cadastralData,
            ]);
            return $this->render('cadastre\cadastreForm', ['model' => $model,'dataProvider' => $dataProvider]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

}
