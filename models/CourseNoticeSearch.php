<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CourseNotice;

/**
 * CourseNoticeSearch represents the model behind the search form about `app\models\CourseNotice`.
 */
class CourseNoticeSearch extends CourseNotice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notice_id', 'course_id'], 'integer'],
            [['notice_title', 'notice_content', 'notice_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CourseNotice::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'notice_id' => $this->notice_id,
            'course_id' => $this->course_id,
        ]);

        $query->andFilterWhere(['like', 'notice_title', $this->notice_title])
            ->andFilterWhere(['like', 'notice_content', $this->notice_content])
            ->andFilterWhere(['like', 'notice_date', $this->notice_date]);

        return $dataProvider;
    }
}
