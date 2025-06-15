# OpenDXP - Component: Mautic
Aquesta carpeta conté els fitxers de configuració necessaris per desplegar Mautic, la plataforma d'automatització de màrqueting del projecte OpenDXP.

## 🚀 Rol dins de la Plataforma OpenDXP
Mautic és el cervell de la comunicació i el nurturing (maduració) de contactes. Les seves funcions principals són:

Automatització de Màrqueting: Permet crear campanyes complexes basades en el comportament de l'usuari (obertura de correus, clics, visites a pàgines).

Segmentació de Contactes: Organitza la base social en segments dinàmics segons els seus interessos, dades demogràfiques o nivell d'interacció.

Gestió de Comunicacions: Gestiona l'enviament de butlletins electrònics, correus transaccionals i campanyes de correu personalitzades.

Lead Scoring: Puntua els contactes segons les seves accions per identificar aquells amb més interès o potencial.

## 📂 Contingut de la Carpeta
docker-compose-mautic.yml: Fitxer de Docker Compose per desplegar el contenidor de Mautic i la seva base de dades MariaDB.

## 🛠️ Instruccions d'Instal·lació i Configuració

### Prerequisits
Una instància de Traefik ja ha d'estar en funcionament.

Un registre DNS de tipus A (ex: mautic.opendxp.net) ha d'apuntar a la IP pública del teu servidor.

### Passos per al Desplegament
Personalitzar el docker-compose-mautic.yml:

Dominis: Substitueix mautic.opendxp.net a la secció labels i a la variable d'entorn MAUTIC_SITE_URL pel domini que hagis escollit.

Credencials de la Base de Dades: Modifica les variables d'entorn (MARIADB_ROOT_PASSWORD, MAUTIC_DB_USER, etc.) per utilitzar contrasenyes segures.

Iniciar el Servei: Des del directori on es troba aquest docker-compose.yml, executa la comanda:
```
docker-compose up -d
```
### Configuració Post-Instal·lació
Assistent de Mautic: Accedeix al teu domini (ex: https://mautic.opendxp.net). La primera vegada, Mautic et guiarà a través d'un breu assistent d'instal·lació per crear el teu usuari administrador i configurar els paràmetres bàsics de correu.

Configurar Cron Jobs: Perquè Mautic funcioni correctament (actualització de segments, enviament de campanyes), és essencial configurar les tasques programades (cron jobs). Dins del contenidor, els scripts es troben a /var/www/html/bin/console. Hauràs de configurar un cron al servidor amfitrió que executi les comandes de Docker corresponents, per exemple:

# Exemple de línia a afegir al crontab de l'amfitrió
```
*/5 * * * * docker exec mautic_app php /var/www/html/bin/console mautic:segments:update
*/5 * * * * docker exec mautic_app php /var/www/html/bin/console mautic:campaigns:update
*/5 * * * * docker exec mautic_app php /var/www/html/bin/console mautic:campaigns:trigger
```

Habilitar l'API: Perquè n8n es pugui connectar, ves a Configuració (icona de l'engranatge) > Configuració > Configuració de l'API i assegura't que l'API estigui habilitada.

Crear Credencials d'API: A Configuració > Credencials de l'API, crea un nou client OAuth 2 per a n8n. D'aquí obtindràs el Client ID i el Client Secret que necessitaràs a n8n.

Per a més informació sobre el projecte global, consulta el README principal.
