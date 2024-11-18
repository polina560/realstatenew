<?php

namespace api\modules\v1\controllers;

//use api\controllers\ActiveDataProvider;
use api\behaviors\returnStatusBehavior\JsonSuccess;
use \api\modules\v1\controllers\AppController;
//use api\controllers\ArrayHelper;
//use api\controllers\Gallery;
use common\models\Gallery;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class GalleryController extends \api\modules\v1\controllers\AppController
{

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index']]]);
    }

    /**
     * Returns a list of Gallery's
     */
    #[Get(
        path: '/gallery/index',
        operationId: 'gallery-index',
        description: 'Возвращает полный список изображений в гелереях',
        summary: 'Список изоюражений в галереях',
        security: [['bearerAuth' => []]],
        tags: ['gallery']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'galleries', type: 'array',
            items: new Items(ref: '#/components/schemas/Gallery'),
        )
    ])]
    public function actionIndex(): array
    {
        $id = $this->getParameterFromRequest('id');


        $query = Gallery::find();

        if ($id != null) {
            $query->where(['id' => $id]);
            return [
                'success' => true,
                'data' => $query->one(),
            ];
        }
        else $query->orderBy('id');

        $provider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => [
//                'pageSize' => 3
//            ]
        ]);


        return $this->returnSuccess([
            'galleries' => $provider,

        ]);

    }
}
