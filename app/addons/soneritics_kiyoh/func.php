<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Get the Kiyoh API based on the CsCart settings
 * @param int $reviewCount
 * @return KiyohApi
 */
function fn_soneritics_kiyoh_get_api($reviewCount = 50)
{
    $settings = new SoneriticsKiyohSettings;
    $api = new KiyohApi(
        $settings->getConnectorCode(),
        $settings->getCompanyId(),
        (int)$reviewCount
    );

    return $api;
}
