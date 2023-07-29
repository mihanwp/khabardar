jQuery(document).ready(function ($) {
    let body = $('body'),
        notificationEl = body.find('.mwn-notification-bar-body');

    if(notificationEl.length){
        body.prepend(notificationEl);
        notificationEl.slideDown();

        body.on('click', '.mwn-notification-bar-body .close-bar', function (e){
           e.preventDefault();
           let btn = $(this);
           btn.closest('.mwn-notification-bar-body').slideUp(function (){
               $(this).remove();
           });
        });
    }
});