<?php

namespace api\controllers;

use api\modules\v1\controllers\AppController;
use common\models\Apartment;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

use yii\rbac\DbManager;
use api\components\devInfo\controllers\DevInfoController;
use api\modules\v1\Module;
use common\components\{UserUrlManager, Utils};
use common\models\User;
use yii\i18n\Formatter;
use yii\log\FileTarget;
use yii\symfonymailer\Mailer;
use yii\web\{JsonParser, JsonResponseFormatter, Request, Response};
class ApartmentControllers extends AppController
{

//    public function behaviors()
//    {
//        return ArrayHelper::merge(parent::behaviors(), [
//            'authentificator' => ['except' => ['index']],
//
//        ]);
//    }

    public function actionIndex()
    {
        $id = $this->getParameterFromRequest('id');


        $query = Apartment::find()->with('rooms');

        if($id != null) {
            $query->andWhere(['id' => $id]);
            return [
                'success' => true,
                'data' => $query->one(),
            ];
        }

        $query->andWhere(['API_flag' => 1]);

        $provider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => [
//                'pageSize' => 3
//            ]
        ]);


        return $this->returnSuccess([
            'apartments' => $provider,

        ]);


    }
}
