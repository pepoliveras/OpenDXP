# OpenDXP - Component: Moodle
Aquesta carpeta conté els fitxers de configuració necessaris per desplegar Moodle, el Sistema de Gestió de l'Aprenentatge (LMS) de la plataforma OpenDXP.

## 🚀 Rol dins de la Plataforma OpenDXP
Moodle s'integra a l'ecosistema per gestionar tots els aspectes relacionats amb la formació en línia i l'aprenentatge. Les seves funcions principals serien:

Plataforma de Cursos: Allotjar i gestionar cursos en línia per a socis, voluntaris o públic general.

Seguiment de l'Alumnat: Permetre el seguiment del progrés dels usuaris als cursos, qualificacions i certificacions.

Integració amb CRM/Mautic: Futurament, es podria integrar amb n8n per:

Inscriure automàticament usuaris a cursos de Moodle des de Mautic o SuiteCRM.

Actualitzar la fitxa d'un contacte a SuiteCRM quan completi un curs a Moodle.

## 📂 Contingut de la Carpeta
docker-compose-moodle.yml: Fitxer de Docker Compose per desplegar el contenidor de Moodle i la seva base de dades MariaDB.

## 🛠️ Instruccions d'Instal·lació i Configuració

### Prerequisits
Una instància de Traefik ja ha d'estar en funcionament.

Un registre DNS de tipus A (ex: moodle.opendxp.net) ha d'apuntar a la IP pública del teu servidor.

### Passos per al Desplegament
Personalitzar el docker-compose-moodle.yml:

Dominis: Substitueix moodle.opendxp.net a la secció labels i a la variable MOODLE_SITE_URL pel teu domini.

Credencials: Estableix contrasenyes segures per a la base de dades i per a l'usuari administrador de Moodle.

Iniciar el Servei:

```
docker-compose up -d
```

### Configuració Post-Instal·lació
Primer Accés: Accedeix al teu domini (ex: https://moodle.opendxp.net). La imatge de Bitnami gestiona la instal·lació automàticament.

Iniciar Sessió: Fes servir l'usuari i la contrasenya d'administrador que has definit al fitxer docker-compose.yml.

Configuració Bàsica: Explora el panell de Site administration per ajustar l'idioma, l'aparença i altres paràmetres essencials del lloc.

Per a més informació sobre el projecte global, consulta el README principal.
