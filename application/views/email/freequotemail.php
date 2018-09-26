

<html>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>MKPARTNAIR - Email de contact</title>
   <body style="margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; font-family: Arial, sans-serif;">

   <!-- Start Main Table -->
   <table width="100%" height="100%" cellpadding="0" style="padding: 20px 0px 20px 0px" background="http://webdesignweb.fr/sources/email-html/img/img_home3.jpg" >
	   <tr align="center">
		   <td>
			   <!-- Start Header -->
			   <table style="width:580; height:108px;" background="http://webdesignweb.fr/sources/email-html/img/1px.png no-repeat" border="0">
				   <tr>
					   <td>
						   <a href="http://mkpartnair.com/" target="_blank"><img src="https://actuzz.files.wordpress.com/2013/04/logo-mk1.png" style="width: 40%; padding-left: 30%;"></a>
					   </td>
				   </tr>
			   </table>
			   <!-- fin header -->
			   <!-- start texte -->
			   <table cellpadding="0" cellspacing="0" width="580" background="http://webdesignweb.fr/sources/email-html/img/1px.png" style="padding:60px 0px 50px 0px;">
				   <tr>
					   <td>
						   <h1 style="font-size:22px; color:#ba4a4a;margin-left:45px; margin-top:20px;">Demande de DEVIS</h1>
					   </td>
				   </tr>
				   <tr>
					   <td valign="top" style="color:#505050; font-size:13px; padding:40px 30px 0px 47px; line-height:20px;">
						   <p>Nouvelle demande de devis de <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_gender. '. ' .$form_mail->form_first_name.' '.$form_mail->form_name ?></strong> :</p>
                           <p>N° Tèl : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_phone ?></strong></p>
                           <p>@ Email : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_email ?></strong></p>
						   <p></p>
						   <p style="margin-top: 30px; ">
							   <strong>Pour les caractéristiques suivantes :</strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 5px;"><strong><?php if($tvl_type == 'owq'){ echo "ALLER SIMPLE"; }elseif ($tvl_type == 'rq') { echo "ALLER / RETOUR"; }else{ echo "MULTI-DESTINATION";} ?> :</strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 5px;"><strong>Passagers : </strong><?= $form_mail->form_passengers ?>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 10px;"><strong>Budget : </strong><?= $form_mail->form_budget ?>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 25px;"><strong>Message : </strong>
							   <em>" <?= !empty($form_mail->form_message)?$form_mail->form_message:"Pas de message..." ?> "</em>
						   </p><hr>
						   <!-- TRAJET -->
						   <!-- ALLER -->
						   <p style="margin-top: 5px;margin-bottom: 10px;">
							   <strong><?= $form_mail->departure ?></strong> >>> <strong><?= $form_mail->dep_date.' - '.$form_mail->dep_time ?></strong> >>> <strong><?= $form_mail->step_1??$form_mail->destination ?></strong>
						   </p>
						   	<!-- MULTI-QUOTE -->
						   <?php if($tvl_type == 'mq'): ?>
						   <p style="margin-top: 10px; margin-bottom: 10px;">
							   <strong style="color: darkblue; text-decoration: underline;">Étapes:</strong>
						   </p>
							<?php for($stp = 1; $stp < $nb_steps; $stp++):
							$step = 'step_'.$stp;
							$date = 'date_s'.$stp;
							$time = 'time_s'.$stp;
							$next = 'step_'.($stp+1);
							?>
						   <p style="margin-top: 5px; margin-bottom: 10px;">
							   <strong><?= $form_mail->$step ?></strong> >>> <strong><?= $form_mail->$date.' - '.$form_mail->$time ?></strong> >>> <strong><?= $form_mail->$next ?></strong>
						   </p>
						   <?php endfor; 
						   if (isset($form_mail->destination)):
							$last = 'step_'.$nb_steps;
							?>
						   <!-- RETOUR Multi-->
						   <p style="margin-top: 10px; margin-bottom: 10px;">
							   <strong style="color: darkblue; text-decoration: underline;">Retour:</strong>
						   </p>
						   <p style="margin-top: 5px; margin-bottom: 10px;">
							   <strong><?= $form_mail->$last ?></strong> >>> <strong><?= $form_mail->ret_date.' - '.$form_mail->ret_time ?></strong> >>> <strong><?= $form_mail->destination ?></strong>
						   </p>
						   <?php endif; endif; ?>
						   	<!-- RETOUR  A/R-->
						   <?php if($tvl_type == 'rq'): ?>
						   <p style="margin-top: 10px; margin-bottom: 10px;">
							   <strong style="color: darkblue; text-decoration: underline;">Retour:</strong>
						   </p>
						   <p style="margin-top: 5px; margin-bottom: 10px;">
							   <strong><?= $form_mail->destination ?></strong> >>> <strong><?= $form_mail->ret_date.' - '.$form_mail->ret_time ?></strong> >>> <strong><?= $form_mail->departure ?></strong>
						   </p>
						   <?php endif; ?>
						   
					   </td>
				   </tr>
			   </table>
			   <!-- end texte -->

   </body>
   </html>