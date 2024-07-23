<?php

namespace backend\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\User\User;

/**
 * UserSearch represents the model behind the search form of `shop\entities\User\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $username;
    public $email;
    public $status;
    public $date_from;
    public $date_to;
    public $created_at;

    public function rules()
    {
        return [
            [['id', 'status','created_at'], 'integer'],
            [['username', 'email'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }


    public function search($params)
    {
        $query = User::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . '00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . '23:59:59') : null])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
