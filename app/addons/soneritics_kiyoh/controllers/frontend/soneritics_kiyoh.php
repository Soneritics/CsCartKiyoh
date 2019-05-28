<?php
if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($mode === 'show') {
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    $totals = fn_soneritics_kiyoh_get_totals();

    $reviewCountPerPage = 25;
    $pages = ceil($totals['total_reviews'] / $reviewCountPerPage);

    Tygh::$app['view']->assign('title', 'Reviews');
    Tygh::$app['view']->assign('page', $page);
    Tygh::$app['view']->assign('pages', $pages);
    Tygh::$app['view']->assign('review_count_per_page', $reviewCountPerPage);
}
