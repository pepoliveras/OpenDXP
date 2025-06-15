# OpenDXP - Component: n8n (Orquestració)
Aquesta carpeta conté els fitxers de configuració per a n8n (pronunciat "nodemation"), la plataforma de workflow automation que actua com a middleware i sistema nerviós central de l'ecosistema OpenDXP.

## 🚀 Rol dins de la Plataforma OpenDXP
n8n és l'orquestrador que connecta totes les altres eines. La seva funció no és emmagatzemar dades a llarg termini, sinó moure-les i transformar-les de manera intel·ligent.

Integració d'APIs: Es connecta a les APIs de WordPress, SuiteCRM, Mautic i qualsevol altra eina futura per intercanviar informació.

Automatització de Processos: Executa els fluxos de treball (workflows) que defineixen la lògica de negoci, com per exemple "quan passi X a l'eina A, fes Y a l'eina B".

Transformació de Dades: Adapta les dades d'una plataforma al format que espera una altra.

Lògica Condicional: Permet crear fluxos complexos que prenen decisions basades en les dades que reben (ex: si el contacte ja existeix, actualitza'l; si no, crea'l).

## 📂 Contingut de la Carpeta
docker-compose-n8n.yml: Fitxer per desplegar el servei de n8n en un contenidor Docker.

Flux01__WP____Mautic___CRM.json: Fitxer d'exportació del workflow Flux 1.

Flux02__SCRM____Mautic.json: Fitxer d'exportació del workflow Flux 3.

Fitxers .txt: Descripcions o notes sobre els fluxos.

## 🛠️ Instruccions d'Instal·lació i Configuració

### Prerequisits
Una instància de Traefik ja ha d'estar en funcionament.

Un registre DNS de tipus A (ex: n8n.opendxp.net) ha d'apuntar a la IP pública del teu servidor.

### Passos per al Desplegament

**Personalitzar el docker-compose-n8n.yml:**

Dominis: Substitueix n8n.opendxp.net a la secció labels i a les variables d'entorn (N8N_HOST, WEBHOOK_URL) pel teu domini.

Zona Horària: Assegura't que GENERIC_TIMEZONE estigui correctament configurada.

Iniciar el Servei:
```
docker-compose up -d
```

### Configuració Post-Instal·lació
Crear Propietari de la Instància: Accedeix al teu domini (ex: https://n8n.opendxp.net). La primera vegada, n8n et demanarà que creïs un usuari propietari (administrador).

Configurar Credencials: Abans d'importar els fluxos, ves a la secció Credentials i crea una credencial per a cada servei:

Una credencial per a Mautic (OAuth2).

Una credencial per a WordPress (Application Password).

Una credencial SMTP per a l'enviament de correus de notificació.

Importar els Workflows:

Ves a Import > From File i selecciona els fitxers .json d'aquesta carpeta.

Un cop importat un flux, hauràs d'obrir-lo i connectar cada node a la credencial corresponent.

Activar els Workflows: Obre cada flux i activa'l amb l'interruptor que es troba a la cantonada superior esquerra. Desa els canvis.

Per a més informació sobre el projecte global, consulta el README principal.
