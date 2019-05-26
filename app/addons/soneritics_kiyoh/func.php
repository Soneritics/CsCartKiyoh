<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Get the Kiyoh API based on the CsCart settings
 * @return KiyohApi
 */
function fn_soneritics_kiyoh_get_api()
{
    $settings = new SoneriticsKiyohSettings;
    $api = new KiyohApi(
        $settings->getConnectorCode(),
        $settings->getCompanyId()
    );

    return $api;
}
