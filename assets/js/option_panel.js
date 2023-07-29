jQuery(document).ready(function ($) {
    let body = $('body');

    body.on('click', '.mwn-tabs .mwn-toggle-tab', function (e){
        e.preventDefault();
        let btn = $(this),
            targetEl = $(btn.data('target'));

        btn.parent().find('.mwn-toggle-tab').removeClass('is-active');
        btn.addClass('is-active');

        $('.mwn-tab-content').removeClass('is-active').hide();
        targetEl.addClass('is-active').show();
    });

    body.on('change', '.mwn-checkbox', function (e){
        let input = $(this),
            affectedEl = $(input.data('affected')),
            isChecked = input.is(':checked');

        if(affectedEl.length){
            if (isChecked){
                affectedEl.show();
            } else {
                affectedEl.hide();
            }
        }
    });

    body.on('change input', '.mwn-notification-bar-options input, .mwn-notification-bar-options select, .mwn-notification-bar-options textarea', function (e){
        let input = $(this),
            saveButton = $('.mwn-save');

        if(saveButton.attr('disabled')){
            saveButton.attr('disabled', false);
        }
    });

    body.on('change', '.mwn-radio-items input', function (e){
        let input = $(this),
            inputVal = input.val(),
            wrap = input.closest('.mwn-radio-control-section'),
            relation = wrap.find('.radio-relation-items');

        if(relation.length){
            relation.find('.radio-rel').slideUp();
            relation.find('.radio-rel-' + inputVal).slideDown();
        }
    });

    body.on('input change', '[data-preview-to]', function (e){
        let input = $(this),
            inputVal = input.val(),
            previewData = input.data('preview-to');

        if(previewData.indexOf('/') !== -1){
            let selectors = previewData.split('/'),
                target = $(selectors[0]),
                targetAttr = selectors[1];
            if(target.length){
                if(targetAttr.indexOf('data-') !== -1){
                    target.data(targetAttr.replace('data-', ''), inputVal);
                } else {
                    target.attr(targetAttr, inputVal);
                }
            }
        } else {
            let target = $(previewData);
            target.text(inputVal);
        }
    });

    body.on('input change', '[data-affected-by-value]', function (e){
        let input = $(this),
            inputVal = input.val(),
            targets = $(input.data('affected-by-value')),
            target = $(input.data('affected-by-value') + '-' + inputVal);

        if(targets.length){
            targets.hide();
            target.show();
        }
    });

    body.on('change', '[data-affetced-by-inner-input-value]', function (e){
        let input = $(this),
            inputVal = input.val(),
            wrap = input.closest('.mwn-field-section'),
            inputTypeEl = wrap.find(input.data('input-type')),
            baseTargets = $(input.data('affetced-base-targets')),
            targets = $((input.data('affetced-targets')).replaceAll('{{VALUE}}', inputTypeEl.val()));

        if(baseTargets.length && targets.length){
            if(input.prop('checked')){
                baseTargets.hide();
                targets.show();
            } else {
                baseTargets.hide();
            }
        }
    });

    body.on('change input', '.countdown-input', function (e){
        let input = $(this),
            countdownType = parseInt($('.countdown-type').val()),
            inputVal = input.val(),
            el2 = $('.mwn-notification-bar-content .countdown-style-type-2');

        if(inputVal){
            body.find('.end-time-content').hide();

            if(countdownType === 1){
                CountdownGenerator.generateFlipCountDown(inputVal);
            } else if(countdownType === 2) {
                el2.data('time', inputVal);
                CountdownGenerator.generateTextCountdown(new Date(inputVal), el2.text());
            }
        }
    });

    body.on('change', '.countdown-type', function (e){
        CountdownGenerator.run();
    });

    body.on('change', 'input[data-unchecked]', function (e){
        e.preventDefault();
        let input = $(this),
            target = $(`input[name*="${input.data('unchecked')}"]`);

        if(input.prop('checked') && target.length){
            target.prop('checked', false).trigger('change');
        }
    });

    body.on('click', '.notification-countdown-codes span', function (e){
        let btn = $(this),
            text = btn.data('text'),
            textarea = btn.parent().parent().find('textarea');

        if(btn.hasClass('default-text')){
            textarea.val(text).trigger('change');
        } else {
            textarea.val(textarea.val() + ' ' + text).trigger('change');
        }
    });

    body.on('click', '.mwn-responsive-options a.mwn-to-top', function (e){
        e.preventDefault();
        let btn = $(this),
            nofitication = $('.mwn-notification-bar-body');

        btn.toggleClass('active');

        if(btn.hasClass('active')){
            nofitication.addClass('is-top');
            $('body').prepend(nofitication);
        } else {
            nofitication.removeClass('is-top');
            $('.mwn-notification-bar-container').append(nofitication);
        }
    });

    if(window.innerWidth > 1400){
        const mwnSidebar = new StickySidebar('.mwn-notification-bar-container', {
            containerSelector: '.mwn-notification-bar-wrap',
            innerWrapperSelector: '.mwn-notification-bar-container .mwn-notification-bar-box',
            topSpacing: 40,
            bottomSpacing: 20
        });
    }

    $('.mw_color_picker').wpColorPicker({
        change: function (e, ui) {
            $(e.target).val(ui.color.toString());
            $(e.target).trigger('change');
        }
    });

    body.on("click", ".mwn-upload-button", function (e) {
        e.preventDefault();
        let fieldEl = $(this).data('field'),
            field = fieldEl ? $(fieldEl) : $(this).parent().find('input');

        let custom_uploader = wp.media({
            title: 'Upload file',
            button: {
                text: 'Select file'
            },
            multiple: false
        }).on('select', function () {
            let attachment = custom_uploader.state().get('selection').first().toJSON();
            field.val(attachment.url).trigger('change');
        }).open();
    });

    $('.mwn-select').select2({
        minimumInputLength: 2,
        width: '100%'
    });
});
