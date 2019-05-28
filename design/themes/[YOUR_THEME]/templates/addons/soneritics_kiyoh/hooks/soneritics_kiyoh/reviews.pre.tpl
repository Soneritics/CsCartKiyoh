<div id="soneritics_kiyoh_reviews">
    <div class="row-fluid">
        <div class="span13">
            <h2>{$title}</h2>
            <span class="rating">9.5</span>
            <a href="" title="" class="total-reviews">1.214 reviews</a>
        </div>

        <div class="span3" class="kiyoh-logo">
            <a href="" title="" target="_blank"><img src="{$images_dir}/addons/soneritics_kiyoh/kiyoh-logo.svg" alt="KiyOh logo" title=""></a><br>
        </div>
    </div>
    <hr class="divider">

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