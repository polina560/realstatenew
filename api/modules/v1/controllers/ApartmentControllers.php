<?php

namespace api\modules\v1\controllers;

use api\components\devInfo\controllers\DevInfoController;
use common\components\{Utils};
use common\models\Apartment;
use common\models\User;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ApartmentControllers extends Controller
{

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authentificator' => ['except' => ['index']],

        ]);
    }

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
