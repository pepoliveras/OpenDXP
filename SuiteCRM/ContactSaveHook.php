<?php

// Assegurem que el fitxer no s'executi directament
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class ContactSaveHook
{
    /**
     * Aquesta funció s'executa després de guardar un contacte.
     * Envia l'ID del contacte a un webhook de n8n.
     *
     * @param SugarBean $bean El registre del contacte que s'ha guardat.
     * @param string $event L'esdeveniment que ha activat el hook (en aquest cas, 'after_save').
     * @param array $arguments Arguments addicionals.
     */
    function sendToN8n(SugarBean $bean, $event, $arguments)
    {
        // URL del Webhook de n8n. POTS OBTENIR AQUESTA URL DEL NODE WEBHOOK A N8N .
        $webhook_url = 'URL_DEL_TEU_WEBHOOK_DE_N8N';

        // Només volem actuar sobre registres existents (actualitzacions), no en la creació de nous.
        // La propietat 'fetched_row' només existeix si el registre ja existia a la base de dades abans de guardar.
        if (empty($bean->fetched_row)) {
            // És un contacte nou, no fem res en aquest flux.
            return;
        }

        // Preparem les dades que enviarem a n8n. Només necessitem l'ID.
        $post_data = json_encode(['contact_id' => $bean->id]);

        // Iniciem una sessió cURL per fer la petició HTTP POST
        $ch = curl_init($webhook_url);

        // Configurem les opcions de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna la resposta en lloc d'imprimir-la
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($post_data)
        ));
        // Opcional: Ignorar la verificació SSL si fas servir certificats autofirmats en desenvolupament
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Executem la petició
        $response = curl_exec($ch);

        // Tanquem la sessió cURL
        curl_close($ch);

        // Opcional: Pots guardar un registre del que ha passat al log de SuiteCRM
        $GLOBALS['log']->info("ContactSaveHook: S'ha enviat l'ID {$bean->id} a n8n. Resposta: {$response}");
    }
}