/**
 * This file holds the main javascript functions needed for the functionality of the widget area creator at wp-admin/widgets.php
 */

(function($)
{
    var InspirySidebar = function(){

        this.widget_wrap = $('.widget-liquid-right');
        this.widget_area = $('#widgets-right');
        this.widget_add  = $('#inspiry-tmpl-add-widget');

        this.create_form();
        this.add_del_button();
        this.bind_events();

    };

    InspirySidebar.prototype = {

        create_form: function()
        {
            this.widget_wrap.append(this.widget_add.html());
            this.widget_name = this.widget_wrap.find('input[name="inspiry-sidebar-widgets"]');
            this.nonce       = this.widget_wrap.find('input[name="inspiry-delete-custom-sidebar-nonce"]').val();
        },

        add_del_button: function()
        {
            this.widget_area.find('.sidebar-inspiry-custom').append('<span class="dashicons dashicons-no-alt inspiry-custom-sidebar-area-delete"></span>');
        },

        bind_events: function()
        {
            this.widget_wrap.on('click', '.inspiry-custom-sidebar-area-delete', $.proxy( this.delete_sidebar, this));
        },


        //delete the sidebar area with all widgets within, then re calculate the other sidebar ids and re save the order
        delete_sidebar: function(e)
        {
            var widgetTitle = $(e.currentTarget).parents('.widgets-holder-wrap:eq(0)').find('h2').text().replace(" ", "");
            var delete_it = confirm("Do you really want to delete '"+ widgetTitle +"' widget area?");

            if(delete_it == false) return false;

            var widget      = $(e.currentTarget).parents('.widgets-holder-wrap:eq(0)'),
                title       = widget.find('.sidebar-name h3 , .sidebar-name h2'),
                spinner     = title.find('.spinner'),
                widget_name = $.trim(title.text()),
                obj         = this;

            $.ajax({
                type: "POST",
                url: window.ajaxurl,
                data: {
                    action: 'inspiry_ajax_delete_custom_sidebar',
                    name: widget_name,
                    _wpnonce: obj.nonce
                },

                beforeSend: function()
                {
                    spinner.addClass('activate_spinner');
                },
                success: function(response)
                {
                    if(response == 'sidebar-deleted')
                    {
                        widget.slideUp(200, function(){

                            $('.widget-control-remove', widget).trigger('click'); //delete all widgets inside
                            widget.remove();

                        });
                    }
                }
            });
        }

    };

    $(function()
    {
        new InspirySidebar();
    });


})(jQuery);