<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Oferta;

/**
 * OfertaSearch represents the model behind the search form about `app\models\Oferta`.
 */
class OfertaSearch extends Oferta
{
    public $pedido;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aprobada', 'empresas_id', 'pedido_id', 'cliente_id'], 'integer'],
            [['oferta_serv'], 'number'],
            [['comentarios', 'coordenadas_actuales'], 'safe'],
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
        $query = Oferta::find();
        if( Yii::$app->user->can('empresa')){
            $query->joinWith(['pedido']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if( Yii::$app->user->can('empresa')){
             $dataProvider->sort->attributes['pedido'] = [
            'asc' => ['pedido.status' => SORT_ASC],
            'desc' => ['pedido.status' => SORT_DESC],
            ];
        }

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if( Yii::$app->user->can('cliente')){
            $query->andFilterWhere([
                'cliente_id' => Yii::$app->user->identity->id,
                'aprobada' =>0,
                'pedido_id'=>$params['pedido_id'],
            ]);
        }else{
             $query->andFilterWhere([
                'cliente_id' => Yii::$app->user->identity->id,
                'aprobada' =>0,
            ]);
        }

        if( Yii::$app->user->can('empresa')){
            $query->andFilterWhere([
                'empresas_id' => Yii::$app->user->identity->id,
                // 'aprobada' => 0,
            ]);
        }
        if( Yii::$app->user->can('empresa')){
            $query->andFilterWhere(['<', 'pedido.status', 2]);
                // ->andFilterWhere(['like', 'comentarios', $this->comentarios])
                // ->andFilterWhere(['like', 'coordenadas_actuales', $this->coordenadas_actuales]);
        }
        if( Yii::$app->user->can('cliente')){
            $query//->andFilterWhere(['<', 'pedido.status', 1]);
                ->andFilterWhere(['like', 'comentarios', $this->comentarios])
                ->andFilterWhere(['like', 'coordenadas_actuales', $this->coordenadas_actuales]);
        }

        return $dataProvider;
    }
}
