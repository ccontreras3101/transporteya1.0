<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;
use app\models\Oferta;

/**
 * PedidoSearch represents the model behind the search form about `app\models\Pedido`.
 */
class Pedidocargasentregadas extends Pedido
{
    public $ofertas;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'cliente_id', 'comuna_origen_id', 'comuna_destino_id'], 'integer'],
            [['origen', 'destino', 'tiempo', 'fecha', 'comentarios', 'coords_origen', 'coords_destino'], 'safe'],
            [['ofertas'],'safe'],
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
        //$query->rightJoin(['ofertas']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // $dataProvider->sort->attributes['oferta'] = [
        //     'asc' => ['ofertas.empresas_id' => SORT_ASC],
        //     'desc' => ['ofertas.empresas_id' => SORT_DESC],
        // ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['>', 'status', 0]);

        if ( \Yii::$app->user->can('cliente') ) {
            $query->andFilterWhere([
                'cliente_id' => \Yii::$app->user->identity->id
            ]);
        }
        
       // $query->andFilterWhere(['ofertas.empresas_id'=> Yii::$app->user->identity->id]);

            
        return $dataProvider;
    }
}
