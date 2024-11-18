<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use api\behaviors\returnStatusBehavior\RequestFormData;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use common\components\{Utils};
use common\models\Apartment;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ApartmentControllers extends AppController
{

    /**
     * {@inheritdoc}
     */
//    public $modelClass = Apartment::class;

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index']]]);
    }

    /**
     * Returns a list of Apartment's
     */
    #[Post(
        path: '/apartment/index',
        operationId: 'apartment-index',
        description: 'Возвращает полный список квартир',
        summary: 'Список квартир',
        security: [['bearerAuth' => []]],
        tags: ['apartment']
    )]
    #[RequestFormData(
        properties: [
            new Property(property: 'id', description: 'ID Квартиры', type: 'integer')
        ]
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'apartments', type: 'array',
            items: new Items(ref: '#/components/schemas/Apartment'),
        )
    ])]
    public function actionIndex(): array
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
