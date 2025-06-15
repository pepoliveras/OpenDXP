# OpenDXP - Component: SuiteCRM
Aquesta carpeta conté els fitxers necessaris per desplegar i configurar SuiteCRM, el sistema de Gestió de Relacions amb el Client (CRM) de la plataforma OpenDXP.

## 🚀 Rol dins de la Plataforma OpenDXP
SuiteCRM és el nucli central de dades i la "font de la veritat" de la plataforma. Les seves funcions principals són:

Gestió Centralitzada de Contactes: Emmagatzema tota la informació de la base social (socis, donants, voluntaris, contactes) en un únic lloc.

Visió 360º: Consolida l'historial d'interaccions d'un contacte a través de les diferents plataformes (què ha rebut de Mautic, de quin formulari de WordPress prové, etc.).

Gestió de Processos de Negoci: Permet gestionar campanyes de captació de fons, oportunitats, casos de suport i altres processos interns de l'ONG.

Punt d'Inici de Sincronització: Les actualitzacions manuals a SuiteCRM inicien el Flux 3, que propaga els canvis a la resta de l'ecosistema.

## 📂 Contingut de la Carpeta
docker-compose-suitecrm.yml: Fitxer de Docker Compose per desplegar el contenidor de SuiteCRM i la seva base de dades.

ContactSaveHook.php: Fitxer PHP que implementa el Logic Hook necessari per activar el Flux 3 quan es desa un contacte.

## 🛠️ Instruccions d'Instal·lació i Configuració

### Prerequisits
Una instància de Traefik ja ha d'estar en funcionament.

Un registre DNS de tipus A (ex: suitecrm.opendxp.net) ha d'apuntar a la IP pública del teu servidor.

### Passos per al Desplegament
Personalitzar el docker-compose-suitecrm.yml:

Dominis: Substitueix suitecrm.opendxp.net a la secció labels i a la variable d'entorn SUITECRM_HOST pel domini que hagis escollit.

Credencials: Modifica les variables d'entorn per a les bases de dades i l'usuari de SuiteCRM per utilitzar contrasenyes segures.

Iniciar el Servei:
```
docker-compose up -d
```

### Configuració Post-Instal·lació
Accedir a SuiteCRM: Un cop iniciat, accedeix al teu domini (ex: https://suitecrm.opendxp.net). La imatge de Bitnami realitza la instal·lació automàticament. Inicia sessió amb l'usuari i contrasenya definits al docker-compose.yml.

Crear Credencials d'API: Ves a Administració > Clients OAuth2 i Tokens i crea un nou client per a n8n. Guarda el Client ID i el Client Secret generats.

Instal·lar el Logic Hook (Molt Important):

Localitza el directori de dades de SuiteCRM al teu servidor amfitrió (el mountpoint del volum suitecrm_data).

Copia el fitxer ContactSaveHook.php a la ruta public/legacy/custom/modules/Contacts/ dins del volum.

A la mateixa carpeta, crea un nou fitxer anomenat logic_hooks.php amb el següent contingut per registrar el hook:
```
<?php
$hook_version = 1;
$hook_array = array();
$hook_array['after_save'] = array();
$hook_array['after_save'][] = array(
    1, 'Envia notificació a n8n en guardar contacte',
    'custom/modules/Contacts/ContactSaveHook.php', 'ContactSaveHook', 'sendToN8n'
);
```

Finalment, ves a Administració > Reparar a SuiteCRM i executa "Quick Repair and Rebuild" perquè els canvis tinguin efecte.

Per a més informació sobre el projecte global, consulta el README principal.
