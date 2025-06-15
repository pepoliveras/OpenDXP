# OpenDXP - Component: Traefik (Reverse Proxy)
Aquesta carpeta conté la configuració de Traefik, el component que actua com a reverse proxy (intermediari) i gestor de xarxa per a tota la plataforma OpenDXP.

## 🚀 Quin és el seu Rol?
Traefik és el punt d'entrada únic per a tot el trànsit que arriba al servidor. Les seves responsabilitats principals són:

Enrutament de Dominis: Rep totes les peticions (ex: https://wordpress.opendxp.net, https://mautic.opendxp.net) i les redirigeix automàticament al contenidor Docker correcte.

Gestió de Certificats SSL: Sol·licita, obté i renova automàticament certificats SSL/TLS de Let's Encrypt, assegurant que totes les comunicacions siguin segures (HTTPS).

Redirecció HTTP a HTTPS: Força que totes les connexions que arribin per HTTP (port 80) siguin redirigides a HTTPS (port 443).

Descobriment Automàtic de Serveis: Gràcies a la seva integració amb Docker, Traefik detecta automàticament quan s'inicia un nou servei (com Moodle) i crea les rutes necessàries si està correctament etiquetat.

En resum, Traefik ens permet allotjar múltiples serveis web en un mateix servidor, cadascun amb el seu propi domini i certificat SSL, de manera segura i automatitzada.

## 📂 Contingut de la Carpeta
docker-compose.yml: Aquest fitxer defineix el servei de Traefik. És l'únic servei que necessita exposar els ports 80 i 443 al servidor amfitrió.

## 🛠️ Instruccions d'Instal·lació i Configuració
La instal·lació de Traefik és el primer pas abans de desplegar qualsevol altra plataforma de l'ecosistema.

### Prerequisits
Un servidor amb Docker i Docker Compose instal·lats.

Un nom de domini (ex: opendxp.net) apuntant a la IP pública del teu servidor.

Un fitxer de configuració estàtica per a Traefik (ex: traefik.yml) i un fitxer per a les credencials (acme.json) en un directori persistent al servidor (ex: /traefik-data/).

### Passos per al Desplegament
Crear la Xarxa Pública de Docker: Traefik necessita una xarxa compartida per comunicar-se amb la resta de contenidors. Crea-la amb aquesta comanda:

docker network create traefik-public

Preparar els Fitxers de Configuració: Assegura't que tens els fitxers traefik.yml (configuració estàtica) i acme.json (per als certificats SSL, amb permisos 600) al teu directori de dades persistent.

Personalitzar el docker-compose.yml:

Autenticació del Dashboard (Opcional pero recomanat): A la secció labels, modifica la línia de basicauth.users per definir un usuari i una contrasenya per accedir al panell de control de Traefik. Pots generar l'hash de la contrasenya amb htpasswd.

Email del Responedor de Certificats: Assegura't que l'adreça de correu a la línia certificatesresolvers.myresolver.acme.email sigui vàlida. Let's Encrypt l'utilitzarà per enviar-te notificacions sobre la renovació dels teus certificats.

Iniciar el Servei: Des del directori on es troba aquest docker-compose.yml, executa la següent comanda:

docker-compose up -d

Un cop iniciat, Traefik estarà escoltant les peticions als ports 80 i 443 i preparat per gestionar els altres serveis de la plataforma a mesura que els vagis desplegant.

Per a més informació sobre el projecte global, consulta el README principal.
