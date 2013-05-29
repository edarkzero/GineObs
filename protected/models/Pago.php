<?php

/**
 * This is the model class for table "pago".
 *
 * The followings are the available columns in table 'pago':
 * @property string $id
 * @property double $paga
 * @property string $fecha
 * @property string $paciente_id
 *
 * The followings are the available model relations:
 * @property Paciente $paciente
 */
class Pago extends CActiveRecord
{
        public function behaviors() {
            
            return array(
                
                'NumeroPuntoFlotante' => array(
                    'class' => 'ext.comportamientos.NumeroPuntoFlotante',
                    'campos' => 'paga',
                    'separador' => '.',
                ),
                
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
	 * @return Pago the static model class
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
		return 'pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paga, paciente_id', 'required'),
			array('paga', 'numerical', 'integerOnly'=>false, 'max'=>20000,'min'=>0.1,'tooSmall'=>'{attribute} es muy pequeño (el minimo es {min}).','tooBig'=>'{attribute} es muy grande (el maximo es {max}).'),
			array('paciente_id', 'length', 'max'=>8),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, paga, fecha, paciente_id', 'safe', 'on'=>'search'),
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
			'paga' => 'Paga',
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
		$criteria->compare('paga',$this->paga);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('paciente_id',$this->paciente_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function MensualData()
        {
            $pagos = array();
            
            for($i = 1 ; $i <= 12 ; $i++)
            {
                $criteria=new CDbCriteria;
                $criteria->addBetweenCondition('fecha', '2013-0'.$i.'-01', '2013-0'.$i.'-31');

                $dataProvider = new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,
                    ));

                
                $sum = 0;

                foreach($dataProvider->getData() as $data)
                {
                    $sum += $data->paga;
                }
                
                $pagos[] = $sum;
            }
            
            return $pagos;
            
        }
        
}