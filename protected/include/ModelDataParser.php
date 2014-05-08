<?php
	/**
	 * Class ModelDataParser
	 */
	class ModelDataParser
	{

		/**
		 * Convierte la data de un modelo dentro de un array a un array clave valor compatible con listas CHtml
		 *
		 * @param $modelData
		 * @param $fields array[]
		 * @param $addAllOption string
		 * @return array
		 */
		public static function toDataList($modelData, $fields, $addAllOption = NULL)
		{
			$parsedData = array();

			if ($addAllOption === 'prepend')
			{
				$parsedData[-1] = Yii::t('app', 'All');
			}

			foreach ($modelData as $data)
			{
				$string = "";

				foreach ($fields as $key => $field)
				{
					if ($key > 0)
						$string .= ' - ';

					$string .= $data->{$field};
				}

				$parsedData[$data->id] = $string;

			}

			if ($addAllOption === 'append')
			{
				$parsedData[-1] = Yii::t('app', 'All');
			}

			return $parsedData;

		}

		/**
		 * retorna el los valores de los atributos de un modelo en formato JSON
		 *
		 * @param $modelData CActiveRecord[]
		 * @param $fields array
		 * @return string
		 */
		public static function toJSONDataList($modelData, $fields)
		{

			$JSON = "";
			$modelsCount = count($modelData);
			$fieldsCount = count($fields);

			foreach ($modelData as $mkey => $model)
			{
				$JSON .= "{";
				$i = 0;

				foreach ($fields as $fkey => $field)
				{
					$JSON .= $fkey . ": '" . $model->{$field} . "'";
					$JSON .= $i < ($fieldsCount - 1) ? "," : '';
					$i++;
				}

				$JSON .= $mkey < ($modelsCount - 1) ? "}," : "}";

			}

			return json_encode($JSON);

		}

        public static function toHtmlValueTag($modelData,$tag,$valueAttr = null,$optionContentAttr,$emptyTag = true)
        {
            $html = "";
            $arrayCount = count($optionContentAttr) - 1;

            if(Validator::HAS_DATA($modelData))
            {
                foreach($modelData as $data)
                {
                    $htmlContent = "";

                    foreach($optionContentAttr as $key => $oAttr)
                    {
                        $htmlContent .= $data->{$oAttr};

                        if($key < $arrayCount)
                            $htmlContent .= ' ';
                    }

                    $htmlValue = $valueAttr != null ? 'value='.'"'.$data->{$valueAttr}.'"' : '';
                    $html .= '<'.$tag.' '.$htmlValue.'>'.$htmlContent.'</'.$tag.'>';
                }
            }

            if($emptyTag)
                $html = '<'.$tag.'></'.$tag.'>'.$html;

            return $html;
        }

	}