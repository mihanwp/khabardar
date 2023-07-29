<?php
$wrapper_style = \app\mihanwp_notification_bar_options::get_box_style();
$content_box_style = \app\mihanwp_notification_bar_options::get_content_wrapper_style();
$title_style = \app\mihanwp_notification_bar_options::get_title_style();
$timer_style = \app\mihanwp_notification_bar_options::get_timer_style();
$cta_style = \app\mihanwp_notification_bar_options::get_cta_style();
$close_btn_style = \app\mihanwp_notification_bar_options::get_close_btn_style();
?>
<div style="<?php echo $wrapper_style; ?>" <?php echo $is_in_footer ? 'mihanwp_notification_bar_move="true"' : '';?> mihanwp_notification_bar_id="<?php echo \app\mihanwp_notification_bar_options::get_banner_id();?>" class="mihanwp_notification_bar_box_wrapper <?php echo is_rtl() ? 'mihanwp_notification_bar_rtl' : 'mihanwp_notification_bar_ltr'; ?>">
        <div class="mihanwp_notification_bar_content" style="<?php echo $content_box_style; ?>">
        <?php if(\app\mihanwp_notification_bar_options::has_close_btn()): ?>
            <span class="mihanwp_notification_bar_close" style="<?php echo $close_btn_style; ?>"></span>
        <?php endif; ?>
            <div class="mihanwp_notification_bar_message">
                <p style="<?php echo $title_style; ?>"><?php echo \app\mihanwp_notification_bar_options::get_title(); ?></p>
            </div>
            <div class="mihanwp_notification_bar_timer" style="<?php echo $timer_style;?>" data-expired_title="<?php echo \app\mihanwp_notification_bar_options::get_expired_title_text(); ?>" data-end-date="<?php echo \app\mihanwp_notification_bar_options::get_end_date(); ?>">
                <?php if(\app\mihanwp_notification_bar_options::has_count_down()): ?>
                    <?php echo \app\mihanwp_notification_bar_options::render_date_time(); ?>
                <?php endif; ?>
            </div>
            <div class="mihanwp_notification_bar_button">
                <a <?php echo \app\mihanwp_notification_bar_options::is_open_in_new_tab() ? 'target="_blank"' : ''; ?> style="<?php echo $cta_style; ?>" href="<?php echo \app\mihanwp_notification_bar_options::get_cta_url(); ?>"><?php echo \app\mihanwp_notification_bar_options::get_cta_title(); ?></a>
            </div>
        </div>
</div>
