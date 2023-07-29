jQuery(document).ready(function ($) {
    $('.mw_color_picker').wpColorPicker({
        change: function (e, ui) {
            $(e.target).val(ui.color.toString());
            $(e.target).trigger('change');
        }
    });
    var width_slider = $('#mihanwp_notification_bar_width'),
        height_slider = $('#mihanwp_notification_bar_height'),
        width_value_wrapper = $('#mihanwp_notification_bar_width_value'),
        height_value_wrapper = $('#mihanwp_notification_bar_height_value'),
        preview_section = $('.mihanwp_notification_bar_preview'),
        title_input = $('input[name=mihanwp_notification_bar_title]'),
        title_wrapper = preview_section.find('#mihanwp_notification_bar_message'),
        cta_btn_title_input = $('input[name=mihanwp_notification_bar_cta_title]'),
        cta_button = $('#mihanwp_notification_bar_button a'),
        has_count_down_checkbox = $('input[name=mihanwp_notification_bar_has_count_down]'),
        has_close_btn = $('input[name=mihanwp_notification_bar_has_close_btn]'),
        end_date_input = $('input[name=mihanwp_notification_bar_end_date]'),
        count_down_content_input = $("#count_down_content"),
        count_down_content_wrapper = preview_section.find('#mihanwp_notification_bar_timer'),
        bg_mode_input = $('input[name=mihanwp_notification_bar_bg_mode]'),
        must_hide_wrapper = $('.mihanwp_notification_bar_option_panel .hide'),
        must_hide_input = $('.mihanwp_notification_bar_option_panel .hide input'),
        bg_color_input = $('input[name=mihanwp_notification_bar_bg_color]'),
        bg_second_color_input = $('input[name=mihanwp_notification_bar_bg_second_color]'),
        bg_gradient_direction_input = $('input[name=mihanwp_notification_bar_bg_gradient_direction]'),
        bg_gradient_direction_value_wrapper = $('#mihanwp_notification_bar_gradient_direction_value'),
        bg_image_input = $('input[name=mihanwp_notification_bar_bg_image]'),
        bg_repeat_mode_input = $('input[name=mihanwp_notification_bar_bg_repeat_mode]'),
        bg_size_input = $('input[name=mihanwp_notification_bar_bg_size]'),
        bg_position_input = $('input[name=mihanwp_notification_bar_bg_position]'),
        text_color_input = $('input[name=mihanwp_notification_bar_text_color]'),
        link_color_input = $('input[name=mihanwp_notification_bar_link_color]'),
        link_btn_color_input = $('input[name=mihanwp_notification_bar_link_btn_color]'),
        close_btn_wrapper = $('.mihanwp_notification_bar_close'),
        close_btn_color_input = $('input[name=mihanwp_notification_bar_close_btn_color]'),
        close_btn_bg_color_input = $('input[name=mihanwp_notification_bar_close_btn_bg_color]'),
        title_font_size_input = $('input[name=mihanwp_notification_bar_title_font_size]'),
        timer_font_size_input = $('input[name=mihanwp_notification_bar_count_down_font_size]'),
        cta_font_size_input = $('input[name=mihanwp_notification_bar_cta_font_size]');
    var timer_wrapper = preview_section.find('#mihanwp_notification_bar_timer');
    
    title_input.on('input', function () {
        title_wrapper.text(this.value);
    });
    width_slider.on('input', function (e) {
        width_value_wrapper.html('(' + this.value + ' px)');
        var new_value = this.value * 88 / 1200;
        preview_section.find('#mihanwp_notification_bar_content').css('width', new_value + '%');
    })
    height_slider.on('input', function () {
        height_value_wrapper.html('(' + this.value + ' px)');
        preview_section.css('height', this.value + 'px');
    });
    cta_btn_title_input.on('input', function (e) {
        cta_button.text(this.value);
    });
    has_count_down_checkbox.on('change', function () {
        if ($(this).is(':checked')) {
            render_timer_data(count_down_content_input.val());
            run_count_down();
        } else {
            timer_wrapper.html('');
        }
    });
    has_close_btn.on('change', function () {
        if ($(this).is(':checked'))
        {
            close_btn_wrapper.show();
        } else {
            close_btn_wrapper.hide();            
        }
    });
    bg_color_input.on('change', function () {
        switch (bg_mode_input.filter(':checked').val())
        {
            case 'solid':
                set_solid_mode_style();
                break;
            case 'gradient':
                set_gradient_mode_style();
                break;
        }
    })
    bg_second_color_input.on('change', function () {
        preview_section.css('background', 'linear-gradient('+bg_gradient_direction_input.val()+'deg, '+bg_color_input.val()+', '+this.value+')');
    });
    bg_gradient_direction_input.on('input', function () {
        bg_gradient_direction_value_wrapper.html('(' + this.value + ')');
        preview_section.css('background', 'linear-gradient('+this.value+'deg, '+bg_color_input.val()+', '+bg_second_color_input.val()+')');
    });
    text_color_input.on('change', function () {
        preview_section.find('#mihanwp_notification_bar_content').css('color', this.value);
    })
    link_color_input.on('change', function () {
        cta_button.css('color', this.value);
    });
    link_btn_color_input.on('change', function () {
        cta_button.css('background-color', this.value);
    });
    close_btn_color_input.on('change', function () {
        close_btn_wrapper.css('color', this.value);
    });
    close_btn_bg_color_input.on('change', function () {
        close_btn_wrapper.css('background-color', this.value);
    });
    title_font_size_input.on('change', function () {
        title_wrapper.find('p').css('font-size', this.value + 'px');
    });
    timer_font_size_input.on('change', function () {
        timer_wrapper.css('font-size', this.value + 'px');
    });
    cta_font_size_input.on('change', function () {
        cta_button.css('font-size', this.value + 'px');
    });
    bg_mode_input.on('change', function () {
        handle_bg_mode();
    });
    bg_image_input.on('blur', function () {
        set_image_mode_style();
    });
    bg_repeat_mode_input.on('change', function () {
        preview_section.css('background-repeat', this.value);
    });
    bg_size_input.on('change', function () {
        preview_section.css('background-size', this.value);
    });
    bg_position_input.on('change', function () {
        preview_section.css('background-position', this.value);
    });
    function has_count_down()
    {
        return has_count_down_checkbox.is(':checked') ? true : false;
    }
    function set_solid_mode_style()
    {
        preview_section.css('background', bg_color_input.val());
    }
    function set_gradient_mode_style()
    {
        preview_section.css('background', 'linear-gradient('+bg_gradient_direction_input.val()+'deg, '+bg_color_input.val()+', '+bg_second_color_input.val()+')');
    }
    function set_image_mode_style()
    {
        preview_section.css({
            'background': 'url("' + bg_image_input.val() + '")',
            'background-repeat' : bg_repeat_mode_input.filter(':checked').val(),
            'background-size': bg_size_input.filter(':checked').val(),
            'background-color': bg_color_input.val(),
            'background-position' : bg_position_input.filter(':checked').val()
        })
    }
    function handle_bg_mode()
    {
        must_hide_wrapper.hide();
        must_hide_input.prop('disabled', true);
        switch (bg_mode_input.filter(':checked').val())
        {
            case 'solid':
                var on_solid_section = $('.mihanwp_notification_bar_option_panel tr[on-solid=on]');
                on_solid_section.find('input').prop('disabled', false);
                on_solid_section.show();
                set_solid_mode_style();
                break;
            case 'gradient':
                var on_gradient_section = $('.mihanwp_notification_bar_option_panel tr[on-gradient=on]');
                on_gradient_section.find('input').prop('disabled', false);
                on_gradient_section.show();
                set_gradient_mode_style();
                break;
            case 'image':
                var on_image_section = $('.mihanwp_notification_bar_option_panel tr[on-image=on]');
                on_image_section.find('input').prop('disabled', false);
                on_image_section.show();
                set_image_mode_style();
                break;
        }
    }
    end_date_input.datetimepicker({
        minDate: 0,
        inline: true,
        todayButton: false,
        onChangeDateTime: function () {
            end_date_input.trigger('input');
        }
    });

    var day_miliseconds = (24 * 60 * 60 * 1000),
        hours_miliseconds = (60 * 60 * 1000),
        minutes_miliseconds = (60 * 1000);
    
    end_date_input.on('input', function () {
        timer_wrapper.attr('data-end-date', this.value);
        run_count_down();
    })
    function render_timer_data(content)
    {
        var count_down_date = new Date(end_date_input.val()).getTime(),
            distance = parseInt(count_down_date) - parseInt(new Date().getTime());
        content = '<span id="timer_data_wrapper">' + content + '</span>';
        content = content.replace('{{d}}', function (match, contents, offset, input_string) {
            return '<span class="day">' + Math.floor(distance / day_miliseconds) + '</span>';
        });
        content = content.replace('{{h}}', function (match, contents, offset, input_string) {
            return '<span class="hour">' + Math.floor((distance % day_miliseconds) / hours_miliseconds) + '</span>';
        });
        content = content.replace('{{m}}', function (match, contents, offset, input_string) {
            return '<span class="minutes">' + Math.floor((distance % hours_miliseconds) / minutes_miliseconds) + '</span>';
        });
        content = content.replace('{{s}}', function (match, contents, offset, input_string) {
            return '<span class="seconds">' + Math.floor((distance % minutes_miliseconds) / 1000) + '</span>';
        });
        count_down_content_wrapper.html(content);
    }
    count_down_content_input.on('input', function () {
        render_timer_data(this.value);
    });
    count_down_content_input.on('blur', function () {
        run_count_down();
    });
    function run_count_down()
    {
        if (!has_count_down())
        {
            return;
        }
        if ((parseInt(new Date(timer_wrapper.attr('data-end-date')).getTime()) - parseInt(new Date().getTime())) <= 0)
        {
            timer_wrapper.html(timer_wrapper.data('expired_title'));
            return;
        }
        var day_wrapper = timer_wrapper.find('.day'),
            hour_wrapper = timer_wrapper.find('.hour'),
            minutes_wrapper = timer_wrapper.find('.minutes'),
            seconds_wrapper = timer_wrapper.find('.seconds');
        if (!preview_section.find("#timer_data_wrapper").length)
        {
            render_timer_data(count_down_content_input.val());
            run_count_down();
        }
        var mihanwp_notification_bar_timer = setInterval(() => {
            var countDownDate = new Date(timer_wrapper.attr('data-end-date')).getTime(),
                mihanwp_notification_bar_now = new Date().getTime(),
                distance = parseInt(countDownDate) - parseInt(mihanwp_notification_bar_now);
            if (distance <= 0)
            {
                clearInterval(mihanwp_notification_bar_timer);
                timer_wrapper.html(timer_wrapper.data('expired_title'));
                return;
            }
            var days = Math.floor(distance / day_miliseconds);
            var hours = Math.floor((distance % day_miliseconds) / hours_miliseconds)
            var minutes = Math.floor((distance % hours_miliseconds) / minutes_miliseconds);
            var seconds = Math.floor((distance % minutes_miliseconds) / 1000);
            day_wrapper.html(days);
            hour_wrapper.html(hours);
            minutes_wrapper.html(minutes);
            seconds_wrapper.html(seconds);
        }, 1000);
    }
    var media_uploader = '';
    $('.mihanwp_notification_bar_media').on('click', function (e) {
        e.preventDefault();
        if (media_uploader)
        {
            media_uploader.open();
        }
        media_uploader = wp.media({
            title: 'Select image',
            button: {
                'text' : 'Select'
            },
            multiple: false
        });
        media_uploader.on('select', function () {
            var attachment = media_uploader.state().get('selection').first().toJSON();
            bg_image_input.val(attachment.url);
            set_image_mode_style();
        });
        media_uploader.open();
    });
    run_count_down();
    handle_bg_mode();
});