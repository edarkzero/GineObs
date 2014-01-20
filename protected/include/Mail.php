<?php
/**
 * Created by PhpStorm.
 * User: Edgar
 * Date: 08/11/13
 * Time: 10:05 AM
 */

class Mail {

    public function sendMail($model = null, $message, $subject, $address = false, $reply = false)
    {
        $testing = Yii::app()->params['testing'];

        try
        {
            $mailer = Yii::createComponent('application.extensions.mailer.EMailer');

            if ($model != null)
            {
                foreach ($model->attributes as $key => $attribute)
                {

                    if (Validator::HAS_DATA($attribute) && $key != 'verifyCode')
                    {
                        if ($key != 'file')
                        {
                            $message .= '<div style="position: relative; overflow: hidden;"><p style="float: left;"><b>' . Yii::t('app', $key) . ': </b></p><p style="float: left; margin-left: 10px;max-width: 600px;">' . nl2br($attribute) . '</p></div><div style="clear: both;"></div>';
                        }

                        else
                        {
                            $mailer->AddAttachment($model->file->tempName, $model->file);
                        }
                    }
                }
            }

            if ($testing)
            {
                $mailer->IsSMTP();
                $mailer->Host     = 'ssl://smtp.gmail.com';
                $mailer->Port     = 465;
                $mailer->SMTPAuth = true;
                $mailer->Username = Yii::app()->params['mail'];
                $mailer->Password = Yii::app()->params['mailPass'];
                $mailer->From     = 'edgarcardona87@gmail.com';
                $mailer->FromName = 'Edgar Cardona';
                //					$mailer->AddReplyTo('edgarcardona87@gmail.com');
                /*if (!$address)*/
                $mailer->AddAddress('edgarcardona87@gmail.com');

                /*else
                    foreach ($address as $add) {
                        $mailer->AddAddress($add);
                    }*/

            }
            else
            {
                $mailer->IsSendmail();
                $mailer->Host     = 'smtp.onbizz.com';
                $mailer->Port     = 25;
                $mailer->Username = 'oferta_demanda@laofertaylademanda.com';
                $mailer->Password = 'arteimpreso2013';
                $mailer->From     = 'oferta_demanda@laofertaylademanda.com';
                $mailer->FromName = 'La Oferta Y La Demanda';

                if ($address)
                {
                    foreach ($address as $add)
                    {
                        $mailer->AddAddress($add);
                    }
                }
                else
                {
                    $mailer->AddAddress('oferta_demanda@laofertaylademanda.com');
                }

                //$mailer->AddAddAddress('ecardona@aia-sc.com');

            }

            if ($reply)
            {
                foreach ($reply as $addReply)
                {
                    $mailer->AddReplyTo($addReply);
                }
            }

            $mailer->IsHTML(true);
            $mailer->CharSet = 'UTF-8';
            $mailer->Subject = $subject;
            $mailer->Body    = $message;

            if (!$mailer->Send())
            {
                error_log($mailer->ErrorInfo, 0);
                $result = "Hubo un inconveniente al enviar el correo.<br />" . $mailer->ErrorInfo . ". Por favor, inténtalo más tarde.";
                Yii::app()->user->setFlash('error', $result);
            }
            else Yii::app()->user->setFlash('success', Yii::t('app', 'Your mail has been send successfully') . '.');

        }
        catch (phpmailerException $e)
        {
            Yii::app()->user->setFlash('notice', $e->errorMessage());
            throw new CHttpException(403, $e->errorMessage());
        }
        catch (Exception $e)
        {
            Yii::app()->user->setFlash('notice', $e->getMessage());
            throw new CHttpException(403, $e->getMessage());
        }

    }

} 