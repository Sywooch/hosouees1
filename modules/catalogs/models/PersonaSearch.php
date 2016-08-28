<?php

namespace app\modules\catalogs\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalogs\models\Persona;

/**
 * PersonaSearch represents the model behind the search form about `app\modules\catalogs\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPersona', 'UserId', 'IdCarrera'], 'integer'],
            [['Nombres', 'Apellidos', 'CarnetEstudiante', 'CarnetEmpleado', 'DUI', 'NIT', 'Direccion', 'Telefono', 'Sexo', 'Cargo', 'TipoPersona', 'ArchivoAdjunto', 'NombreAdjunto', 'EstadoRegistro', 'Elegible'], 'safe'],
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
    public function search($params, $tipoPersona)
    {
        $query = Persona::find()->where(['TipoPersona' => $tipoPersona]);

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
            'IdPersona' => $this->IdPersona,
            'UserId' => $this->UserId,
            'IdCarrera' => $this->IdCarrera,
        ]);

        $query->andFilterWhere(['like', 'Nombres', $this->Nombres])
            ->andFilterWhere(['like', 'Apellidos', $this->Apellidos])
            ->andFilterWhere(['like', 'CarnetEstudiante', $this->CarnetEstudiante])
            ->andFilterWhere(['like', 'CarnetEmpleado', $this->CarnetEmpleado])
            ->andFilterWhere(['like', 'DUI', $this->DUI])
            ->andFilterWhere(['like', 'NIT', $this->NIT])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Sexo', $this->Sexo])
            ->andFilterWhere(['like', 'Cargo', $this->Cargo])
            ->andFilterWhere(['like', 'TipoPersona', $this->TipoPersona])
            ->andFilterWhere(['like', 'ArchivoAdjunto', $this->ArchivoAdjunto])
            ->andFilterWhere(['like', 'NombreAdjunto', $this->NombreAdjunto])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro])
            ->andFilterWhere(['like', 'Elegible', $this->Elegible]);

        return $dataProvider;
    }
}
