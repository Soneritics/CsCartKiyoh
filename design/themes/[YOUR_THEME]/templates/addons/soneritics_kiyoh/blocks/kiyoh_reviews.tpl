{assign var="kiyohApi" value=fn_soneritics_kiyoh_get_api($review_count_per_page)}
{assign var="kiyohReviews" value=$kiyohApi->getReviews()}
<p>
    kiyoh reviews block<br>
    Per pagina {$review_count_per_page} reviews<br>
    Pagina: 1
</p>
<pre>{$kiyohReviews|print_r}</pre>
