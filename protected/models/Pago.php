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
        var $total;

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
			'total' => 'Total',
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

    /*
    * @return array ChartLabel at(0) ChartPagos at(1)
     * @param CDbCriteria $criteria
    */
    public function monthlyDataChart()
    {

        $chartLabels = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Noviembre","Diciembre");
        $chartPagos = array();
        $actualYear = Date('Y');

        for ($i = 1; $i <= 12; $i++) {
            $criteria = new CDbCriteria;
            $criteria->addBetweenCondition('fecha', $actualYear.'-0' . $i . '-01', $actualYear.'-0' . $i . '-31');

            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));


            $sum = 0;

            foreach ($dataProvider->getData() as $data) {
                $sum += $data->paga;
            }

            $chartPagos[] = $sum;
        }
        
        return array($chartLabels,$chartPagos);

    }

    /*
    * @return array ChartLabel at(0) ChartPagos at(1)
    */
    public function weeklyDataChart()
    {
        $semana = array("1ra Semana","2da Semana","3ra Semana","4ta Semana","5ta Semana");
        $actualYear = Date('Y');
        $actualMonth = Date('m');

        $chartPagos = array();

        for ($i = 1; $i <= 31; $i+=7) {
            $criteria = new CDbCriteria;

            if($i < 10)
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-0'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-0'.($i+7).' 23:59');

            else
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-'.($i+7).' 23:59');

            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));


            $sum = 0;

            foreach ($dataProvider->getData() as $data) {
                $sum += $data->paga;
            }

            $chartPagos[] = $sum;
        }

        return array($semana,$chartPagos);

    }

    /*
    * @return array ChartLabel at(0) ChartPagos at(1)
    */
    public function DayWeeklyDataChart()
    {
        $semana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
        $actualYear = Date('Y');
        $actualMonth = Date('m');

        $chartPagos = array();

        for ($i = 1; $i <= 31; $i+=7) {
            $criteria = new CDbCriteria;

            if($i < 10)
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-0'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-0'.($i+7).' 23:59');

            else
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-'.($i+7).' 23:59');

            print('<br/> '. $actualYear.'-' . $actualMonth . '-'.$i.' 00:00  -----'. $actualYear.'-' . $actualMonth . '-'.($i+7).' 23:59');
            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));


            $sum = 0;

            foreach ($dataProvider->getData() as $data) {
                $sum += $data->paga;
            }

            $chartPagos[] = $sum;
        }

        return array($semana,$chartPagos);

    }

    /*
    * @return array ChartLabel at(0) ChartPagos at(1)
    */
    public function dailyDataChart()
    {
        $dias = array();
        $actualYear = Date('Y');
        $actualMonth = Date('m');

        $chartPagos = array();

        for ($i = 1; $i <= 31; $i++) {
            $criteria = new CDbCriteria;

            if($i < 10)
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-0'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-0'.$i.' 23:59');

            else
                $criteria->addBetweenCondition('fecha', $actualYear.'-' . $actualMonth . '-'.$i.' 00:00', $actualYear.'-' . $actualMonth . '-'.$i.' 23:59');

            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));


            $sum = 0;

            foreach ($dataProvider->getData() as $data) {
                $sum += $data->paga;
            }

            $chartPagos[] = $sum;
            $dias[] = $i;
        }

        return array($dias,$chartPagos);
    }

    /*
     * Devuelve un array del ActiveRecord dado
    * @return array parsetoarry ActiveRecord
    * @param CActiveRecord $AR
    * @return string $att
    */
    public function activeRecordColumnToArray($AR,$att='id')
    {
        $arr_AR = array();

        foreach($AR as $item)
        {
            $arr_AR[] = $item->{$att};
        }

        return $arr_AR;

    }
        
}