<?php

namespace app\modules\catalogs\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalogs\models\Universidad;

/**
 * UniversidadSearch represents the model behind the search form about `app\modules\catalogs\models\Universidad`.
 */
class UniversidadSearch extends Universidad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdUniversidad'], 'integer'],
            [['Nombre', 'NombreCorto', 'Mision', 'Vision', 'CorreoElectronico', 'Telefono', 'Direccion', 'Url', 'Logo', 'EstadoRegistro'], 'safe'],
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
        $query = Universidad::find();

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
            'IdUniversidad' => $this->IdUniversidad,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'NombreCorto', $this->NombreCorto])
            ->andFilterWhere(['like', 'Mision', $this->Mision])
            ->andFilterWhere(['like', 'Vision', $this->Vision])
            ->andFilterWhere(['like', 'CorreoElectronico', $this->CorreoElectronico])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Url', $this->Url])
            ->andFilterWhere(['like', 'Logo', $this->Logo])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
