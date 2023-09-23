<?php
$countdown_status = \mwn\app\NotificationOptions::get_countdown_status();
$show_countdown = !is_admin() ? $countdown_status === true : true;
$countdown_type = $countdown_status ? \mwn\app\NotificationOptions::get_countdown_type() : false;
$countdown_datetime = \mwn\app\NotificationOptions::get_countdown_datetime();
$countdown_datetime = !empty($countdown_datetime) ? $countdown_datetime : date('Y/m/d H:i AM');

$btn_status = \mwn\app\NotificationOptions::get_button_status();
$show_btn = !is_admin() ? $btn_status === true : true;
?>
<div class="mwn-notification-bar-body" style="display:<?php echo !is_admin() ? 'none' : '' ?>">
    <div class="mwn-notification-bar-box">
        <div class="mwn-notification-bar-content mwn-<?php echo is_rtl() ? 'rtl' : 'ltr' ?>">
            <div class="mwn-notification-bar-text">
                <div class="close-bar">
                    <svg fill="#000000" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                </div>
                <div class="notification-text"><?php echo \mwn\app\NotificationOptions::get_notification_content() ?></div>
            </div>
            <div class="notification-buttons">
                <?php if($show_countdown): ?>
                <div class="notification-countdown countdown-style-type countdown-style-type-1" data-time="<?php echo esc_attr($countdown_datetime) ?>" style="display:<?php echo $countdown_status && $countdown_type === 1 ? 'block' : 'none' ?>"></div>
                <div class="notification-countdown countdown-style-type countdown-style-type-2" style="display:<?php echo $countdown_status && $countdown_type === 2 ? 'block' : 'none' ?>;" data-time="<?php echo esc_attr($countdown_datetime) ?>"><?php echo \mwn\app\NotificationOptions::get_countdown_content() ?></div>
                <div class="end-time-content" style="display:none;"><?php echo \mwn\app\NotificationOptions::get_countdown_end_text() ?></div>
                <?php endif; ?>
                <?php if ($show_btn): ?>
                <a href="<?php echo esc_attr(\mwn\app\NotificationOptions::get_button_link()) ?>" style="display:<?php echo $btn_status ? 'block' : 'none' ?>;" class="notification-btn" target="<?php echo \mwn\app\NotificationOptions::get_button_target_blank_status() ? '_blank' : '' ?>">
                    <?php echo \mwn\app\NotificationOptions::get_button_text() ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>