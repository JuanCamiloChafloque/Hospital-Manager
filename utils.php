<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

//Esta función crea un select con los valores y opciones de un arreglo
    function crearSelect($label, $nombreSelect, $opciones){
        $select = "<label class=\"col-sm-2 col-form-label\" for='$nombreSelect'><b>$label</b></label>";
        $select .= "<div class=\"col-sm-4\">";
        $select .= "<select class=\"form-control\" name=$nombreSelect>";
        foreach($opciones as $value => $text){
            $select .= "<option value=$value>$text</option>";
        }
        $select .="</select>";
        $select .="</div>";
        return $select;
    }

    function sendemail($to, $name, $last, $subject, $msg){
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->CharSet = 'utf-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = "prowe202010@gmail.com";
            $mail->Password = "admin202010";
            $mail->setFrom('noreply@phpros.com', 'No Reply');
            $mail->addAddress($to, $name.' '.$last);
            $mail->Subject = $subject;
            $mail->Body = $msg;
            $mail->send();
        }catch(Exception $e){
            echo $e->errorMessage();
        }
        catch (\Exception $e)
        {
        echo $e->getMessage();
        }
    }
?>