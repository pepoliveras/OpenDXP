# OpenDXP
# CATALAN (ENGLISH BELOW)

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

* Fitxers `docker-compose.yml` per a la instal·lació de cada servei a la carpeta corresponent.
* Guia de configuració (en els arxius d'explicació dins de cada carpeta també).
* Axius JSON amb els Fluxos d'integració es poden trobar a la carpeta N8N 📁.
* Exemples de configuració de Traefik.


## ✉️ Contacte

Si tens preguntes o vols col·laborar, no dubtis en contactar amb nosaltres a http://www.opendxp.net

Podeu consultar el document origen d'aquest projecte en aquest repositori de la UOC: https://openaccess.uoc.edu/handle/10609/152740

---

# ENGLISH
# **OpenDXP**
# Integration of an OpenDXP Platform using Open Source Tools

This repository contains the code and configuration for the OpenDXP project, a Digital Experience Platform (DXP) built exclusively with open-source and free software tools. The goal of this project is to offer a functional, scalable, and low-cost reference model for small and medium-sized organizations with limited resources that are looking to integrate their existing digital systems.

## 🚀 What is OpenDXP?
OpenDXP (Open Digital Experience Platform) is an approach to DXPs that leverages the flexibility and sustainability of free software. It goes beyond simple content management or isolated tools, enabling a holistic view of the user and the automation of processes across different systems.

## ✨ Integrated Components (Prototype)
The developed prototype integrates the following tools:

* WordPress: Content Management System (CMS) for the web portal and user interaction.
* SuiteCRM: Customer Relationship Management (CRM) system for the user base.
* Mautic: Marketing Automation tool for personalized campaigns.
* n8n: Workflow Automation platform (middleware) that orchestrates data flows between all tools via APIs.

## 🗓️ Additional Components
Beyond the prototype, other platforms have been added, such as:

* Moodle: Learning Management System (LMS) for managing online learning and training.
* Prestashop: E-commerce Management System (CMS) for online retail solutions.
* Mediawiki: Platform for publishing free and collaborative knowledge (wiki).
* Koha: Integrated Library System (ILS) for managing catalogs, people, and library loans.

## ⚙️ Architecture and Technologies
The solution is based on a modular three-layer architecture (Frontend, Functional Backend, Middleware) and uses:

* Docker & Docker Compose: For the isolated and scalable deployment of components.
* Traefik: As a Reverse Proxy and manager for automatic SSL/TLS certificates (Let's Encrypt).
* RESTful APIs and Webhooks: For data communication and synchronization.
* MariaDB & PHP: As the database and server-side engine.

## 🔗 Key Integration Flows
We have implemented and documented essential flows such as:

* WordPress forms to Mautic and SuiteCRM.
* SuiteCRM updates based on Mautic interactions.
* Synchronization of master data between SuiteCRM, Mautic, and WordPress.

## 🛠️ How to Replicate the Project
This repository includes:

* docker-compose.yml files for each service.
* Configuration guides (in the explanation files within each folder).
* JSON files with the integration flows can be found in n8n folder 📁.
* Examples of Traefik configuration.

## ✉️ Contact
If you have questions or want to collaborate, feel free to contact us at http://www.opendxp.net.
You can consult the source document for this project in this UOC repository: https://openaccess.uoc.edu/handle/10609/152740
