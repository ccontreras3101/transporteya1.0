<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Oferta;

/**
 * OfertaSearch represents the model behind the search form about `app\models\Oferta`.
 */
class OfertaSearch_mis_cargas extends Oferta
{
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
            $query->andFilterWhere([
                'empresas_id' => Yii::$app->user->identity->id,
                'aprobada' => 1,
            ]);
      

        $query->andFilterWhere(['like', 'comentarios', $this->comentarios])
            ->andFilterWhere(['like', 'coordenadas_actuales', $this->coordenadas_actuales]);

        return $dataProvider;
    }
}
