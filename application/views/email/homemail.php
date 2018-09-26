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
						   <h1 style="font-size:22px; color:#ba4a4a;margin-left:45px; margin-top:20px;">Demande de DEVIS LIGHT</h1>
					   </td>
				   </tr>
				   <tr>
					   <td valign="top" style="color:#505050; font-size:13px; padding:40px 30px 0px 47px; line-height:20px;">
						   <p>Nouvelle demande de devis de <strong style="color: #ba4a4a; font-size:13px;"><?= /*$form_mail->form_gender. '. ' .*/$form_mail->form_name ?></strong> :</p>
                           <p>N° Tèl : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_phone ?></strong></p>
                           <p>@ : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_email ?></strong></p>
						   <p></p>
						   <p style="margin-top: 30px; ">
							   <strong>Pour les caractéristiques suivantes :</strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 20px;"><strong><?= $form_mail->form_type == 'as'? "ALLER SIMPLE": "ALLER / RETOUR" ?> :</strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 10px;">
							   Départ de: <strong><?= $form_mail->form_departure ?></strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 10px;">
							   Destination: <strong><?= $form_mail->form_destination ?></strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 10px;">
							   Date de départ: <strong><?= $form_mail->form_dep_date ?></strong>
						   </p>
						   <p style="margin-top: 5px;margin-bottom: 10px;">
							   Date de retour: <strong><?= !empty($form_mail->form_des_date)?$form_mail->form_des_date: "Aller Simple" ?></strong>
						   </p>
					   </td>
				   </tr>
			   </table>
			   <!-- end texte -->

   </body>
   </html>