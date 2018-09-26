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
						   <h1 style="font-size:22px; color:#ba4a4a;margin-left:45px; margin-top:20px;">Demande de VENTE FLASH #<?= $form_sale->id ?></h1>
					   </td>
				   </tr>
				   <tr>
					   <td valign="top" style="color:#505050; font-size:13px; padding:40px 30px 0px 47px; line-height:20px;">
						   <p>Nouvelle demande de contact de <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_gender. '. ' .$form_mail->form_name ?></strong> pour la vente <strong style="color: #ba4a4a; font-size:13px;">#<?= $form_sale->id ?></strong></p>
                           <p>N° Tèl : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->form_phone ?></strong></p>
                           <p>@ : <strong style="color: #ba4a4a; font-size:13px;"><?= $form_mail->to_email ?></strong></p>
						   <p style="margin-top: 30px;">
							   <strong>Commentaire :</strong>
						   </p>
						   <p style="margin-top: 10px;margin-bottom: 10px;">
							   <em>" <?= !empty($form_mail->form_message)?$form_mail->form_message:"Pas de message..." ?> "</em>
						   </p><hr/>
					   </td>
				   </tr>
				   <tr>
                       <td style="padding:20px 30px 0px 50px;">
                           <table style="width: 500px;">
                               <thead>
                                   <tr style="font-size:14px;">
                                       <th style="border-bottom: 1px solid #000;">ID</th>
                                       <th style="border-bottom: 1px solid #000;">Départ</th>
                                       <th style="border-bottom: 1px solid #000;">Arrivée</th>
                                       <th style="border-bottom: 1px solid #000;">Disponibilité</th>
                                       <th style="border-bottom: 1px solid #000;">Appareil</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr style="text-align: center; font-size:12px;">
                                       <td><?= $form_sale->id ?></td>
                                       <td><?= $form_sale->departure ?></td>
                                       <td><?= $form_sale->arrival ?></td>
                                       <td><?= $form_sale->dispo ?></td>
                                       <td><?= '#'.$form_sale->fleet->id.'. '.$form_sale->fleet->manufacturer->name.' - '.$form_sale->fleet->model ?></td>
                                   </tr>
                               </tbody>
                           </table>
					   </td>
				   </tr>
			   </table>
			   <!-- end texte -->

   </body>
   </html>