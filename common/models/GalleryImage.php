<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%gallery_image}}".
 *
 * @property int              $id
 * @property int|null         $id_gallery
 * @property string           $img
 * @property string|null      $title
 * @property string|null      $text
 *
 * @property-read Gallery     $gallery
 */
class GalleryImage extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%gallery_image}}';
    }

    public static function externalAttributes(): array
    {
        return ['gallery.name'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_gallery'], 'integer'],
            [['img'], 'required'],
            [['text'], 'string'],
            [['img', 'title'], 'string', 'max' => 255],
            [['id_gallery'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::class, 'targetAttribute' => ['id_gallery' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_gallery' => Yii::t('app', 'Id Gallery'),
            'img' => Yii::t('app', 'Img'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    final public function getGallery(): ActiveQuery
    {
        return $this->hasOne(Gallery::class, ['id' => 'id_gallery']);
    }
}
