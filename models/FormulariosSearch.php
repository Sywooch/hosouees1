<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Formularios;

/**
 * FormulariosSearch represents the model behind the search form about `app\models\Formularios`.
 */
class FormulariosSearch extends Formularios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdFormulario'], 'integer'],
            [['NombreFormulario', 'Reglamentos', 'DescripcionFormulario', 'ArchivoAdjunto', 'NombreAdjunto', 'EstadoRegistro'], 'safe'],
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
        $query = Formularios::find();

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
            'IdFormulario' => $this->IdFormulario,
        ]);

        $query->andFilterWhere(['like', 'NombreFormulario', $this->NombreFormulario])
            ->andFilterWhere(['like', 'Reglamentos', $this->Reglamentos])
            ->andFilterWhere(['like', 'DescripcionFormulario', $this->DescripcionFormulario])
            ->andFilterWhere(['like', 'ArchivoAdjunto', $this->ArchivoAdjunto])
            ->andFilterWhere(['like', 'NombreAdjunto', $this->NombreAdjunto])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
