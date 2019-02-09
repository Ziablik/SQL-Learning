<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_quest".
 *
 * @property int $user_id
 * @property int $quest_id
 *
 * @property Question $quest
 * @property User $user
 */
class UserQuest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_quest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'quest_id'], 'required'],
            [['user_id', 'quest_id'], 'integer'],
            [['user_id', 'quest_id'], 'unique', 'targetAttribute' => ['user_id', 'quest_id']],
            [['quest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['quest_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'quest_id' => Yii::t('app', 'Quest ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuest()
    {
        return $this->hasOne(Question::className(), ['id' => 'quest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
