<?php

/**
 * This is the model class for table "historia_ginecologia".
 *
 * The followings are the available columns in table 'historia_ginecologia':
 * @property string $id
 * @property string $paciente_id
 * @property string $fecha
 * @property string $motivo_consulta
 * @property string $dir_examen1
 * @property string $dir_examen2
 * @property string $examen_fisico
 * @property string $diagnostico
 * @property string $tratamiento
 *
 * The followings are the available model relations:
 * @property GinecologiaEnfermedad[] $ginecologiaEnfermedads
 * @property Paciente $paciente
 */
class HistoriaGinecologia extends MtMActiveRecord
{
    var $relData = array("ginecologia_enfermedad", "ginecologia_id", "enfermedad_id");
    public $paciente_nombre;
    public $fecha_bdd;
    public $fecha_alt;
    public $fecha_time_bdd = '1';
    public $fecha_time = '1';

    public function behaviors()
    {

        return array(
            'FechaHoraDetallada' => array(
                'class' => 'ext.comportamientos.FechaHoraDetallada',
                'campos' => 'fecha',
                'tipo' => '2',
            ),

        );

    }


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HistoriaGinecologia the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getHistoriasGinecologicasByPaciente($idPaciente)
    {
        $criteria = new CDBCriteria;

        $criteria->together = true;

        $criteria->compare('t.paciente_id', $idPaciente);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5
            ),
        ));

    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'historia_ginecologia';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('paciente_id, fecha, motivo_consulta', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('fecha_bdd,fecha_alt,fecha_time_bdd,fecha_time', 'safe'),
            array('id, paciente_id, fecha,ginecologiaEnfermedads, motivo_consulta, examen_fisico, diagnostico, tratamiento, paciente_nombre', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ginecologiaEnfermedads' => array(self::MANY_MANY, 'Enfermedad', 'ginecologia_enfermedad(ginecologia_id, enfermedad_id)'),
            'paciente' => array(self::BELONGS_TO, 'Paciente', 'paciente_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'paciente_id' => 'Cedula',
            'paciente_nombre' => 'Paciente',
            'fecha' => 'Fecha',
            'motivo_consulta' => 'Motivo Consulta',
            'ginecologiaEnfermedads' => 'Enfermedades',
            'examen_fisico' => 'Examen Fisico',
            'diagnostico' => 'Diagnostico',
            'tratamiento' => 'Tratamiento',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->together = true;

        $criteria->with = array(
            'paciente',
        );

        $criteria->compare('id', $this->id, true);
        $criteria->compare('paciente_id', $this->paciente_id, true);
        $criteria->compare('paciente.nombre1', $this->paciente_nombre, true, 'OR');
        $criteria->compare('paciente.nombre2', $this->paciente_nombre, true, 'OR');
        $criteria->compare('paciente.apellido1', $this->paciente_nombre, true, 'OR');
        $criteria->compare('paciente.apellido2', $this->paciente_nombre, true, 'OR');
        $criteria->compare('fecha', $this->fecha, true);
        $criteria->compare('ginecologiaEnfermedads', $this->ginecologiaEnfermedads, true);
        $criteria->compare('motivo_consulta', $this->motivo_consulta, true);
        $criteria->compare('examen_fisico', $this->examen_fisico, true);
        $criteria->compare('diagnostico', $this->diagnostico, true);
        $criteria->compare('tratamiento', $this->tratamiento, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}