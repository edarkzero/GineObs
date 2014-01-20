<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: edark_000
	 * Date: 11/07/13
	 * Time: 02:46 PM
	 * To change this template use File | Settings | File Templates.
	 */

	class ModelBase
	{
		/**
		 * @param CActiveRecord $data
		 */
		public static function SHOW_MODEL_DATA($data, $extraAttr = NULL, $relations = NULL, $end_app = false)
		{
			echo "<pre>";

			if (is_array($data))
			{
				foreach ($data as $model)
				{
					echo "Model: " . $model->tableName() . "<br/>";
					self::printModelAttributes($model, $extraAttr);

					if ($relations)
					{
						foreach ($relations as $relation)
						{
							echo "Relation: " . $model->tableName() . "->" . $relation . "<br/>";
							self::SHOW_MODEL_DATA($model->{$relation});
						}
					}
				}
			}
			else self::printModelAttributes($data, $extraAttr);


			echo "</pre>";

			if ($end_app)
				Yii::app()->end();

		}

		private static function printModelAttributes($model, $extraAttr)
		{

			if (isset($model->attributes))
			{
				foreach ($model->attributes as $key => $attribute)
				{
					echo "[" . $key . '] => ' . $attribute;
					echo "<br/>";
				}
			}

			if ($extraAttr)
			{
				foreach ($extraAttr as $key => $attr)
				{
					echo "[" . $key . '] => ' . $attr;
					echo "<br/>";
				}
			}

			echo "<br/>****************************************************************<br/>";
		}

		public static function toJSonArray_mapFormat($models, $coord_attr, $description_attr, $message_method = NULL, $message_model = NULL,$extraData = NULL)
		{
			$result = array();

			foreach ($models as $model)
			{
				$dataCoord = $model->{$coord_attr};

				if (is_string($dataCoord))
				{
					$coord = explode(',', $dataCoord);
					$result[] = self::jsonGoogleMapData($message_method,$message_model,$model,$coord,$description_attr,$extraData);
				}

				elseif(is_array($dataCoord))
				{
					foreach($dataCoord as $c)
					{
						$coord = explode(',', $c);
						$result[] = self::jsonGoogleMapData($message_method,$message_model,$model,$coord,$description_attr,$extraData);
					}
				}
			}

			return $result;
		}

		private static function jsonGoogleMapData($message_method,$message_model,$model,$coord,$description_attr,$extraData)
		{
			$message = NULL;

			if ($message_method != NULL)
			{

				if ($message_model != NULL)
				{
					$message = $message_model->{$message_method};
				}
				else
				{
					$message = $model->{$message_method};
				}

			}

			$result = array(
				"mensaje" => $message,
				"id"      => $model->id,
				"nombre"  => $model->{$description_attr},
				"x"       => !empty($coord[0]) ? $coord[0] : NULL,
				"y"       => !empty($coord[1]) ? $coord[1] : NULL,
				"extra" => isset($coord[2]) && !empty($coord[2]) ? $coord[2] : NULL
			);

			return $result;
		}

		public static function toHtmlLiFormat($model, $href_model_attr = 'id', $content_model_attr = 'nombre', $href_model_relation = NULL, $allOption = true)
		{
			$dataHtml = "";
			$count = count($model);

			if (!$count > 0)
			{
				$dataHtml = '<li><a tabindex="-1" href="#">No hay ocurrencias</a></li>';
			}

			elseif ($count > 1)
			{
				$dataHtml = '<li><a tabindex="-1" href="#">' . Yii::t('app', 'All') . '</a></li>';
			}

			foreach ($model as $data)
			{
				$href = !Validator::HAS_DATA($href_model_relation) ? $data->{$href_model_attr} : $data->{$href_model_relation}->{$href_model_attr};
				$dataHtml .= '<li><a tabindex="-1" href="#' . $href . '">' . $data->{$content_model_attr} . '</a></li>';
			}

			return $dataHtml;
		}

		/**
		 * Dado un modelo su atributo y una etiqueta html con el que se encapsulara la cadena, se devuelve una cadena separada por comas formato html
		 *
		 * @param CActiveRecord $model
		 * @param string $attribute
		 * @param array $htmlEnclosure
		 * @return string
		 */
		public static function toHtmlComasFormat($model, $attribute, $htmlEnclosure = array('<span>', '</span>'),$separator = ', ')
		{
			$dataHtml = "";
			$dataCount = count($model);

			if (!$dataCount > 0)
			{
				return 'No hay ocurrencias';
			}

			$dataCount -= 1;
			foreach ($model as $key => $data)
			{
				$dataHtml .= $data->{$attribute};

				if ($key < $dataCount)
					$dataHtml .= $separator;

			}

			return $htmlEnclosure[0] . $dataHtml . $htmlEnclosure[1];
		}

		public static function TO_ARRAY_TB_FORMAT($model, $labelAttribute = 'nombre', $urlAttribute = 'id', $valueAttribute = 'nombre', $allOption = true)
		{
			$dataArray = array();
			$count = count($model);

			if ($count > 0)
			{
				if ($count > 1 && $allOption)
				{
					if (!is_array($urlAttribute))
						$dataArray[] = array('label' => Yii::t('app', 'All'), 'url' => '#', 'value' => '-1');
					else
						$dataArray[] = array('label' => Yii::t('app', 'All'), 'url' => Yii::app()->createUrl($urlAttribute['url'], array($urlAttribute['paramName'] => -1)), 'value' => '-1');

				}

				if (!is_array($urlAttribute))
				{
					foreach ($model as $data)
					{
						$dataArray[] = array('label' => $data->{$labelAttribute}, 'url' => '#' . $data->{$urlAttribute}, 'value' => $data->{$valueAttribute});
					}
				}

				else
				{
					foreach ($model as $data)
					{
						$dataArray[] = array('label' => $data->{$labelAttribute}, 'url' => Yii::app()->createUrl($urlAttribute['url'], array($urlAttribute['paramName'] => $data->{$urlAttribute['paramModelAttribute']})), 'value' => $data->{$valueAttribute});
					}
				}
			}

			else
				$dataArray[] = array('label' => 'No hay ocurrencias', 'url' => '#', 'value' => '-1');

			return $dataArray;

		}

		public static function ADD_MANY_NOT_IN_CONDITIONS($data, $criteria)
		{
			if (Validator::HAS_DATA($data))
			{
				foreach ($data as $key => $notIn)
				{
					$criteria->addNotInCondition('t.' . $key, $notIn);
				}
			}

			return $criteria;
		}

		public static function ADD_MANY_COMPARES($data, $criteria)
		{
			if (Validator::HAS_DATA($data))
			{
				foreach ($data as $key => $compare)
				{
					$criteria->compare('t.' . $key, $compare);
				}
			}

			return $criteria;
		}

		public static function getRandomArrayIndex($array)
		{
			return rand(0, count($array) - 1);
		}


		/**
		 * @param CActiveRecord $model
		 * @param array $attributes
		 * @param int $index
		 */
		public static function GET_ATTRIBUTE($index = NULL, $model, $relation, $attribute)
		{

			if ($index > -1)
			{
				if (Validator::HAS_DATA($model) && Validator::HAS_DATA($model->{$relation}))
				{
					if (Validator::HAS_DATA($model->{$relation}[$index]))
					{
						return Validator::HAS_DATA($model->{$relation}[$index]->{$attribute}) ? $model->{$relation}[$index]->{$attribute} : NULL;
					}
				}
			}
			elseif ($index == NULL)
			{
				if (Validator::HAS_DATA($model) && Validator::HAS_DATA($model->{$relation}))
				{
					Validator::HAS_DATA($model->{$relation}->{$attribute}) ? $model->{$relation}->{$attribute} : NULL;
				}
			}

			return NULL;

		}

		/**
		 * @param $CActiveRecord $model
		 * @param $string $relation
		 * @param $string $attribute
		 * @return array
		 */
		public static function GET_MODEL_ATTRIBUTE_VALUES_TO_ARRAY($model, $relation, $attribute, $appendAttr = null)
		{
			$result = array();

			if ($relation != NULL)
			{
				if (is_array($model->{$relation}))
					foreach ($model->{$relation} as $rel)
					{
						$result[] = !isset($appendAttr) ? $rel->{$attribute} : $rel->{$attribute}.','.$rel->{$appendAttr};
					}

				else
					foreach ($model as $data)
					{
						$result[] = !isset($appendAttr) ? $data->{$relation}->{$attribute} : $data->{$relation}->{$attribute}.','.$data->{$relation}->{$appendAttr};
					}
			}
			else
			{
				foreach ($model as $data)
				{
					$result[] = !isset($appendAttr) ? $data->{$attribute} : $data->{$attribute}.','.$data->{$appendAttr};
				}
			}

			return Validator::HAS_DATA($result) ? $result : false;
		}

		/**
		 * @param CActiveRecord $model
		 * @param CDbCriteria $criteria
		 * @param int $length
		 * @return CDbCriteria
		 */
		public static function GET_RANDOM_CRITERIA_OFFSET($model, $criteria, $length = NULL)
		{
			$criteriaTmp = $criteria;

			$criteriaTmp->select = 't.id';

			$randomMax = count($model->findAll($criteriaTmp));
			if ($randomMax > $length)
			{

				if ($length == NULL)
					$random = rand(0, $randomMax - 1);
				else
					$random = rand(0, $randomMax - $length);

				$criteria->offset = $random;
			}

			return $criteria;
		}

		/*
		 * @param CActiveRecord $model
		 * @param CDbCriteria $criteria
		 * @param int $length
		 * @return int
		 */
		public static function GET_RANDOM_OFFSET($model, $criteria, $length)
		{
			$randomMax = count($model->findAll($criteria));
			if ($randomMax > $length)
			{
				$random = rand(0, $randomMax - $length);

				return $random;
			}

			return NULL;
		}

	}