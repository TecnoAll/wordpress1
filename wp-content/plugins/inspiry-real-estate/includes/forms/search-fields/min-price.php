
<div class="option-bar property-min-price price-for-others">
    <select name="min-price" id="select-min-price" class="search-select">
        <?php ire_minimum_prices_options(); ?>
    </select>
</div>

<div class="option-bar property-min-price price-for-rent hidden">
    <select name="min-price" id="select-min-price-rent" class="search-select" disabled="disabled">
        <?php ire_minimum_prices_options( 'rent' ); ?>
    </select>
</div>