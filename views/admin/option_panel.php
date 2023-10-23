<?php
use mwn\app\NotificationOptions;
use mwn\app\OptionsControl;
$notification_status = NotificationOptions::get_notification_status();
?>
<div class="wrap">
    <h2><?php _e('MihanWP Notification Bar', 'mihanwp-notification-bar'); ?></h2>
    <form action="/" id="mwn-notification-builder-form">
        <div class="mwn-notification-bar-wrap">
            <div class="mwn-notification-bar-options">
                <div class="mwn-responsive-options">
                    <a href="#" class="mwn-to-top"><i class="dashicons dashicons-arrow-up-alt"></i><?php _e('Test Notification In Top', MWNB_TEXT_DOMAIN) ?></a>
                </div>
                <div class="mwn-tabs">
                    <a href="#" class="mwn-toggle-tab is-active" data-target="#mwn-content-tab"><?php _e('Content', MWNB_TEXT_DOMAIN) ?></a>
                    <a href="#" class="mwn-toggle-tab" data-target="#mwn-style-tab"><?php _e('Style', MWNB_TEXT_DOMAIN) ?></a>
                </div>
                <div class="mwn-tabs-content">
                    <!--------------------------- Content Tab ------------------------------->
                    <div class="mwn-tab-content is-active" id="mwn-content-tab">
                        <div class="mwn-notification-status <?php echo $notification_status !== 'active' ? 'inactive' : esc_attr($notification_status) ?>">
                            <div class="mwn-status"><?php echo sprintf('%s<span>%s</span>', __('Status', MWNB_TEXT_DOMAIN), ($notification_status === 'active' ? __('Active', MWNB_TEXT_DOMAIN) : __('Inactive', MWNB_TEXT_DOMAIN))) ?></div>
                            <span class="mwn-change-status"><i class="dashicons dashicons-update"></i></span>
                        </div>
                        <div class="mwn-options-list">
                            <div class="mwn-field-wrap">
                                <label for="notification_content"><?php _e('Text', MWNB_TEXT_DOMAIN) ?></label>
                                <textarea name="notification_content" id="notification_content" data-preview-to=".notification-text"><?php echo NotificationOptions::get_notification_content(); ?></textarea>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Show Button', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_status',
                                    'is_checked' => NotificationOptions::get_button_status(),
                                    'input_atts' => [
                                        'data-affected' => '.button-options,.notification-btn',
                                    ]
                                ]);
                                ?>
                                <div class="button-options" style="display:<?php echo NotificationOptions::get_button_status() ? 'block' : 'none' ?>">
                                    <div class="mwn-field-wrap">
                                        <label for="notification_button_text"><?php _e('Button Title', MWNB_TEXT_DOMAIN) ?></label>
                                        <input type="text" name="notification_button_text" id="notification_button_text" data-preview-to=".notification-btn" value="<?php echo NotificationOptions::get_button_text() ?>">
                                    </div>
                                    <div class="mwn-field-wrap">
                                        <label for="notification_button_link"><?php _e('Button Link', MWNB_TEXT_DOMAIN) ?></label>
                                        <input type="text" name="notification_button_link" dir="ltr" id="notification_button_link" data-preview-to=".notification-btn/href" value="<?php echo NotificationOptions::get_button_link() ?>">
                                    </div>
                                    <?php
                                    OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                        'label' => __('Open link to new tab', MWNB_TEXT_DOMAIN),
                                        'name' => 'notification_button_target_blank',
                                        'is_checked' => NotificationOptions::get_button_target_blank_status(),
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Countdown Timer', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_countdown_status',
                                    'is_checked' => NotificationOptions::get_countdown_status(),
                                    'input_atts' => [
                                        'data-affected' => '.countdown-options',
                                        'data-affetced-by-inner-input-value' => true,
                                        'data-input-type' => 'select',
                                        'data-affetced-base-targets' => '.notification-countdown.countdown-style-type',
                                        'data-affetced-targets' => '.notification-countdown.countdown-style-type-{{VALUE}}'
                                    ]
                                ]);
                                ?>
                                <div class="countdown-options" style="display:<?php echo NotificationOptions::get_countdown_status() ? 'block' : 'none' ?>;">
                                    <div class="mwn-field-wrap">
                                        <?php
                                        $countdown_type = NotificationOptions::get_countdown_type();
                                        OptionsControl::renderControl(OptionsControl::SELECT,[
                                            'label' => __('Style', MWNB_TEXT_DOMAIN),
                                            'name' => 'notification_countdown_style_type',
                                            'selected' => $countdown_type,
                                            'options' => [
                                                1 => __('Style 1', MWNB_TEXT_DOMAIN),
                                                2 => __('Style 2', MWNB_TEXT_DOMAIN)
                                            ],
                                            'class' => 'countdown-type',
                                            'input_atts' => [
                                                'data-affected-by-value' => '.countdown-style-type'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="countdown-style-type countdown-style-type-1 countdown-style-type-2">
                                        <div class="mwn-field-wrap">
                                            <label for="notification_countdown_datetime"><?php _e('Countdown Datetime', MWNB_TEXT_DOMAIN) ?></label>
                                            <input type="datetime-local" name="notification_countdown_datetime" id="notification_countdown_datetime" class="countdown-input" value="<?php echo NotificationOptions::get_countdown_datetime() ?>">
                                        </div>
                                        <div class="mwn-field-wrap">
                                            <label for="notification_countdown_end_text"><?php _e('Countdown End Text', MWNB_TEXT_DOMAIN) ?></label>
                                            <input type="text" name="notification_countdown_end_text" id="notification_countdown_end_text" data-preview-to=".end-time-content" value="<?php echo NotificationOptions::get_countdown_end_text() ?>">
                                        </div>
                                    </div>
                                    <div class="countdown-style-type countdown-style-type-1" style="display:<?php echo $countdown_type === 1 ? 'block' : 'none' ?>;">
                                        <div class="mwn-field-wrap">
                                            <label><?php _e('Labels', MWNB_TEXT_DOMAIN) ?></label>
                                            <div class="mwn-fields-group-4">
                                                <input type="text" name="countdown_days_label" id="countdown_days_label" data-preview-to=".tick-countdown > div > div:nth-child(1) .tick-label" placeholder="<?php echo __('Days', MWNB_TEXT_DOMAIN) ?>" value="<?php echo NotificationOptions::get_countdown_days_label() ?>">
                                                <input type="text" name="countdown_hours_label" id="countdown_hours_label" data-preview-to=".tick-countdown > div > div:nth-child(2) .tick-label" placeholder="<?php echo __('Hours', MWNB_TEXT_DOMAIN) ?>" value="<?php echo NotificationOptions::get_countdown_hours_label() ?>">
                                                <input type="text" name="countdown_minutes_label" id="countdown_minutes_label" data-preview-to=".tick-countdown > div > div:nth-child(3) .tick-label" placeholder="<?php echo __('Minutes', MWNB_TEXT_DOMAIN) ?>" value="<?php echo NotificationOptions::get_countdown_minutes_label() ?>">
                                                <input type="text" name="countdown_seconds_label" id="countdown_seconds_label" data-preview-to=".tick-countdown > div > div:nth-child(4) .tick-label" placeholder="<?php echo __('Seconds', MWNB_TEXT_DOMAIN) ?>" value="<?php echo NotificationOptions::get_countdown_seconds_label() ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="countdown-style-type countdown-style-type-2" style="display:<?php echo $countdown_type === 2 ? 'block' : 'none' ?>;">
                                        <div class="mwn-field-wrap">
                                            <label for="notification_countdown_content"><?php _e('Countdown Timer Text', MWNB_TEXT_DOMAIN) ?></label>
                                            <textarea name="notification_countdown_content" id="notification_countdown_content" data-preview-to=".notification-countdown.countdown-style-type-2/data-text"><?php echo NotificationOptions::get_countdown_content() ?></textarea>
                                            <div class="notification-countdown-codes">
                                                <span class="default-text" data-text="<?php echo sprintf(__('%s Day %s Hour %s Minutes %s Seconds!', MWNB_TEXT_DOMAIN), '{{d}}', '{{h}}', '{{m}}', '{{s}}') ?>"><?php _e('Default', MWNB_TEXT_DOMAIN) ?></span>
                                                <span data-text="{{d}}"><?php _e('Days', MWNB_TEXT_DOMAIN) ?></span>
                                                <span data-text="{{h}}"><?php _e('Hour', MWNB_TEXT_DOMAIN) ?></span>
                                                <span data-text="{{m}}"><?php _e('Minutes', MWNB_TEXT_DOMAIN) ?></span>
                                                <span data-text="{{s}}"><?php _e('Seconds', MWNB_TEXT_DOMAIN) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Only Logged In User', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_only_logged_in_user',
                                    'is_checked' => NotificationOptions::only_logged_in_user(),
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                $only_woo_customer_status = NotificationOptions::only_woo_products_customer_status();
                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Woo Customer Products', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_only_woo_products_customer',
                                    'is_checked' => $only_woo_customer_status,
                                    'disabled' => !\mwn\app\Utility::isActiveWoo(),
                                    'description' => __('Only shown to buyers of selected woocommerce products.', MWNB_TEXT_DOMAIN),
                                    'input_atts' => [
                                        'data-affected' => '.woo-customers-options',
                                    ]
                                ]);
                                ?>
                                <?php if(\mwn\app\Utility::isActiveWoo()): ?>
                                    <div class="woo-customers-options" style="display:<?php echo $only_woo_customer_status ? 'block' : 'none' ?>">
                                        <?php
                                        OptionsControl::renderControl(OptionsControl::SELECT,[
                                            'label' => __('Products', MWNB_TEXT_DOMAIN),
                                            'name' => 'woo_products[]',
                                            'id' => 'woo_products',
                                            'selected' => NotificationOptions::get_woo_products(),
                                            'options' => \mwn\app\Utility::getPostTypesItems('product'),
                                            'class' => 'mwn-select',
                                            'multiple' => true
                                        ]);
                                        ?>
                                    </div>
                                <?php else: ?>
                                    <div class="error-box"><?php _e('Woocommerce is not active.', MWNB_TEXT_DOMAIN) ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                $has_include_pages = NotificationOptions::get_include_pages_status();
                                $include_page_type = NotificationOptions::get_include_pages_type();

                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Show in Special Pages', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_include_pages_status',
                                    'is_checked' => $has_include_pages,
                                    'input_atts' => [
                                        'data-unchecked' => 'notification_exclude_pages_status',
                                        'data-affected' => '.include-pages-options',
                                    ]
                                ]);
                                ?>
                                <div class="include-pages-options mwn-radio-control-section" style="display:<?php echo $has_include_pages ? 'block' : 'none' ?>;">
                                    <div class="mwn-field-wrap mwn-radio-wrap">
                                        <div class="mwn-radio-items">
                                            <label>
                                                <input type="radio" name="notification_include_pages_type" value="id" <?php echo $include_page_type === 'id' ? 'checked' : '' ?>>
                                                <span><?php _e('Select Page', MWNB_TEXT_DOMAIN) ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="notification_include_pages_type" value="url" <?php echo $include_page_type === 'url' ? 'checked' : '' ?>>
                                                <span><?php _e('Page Url', MWNB_TEXT_DOMAIN) ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio-relation-items">
                                        <div class="radio-rel radio-rel-id" style="display:<?php echo $include_page_type === 'id' ? 'block' : 'none'?>;">
                                            <?php
                                            $posts = \mwn\app\Utility::getPostTypesItems();
                                            $options = [];
                                            if ($posts){
                                                foreach($posts as $key => $value){
                                                    foreach($value as $post){
                                                        $options[$post->ID] = $post->post_title;
                                                    }
                                                }
                                            }
                                            OptionsControl::renderControl(OptionsControl::SELECT,[
                                                'name' => 'notification_include_pages_id[]',
                                                'id' => 'notification_include_pages_id',
                                                'selected' => NotificationOptions::get_include_pages_id(),
                                                'options' => $options,
                                                'class' => 'mwn-select',
                                                'multiple' => true
                                            ]);
                                            ?>
                                        </div>
                                        <div class="radio-rel radio-rel-url" style="display:<?php echo $include_page_type === 'url' ? 'block' : 'none'?>">
                                            <textarea name="notification_include_pages_url" id="notification_include_pages_url" dir="ltr"><?php echo NotificationOptions::get_include_pages_url() ?></textarea>
                                            <p class="description"><?php _e('Separate the addresses of the pages with an enter (each address on one line).', MWNB_TEXT_DOMAIN) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mwn-field-section">
                                <?php
                                $has_exclude_pages = NotificationOptions::get_exclude_pages_status();
                                $exclude_page_type = NotificationOptions::get_exclude_pages_type();

                                OptionsControl::renderControl(OptionsControl::CHECKBOX, [
                                    'label' => __('Hide in Special Pages', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_exclude_pages_status',
                                    'is_checked' => $has_exclude_pages,
                                    'input_atts' => [
                                        'data-unchecked' => 'notification_include_pages_status',
                                        'data-affected' => '.exclude-pages-options',
                                    ]
                                ]);
                                ?>
                                <div class="exclude-pages-options mwn-radio-control-section" style="display:<?php echo $has_exclude_pages ? 'block' : 'none' ?>;">
                                    <div class="mwn-field-wrap mwn-radio-wrap">
                                        <div class="mwn-radio-items">
                                            <label>
                                                <input type="radio" name="notification_exclude_pages_type" value="id" <?php echo $exclude_page_type === 'id' ? 'checked' : '' ?>>
                                                <span><?php _e('Select Page', MWNB_TEXT_DOMAIN) ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="notification_exclude_pages_type" value="url" <?php echo $exclude_page_type === 'url' ? 'checked' : '' ?>>
                                                <span><?php _e('Page Url', MWNB_TEXT_DOMAIN) ?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="radio-relation-items">
                                        <div class="radio-rel radio-rel-id" style="display:<?php echo $exclude_page_type === 'id' ? 'block' : 'none' ?>">
                                            <?php
                                            $posts = \mwn\app\Utility::getPostTypesItems();
                                            $options = [];
                                            if ($posts){
                                                foreach($posts as $key => $value){
                                                    foreach($value as $post){
                                                        $options[$post->ID] = $post->post_title;
                                                    }
                                                }
                                            }
                                            OptionsControl::renderControl(OptionsControl::SELECT,[
                                                'name' => 'notification_exclude_pages_id[]',
                                                'id' => 'notification_exclude_pages_id',
                                                'selected' => NotificationOptions::get_exclude_pages_id(),
                                                'options' => $options,
                                                'class' => 'mwn-select',
                                                'multiple' => true
                                            ]);
                                            ?>
                                        </div>
                                        <div class="radio-rel radio-rel-url" style="display:<?php echo $exclude_page_type === 'url' ? 'block' : 'none' ?>">
                                            <textarea name="notification_exclude_pages_url" id="notification_exclude_pages_url" dir="ltr"><?php echo NotificationOptions::get_exclude_pages_url() ?></textarea>
                                            <p class="description"><?php _e('Separate the addresses of the pages with an enter (each address on one line).', MWNB_TEXT_DOMAIN) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------- / END Content Tab ------------------------------->

                    <!--------------------------- Style Tab ------------------------------->
                    <div class="mwn-tab-content" id="mwn-style-tab" style="display:none;">
                        <div class="mwn-style-options-list">
                            <div class="mwn-field-wrap">
                                <?php OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Box Width', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_width',
                                    'min' => 80,
                                    'max' => 1280,
                                    'units' => ['%', 'px'],
                                    'current_unit' => NotificationOptions::getOption('notification_width_unit', '%'),
                                    'value' => NotificationOptions::getOption('notification_width', 100),
                                    'selectors' => [
                                        '.mwn-notification-bar-content' => 'width: {{VALUE}}{{UNIT}}'
                                    ]
                                ]); ?>
                            </div>
                            <div class="mwn-field-wrap">
                                <?php
                                OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Box Height', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_height',
                                    'min' => 45,
                                    'max' => 300,
                                    'units' => ['px'],
                                    'current_unit' => NotificationOptions::getOption('notification_height_unit', 'px'),
                                    'value' => NotificationOptions::getOption('notification_height', 45),
                                    'selectors' => [
                                        '.mwn-notification-bar-content' => 'height: {{VALUE}}{{UNIT}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-wrap">
                                <?php
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Text Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_text_color',
                                    'value' => NotificationOptions::getOption('notification_text_color', '#ffffff'),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .mwn-notification-bar-text' => 'color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::BACKGROUND_GROUP,[
                                    'label' => __('Background', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_bg',
                                    'selectors' => [
                                        '.mwn-notification-bar-box'
                                    ],
                                    'values' => [
                                        'type' => NotificationOptions::getOption('notification_bg_type', 'simple'),
                                        'color' => NotificationOptions::getOption('notification_bg_color', '#4f00d7'),
                                        'color2' => NotificationOptions::getOption('notification_bg_color2', '#a200d7'),
                                        'direction' => NotificationOptions::getOption('notification_bg_direction'),
                                        'image' => NotificationOptions::getOption('notification_bg_image'),
                                        'repeat' => NotificationOptions::getOption('notification_bg_repeat', 'no-repeat'),
                                        'size' => NotificationOptions::getOption('notification_bg_size', 'cover'),
                                        'position' => NotificationOptions::getOption('notification_bg_position', 'center center'),
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-wrap button-options" style="display:<?php echo NotificationOptions::get_button_status() ? 'block' : 'none' ?>">
                                <?php
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Button Text Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_text_color',
                                    'value' => NotificationOptions::getOption('notification_button_text_color', '#000000'),
                                    'selectors' => [
                                        '.notification-buttons a' => 'color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Button Background Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_bg_color',
                                    'value' => NotificationOptions::getOption('notification_button_bg_color', '#ffffff'),
                                    'selectors' => [
                                        '.notification-buttons a' => 'background-color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Button Border Radius', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_border_radius',
                                    'min' => 0,
                                    'max' => 300,
                                    'current_unit' => NotificationOptions::getOption('notification_button_border_radius_unit', 'px'),
                                    'value' => NotificationOptions::getOption('notification_button_border_radius', 7),
                                    'selectors' => [
                                        '.notification-buttons a' => 'border-radius: {{VALUE}}{{UNIT}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::DIMENSIONS,[
                                    'label' => __('Button Padding', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_padding',
                                    'min' => 0,
                                    'max' => 100,
                                    'units' => ['px'],
                                    'current_unit' => 'px',
                                    'values' => [
                                        'top' => NotificationOptions::getOption('notification_button_padding_top', 12),
                                        'right' => NotificationOptions::getOption('notification_button_padding_right', 15),
                                        'bottom' => NotificationOptions::getOption('notification_button_padding_bottom', 12),
                                        'left' => NotificationOptions::getOption('notification_button_padding_left', 15),
                                    ],
                                    'is_linked' => false,
                                    'selectors' => [
                                        '.notification-buttons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-wrap">
                                <?php
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Close Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_close_color',
                                    'value' => NotificationOptions::getOption('notification_close_color', '#ffffff'),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .mwn-notification-bar-text .close-bar svg' => 'fill: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Close Background Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_close_bg_color',
                                    'value' => NotificationOptions::getOption('notification_close_bg_color', '#686868'),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .close-bar' => 'background-color: {{VALUE}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-wrap countdown-options" style="display:<?php echo NotificationOptions::get_countdown_status() ? 'block' : 'none' ?>">
                                <?php
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Timer Text Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_timer_text_color',
                                    'value' => NotificationOptions::getOption('notification_timer_text_color', '#ffffff'),
                                    'selectors' => [
                                        '.notification-countdown, .notification-countdown .tick-label, .end-time-content' => 'color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Timer Number Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_timer_number_color',
                                    'value' => NotificationOptions::getOption('notification_timer_number_color', '#ffffff'),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .tick-flip-panel-text-wrapper' => 'color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::COLOR,[
                                    'label' => __('Timer Number Background Color', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_timer_number_bg_color',
                                    'value' => NotificationOptions::getOption('notification_timer_number_bg_color', '#333232'),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .tick-flip-panel' => 'background-color: {{VALUE}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Timer End Text Font Size', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_timer_font_size',
                                    'min' => 0,
                                    'max' => 400,
                                    'current_unit' => NotificationOptions::getOption('notification_timer_font_size_unit', 'px'),
                                    'units' => ['px', 'rem', 'em'],
                                    'value' => NotificationOptions::getOption('notification_timer_font_size', 16),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .end-time-content' => 'font-size: {{VALUE}}{{UNIT}}'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div class="mwn-field-wrap">
                                <?php
                                OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Text Font Size', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_text_font_size',
                                    'min' => 0,
                                    'max' => 400,
                                    'current_unit' => NotificationOptions::getOption('notification_text_font_size_unit', 'px'),
                                    'units' => ['px', 'rem', 'em'],
                                    'value' => NotificationOptions::getOption('notification_text_font_size', 16),
                                    'selectors' => [
                                        '.mwn-notification-bar-box .notification-text' => 'font-size: {{VALUE}}{{UNIT}}'
                                    ]
                                ]);
                                OptionsControl::renderControl(OptionsControl::RANGE,[
                                    'label' => __('Button Font Size', MWNB_TEXT_DOMAIN),
                                    'name' => 'notification_button_font_size',
                                    'min' => 0,
                                    'max' => 400,
                                    'current_unit' => NotificationOptions::getOption('notification_button_font_size_unit', 'px'),
                                    'units' => ['px', 'rem', 'em'],
                                    'class' => 'button-options',
                                    'value' => NotificationOptions::getOption('notification_button_font_size', 16),
                                    'selectors' => [
                                        '.notification-buttons a' => 'font-size: {{VALUE}}{{UNIT}}'
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--------------------------- / END Style Tab ------------------------------->
                </div>
                <button type="submit" class="mwn-save" disabled><?php _e('Save Changes', MWNB_TEXT_DOMAIN) ?></button>
            </div>
            <div class="mwn-notification-bar-container">
                <?php include_once MWNB_VIEW_USER_PATH . 'notification-content.php' ?>
            </div>
        </div>
    </form>
</div>