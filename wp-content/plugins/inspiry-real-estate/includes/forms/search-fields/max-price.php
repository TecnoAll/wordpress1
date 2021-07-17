
<div class="option-bar property-max-price price-for-others">
    <select name="max-price" id="select-max-price" class="search-select">
        <?php ire_maximum_prices_options(); ?>
    </select>
</div>

<div class="option-bar property-max-price price-for-rent hidden">
    <select name="max-price" id="select-max-price-rent" class="search-select" disabled="disabled">
        <?php ire_maximum_prices_options( 'rent' ); ?>
    </select>
</div>