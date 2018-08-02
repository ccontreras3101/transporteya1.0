<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;

/**
 * PedidoSearch represents the model behind the search form about `app\models\Pedido`.
 */
class Pedidomispedidos extends Pedido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'cliente_id', 'comuna_origen_id', 'comuna_destino_id'], 'integer'],
            [['origen', 'destino', 'tiempo', 'fecha', 'comentarios', 'coords_origen', 'coords_destino'], 'safe'],
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
        $query = Pedido::find();

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
                'cliente_id' => Yii::$app->user->identity->id,
            ]);

        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['<', 'status', 3]);
            // ->andFilterWhere(['like', 'origen', $this->origen])
            // ->andFilterWhere(['like', 'destino', $this->destino])
            // ->andFilterWhere(['like', 'comentarios', $this->comentarios])
            // ->andFilterWhere(['like', 'coords_origen', $this->coords_origen])
            // ->andFilterWhere(['like', 'coords_destino', $this->coords_destino]);

        return $dataProvider;
    }
}
