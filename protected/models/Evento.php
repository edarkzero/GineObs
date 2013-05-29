<?php

/**
 * This is the model class for table "evento".
 *
 * The followings are the available columns in table 'evento':
 * @property string $id
 * @property string $fechaInicio
 * @property string $fechaFin
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Cita[] $citas
 */
class Evento extends CActiveRecord
{       
       
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evento the static model class
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
		return 'evento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fechaInicio, fechaFin, descripcion', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fechaInicio, fechaFin, descripcion', 'safe', 'on'=>'search'),
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
			'citas' => array(self::HAS_MANY, 'Cita', 'calendario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fechaInicio' => 'Fecha Inicio',
			'fechaFin' => 'Fecha Fin',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('fechaInicio',$this->fechaInicio,true);
		$criteria->compare('fechaFin',$this->fechaFin,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function FORMATEAR_FECHA($fecha)
        {
            $aux = Yii::app()->dateFormatter->formatDateTime($fecha, 'long',false);
            $fecha = $aux." ".date('h:i a', strtotime($fecha));
            return $fecha;
        }
        
}