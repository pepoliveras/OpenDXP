# OpenDXP
# Integració d'una Plataforma OpenDXP mitjançant eines Open Source

Aquest repositori conté el codi i la configuració del projecte **OpenDXP**, una Plataforma d'Experiència Digital (DXP) construïda exclusivament amb eines de codi obert i programari lliure. L'objectiu d'aquest projecte és oferir un model de referència funcional, escalable i de baix cost per a organitzacions petites i mitjanes amb recursos limitats, que busquen integrar els seus sistemes digitals existents.

## 🚀 Què és OpenDXP?

OpenDXP (Open Digital Experience Platform) és una aproximació a les DXP que aprofita la flexibilitat i sostenibilitat del programari lliure. Va més enllà de la simple gestió de continguts o eines aïllades, permetent una visió holística de l'usuari i l'automatització de processos a través de diferents sistemes.

## ✨ Components Integrats (Prototip)

El prototip desenvolupat integra les següents eines:

* **WordPress:** Gestor de Continguts (CMS) per al portal web i la interacció amb usuaris.
* **SuiteCRM:** Sistema de Gestió de Relacions amb el Client (CRM) per a la base social.
* **Mautic:** Eina d'Automatització de Màrqueting per a campanyes personalitzades.
* **n8n:** Plataforma de Workflow Automation (middleware) que orquestra els fluxos de dades entre totes les eines mitjançant APIs.

## 🗓️ Components Adicionals 

A partir del prototip s'han afegit altres plataformes com són:

* **Moodle:** Gestor de Continguts d'aprenentatge (LMS) Per a la gestió de l'aprenentatge en línia i la formació.
* **Prestashop:** Sistema de Gestió de vendes (CMS) per a solucions de comerç electrònic.
* **Mediawiki:** Plataforma de publicació de coneixement lliure i col·laboratiu (wiki).
* **Koha:** Sistema Integral de Gestió Bibliotecària (SIGB) per a la gestió de catàlegm persones i prèstecs de biblioteques.


## ⚙️ Arquitectura i Tecnologies

La solució es basa en una arquitectura modular de tres capes (Frontend, Backend funcional, Middleware) i utilitza:

* **Docker & Docker Compose:** Per al desplegament aïllat i escalable dels components.
* **Traefik:** Com a Reverse Proxy i gestor de certificats SSL/TLS automàtics (Let's Encrypt).
* **RESTful APIs i Webhooks:** Per a la comunicació i sincronització de dades.
* **MariaDB & PHP:** Com a bases de dades i motor de servidor.

## 🔗 Fluxos d'Integració Clau

Hem implementat i documentat fluxos essencials com:

* Formularis de WordPress a Mautic i SuiteCRM.
* Actualitzacions de SuiteCRM basades en interaccions de Mautic.
* Sincronització de dades mestres entre SuiteCRM, Mautic i WordPress.

## 🛠️ Com replicar el Projecte

Aquest repositori inclou:

* Fitxers `docker-compose.yml` per a cada servei.
* Guia de configuració (en els arxius d'explicació dins de cada carpeta).
* Axius JSON amb els Fluxos d'integració per a N8N
* Exemples de configuració de Traefik.


## ✉️ Contacte

Si tens preguntes o vols col·laborar, no dubtis en contactar amb nosaltres a http://www.opendxp.net

Podeu consultar el document origen d'aquest projecte en aquest repositori de la UOC: https://openaccess.uoc.edu/handle/10609/152740

---
