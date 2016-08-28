<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Asistencia;

/**
 * AsistenciaSearch represents the model behind the search form about `app\models\Asistencia`.
 */
class AsistenciaSearch extends Asistencia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdAsistencia', 'IdProyecto', 'IdPersona', 'IdUsuarioRegistro'], 'integer'],
            [['Fecha', 'HoraEntrada', 'HoraSalida', 'Comentarios', 'EstadoRegistro'], 'safe'],
            [['CantidadHoras'], 'number'],
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
        $query = Asistencia::find();
        
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
            'IdAsistencia' => $this->IdAsistencia,
            'IdProyecto' => $this->IdProyecto,
            'IdPersona' => $this->IdPersona,
            'Fecha' => $this->Fecha,
            'HoraEntrada' => $this->HoraEntrada,
            'HoraSalida' => $this->HoraSalida,
            'CantidadHoras' => $this->CantidadHoras,
            'IdUsuarioRegistro' => $this->IdUsuarioRegistro,
        ]);

        $query->andFilterWhere(['like', 'Comentarios', $this->Comentarios])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro]);

        return $dataProvider;
    }
}
