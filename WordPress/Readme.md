# OpenDXP - Component: WordPress
Aquesta carpeta conté els fitxers de configuració necessaris per desplegar WordPress, el Gestor de Continguts (CMS) de la plataforma OpenDXP.

## 🚀 Rol dins de la Plataforma OpenDXP
WordPress és la façana pública de l'ecosistema. Les seves funcions principals són:

Gestió de Continguts: Publicar notícies, pàgines, articles de bloc i qualsevol altre tipus de contingut per comunicar la missió i activitats de l'organització.

Interacció amb l'Usuari: Actua com el principal punt de captació de dades a través de formularis de contacte, subscripció a butlletins o registre de nous membres.

Punt d'Inici de Fluxos: Les dades enviades des dels formularis de WordPress inicien el Flux 1, que alimenta la resta de plataformes (Mautic i SuiteCRM).

## 📂 Contingut de la Carpeta
docker-compose-wordpress.yml: Fitxer de Docker Compose per desplegar el contenidor de WordPress i la seva base de dades MariaDB associada.

Add_action_WP-to-N8n.php: Fragment de codi PHP que s'ha d'implementar a WordPress per connectar l'enviament de formularis amb el webhook de n8n.

## 🛠️ Instruccions d'Instal·lació i Configuració

### Prerequisits
Una instància de Traefik ja ha d'estar en funcionament.

Un registre DNS de tipus A (ex: wordpress.opendxp.net) ha d'apuntar a la IP pública del teu servidor.

### Passos per al Desplegament
Personalitzar el docker-compose-wordpress.yml:

Dominis: Substitueix wordpress.opendxp.net a la secció labels pel domini que hagis escollit.

Credencials de la Base de Dades: Modifica les variables d'entorn (MARIADB_ROOT_PASSWORD, WORDPRESS_DB_USER, etc.) per utilitzar contrasenyes segures.

Iniciar el Servei: Des del directori on es troba aquest docker-compose.yml, executa la comanda:

docker-compose up -d

### Configuració Post-Instal·lació
Assistent de WordPress: Accedeix al domini que has configurat (ex: https://wordpress.opendxp.net) i completa l'assistent d'instal·lació inicial (idioma, títol del lloc, usuari administrador, etc.).

Instal·lar Plugin de Formularis: Instal·la i activa un plugin per a la creació de formularis, com WPForms o similar.

Connectar Formularis a n8n:

Opció A (Amb Plugin de Webhooks): Si el teu plugin de formularis suporta webhooks de manera nativa, ves a la configuració del formulari i enganxa la URL del webhook del Flux 1 de n8n.

Opció B (Manualment amb Codi): Si el teu plugin no suporta webhooks, hauràs d'afegir el codi del fitxer Add_action_WP-to-N8n.php al fitxer functions.php del teu tema actiu (preferiblement un tema fill o child theme). Aquest codi intercepta l'enviament del formulari i envia les dades al webhook de n8n. Hauràs d'adaptar el hook d'acció (wpforms_process_complete en aquest exemple) al que utilitzi el teu plugin específic.

// Contingut d'exemple per a Add_action_WP-to-N8n.php (adaptar al teu plugin)
add_action('wpforms_process_complete', function($fields, $entry, $form_data, $entry_id) {
    $n8n_webhook_url = 'LA_TEVA_URL_DE_WEBHOOK_DE_N8N_AQUI';

    $body = [
        'firstName' => $entry['fields'][1], // L'ID del camp pot variar
        'lastName'  => $entry['fields'][2],
        'email'     => $entry['fields'][3],
        'message'   => $entry['fields'][4],
    ];

    wp_remote_post($n8n_webhook_url, [
        'headers' => ['Content-Type' => 'application/json; charset=utf-8'],
        'body'    => json_encode($body),
        'method'  => 'POST',
    ]);
}, 10, 4);

Per a més informació sobre el projecte global, consulta el README principal.
