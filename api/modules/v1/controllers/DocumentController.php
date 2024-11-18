<?php

namespace api\modules\v1\controllers;


use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\models\Document;
use OpenApi\Attributes\{Get, Items, Property};
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


class DocumentController extends \api\modules\v1\controllers\AppController
{

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index']]]);
    }

    /**
     * Returns a list of Document's
     */
    #[Get(
        path: '/document/index',
        operationId: 'document-index',
        description: 'Возвращает полный список документов',
        summary: 'Список документов',
        security: [['bearerAuth' => []]],
        tags: ['document']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'documents', type: 'array',
            items: new Items(ref: '#/components/schemas/Document'),
        )
    ])]
    public function actionIndex(): array
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
