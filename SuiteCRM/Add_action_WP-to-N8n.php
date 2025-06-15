// Aquesta funció s'executarà quan s'enviï un formulari específic de Contact Form 7
// amb èxit (després que l'email hagi estat enviat).
add_action( 'wpcf7_mail_sent', 'send_cf7_data_to_n8n_webhook' );

function send_cf7_data_to_n8n_webhook( $contact_form ) {

    // DEBUG: Afegeix aquesta línia al principi de la funció per verificar l'execució
    error_log( "DEBUG: La funció send_cf7_data_to_n8n_webhook s'ha executat per al formulari ID: " . $contact_form->id() );

    // --- Configuració del Webhook de n8n ---
	$webhook_url = 'URL_DEL_WEBHOOK_DE_N8N'; // PROD
    $auth_header_name = 'X-WordPress-Webhook-Key';
    $auth_header_value = 'XXXX'; // La clau secreta de n8n
    
	if ( ! class_exists( 'WPCF7_Submission' ) ) {
        error_log( "DEBUG: La classe WPCF7_Submission no està disponible quan es dispara wpcf7_mail_sent." );
        return; // Surt de la funció si la classe no està disponible
    }
    
	// --- Obtenir les dades del formulari de Contact Form 7 ---
    $submission = WPCF7_Submission::get_instance();
	
	if ( ! $submission ) {
        error_log( "DEBUG: No s'ha pogut obtenir la instància de submissió de Contact Form 7." );
        return;
    }

    // Obtenim les dades enviades del formulari
    $posted_data = $submission->get_posted_data();

    // El contact_form->id() retorna l'ID del formulari actual.
    
    if ( $contact_form->id() !== 49 ) { 
        error_log( "DEBUG: El formulari ID " . $contact_form->id() . " no és el formulari desitjat (ID 49)." ); 
        return;
    }


    // --- Preparació de les dades per enviar a n8n (JSON) ---
    $data_to_send = array();

    // Mapegem els camps de Contact Form 7
    // als noms que esperem rebre a n8n.
    // Nom: [text* first-name] -> 'first-name'
    // Cognoms: [text* last-name] -> 'last-name'
    // Correu electrònic: [email* your-email] -> 'your-email'
    // Missatge: [textarea your-message] -> 'your-message'
    
    $data_to_send['firstName'] = isset( $posted_data['first-name'] ) ? sanitize_text_field( $posted_data['first-name'] ) : '';
    $data_to_send['lastName'] = isset( $posted_data['last-name'] ) ? sanitize_text_field( $posted_data['last-name'] ) : '';
    $data_to_send['email'] = isset( $posted_data['your-email'] ) ? sanitize_email( $posted_data['your-email'] ) : '';
    $data_to_send['message'] = isset( $posted_data['your-message'] ) ? sanitize_textarea_field( $posted_data['your-message'] ) : '';

    // camps addicionals si són necessaris
    $data_to_send['form_title'] = $contact_form->title();
    $data_to_send['form_id'] = $contact_form->id();
    $data_to_send['submit_time'] = current_time( 'mysql' );


    // Codifiquem les dades a format JSON
    $json_body = wp_json_encode( $data_to_send );

    // DEBUG: aquesta línia serveix per depurar el JSON que s'envia
    error_log( "DEBUG: JSON a enviar a n8n des de CF7: " . $json_body );

    // --- Enviament de la petició POST a n8n ---
    $args = array(
        'body'        => $json_body,
        'headers'     => array(
            'Content-Type'      => 'application/json',
            $auth_header_name   => $auth_header_value, // Capçalera d'autenticació
        ),
        'method'      => 'POST',
        'data_format' => 'body',
        'timeout'     => 15, // Temps màxim d'espera per a la resposta (en segons)
    );

    // Realitzem la petició HTTP POST al webhook de n8n
    $response = wp_remote_post( $webhook_url, $args );

    // --- Gestió de la resposta (per depuració) ---
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        error_log( "Error enviant dades del formulari CF7 a n8n: " . $error_message );
    } else {
        $body = wp_remote_retrieve_body( $response );
        $http_code = wp_remote_retrieve_response_code( $response );
        error_log( "Dades del formulari CF7 enviades a n8n. Codi HTTP: " . $http_code . ". Resposta: " . $body );
    }
}
