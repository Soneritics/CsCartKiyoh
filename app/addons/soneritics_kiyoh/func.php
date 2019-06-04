<?php

use Tygh\Registry;

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

/**
 * Get the totals
 * @return array
 */
function fn_soneritics_kiyoh_get_totals(): array
{
    $companyId = Registry::get('runtime.company_id');
    $companyData = fn_get_company_data($companyId);

    $totals = db_get_row("SELECT * FROM `?:soneritics_kiyoh_totals`");
    $totals['logo'] = fn_get_logos()['theme']['image']['image_path'];
    $totals['company_name'] = $companyData['company'];
    $totals['company_phone'] = $companyData['phone'];
    $totals['company_address'] = implode(
        ', ',
        [$companyData['address'], $companyData['zipcode'], $companyData['city']]
    );

    return $totals;
}
