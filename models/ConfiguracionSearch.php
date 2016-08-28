<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Configuracion;

/**
 * ConfiguracionSearch represents the model behind the search form about `app\models\Configuracion`.
 */
class ConfiguracionSearch extends Configuracion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdConfiguracion', 'CantidadHorasSociales'], 'integer'],
            [['PesoMaximoAdjuntos', 'EstadoRegistro'], 'safe'],
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
        $query = Configuracion::find();

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
            'IdConfiguracion' => $this->IdConfiguracion,
            'CantidadHorasSociales' => $this->CantidadHorasSociales,
        ]);

        $query->andFilterWhere(['like', 'PesoMaximoAdjuntos', $this->PesoMaximoAdjuntos])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
