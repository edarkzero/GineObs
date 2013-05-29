<?php

/**
 * This is the model class for table "recipe".
 *
 * The followings are the available columns in table 'recipe':
 * @property string $id
 * @property string $indicaciones
 * @property string $fecha
 * @property string $paciente_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 * @property RecipeMedicina[] $recipeMedicinas
 */
class Recipe extends MtMActiveRecord
{       
        var $relData = array("recipe_medicina","recipe_id","medicina_id");
    
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
	 * @return Recipe the static model class
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
		return 'recipe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('indicaciones, recipeMedicinas, paciente_id', 'required'),
                        array('recipeMedicinas','ext.validaciones.checkList'),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,recipeMedicinas , indicaciones, fecha, paciente_id', 'safe', 'on'=>'search'),
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
			'recipeMedicinas' => array(self::MANY_MANY, 'Medicina', 'recipe_medicina(recipe_id, medicina_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'recipeMedicinas' => 'Medicinas',
                        'indicaciones' => 'Indicaciones',
			'fecha' => 'Fecha',
			'paciente_id' => 'Paciente',
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
		$criteria->compare('recipeMedicinas',$this->recipeMedicinas,true);
		$criteria->compare('indicaciones',$this->indicaciones,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('paciente_id',$this->paciente_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}