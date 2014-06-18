<?php

/**
 * This is the model class for table "historia_obstetricia".
 *
 * The followings are the available columns in table 'historia_obstetricia':
 * @property string $id
 * @property string $paciente_id
 * @property string $fecha
 * @property float $peso
 * @property string $tension_arterial
 * @property integer $tension_arterial_mm
 * @property integer $tension_arterial_hg
 * @property float $altura_uterina
 * @property integer $foco_fetal
 * @property integer $edad_embarazo
 * @property integer $edemas
 * @property string $otros
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 */
class HistoriaObstetricia extends CActiveRecord
{
    var $tension_arterial;
    public $paciente_nombre;
    public $fecha_bdd;
    public $fecha_alt;

    public function behaviors()
    {

        return array(

            'NumeroPuntoFlotante' => array(
                'class' => 'ext.comportamientos.NumeroPuntoFlotante',
                'campos' => 'peso,altura_uterina',
                'separador' => '.',
            ),

            'FechaHoraDetallada' => array(
                'class' => 'ext.comportamientos.FechaHoraDetallada',
                'campos' => 'fecha',
                'tipo' => '2',
            ),

        );

    }

    public function afterFind()
    {

        if (isset($this->getOwner()->foco_fetal)) {
            if ($this->getOwner()->foco_fetal == 0) $this->getOwner()->foco_fetal = "+";
            else $this->getOwner()->foco_fetal = "-";
        }

        if (isset($this->getOwner()->edemas)) {
            if ($this->getOwner()->edemas == 0) $this->getOwner()->edemas = "Si";
            else $this->getOwner()->edemas = "No";
        }

        parent::afterFind();
    }

    public function beforeValidate()
    {

        if (isset($this->getOwner()->foco_fetal)) {
            if ($this->getOwner()->foco_fetal == "+") $this->getOwner()->foco_fetal = "0";
            else $this->getOwner()->foco_fetal = "1";
        }

        if (isset($this->getOwner()->edemas)) {
            if ($this->getOwner()->edemas == "Si") $this->getOwner()->edemas = "0";
            else $this->getOwner()->edemas = "1";
        }

        parent::beforeSave();
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return HistoriaObstetricia the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'historia_obstetricia';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('paciente_id, fecha, peso, tension_arterial_mm, tension_arterial_hg, altura_uterina, foco_fetal, edad_embarazo, edemas', 'required'),
            array('edad_embarazo', 'numerical', 'integerOnly' => true, 'max' => 60, 'min' => 7, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            array('tension_arterial_mm,tension_arterial_hg', 'numerical', 'integerOnly' => true, 'max' => 1000, 'min' => 2, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            array('peso, altura_uterina', 'numerical', 'integerOnly' => false, 'max' => 20000, 'min' => 0.1, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            array('paciente_id', 'length', 'max' => 8),
            array('otros', 'length', 'min' => 4),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            //array('id, paciente_id, fecha, peso, tension_arterial_mm, tension_arterial_hg, altura_uterina, foco_fetal, edad_embarazo, edemas, otros', 'safe', 'on'=>'search'),
            array('paciente_id, fecha, peso, edad_embarazo,edemas,foco_fetal', 'safe', 'on' => 'search'),
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
            'peso' => 'Peso Fetal (Kg)',
            'tension_arterial' => 'Tension Arterial (mm/Hg)',
            'tension_arterial_mm' => 'Tension Arterial (mm)',
            'tension_arterial_hg' => 'Tension Arterial (Hg)',
            'altura_uterina' => 'Altura Uterina (cm)',
            'foco_fetal' => 'Foco Fetal',
            'edad_embarazo' => 'Edad de Embarazo',
            'edemas' => 'Edemas',
            'otros' => 'Otros',
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
        $criteria->compare('peso', $this->peso);
        $criteria->compare('tension_arterial_mm', $this->tension_arterial_mm, true);
        $criteria->compare('tension_arterial_hg', $this->tension_arterial_hg, true);
        $criteria->compare('altura_uterina', $this->altura_uterina);
        $criteria->compare('foco_fetal', $this->foco_fetal);
        $criteria->compare('edad_embarazo', $this->edad_embarazo);
        $criteria->compare('edemas', $this->edemas);
        $criteria->compare('otros', $this->otros, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getHistoriasObstetriciaByPaciente($idPaciente)
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

    public function getNombreCompleto()
    {

        return $this->nombre1 . ' ' . $this->nombre2 . ' ' . $this->apellido1 . ' ' . $this->apellido2;

    }

}