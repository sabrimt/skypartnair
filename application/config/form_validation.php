<?php

/*

===================================================================

 *  FORM_VALIDATION CONFIG

===================================================================

*/



$config = array(
	// Flash sales Form
    'flashform' => array(

        array(
            "field" => "departure",
            "label" => "Ville de départ",
            "rules" => "trim|required|xss_clean",
        ),

        array(
            "field" => "arrival",
            "label" => "Ville d'arrivée",
            "rules" => "trim|required|differs[departure]|xss_clean",
        ),

        array(
            "field" => "fleet_id",
            "label" => "Choix de l'appareil",
            "rules" => "trim|required|xss_clean",
        ),

        array(
            "field" => "price",
            "label" => "Prix",
            "rules" => "trim|required|max_length[6]|xss_clean",
        ),

        array(
			"field" => "capacity",
			"label" => "Capacité",
			"rules" => "callback_max_passengers[fleet_id]"
        ),

        array(
            "field" => "from_date",
            "label" => "Début de disponibilité",
            "rules" => "trim|required|xss_clean",
        ),

        array(
            "field" => "to_date",
            "label" => "Fin de disponibilité",
            "rules" => "trim|xss_clean",
        ),
    ),
	
	// Fleet form
    'fleetform' => array(

		array(
			"field" => "manufacturer",
            "label" => "Constructeur",
            "rules" => "trim|ucwords|required|xss_clean",
		),

		array(
			"field" => "model",
            "label" => "Modèle",
            "rules" => "trim|ucwords|required|xss_clean",
		),

		array(
			"field" => "type",
            "label" => "Type d'appareil",
            "rules" => "trim|required|xss_clean",
		),

		array(
			"field" => "category",
            "label" => "Catégorie d'appareil",
            "rules" => "trim|required|xss_clean",
		),

		array(
			"field" => "cruise_speed",
            "label" => "Vitesse",
            "rules" => "trim|required|xss_clean",
			
		),

		array(
			"field" => "aircraft_range",
            "label" => "Autonomie",
            "rules" => "trim|required|xss_clean",

		),
		
		array(
			"field" => "passengers",
            "label" => "Passagers max",
            "rules" => "trim|required|xss_clean",

		),
		
		array(
			"field" => "crew",
            "label" => "Choix de l'équipage",
            "rules" => "trim|required|xss_clean",

		),

		array(
			"field" => "description_fr",
            "label" => "Description Français",
            "rules" => "trim|required|xss_clean",
		),

		array(
			"field" => "description_en",
            "label" => "Description Anglais",
            "rules" => "trim|required|xss_clean",
		),
	),
	
	// Fleet Category form
	'categoryform' => array(

		array(
            "field" => "category",
            "label" => "Catégorie",
            "rules" => "trim|min_length[3]|required|xss_clean",
        ),
	),
	
	// Fleet Category adding form
	'categoryformadd' => array(

		array(
            "field" => "category",
            "label" => "Catégorie",
            "rules" => "trim|min_length[3]|required|is_unique[aircraft_category.category]|xss_clean",
        ),
	),
	
	// Fleet Manufacturer form
	'manufacturerform' => array(

		array(
            "field" => "name",
            "label" => "Nom du constructeur",
            "rules" => "trim|required|min_length[3]|xss_clean",
		),

		array(

            "field" => "flag",
            "label" => "Drapeau",
            "rules" => "min_length[4]|required|max_length[200]|encode_php_tags|xss_clean",
        ),
	),

	// Fleet Manufacturer adding form
	'manufacturerformadd' => array(

		array(
            "field" => "name",
            "label" => "Nom du constructeur",
            "rules" => "trim|required|min_length[3]|is_unique[aircraft_manufacturer.name]|xss_clean",

		),

		array(
            "field" => "flag",
            "label" => "Drapeau",
            "rules" => "min_length[4]|required|max_length[200]|encode_php_tags|xss_clean",
        ),
	),

	// Fleet Crew form
	'crewform' => array(

		array(
            "field" => "crew_fr",
            "label" => "Equipage FR",
            "rules" => "trim|required|xss_clean",
        ),

		array(
            "field" => "crew_en",
            "label" => "Equipage EN",
            "rules" => "trim|required|xss_clean",
        ),
	),

	// Blog form
    'blogform' => array(

         array(
            "field" => "title_fr",
            "label" => "Titre de l'article FR",
            "rules" => "trim|required|xss_clean",
        ),

        array(
            "field" => "title_en",
            "label" => "Article title EN",
            "rules" => "trim|required|xss_clean",
        ),

        array(
            "field" => "article_category_id",
            "label" => "Choix de la catégorie",
            "rules" => "trim",
        ),

    ),
	
	// Authentication form
	'authenticationform' => array(
		array(
			'field' => 'email',
			'label' => 'Identifiant',
			'rules' => 'required|min_length[6]',
		),
		array(
			'field' => 'password',
			'label' => 'Mot de passe',
			'rules' => 'required|min_length[8]',
		),
	),
	
	// Adding User form
	'newuserform' => array(
		array(
			'field' => 'name',
			'label' => 'Nom',
			'rules' => 'required',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email|min_length[6]|is_unique[user.email]',
		),
		array(
			'field' => 'role',
			'label' => 'Rôle',
			'rules' => '',
		),
		array(
			'field' => 'password',
			'label' => 'Mot de passe',
			'rules' => 'required|min_length[8]',
		),
		array(
			'field' => 'password-confirm',
			'label' => 'Confirmation mot de passe',
			'rules' => 'required||matches[password]',
		),
	),
	
	// Role change
	'roleform' => array(
		array(
			'field' => 'role-check',
			'label' => 'Role',
			'rules' => 'alpha',
		),
	),
	
	// Edit User Form
	'usereditform' => array(
		array(
			'field' => 'name',
			'label' => 'Nom',
			'rules' => 'required',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email|min_length[6]',
		),
		array(
			'field' => 'password',
			'label' => 'Mot de passe',
			'rules' => 'required|matches[password-confirm]|min_length[8]',
		),
		array(
			'field' => 'password-confirm',
			'label' => 'Confirmation mot de passe',
			'rules' => 'required|min_length[8]',
		),
	),
	
	//***********************************
			/*	FRONT	*/
	//************************************
	
	// Home mail form AS
    'homemailform' => array(
		array(
			"field" => "departure",
            "label" => "Lieu de départ",
            "rules" => "trim|required",
		),
		array(
			"field" => "destination",
            "label" => "Destination",
            "rules" => "trim|required",
		),
		array(
			"field" => "dep-date",
            "label" => "Date départ",
            "rules" => "trim|required",
		),
		array(
			"field" => "name",
            "label" => "lang:flash_lang_name",
            "rules" => "trim|required",
		),
		array(
			"field" => "phone",
            "label" => "lang:flash_lang_phone",
            "rules" => "trim|regex_match[/^\+\d+/]|min_length[8]|required",
		),
		array(
			"field" => "email",
            "label" => "Email",
            "rules" => "trim|required|valid_email",
		),
	),
	
	// Home mail form A/R
    'homemailform_ar' => array(
		array(
			"field" => "departure",
            "label" => "lang:home_lang_form_from",
            "rules" => "trim|required",
		),
		array(
			"field" => "destination",
            "label" => "lang:home_lang_form_to",
            "rules" => "trim|required",
		),
		array(
			"field" => "dep-date",
            "label" => "lang:home_lang_form_departuredate",
            "rules" => "trim|required",
		),
		array(
			"field" => "des-date",
            "label" => "lang:home_lang_form_returndate",
            "rules" => "trim|required",
		),
		array(
			"field" => "name",
            "label" => "lang:home_lang_form_name",
            "rules" => "trim|required",
		),
		array(
			"field" => "phone",
            "label" => "lang:home_lang_form_phone",
            "rules" => "trim|regex_match[/^\+\d+/]|min_length[8]|required",
		),
		array(
			"field" => "email",
            "label" => "Email",
            "rules" => "trim|required|valid_email",
		),
	),
	
	// Front flash mail form
    'flashmailform' => array(
		array(
			"field" => "gender",
            "label" => "lang:flash_lang_gender",
            "rules" => "trim|required",
		),
		array(
			"field" => "name",
            "label" => "lang:flash_lang_name",
            "rules" => "trim|required",
		),
		array(
			"field" => "phone",
            "label" => "lang:flash_lang_phone",
            "rules" => "trim|regex_match[/^\+\d+/]|min_length[8]|required",
		),
		array(
			"field" => "email",
            "label" => "Email",
            "rules" => "trim|required|valid_email",
		),
		array(
			"field" => "message",
            "label" => "lang:flash_lang_requirements",
            "rules" => "trim|max_length[300]",
		),
	),
	
	

);