<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property int                 $id
 * @property string              $name
 *
 * @property-read GalleryImage[] $galleryImages
 */

#[Schema(properties: [
    new Property(property: 'id', type: 'integer'),
    new Property(property: 'name', type: 'string'),
    new Property(property: 'images', type: 'string'),

])]
class Gallery extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    final public function fields(): array
    {
        return [
            'id',
            'name',
            'images',
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }


    public function getGalleryNameArray()
    {
        $names = self::find()->select(['id', 'name'])->asArray()->all();


        return array_column($names, 'name', 'id');
    }



    public static function viewMenuItems()
    {
        /** @var self[] $items */
        $items = self::find()->all();
        $results = [];
        foreach($items as $item){
            $results[] = [
                'label' => $item->name,
                'url' => ['/gallery-image/index', 'id_gallery' => $item->id],
            ];

        }
        return $results;
    }

    final public function getImages(): ActiveQuery
    {
        return $this->hasMany(GalleryImage::class, ['id_gallery' => 'id']);
    }
}
