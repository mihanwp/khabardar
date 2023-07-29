class CountdownGenerator {
    static inter;

    static handleTickInit(tick) {
        let locale = {
            YEAR_PLURAL: mwn_data.text.year,
            YEAR_SINGULAR: mwn_data.text.year,
            MONTH_PLURAL: mwn_data.text.month,
            MONTH_SINGULAR: mwn_data.text.month,
            WEEK_PLURAL: mwn_data.text.week,
            WEEK_SINGULAR: mwn_data.text.week,
            DAY_PLURAL: mwn_data.text.day,
            DAY_SINGULAR: mwn_data.text.day,
            HOUR_PLURAL: mwn_data.text.hour,
            HOUR_SINGULAR: mwn_data.text.hour,
            MINUTE_PLURAL: mwn_data.text.minute,
            MINUTE_SINGULAR: mwn_data.text.minute,
            SECOND_PLURAL: mwn_data.text.seconds,
            SECOND_SINGULAR: mwn_data.text.seconds,
            MILLISECOND_PLURAL: mwn_data.text.mseconds,
            MILLISECOND_SINGULAR: mwn_data.text.mseconds
        };

        for (let key in locale) {
            if (!locale.hasOwnProperty(key)) { continue; }
            tick.setConstant(key, locale[key]);
        }

        let counter = Tick.count.down(tick._element.dataset.time);

        counter.onupdate = function(value) {
            tick.value = value;
        };

        counter.onended = function (){
            let tickEl = jQuery(tick._element),
                endEl = tickEl.parent().parent().find('.end-time-content');
            if(jQuery('.countdown-style-type-1').is(':visible')){
                endEl.show();
                tickEl.remove();
            }
        };
    }

    static generateFlipCountDown(datetime, view = 'flip'){
        if(jQuery('.countdown-style-type-1').length){
            jQuery(document).find('.end-time-content').hide();
            let viewContent = `<div data-repeat="true" data-layout="horizontal fit" data-transform="preset(d, h, m, s) -> delay"> <div class="tick-group"> <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay"> <span data-view="flip"></span> </div> <span data-key="label" data-view="text" class="tick-label"></span> </div> </div>`;
            if(view === 'text'){
                viewContent = '<span data-view="text"></span>';
            }
            let tickEl = `<div class="tick-countdown" data-time="${datetime}">${viewContent}</div>`;
            jQuery(tickEl).appendTo('.notification-countdown');
            let oldTick = Tick.DOM.find(document.querySelector('.tick-countdown'));
            if(oldTick){
                oldTick.destroy();
            }
            let tick = Tick.DOM.create(document.querySelector('.tick-countdown'));
            this.handleTickInit(tick);
        }
    }

    static generateTextCountdown(date, text) {
        let textEl1 = jQuery('.mwn-notification-bar-content .countdown-style-type-1'),
            textEl = jQuery('.mwn-notification-bar-content .countdown-style-type-2');

        if(!textEl1.is(':visible') && !textEl.is(':visible')){
            jQuery('.end-time-content').hide();
            return false;
        }

        if(!textEl.data('text')){
            textEl.data('text', text);
        }
        textEl.empty();

        if(!textEl1.is(':visible')){
            console.log(111)
            textEl.show();
        }

        if(typeof this.inter !== 'undefined' || !textEl.is(':visible')){
            console.log(222)
            clearInterval(this.inter);
        }

        this.inter = setInterval(function (){
            console.log(333)
            let now = new Date();
            let timeDifference = date - now;

            if(!textEl.is(':visible') && textEl.css('display') === 'none'){
                jQuery('.end-time-content').hide();
                clearInterval(CountdownGenerator.inter);
                return false;
            }

            if (timeDifference <= 0) {
                textEl.hide();
                jQuery('.end-time-content').show();
                return;
            }

            let days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            let hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            let baseText = textEl.data('text');
            let countdownText = baseText.replace('{{d}}', days);
            countdownText = countdownText.replace('{{h}}', hours);
            countdownText = countdownText.replace('{{m}}', minutes);
            countdownText = countdownText.replace('{{s}}', seconds);

            textEl.text(countdownText);
        }, 1000);
    }

    static run(){
        let datetime = jQuery('.notification-countdown').data('time') || 0;

        if(datetime){
            jQuery('.end-time-content').hide();

            CountdownGenerator.generateFlipCountDown(datetime);

            CountdownGenerator.generateTextCountdown(new Date(datetime), jQuery('.mwn-notification-bar-content .countdown-style-type-2').text());
        }
    }
}

CountdownGenerator.run();