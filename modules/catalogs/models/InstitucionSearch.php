<?php

namespace app\modules\catalogs\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalogs\models\Institucion;

/**
 * InstitucionSearch represents the model behind the search form about `app\modules\catalogs\models\Institucion`.
 */
class InstitucionSearch extends Institucion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdInstitucion'], 'integer'],
            [['Nombre', 'Siglas', 'SitioWeb', 'EstadoRegistro'], 'safe'],
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
        $query = Institucion::find();

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
            'IdInstitucion' => $this->IdInstitucion,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Siglas', $this->Siglas])
            ->andFilterWhere(['like', 'SitioWeb', $this->SitioWeb])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
