<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $text_quest
 * @property string $code_quest
 * @property string $key_word
 * @property string $key_wrong_word
 * @property int $point
 *
 * @property UserQuest[] $userQuests
 * @property User[] $users
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_quest', 'code_quest'], 'required'],
            [['text_quest', 'code_quest', 'key_word', 'key_wrong_word'], 'string'],
            [['point'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text_quest' => Yii::t('app', 'Text Quest'),
            'code_quest' => Yii::t('app', 'Code Quest'),
            'key_word' => Yii::t('app', 'Key Word'),
            'key_wrong_word' => Yii::t('app', 'Key Wrong Word'),
            'point' => Yii::t('app', 'Point'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserQuests()
    {
        return $this->hasMany(UserQuest::className(), ['quest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_quest', ['quest_id' => 'id']);
    }
}
