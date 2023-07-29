jQuery(document).ready(function ($) {
    var mihanwp_notification_barbox = $('.mihanwp_notification_bar_box_wrapper'),
        timer_wrapper = $('.mihanwp_notification_bar_box_wrapper .mihanwp_notification_bar_timer'),
        day_wrapper = timer_wrapper.find('.day');
    if (mihanwp_notification_barbox.attr('mihanwp_notification_bar_move')) {
        mihanwp_notification_barbox.prependTo('body');
    }
    $('.mihanwp_notification_bar_close').on('click', function () {
        mihanwp_notification_barbox.addClass('mihanwp_notification_bar_hide');
        var expiration_value = timer_wrapper.data('end-date'),
            expiration_date = new Date(expiration_value).toUTCString();
        document.cookie = 'mw_mihanwp_notification_bar_id=' + mihanwp_notification_barbox.attr('mihanwp_notification_bar_id') + ';expires=' + expiration_date;
        setTimeout(() => {
            mihanwp_notification_barbox.hide();
        }, 800);
    });
    if (!day_wrapper.length)
    {
        return;
    }
    var hour_wrapper = timer_wrapper.find('.hour'),
        minute_wrapper = timer_wrapper.find('.minutes'),
        second_wrapper = timer_wrapper.find('.seconds');
    var end_date = timer_wrapper.data('end-date'),
        countDownDate = new Date(end_date).getTime();
    
    
    var day_miliseconds = (24 * 60 * 60 * 1000),
        hours_miliseconds = (60 * 60 * 1000),
        minutes_miliseconds = (60 * 1000);
    

    var mihanwp_notification_bar_timer = setInterval(() => {
        var mihanwp_notification_bar_now = new Date().getTime();
        var distance = parseInt(countDownDate) - parseInt(mihanwp_notification_bar_now);
        var days = Math.floor(distance / day_miliseconds);
        var hours = Math.floor((distance % day_miliseconds) / hours_miliseconds);
        var minutes = Math.floor((distance % hours_miliseconds) / minutes_miliseconds);
        var seconds = Math.floor((distance % minutes_miliseconds) / 1000);
        day_wrapper.html(days);
        hour_wrapper.html(hours);
        minute_wrapper.html(minutes);
        second_wrapper.html(seconds);
        if (distance <= 0)
        {
            clearInterval(mihanwp_notification_bar_timer);
            timer_wrapper.html(timer_wrapper.data('expired_title'));
        }
    }, 1000);
});