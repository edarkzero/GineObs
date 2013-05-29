<?php

class Medicina extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'medicina';
	}

	public function rules()
	{
		return array(
			array('nombre, presentacion, unidad', 'required'),
                        array('nombre', 'match', 'pattern' => '/^[\p{L}\s,0-9]+$/u', 'message'=>'Nombre solo puede contener espacios,letras y numeros.'),
			array('nombre, presentacion', 'length', 'min'=>3,'max'=>20),
                        array('unidad', 'numerical', 'integerOnly'=>true,'min'=>1,'max'=>9999,'tooSmall'=>'Unidad es muy pequeño (el minimo es 1).','tooBig'=>'Unidad es muy grande (el maximo es 9999).'),
			array('unidadPatron', 'length', 'max'=>3),
			array('id, nombre, presentacion, unidad, unidadPatron', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'recipes' => array(self::HAS_MANY, 'Recipe', 'medicina_id'),
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'nombre' => Yii::t('app', 'Nombre'),
			'presentacion' => Yii::t('app', 'Presentacion'),
			'unidad' => Yii::t('app', 'Unidad'),
			'unidadPatron' => Yii::t('app', 'Unidad Patron'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);

		$criteria->compare('nombre',$this->nombre,true);

		$criteria->compare('presentacion',$this->presentacion,true);

		$criteria->compare('unidad',$this->unidad,true);

		$criteria->compare('unidadPatron',$this->unidadPatron,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public static function GET_NOMBRE_PK($key) {
            
            $model_aux = Medicina::model()->findByPk($key);
            
            return $model_aux->nombre;
            
        }
        
        public static function GET_LISTA_NOMBRE() {
		
		return CHtml::listData(Medicina::model()->findAll(), 'id', 'nombre');
		
	}
        
}
