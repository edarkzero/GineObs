<?php

/**
 * This is the model class for table "paciente".
 *
 * The followings are the available columns in table 'paciente':
 * @property string $id
 * @property string $nombre1
 * @property string $nombre2
 * @property string $apellido1
 * @property string $apellido2
 * @property string $direccion
 * @property string $telefono1
 * @property string $telefono2
 * @property string $correo
 * @property integer $edo_civil
 * @property string $fecha_ingreso
 * @property string $fecha_nacimiento
 * @property string $ante_familiares
 * @property string $ante_personales
 * @property integer $menarquia
 * @property string $tipo_regla
 * @property integer $gesta
 * @property integer $para
 * @property integer $aborto
 * @property integer $cesarea
 * @property string $cesarea_descrip
 * @property string $fue
 * @property double $pmf
 *
 * The followings are the available model relations:
 * @property Cita[] $citas
 * @property HistoriaGinecologia[] $historiaGinecologias
 * @property HistoriaObstetricia[] $historiaObstetricias
 * @property Recipe[] $recipes
 */
class Paciente extends CActiveRecord
{
    public $fecha_nacimiento_bdd;
    public $fecha_ingreso_bdd;
    public $fue_bdd;

    public function behaviors()
    {

        return array(
            'NumeroPuntoFlotante' => array(
                'class' => 'ext.comportamientos.NumeroPuntoFlotante',
                'campos' => 'pmf',
                'separador' => ',',
            ),

            'FechaHoraDetallada' => array(
                'class' => 'ext.comportamientos.FechaHoraDetallada',
                'campos' => 'fecha_ingreso,fecha_nacimiento,fue',
                'tipo' => '1',
            ),
            'NumeroRomano' => array(
                'class' => 'ext.comportamientos.NumeroRomano',
                'campos' => 'gesta,para,aborto,cesarea',
            ),

        );

    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Paciente the static model class
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
        return 'paciente';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, nombre1, apellido1, apellido2, direccion, edo_civil, fecha_ingreso, fecha_nacimiento, ante_familiares, ante_personales, menarquia, tipo_regla, gesta, para, aborto, cesarea, fue, pmf', 'required'),
            array('id', 'unique', 'attributeName' => 'id', 'className' => 'Paciente', 'allowEmpty' => false),
            array('id', 'numerical', 'integerOnly' => true, 'min' => 1, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            array('menarquia', 'numerical', 'integerOnly' => true, 'max' => 18, 'min' => 3, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            //array('para, aborto, cesarea','numerical','integerOnly'=>true, 'max'=>99, 'min'=>1,'tooSmall'=>'{attribute} es muy pequeño (el minimo es {min}).','tooBig'=>'{attribute} es muy grande (el maximo es {max}).'),
            array('nombre1, nombre2, apellido1, apellido2', 'length', 'max' => 20, 'min' => 2),
            array('correo', 'email'),
            //array('pmf', 'match', 'pattern' => '/^(?:\d+|\d*\,\d+)$/','message'=>'{attribute} debe ser un numero positivo, puede contener decimales'),
            array('pmf', 'numerical', 'integerOnly' => false, 'max' => 20000, 'min' => 0.1, 'tooSmall' => '{attribute} es muy pequeño (el minimo es {min}).', 'tooBig' => '{attribute} es muy grande (el maximo es {max}).'),
            array('nombre2,tipo_regla', 'match', 'pattern' => '/^[\p{L}\s]+$/u', 'message' => '{attribute} solo puede contener letras.'),
            array('nombre1,apellido1,apellido2', 'match', 'pattern' => '/^[\p{L}]+$/u', 'message' => '{attribute} solo puede contener letras y sin espacios.'),
            //array('direccion', 'match', 'pattern' => '/^[\p{L}\s,0-9]+$/u', 'message'=>'Descripcion solo puede contener letras y numeros.'),
            array('direccion, ante_familiares, ante_personales,cesarea_descrip', 'length', 'min' => 4),
            array('tipo_regla', 'length', 'max' => 20, 'min' => 2),
            array('telefono2', 'compararNumeros'),
            array('telefono1, telefono2', 'length', 'max' => 13),
            array('cesarea_descrip', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, nombre1, nombre2, apellido1, apellido2, direccion, telefono1, telefono2, correo, edo_civil, fecha_ingreso, fecha_nacimiento, ante_familiares, ante_personales, menarquia, tipo_regla, gesta, para, aborto, cesarea, cesarea_descrip, fue, pmf', 'safe', 'on' => 'search'),
        );
    }

    public function compararNumeros($attribute, $params)
    {
        if ($this->telefono1 == $this->telefono2 && ($this->telefono1 != '' || $this->telefono1 != null))
            $this->addError('telefono2', 'Telefono #2 no puede ser igual a Telefono #1');
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'citas' => array(self::HAS_MANY, 'Cita', 'paciente_id'),
            'historiaGinecologias' => array(self::HAS_MANY, 'HistoriaGinecologia', 'paciente_id'),
            'historiaObstetricias' => array(self::HAS_MANY, 'HistoriaObstetricia', 'paciente_id'),
            'recipes' => array(self::HAS_MANY, 'Recipe', 'paciente_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Cedula',
            'nombre1' => '1er Nombre',
            'nombre2' => '2do Nombre',
            'apellido1' => '1er Apellido',
            'apellido2' => '2do Apellido',
            'direccion' => 'Direccion',
            'telefono1' => 'Telefono #1',
            'telefono2' => 'Telefono #2',
            'correo' => 'Correo',
            'edo_civil' => 'Estado Civil',
            'fecha_ingreso' => 'Fecha de Ingreso',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'ante_familiares' => 'Antecedentes Familiares',
            'ante_personales' => 'Antecedentes Personales',
            'menarquia' => 'Menarquia',
            'tipo_regla' => 'Tipo de Regla',
            'gesta' => 'Gesta',
            'para' => 'Para',
            'aborto' => 'Aborto',
            'cesarea' => 'Cesarea',
            'cesarea_descrip' => 'Indicacion de Cesarea',
            'fue' => 'F.U.E',
            'pmf' => 'P.M.F',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('nombre1', $this->nombre1, true);
        $criteria->compare('nombre2', $this->nombre2, true);
        $criteria->compare('apellido1', $this->apellido1, true);
        $criteria->compare('apellido2', $this->apellido2, true);
        $criteria->compare('direccion', $this->direccion, true);
        $criteria->compare('telefono1', $this->telefono1, true);
        $criteria->compare('telefono2', $this->telefono2, true);
        $criteria->compare('correo', $this->correo, true);
        $criteria->compare('edo_civil', $this->edo_civil);
        $criteria->compare('fecha_ingreso', $this->fecha_ingreso, true);
        $criteria->compare('fecha_nacimiento', $this->fecha_nacimiento, true);
        $criteria->compare('ante_familiares', $this->ante_familiares, true);
        $criteria->compare('ante_personales', $this->ante_personales, true);
        $criteria->compare('menarquia', $this->menarquia);
        $criteria->compare('tipo_regla', $this->tipo_regla, true);
        $criteria->compare('gesta', $this->gesta);
        $criteria->compare('para', $this->para);
        $criteria->compare('aborto', $this->aborto);
        $criteria->compare('cesarea', $this->cesarea);
        $criteria->compare('cesarea_descrip', $this->cesarea_descrip, true);
        $criteria->compare('fue', $this->fue, true);
        $criteria->compare('pmf', $this->pmf);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getNombreCompleto()
    {

        return $this->nombre1 . ' ' . $this->nombre2 . ' ' . $this->apellido1 . ' ' . $this->apellido2;

    }

    public static function GET_LISTA_NOMBRE_COMPLETO()
    {

        return CHtml::listData(Paciente::model()->findAll(), 'id', 'nombreCompleto');

    }

    public static function GET_NOMBRE_COMPLETO_PK($key)
    {

        $model_aux = Paciente::model()->findByPk($key);

        return $model_aux->nombre1 . " " . $model_aux->nombre2 . " " . $model_aux->apellido1 . " " . $model_aux->apellido2;

    }

    public function getEdoCivil()
    {
        //'0'=>'Soltera','1'=>'Casada','2'=>'Divorciada','3'=>'Viuda','4'=>'Concubino'

        if ($this->edo_civil == '0') return 'Soltera';
        else if ($this->edo_civil == '1') return 'Casada';
        else if ($this->edo_civil == '2') return 'Divorciada';
        else if ($this->edo_civil == '3') return 'Viuda';
        else return 'Concubino';
    }


    public static function GET_EDO_CIVIL($id)
    { //'0'=>'Soltera','1'=>'Casada','2'=>'Divorciada','3'=>'Viuda','4'=>'Concubino'

        $model = Paciente::model()->findByPk($id);

        if ($model->edo_civil == '0') return 'Soltera';
        else if ($model->edo_civil == '1') return 'Casada';
        else if ($model->edo_civil == '2') return 'Divorciada';
        else if ($model->edo_civil == '3') return 'Viuda';
        else return 'Concubino';

    }

    public static function cargarMenuMenarquia()
    {
        return array(
            '0' => '0',
            'I' => 'I - 1',
            'II' => 'II - 2',
            'III' => 'III - 3',
            'IV' => 'IV - 4',
            'V' => 'V  - 5',
            'VI' => 'VI  - 6',
            'VII' => 'VII  - 7',
            'VIII' => 'VIII  - 8',
            'IX' => 'IX  - 9',
            'X' => 'X  - 10',
            'XI' => 'XI  - 11',
            'XII' => 'XII - 12',
            'XIII' => 'XIII - 13',
            'XIV' => 'XIV - 14',
            'XV' => 'XV - 15',
            'XVI' => 'XVI - 16',
            'XVII' => 'XVII - 17',
            'XVIII' => 'XVIII - 18',
        );

    }

}