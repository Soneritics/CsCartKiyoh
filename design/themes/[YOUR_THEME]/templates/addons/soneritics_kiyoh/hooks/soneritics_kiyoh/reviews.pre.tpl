<p>Totale reviews</p>

<div id="soneritics_kiyoh_reviews">
    {foreach from=fn_soneritics_kiyoh_get_reviews($page, $review_count_per_page) item="review"}
        <div class="row-fluid">
           <div class="span4">
               {assign var="stars" value=$review.total_score}
               <div class="stars">{hook name="soneritics_kiyoh:stars"}{/hook}</div>
               <div class="placed-by">Door <strong>{$review.customer_name}</strong></div>
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

{if $pages > 1}
    Pagination
{/if}