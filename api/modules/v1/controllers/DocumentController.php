<?php

namespace api\modules\v1\controllers;

use api\controllers\ActiveDataProvider;
use api\controllers\AppController;
use api\controllers\ArrayHelper;
use api\controllers\Documents;
use common\models\Document;
use OpenApi\Attributes\{Get, Items, Property};

class DocumentController extends \api\modules\v1\controllers\AppController
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


        $query = Document::find();

        if($id != null) {
            $query->andWhere(['id' => $id]);
            return [
                'success' => true,
                'data' => $query->one(),
            ];
        }

        $provider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => [
//                'pageSize' => 3
//            ]
        ]);


        return $this->returnSuccess([
            'documents' => $provider,

        ]);


    }
}
