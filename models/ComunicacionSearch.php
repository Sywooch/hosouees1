<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comunicacion;

/**
 * ComunicacionSearch represents the model behind the search form about `app\models\Comunicacion`.
 */
class ComunicacionSearch extends Comunicacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdComunicacion', 'IdPersonaRemitente', 'IdPersonaReceptor', 'IdProyecto', 'IdUsuarioRegistro'], 'integer'],
            [['Comentarios','Sujeto', 'FechaHora', 'NombreAdjunto1', 'RutaAdjunto1', 'NombreAdjunto2', 'RutaAdjunto2', 'EstadoRegistro'], 'safe'],
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
        $query = Comunicacion::find();
        
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
            'IdComunicacion' => $this->IdComunicacion,
            'IdPersonaRemitente' => $this->IdPersonaRemitente,
            'IdPersonaReceptor' => $this->IdPersonaReceptor,
            'IdProyecto' => $this->IdProyecto,
            'IdUsuarioRegistro' => $this->IdUsuarioRegistro,
        ]);

        $query->andFilterWhere(['like', 'Comentarios', $this->Comentarios])
            ->andFilterWhere(['like', 'FechaHora', $this->FechaHora])
            ->andFilterWhere(['like', 'NombreAdjunto1', $this->NombreAdjunto1])
            ->andFilterWhere(['like', 'RutaAdjunto1', $this->RutaAdjunto1])
            ->andFilterWhere(['like', 'NombreAdjunto2', $this->NombreAdjunto2])
            ->andFilterWhere(['like', 'RutaAdjunto2', $this->RutaAdjunto2])
            ->andFilterWhere(['like', 'EstadoRegistro', $this->EstadoRegistro])
            ->andFilterWhere(['like', 'Sujeto', $this->Sujeto]);

        return $dataProvider;
    }
}
