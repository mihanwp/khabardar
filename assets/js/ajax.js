jQuery(document).ready(function ($){
    let body = $('body');

    body.on('click', '.mwn-change-status', function (e){
       e.preventDefault();
       let btn = $(this),
           box = btn.parent(),
           statusLabel = box.find('.mwn-status span');

        $.ajax({
            url: mwn_data.ajax_url,
            data: {
                action: 'mwn_change_notification_status',
                nonce: mwn_data.nonce
            },
            type: 'POST',
            dataType: 'json',
            beforeSend: function (){
                btn.addClass('has-loading');
            },
            complete: function (res){
                btn.removeClass('has-loading');
                if(res){
                    res = res.responseJSON;
                    if(res.success) {
                        let newStatus = res.data.status;
                        if (newStatus === 'active') {
                            box.removeClass('inactive').addClass('active');
                        } else if (newStatus === 'inactive') {
                            box.removeClass('active').addClass('inactive');
                        }
                        statusLabel.text(res.data.status_label);
                    }
                }
            },
            error: function (){
                btn.removeClass('has-loading');
            }
        });
    });

    body.on('submit', '#mwn-notification-builder-form', function (e){
        e.preventDefault();
        let form = $(this),
            optionsWrap = form.find('.mwn-notification-bar-options'),
            formData = form.serialize(),
            style = StyleGenerator.generate();

        $.ajax({
            url: mwn_data.ajax_url,
            data: 'action=mwn_save_notification_data&' + formData + '&styles='+ style +'&nonce=' + mwn_data.nonce,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (){
                optionsWrap.addClass('has-loading');
            },
            complete: function (res){
                if(res){
                    res = res.responseJSON;
                    if(res.success){
                        location.reload();
                    } else {
                        optionsWrap.removeClass('has-loading');
                    }
                } else {
                    optionsWrap.removeClass('has-loading');
                }
            },
            error: function (){
                optionsWrap.removeClass('has-loading');
            }
        });
    })
});