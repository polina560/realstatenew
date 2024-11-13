<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property int    $id
 * @property string $key
 * @property string $file
 */
class Document extends AppActiveRecord
{

    public UploadedFile|string|null $newFile = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%document}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['file'], 'required'],
            [['key', 'file'], 'string', 'max' => 255],
            [['newFile'], 'file', 'skipOnEmpty' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'file' => Yii::t('app', 'File'),
            'newFile' => Yii::t('app', 'File')

        ];
    }

//    public function beforeValidate(): bool
//    {
//        $this->newFile = UploadedFile::getInstance($this, 'newFile');
//        return parent::beforeValidate();
//    }
//
    public function beforeSave($insert): bool
    {
//        if ($this->newFile instanceof UploadedFile) {
//            if (!$insert && !empty($this->file)) {
//                // удалить старую
//                $public = Yii::getAlias('@public');
//                $oldImagePath = $public . $this->file;
//                if (file_exists($oldImagePath)) {
//                    unlink($oldImagePath); // удаление файла
//                }
//            }
//            $randomName = Yii::$app->security->generateRandomString(8);
//            $public = Yii::getAlias('@public');
//            $path = '/uploads/' . $randomName . '.' . $this->newFile->extension;
//            $this->newFile->saveAs($public . $path);
//            $this->file = $path;
//        }

        $randomKey = Yii::$app->security->generateRandomString(5);
        $this->key = $randomKey;

        return parent::beforeSave($insert);
    }
}
