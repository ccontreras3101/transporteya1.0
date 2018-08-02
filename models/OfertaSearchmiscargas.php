<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Oferta;
use app\models\Pedido;

/**
 * OfertaSearch represents the model behind the search form about `app\models\Oferta`.
 */
class OfertaSearchmiscargas extends Oferta
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
            [['pedido'], 'safe'],
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
        $query->joinWith(['pedido']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['pedido'] = [
        'asc' => ['pedido.status' => SORT_ASC],
        'desc' => ['pedido.status' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
            $query->andFilterWhere([
                'empresas_id' => Yii::$app->user->identity->id,
                'aprobada' => 1,
                 
            ]);
        $query->andFilterWhere(['<', 'pedido.status', 2]);
            //->andFilterWhere(['like', 'coordenadas_actuales', $this->coordenadas_actuales]);

        return $dataProvider;
    }
}
