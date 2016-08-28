<?php

namespace app\modules\catalogs\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalogs\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `app\modules\catalogs\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdProyecto', 'HorasSolicitadas', 'IdInstitucion', 'IdEstadoProyecto', 'IdPersonaAsesor', 'NumeroPersonas'], 'integer'],
            [['NombreProyecto', 'Ubicacion', 'FechaIni', 'FechaFin', 'EstadoRegistro'], 'safe'],
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
    public function search($params, $where = FALSE)
    {
        $query = Proyecto::find();
        
        if($where !== FALSE)
        {
            $query->where($where);
        }
        
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
            'IdProyecto' => $this->IdProyecto,
            'HorasSolicitadas' => $this->HorasSolicitadas,
            'FechaIni' => $this->FechaIni,
            'FechaFin' => $this->FechaFin,
            'IdInstitucion' => $this->IdInstitucion,
            'IdEstadoProyecto' => $this->IdEstadoProyecto,
            'IdPersonaAsesor' => $this->IdPersonaAsesor,
            'NumeroPersonas' => $this->NumeroPersonas,
        ]);

        $query->andFilterWhere(['like', 'NombreProyecto', $this->NombreProyecto])
            ->andFilterWhere(['like', 'Ubicacion', $this->Ubicacion])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
