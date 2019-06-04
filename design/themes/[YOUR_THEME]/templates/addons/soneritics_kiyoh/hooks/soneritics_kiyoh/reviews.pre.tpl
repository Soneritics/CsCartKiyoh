{assign var="totals" value=fn_soneritics_kiyoh_get_totals()}
{include file="common/pagination.tpl" id="soneritics_kiyoh_reviews" search=$paginationVars}

<div id="soneritics_kiyoh_reviews">
    <div class="row-fluid">
        <div class="span14">
            {if $title}<h1>{$title}</h1>{/if}
            {if $subtitle}<h2>{$subtitle}</h2>{/if}
            <span class="rating">{$totals.total_score}</span>
            <a href="/kiyoh-reviews/" title="KiyOh reviews" class="total-reviews">{number_format($totals.total_reviews, 0, ',', '.')} reviews</a>
        </div>

        <div class="span2 kiyoh-logo">
            <a href="{$totals.url}" title="KiyOh reviews" target="_blank"><img src="{$images_dir}/addons/soneritics_kiyoh/kiyoh-logo.svg" alt="KiyOh logo" title=""></a>
        </div>
    </div>
    <hr class="divider">

    <div class="review-snippet">
        <div itemscope itemtype="https://schema.org/LocalBusiness">
            <meta itemprop="image" content="{$totals.logo}">
            <span itemprop="name">{$totals.company_name}</span>
            <span itemprop="telephone">{$totals.company_phone}</span>
            <span itemprop="address">{$totals.company_address}</span>
            <span itemprop="priceRange">€€</span>
            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="{$totals.total_score}">
                <meta itemprop="bestRating" content="10">
                <meta itemprop="worstRating" content="1">
                <meta itemprop="ratingCount" content="{$totals.total_reviews}">
            </div>
        </div>
    </div>

    {foreach from=fn_soneritics_kiyoh_get_reviews($page, $review_count_per_page) item="review"}
        <div class="row-fluid" itemscope itemtype="https://schema.org/Review">
           <div class="span4">
               {assign var="stars" value=$review.total_score}
               <div class="stars">{hook name="soneritics_kiyoh:stars"}{/hook}</div>
               {if $review.customer_name}<div class="placed-by">Door <strong>{$review.customer_name}</strong></div>{/if}
               <div class="placed-at">Geplaatst op {date('j-n-Y', $review['date'])}</div>

                <div class="review-snippet">
                    <span itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
                        <meta itemprop="image" content="{$totals.logo}">
                        <meta itemprop="name" content="{$totals.company_name}">
                        <meta itemprop="telephone" content="{$totals.company_phone}">
                        <meta itemprop="address" content="{$totals.company_address}">
                        <meta itemprop="priceRange" content="€€">
                    </span>

                    <span itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                        <meta itemprop="ratingValue" content="{$review.total_score}">
                        <meta itemprop="bestRating" content="10">
                        <meta itemprop="worstRating" content="1">
                    </span>

                    <meta itemprop="datePublished" content="{date('c', $review['date'])}">

                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <span itemprop="name">{$review.customer_name}</span>
                    </span>

                    <span itemprop="reviewBody">{$review.positive}</span>

                    <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <meta itemprop="name" content="{$totals.company_name}">
                    </span>
                </div>
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
