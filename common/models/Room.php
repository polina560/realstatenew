<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%room}}".
 *
 * @property int              $id
 * @property int              $id_apartment
 * @property string|null      $title
 * @property int|null         $area
 * @property string|null      $uid
 *
 * @property-read Apartment   $apartment
 */
class Room extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%room}}';
    }

    public static function externalAttributes(): array
    {
        return ['apartment.title'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
//            [['id_apartment'], 'required'],
            [['id_apartment', 'area'], 'integer'],
            [['title', 'uid'], 'string', 'max' => 255],
            [['id_apartment'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::class, 'targetAttribute' => ['id_apartment' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_apartment' => Yii::t('app', 'ID Apartment'),
            'title' => Yii::t('app', 'Title'),
            'area' => Yii::t('app', 'Area'),
            'uid' => Yii::t('app', 'UID'),
        ];
    }

    final public function getApartment(): ActiveQuery
    {
        return $this->hasOne(Apartment::class, ['id' => 'id_apartment']);
    }
}
