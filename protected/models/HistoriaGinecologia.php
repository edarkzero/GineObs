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
        var $relData = array("ginecologia_enfermedad","ginecologia_id","enfermedad_id");
    
        public function behaviors() {
        
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
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
			array('paciente_id, fecha,ginecologiaEnfermedads, motivo_consulta, dir_examen1, dir_examen2, examen_fisico, diagnostico, tratamiento', 'required'),
			array('paciente_id', 'length', 'max'=>8),
			array('dir_examen1, dir_examen2', 'length', 'max'=>40),
                        array('ginecologiaEnfermedads','ext.validaciones.checkList'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, paciente_id, fecha,ginecologiaEnfermedads, motivo_consulta, dir_examen1, dir_examen2, examen_fisico, diagnostico, tratamiento', 'safe', 'on'=>'search'),
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
			'paciente_id' => 'Paciente',
			'fecha' => 'Fecha',
			'motivo_consulta' => 'Motivo Consulta',
                        'ginecologiaEnfermedads' => 'Enfermedades',
			'dir_examen1' => 'Dir Examen1',
			'dir_examen2' => 'Dir Examen2',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('paciente_id',$this->paciente_id,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('ginecologiaEnfermedads',$this->ginecologiaEnfermedads,true);
		$criteria->compare('motivo_consulta',$this->motivo_consulta,true);
		/*$criteria->compare('dir_examen1',$this->dir_examen1,true);
		$criteria->compare('dir_examen2',$this->dir_examen2,true);
		$criteria->compare('examen_fisico',$this->examen_fisico,true);
		$criteria->compare('diagnostico',$this->diagnostico,true);
		$criteria->compare('tratamiento',$this->tratamiento,true);*/

                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
}