jQuery(document).ready(function ($){
    let body = $('body');

    body.on('mousemove', '.range-slider-wrap input[type=range]', function (e){
        let input = $(this),
            rangeVal = input.val();
        input.parent().find('.range-value input').val(rangeVal);
    });

    body.on('input', '.range-slider-wrap .range-value input', function (e){
        let input = $(this),
            inputVal = input.val();
        input.parent().parent().find('input[type=range]').val(inputVal);
    });

    body.on('change input', '.range-slider-wrap select', function (e){
        let input = $(this),
            wrap = input.parent().parent(),
            rangeEl = wrap.find('input[type=range]'),
            min = rangeEl.attr('min'),
            max = rangeEl.attr('max'),
            inputVal = input.val();

        if(!rangeEl.data('min') && min) rangeEl.data('min', min);
        if(!rangeEl.data('max') && max) rangeEl.data('max', max);

        if(inputVal === '%'){
            rangeEl.attr('min', 0);
            rangeEl.attr('max', 100);
        } else {
            if(rangeEl.data('min')){
                rangeEl.attr('min', rangeEl.data('min'));
            }
            if(rangeEl.data('max')){
                rangeEl.attr('max', rangeEl.data('max'));
            }
        }
    });

    body.on('change', '.background-control-item .background-type', function (e){
        let input = $(this),
            wrap = input.parent(),
            inputVal = input.val();

        wrap.find('.mwn-bg-control-option:not(.all)').slideUp();
        wrap.find(`.${inputVal}-options`).slideDown();
    });

    body.on('change input', '.mwn-style-options-list input, .mwn-style-options-list select', function (e){
        let input = $(this);
        StyleGenerator.appendToHead(StyleGenerator.generate());
    });

    body.on('click', '.inputs-linked-value', function (e){
        e.preventDefault();
        let btn = $(this);
        btn.toggleClass('is-linked');
    });

    body.on('change input', '.dimensions-wrap input', function (e){
        e.preventDefault();
        let input = $(this),
            isLinked = input.parent().find('.is-linked');
        if(isLinked.length){
            input.parent().find('input').val(input.val());
        }
    });
});

/**
 *
 *
 * Style generator
 *
 *
 */
class StyleGenerator {
    static replacement(search, replace, string){
        return string.replaceAll(search, replace);
    }

    static appendToHead(style){
        let head = jQuery('head'),
            styleEl = head.find('#mwn-custom-notification-style');
        if(styleEl.length){
            styleEl.text(style);
        } else {
            head.append(`<style id="mwn-custom-notification-style">${style}</style>`);
        }
    }

    static generate(){
        let items = jQuery(document).find('.mwn-style-control'),
            style = '';
        if(!items.length) return false;

        items.each(function (k, i){
            let item = jQuery(i),
                type = item.data('type'),
                selectors = item.data('selectors-json');
            if(selectors && typeof selectors !== 'undefined'){
                if(type === 'range'){
                    let unit = item.find('select[name*="_unit"]').val(),
                        value = item.find('input[type=range]').val();
                    jQuery.each(selectors, function (k, v){
                        value = StyleGenerator.replacement('{{VALUE}}', value, v);
                        value = StyleGenerator.replacement('{{UNIT}}', unit, value);
                        style += k + '{' + value + ';}';
                    });
                } else if(type === 'color'){
                    let value = item.find('input').val();
                    if(value){
                        jQuery.each(selectors, function (k, v){
                            value = StyleGenerator.replacement('{{VALUE}}', value, v);
                            style += k + '{' + value + ';}';
                        });
                    }
                } else if(type === 'background'){
                    let bgType = item.find('.background-type').val(),
                        bgColor = item.find('input[name*="_color"]').val(),
                        bgColor2 = item.find('input[name*="_color2"]').val(),
                        bgDir = item.find('input[name*="_direction"]').val(),
                        dirUnit = item.find('select[name*="_direction_unit"]').val(),
                        bgImage = item.find('input[name*="_image"]').val(),
                        bgRepeat = item.find('select[name*="_repeat"]').val(),
                        bgPosition = item.find('select[name*="_position"]').val(),
                        bgSize = item.find('select[name*="_size"]').val();

                    jQuery.each(selectors, function (k, selector){
                        if(bgType === 'simple'){
                            if(bgColor){
                                style += selector + '{background-color:' + bgColor + ';}';
                            }
                        } else if(bgType === 'gradient'){
                            if(bgColor && bgColor2 && bgDir && dirUnit){
                                style += selector + '{background:' + bgColor + ';background: linear-gradient(' + bgDir + dirUnit + ', ' + bgColor + ' 0%, ' + bgColor2 + ' 100%);}';
                            }
                        } else if(bgType === 'image'){
                            if(bgImage){
                                bgPosition = !bgPosition ? 'center center' : bgPosition;
                                style += selector + '{background:' + bgColor + ' url(' + bgImage + ') ' + bgRepeat + ' ' + bgPosition + ';background-size:' + bgSize + '}';
                            }
                        }
                    });
                } else if(type === 'dimensions'){
                    let unit = item.find('select[name*="_unit"]').val() || 0,
                        top = item.find('input[name*="_top"]').val() || 0,
                        right = item.find('input[name*="_right"]').val() || 0,
                        bottom = item.find('input[name*="_bottom"]').val() || 0,
                        left = item.find('input[name*="_left"]').val() || 0;
                    jQuery.each(selectors, function (k, v){
                        let str = k + '{' + v + ';}';
                        str = StyleGenerator.replacement('{{UNIT}}', unit, str);
                        str = StyleGenerator.replacement('{{TOP}}', top, str);
                        str = StyleGenerator.replacement('{{RIGHT}}', right, str);
                        str = StyleGenerator.replacement('{{BOTTOM}}', bottom, str);
                        str = StyleGenerator.replacement('{{LEFT}}', left, str);
                        style += str;
                    });
                }
            }
        });

        return style;
    }
}

StyleGenerator.appendToHead(StyleGenerator.generate());