<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Get the Kiyoh API based on the CsCart settings
 * @return KiyohApi
 */
function fn_soneritics_kiyoh_get_api(): KiyohApi
{
    $settings = new SoneriticsKiyohSettings;
    $api = new KiyohApi(
        $settings->getConnectorCode(),
        $settings->getCompanyId()
    );

    return $api;
}

/**
 * Get reviews per page
 * @param int $page
 * @param int $reviewCountPerPage
 * @return array
 */
function fn_soneritics_kiyoh_get_reviews(int $page, int $reviewCountPerPage = 25): array
{
    $start = ($page * $reviewCountPerPage) - $reviewCountPerPage;

    return db_get_array(
        "SELECT * FROM `?:soneritics_kiyoh_reviews` ORDER BY `date` DESC LIMIT ?i,?i",
        $start,
        $reviewCountPerPage
    );
}
