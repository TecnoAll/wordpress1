(function( $ ) {
    'use strict';

    $(function() {

        /**
         * Disable parent select
         */
        $( "#newproperty-feature_parent" ).remove();
        $( "#newproperty-status_parent" ).remove();

    });

    $(function(){
        var selectPage =  $('#page_template');
        var getSelectOption = $('#page_template').val();
        var googleField = $('#inspiry_display_google_map_description').closest('.rwmb-row');

        var halfMapSelect = $('#inspiry_display_google_half_map-description');
        var halfMapSelectField = $('#inspiry_display_google_half_map-description').closest('.rwmb-row');

        if(getSelectOption === 'page-templates/properties-list-half-map.php'){
            googleField.hide();
            halfMapSelectField.show();
        }else{
            googleField.show();
            halfMapSelectField.hide();
        }

        selectPage.on('change',function(){
            if( $("#page_template option:selected").val() == 'page-templates/properties-list-half-map.php'){
                googleField.hide();
                halfMapSelectField.show();
            }else{
                googleField.show();
                halfMapSelectField.hide();
            }
        });
    });


})( jQuery );