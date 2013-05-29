<?php

/**
 * This is the model class for table "cita".
 *
 * The followings are the available columns in table 'cita':
 * @property string $id
 * @property string $paciente_id
 * @property string $calendario_id
 *
 * The followings are the available model relations:
 * @property Evento $calendario
 * @property Paciente $paciente
 */
class Cita extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cita the static model class
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
		return 'cita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paciente_id, calendario_id', 'required'),
			array('paciente_id, calendario_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, paciente_id, calendario_id', 'safe', 'on'=>'search'),
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
			'calendario' => array(self::BELONGS_TO, 'Evento', 'calendario_id'),
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
			'calendario_id' => 'Calendario',
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
		$criteria->compare('calendario_id',$this->calendario_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}