<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property int    $id
 * @property string $key
 * @property string $file
 */
class Document extends AppActiveRecord
{
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
            [['key', 'file'], 'required'],
            [['key', 'file'], 'string', 'max' => 255]
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
        ];
    }
}
