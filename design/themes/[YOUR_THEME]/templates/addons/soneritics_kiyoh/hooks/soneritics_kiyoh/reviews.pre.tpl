{assign var="totals" value=fn_soneritics_kiyoh_get_totals()}
{include file="common/pagination.tpl" id="soneritics_kiyoh_reviews" search=$paginationVars}

<div id="soneritics_kiyoh_reviews">
    <div class="row-fluid">
        <div class="span13">
            {if $title}<h1>{$title}</h1>{/if}
            {if $subtitle}<h2>{$subtitle}</h2>{/if}
            <span class="rating">{$totals.total_score}</span>
            <a href="{fn_url('soneritics_kiyoh.show')}" title="KiyOh reviews" class="total-reviews">{number_format($totals.total_reviews, 0, ',', '.')} reviews</a>
        </div>

        <div class="span3" class="kiyoh-logo">
            <a href="{$totals.url}" title="KiyOh reviews" target="_blank"><img src="{$images_dir}/addons/soneritics_kiyoh/kiyoh-logo.svg" alt="KiyOh logo" title=""></a><br>
        </div>
    </div>
    <hr class="divider">

    {foreach from=fn_soneritics_kiyoh_get_reviews($page, $review_count_per_page) item="review"}
        <div class="row-fluid">
           <div class="span4">
               {assign var="stars" value=$review.total_score}
               <div class="stars">{hook name="soneritics_kiyoh:stars"}{/hook}</div>
               {if $review.customer_name}<div class="placed-by">Door <strong>{$review.customer_name}</strong></div>{/if}
               <div class="placed-at">Geplaatst op {date('j-n-Y', $review['date'])}</div>
           </div>

           <div class="span7">
               {if $review.positive != ""}<i class="fa fa-plus-circle"></i>{/if}
               {$review.positive}
           </div>

           <div class="span5">
               {if $review.negative != ""}<i class="fa fa-minus-circle"></i>{/if}
               {$review.negative}
           </div>
        </div>
        <hr>
    {/foreach}
</div>

{include file="common/pagination.tpl" id="soneritics_kiyoh_reviews" search=$paginationVars}
