<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;
use yii\helpers\VarDumper;

/**
 * QuestionSearch represents the model behind the search form of `app\models\Question`.
 */
class QuestionSearch extends Question
{
    public $user;
    public $course;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'point', 'course_id', 'created_at', 'updated_at'], 'integer'],
            [['text_quest', 'code_quest', 'key_word', 'key_wrong_word', 'course', 'user'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Question::find()
        ->joinWith('course')
        ->joinWith('course.user');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['course'] = [
            'asc' => ['course.name_course' => SORT_ASC],
            'desc' => ['course.name_course' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['course.user.username' => SORT_ASC],
            'desc' => ['course.user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'point' => $this->point,
            'course_id' => $this->course_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'text_quest', $this->text_quest])
            ->andFilterWhere(['like', 'code_quest', $this->code_quest])
            ->andFilterWhere(['like', 'key_word', $this->key_word])
            ->andFilterWhere(['like', 'key_wrong_word', $this->key_wrong_word])
            ->andFilterWhere(['like', 'course.name_course', $this->course])
            ->andFilterWhere(['like', 'course.user.username', $this->user]);


        return $dataProvider;
    }
}
