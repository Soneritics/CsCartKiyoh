<?php
/*
 * The MIT License
 *
 * Copyright 2018 Jordi Jolink.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

// https://domain/?dispatch=soneritics_kiyoh_refresh.action&secret={SECRETKEY}
if ($mode === 'action' && !empty($_GET['secret'])) {
    if ($_GET['secret'] == \Tygh\Registry::get('addons.soneritics_kiyoh.secretkey')) {
        $existingIds = db_get_fields("SELECT review_id FROM ?:soneritics_kiyoh_reviews");

        $api = fn_soneritics_kiyoh_get_api();

        $results = $api->getReviews();
        $pages = $results->getPages();
        for ($page = 1; $page <= $pages; $page++) {
            if ($page > 1) {
                $results = $api->getReviews($page);
            }

            if (!empty($results->getReviews())) {
                foreach ($results->getReviews() as $review) {
                    /** @var KiyohReview $review */
                    if (!in_array($review->getReviewId(), $existingIds)) {
                        db_query(
                            "INSERT INTO `?:soneritics_kiyoh_reviews`
                                (`review_id`, `customer_name`, `customer_place`, `total_score`, `recommendation`, `positive`, `negative`, `purchase`, `reaction`, `image`, `date`)
                            VALUES(?i, ?s, ?s, ?i, ?i, ?s, ?s, ?s, ?s, ?s, ?i)",
                            $review->getReviewId(),
                            $review->getCustomerName(),
                            $review->getCustomerPlace(),
                            $review->getTotalScore(),
                            $review->isRecommendation() ? 1 : 0,
                            $review->getPositive(),
                            $review->getNegative(),
                            $review->getPurchase(),
                            $review->getReaction(),
                            $review->getImage(),
                            $review->getDate()->format('U')
                        );
                    }
                }
            }
        }

        // Update the totals
        db_query("TRUNCATE `?:soneritics_kiyoh_totals`");
        db_query(
            "INSERT INTO `?:soneritics_kiyoh_totals`(url, total_score, total_reviews) VALUES(?s, ?d, ?i)",
            $results->getCompany()->getUrl(),
            round($results->getCompany()->getTotalScore(), 1),
            $results->getCompany()->getTotalReviews()
        );
    }

    fn_clear_ob();
    die('OK');
}
