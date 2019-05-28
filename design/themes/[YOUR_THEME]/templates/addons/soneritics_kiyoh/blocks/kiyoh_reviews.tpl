{assign var="review_count_per_page" value="10"}
{assign var="page" value="1"}
{assign var="pages" value="1"}
{assign var="title" value=""}
{assign var="subtitle" value="Reviews"}
{hook name="soneritics_kiyoh:reviews"}{/hook}

<p><a href="{fn_url('soneritics_kiyoh.show')}" class="ty-btn ty-btn__primary">Meer reviews &raquo;</a></p>
