<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string $text_quest
 * @property string $code_quest
 * @property string $key_word
 * @property string $key_wrong_word
 * @property int $point
 * @property int $course_id
 * @property int $created_at
 * @property int $updated_at
 * @property string $codeByStudent
 *
 * @property Course $course
 * @property UserQuest[] $userQuests
 * @property User[] $users
 */
class Question extends \yii\db\ActiveRecord
{
    public $codeByStudent;
    public $wrongWordList = ['DELETE' , 'UPDATE', 'INSERT', 'DROP'];

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
            [['text_quest', 'code_quest', 'key_word', 'key_wrong_word', 'codeByStudent'], 'string'],
            [['point', 'course_id', 'created_at', 'updated_at'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text_quest' => Yii::t('app', 'Текст практической задачи'),
            'code_quest' => Yii::t('app', 'Эталонный код'),
            'key_word' => Yii::t('app', 'Ключивые слова'),
            'key_wrong_word' => Yii::t('app', 'Запрещенные ключевые слова'),
            'point' => Yii::t('app', 'Количество баллов за задачу'),
            'user' => 'Автор задачи',
            'course' => 'Курс задачи',
            'course_id' => Yii::t('app', 'Course ID'),
            'codeByStudent' => 'Форма для ввода sql-кода',
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
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

    public function check($codeByStudent)
    {
        foreach ($this->wrongWordList as $item)
        {
            if(stripos($codeByStudent, $item) != false || stripos($codeByStudent, $item) === 0)
            {
//                VarDumper::dump(Yii::$app->session->setFlash('error', 'Вы использовали не допустимые слова (*_*)'),10,true);
//                VarDumper::dump(YIi::$app->session,10,true);
                return Yii::$app->session->setFlash('error', 'Вы использовали не допустимые слова (*_*)');
            }
        }

        return $this->checkRightWords($codeByStudent);
    }

    public function checkRightWords($codeByStudent)
    {
        if(empty($this->key_word))
        {
            return $this->createTables($codeByStudent);
        }
        $list = str_replace(',', '', $this->key_word);
        $list = explode(' ', $list);
//        VarDumper::dump($codeByStudent,10,true);
//        VarDumper::dump($list,10,true);
//        VarDumper::dump(stripos($codeByStudent, 'select'));
//        VarDumper::dump((0 === false),10, true);
        foreach ($list as $item)
        {
//            VarDumper::dump($item,10,true);
//            VarDumper::dump(stripos($codeByStudent,$item),10,true);
            if(stripos($codeByStudent, $item) === false)
            {
//                VarDumper::dump(false,10,true);
                return Yii::$app->session->setFlash('error', 'Вы не использовали слова, необходимые для решение практического задания');
            }
        }

        return $this->createTables($codeByStudent);

    }

    public function createTables($codeByStudent)
    {
        try{
            $tableByStudent = Yii::$app->computer_company->createCommand($codeByStudent)->queryAll();
        }
        catch(Exception $e){
            return Yii::$app->session->setFlash('error', $e->getMessage());
//            VarDumper::dump($e->getMessage(),10,true);
        };
        $tableByTeacher = Yii::$app->computer_company->createCommand($this->code_quest)->queryAll();
        return $this->checkTables($tableByStudent, $tableByTeacher);

    }

    public function checkTables($tableByStudent, $tableByTeacher)
    {
//        VarDumper::dump($tableByTeacher == $tableByStudent,10, true);
        if($tableByStudent == $tableByTeacher)
        {
            Yii::$app->session->setFlash('success','Все верно!!!');
        }
        else
        {
            Yii::$app->session->setFlash('error','Решение не верное, посмотрите на результаты и попробуйте еще раз');
        }
    }










}
