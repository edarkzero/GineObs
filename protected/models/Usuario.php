<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id
 * @property string $nombre
 * @property string $clave
 * @property integer $nivel
 */
class Usuario extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Usuario the static model class
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
        return 'usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, clave, nivel', 'required'),
            array('nivel', 'numerical', 'integerOnly' => true, 'max' => 3, 'min' => 0),
            array('clave', 'length', 'min' => 4),
            array('nombre', 'length', 'min' => 4, 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, nombre, clave, nivel', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nombre' => 'Nombre',
            'clave' => 'Clave',
            'nivel' => 'Nivel',
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
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('nivel', $this->nivel);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->clave;
    }

    public function hashPassword($password)
    {
        return md5($password);
    }

}