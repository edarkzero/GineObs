<?php

/**
 * This is the model class for table "enfermedad".
 *
 * The followings are the available columns in table 'enfermedad':
 * @property string $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_creacion
 *
 * The followings are the available model relations:
 * @property HistoriaGinecologia[] $historiaGinecologias
 */
class Enfermedad extends CActiveRecord
{
        public function behaviors() {
                
            return array(                
                'FechaHoraDetallada' => array(
                    'class' => 'ext.comportamientos.FechaHoraDetallada',
                    'campos' => 'fecha_creacion',
                    'tipo' => '2',
                ),
                
            );
            
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Enfermedad the static model class
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
		return 'enfermedad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, descripcion', 'required'),
			array('nombre', 'length', 'max'=>20),
                        //array('descripcion', 'match', 'pattern' => '/^[\p{L}\s,0-9]+$/u', 'message'=>'Descripcion solo puede contener letras.'),
                        array('nombre', 'match', 'pattern' => '/^[\p{L}\s]+$/u', 'message'=>'Nombre solo puede contener letras.'),
			array('nombre', 'unique', 'attributeName'=>'nombre','className'=>'Enfermedad','allowEmpty'=>false),
			array('nombre,descripcion', 'length', 'min'=>4),
			array('fecha_creacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, descripcion, fecha_creacion', 'safe', 'on'=>'search'),
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
			'historiaGinecologias' => array(self::MANY_MANY, 'HistoriaGinecologia', 'ginecologia_enfermedad(enfermedad_id, ginecologia_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'fecha_creacion' => 'Fecha Creacion',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function GET_NOMBRE_PK($key) {
            
            $model_aux = Enfermedad::model()->findByPk($key);
            
            return $model_aux->nombre;
            
        }
        
        public static function GET_LISTA_NOMBRE() {
		
		return CHtml::listData(Enfermedad::model()->findAll(), 'id', 'nombre');
		
	}
        
}