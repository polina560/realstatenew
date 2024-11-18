<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%apartment}}".
 *
 * @property int              $id
 * @property string           $title
 * @property string|null      $subtitle
 * @property string|null      $description
 * @property int              $price
 * @property int              $floor
 * @property string|null      $img
 * @property string|null      $address
 * @property string|null      $add_title
 * @property string|null      $add_img
 * @property int|null         $API_flag
 *
 * @property-read Room[]      $rooms
 */

#[Schema(properties: [
    new Property(property: 'id', type: 'integer'),
    new Property(property: 'title', type: 'string'),
    new Property(property: 'subtitle', type: 'string'),
    new Property(property: 'description', type: 'string'),
    new Property(property: 'price', type: 'string'),
    new Property(property: 'floor', type: 'string'),
    new Property(property: 'img', type: 'string'),
    new Property(property: 'address', type: 'string'),
    new Property(property: 'add_title', type: 'string'),
    new Property(property: 'add_img', type: 'string'),
    new Property(property: 'rooms', type: 'string'),
])]
class Apartment extends AppActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%apartment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'price', 'floor'], 'required'],
            [['price', 'floor', 'API_flag'], 'integer'],
            [['title', 'subtitle', 'description', 'img', 'address', 'add_title', 'add_img'], 'string', 'max' => 255]
        ];
    }

    final public function fields(): array
    {
        return [
            'id',
            'title',
            'subtitle',
            'description',
            'price',
            'floor',
            'img' => fn() => Yii::$app->request->hostInfo . $this->img,
            'address',
            'add_title',
            'add_img' => fn() => Yii::$app->request->hostInfo . $this->add_img,
//            'API_flag',
            'rooms'
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'floor' => Yii::t('app', 'Floor'),
            'img' => Yii::t('app', 'Image'),
            'address' => Yii::t('app', 'Address'),
            'add_title' => Yii::t('app', 'Add Title'),
            'add_img' => Yii::t('app', 'Add Img'),
            'API_flag' => Yii::t('app', 'Api Flag'),
        ];
    }

    final public function getRooms(): ActiveQuery
    {
        return $this->hasMany(Room::class, ['id_apartment' => 'id']);
    }
}
