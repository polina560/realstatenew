<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%gallery_image}}".
 *
 * @property int         $id
 * @property int|null    $id_gallery
 * @property string      $img
 * @property string|null $title
 * @property string|null $text
 */
class GalleryImage extends AppActiveRecord
{

    public UploadedFile|string|null $imageFile = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%gallery_image}}';
    }

    public static function externalAttributes(): array
    {
        return ['gallery.title'];
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
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_gallery' => Yii::t('app', 'ID Gallery'),
            'img' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

//    public function beforeValidate(): bool
//    {
//        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
//        return parent::beforeValidate();
//    }
//
//    public function beforeSave($insert): bool
//    {
//        if ($this->img instanceof UploadedFile) {
//            if (!$insert && !empty($this->img)) {
//                // удалить старую
//                $public = Yii::getAlias('@public');
//                $oldImagePath = $public . $this->img;
//                if (file_exists($oldImagePath)) {
//                    unlink($oldImagePath); // удаление файла
//                }
//            }
//            $randomName = Yii::$app->security->generateRandomString(8);
//            $public = Yii::getAlias('@public');
//            $path = '/uploads/' . $randomName . '.' . $this->imageFile->extension;
//            $this->imageFile->saveAs($public . $path);
//            $this->img = $path;
//        }
//
//        return parent::beforeSave($insert);
//    }

    public function getGallery(): ActiveQuery
    {
        return $this->hasOne(Gallery::class, ['id' => 'id_gallery']);
    }
}
