<div class="wrap">
    <h2><?php _e('MihanWP Notification Bar', 'mihanwp-notification-bar'); ?></h2>
    <div class="mihanwp_notification_bar_option_panel_wrapper">
        <div class="mihanwp_notification_bar_option_panel">
            <div class="tabs">
                <ul>
                <?php
                $tabs = \app\mihanwp_notification_bar_options::get_tabs();
                $white_list = array_keys($tabs);
                $active_tab = isset($_GET['tab']) && in_array($_GET['tab'], $white_list) ? $_GET['tab'] : $white_list[0];
                foreach($tabs as $tab_id => $tab_name):
                ?>
                    <li <?php echo $tab_id == $active_tab ? 'class="active"' : ''; ?>>
                        <a href="<?php echo esc_url(add_query_arg(['tab' => $tab_id])); ?>"><?php echo $tab_name; ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <?php
                $preview_style = \app\mihanwp_notification_bar_options::get_box_style();
                $content_wrapper_style = \app\mihanwp_notification_bar_options::get_content_wrapper_style(true);
                $title_style = \app\mihanwp_notification_bar_options::get_title_style();
                $timer_style = \app\mihanwp_notification_bar_options::get_timer_style();
                $cta_style = \app\mihanwp_notification_bar_options::get_cta_style();
                $close_btn_style = \app\mihanwp_notification_bar_options::get_close_btn_style();
                if(!\app\mihanwp_notification_bar_options::has_close_btn())
                {
                    $close_btn_style .= 'display:none;';
                }
            ?>
            <div class="mihanwp_notification_bar_preview <?php echo is_rtl() ? 'mw_rtl' : 'mw_ltr'; ?>" style="<?php echo $preview_style?>">
                <div id="mihanwp_notification_bar_content" style="<?php echo $content_wrapper_style; ?>">
                <span class="mihanwp_notification_bar_close" style="<?php echo $close_btn_style?>"></span>
                    <div id="mihanwp_notification_bar_message">
                        <p style="<?php echo $title_style;?>"><?php echo \app\mihanwp_notification_bar_options::get_title(); ?></p>
                    </div>
                    <div id="mihanwp_notification_bar_timer" style="<?php echo $timer_style;?>" data-end-date="<?php echo \app\mihanwp_notification_bar_options::get_end_date(); ?>" data-expired_title="<?php echo \app\mihanwp_notification_bar_options::get_expired_title_text(); ?>">
                        <span id="timer_data_wrapper"><?php echo \app\mihanwp_notification_bar_options::has_count_down() ? \app\mihanwp_notification_bar_options::render_date_time() : ''; ?></span>
                    </div>
                    <div id="mihanwp_notification_bar_button">
                        <a style="<?php echo $cta_style; ?>" href="#"><?php echo \app\mihanwp_notification_bar_options::get_cta_title(); ?></a>
                    </div>
                </div>
            </div>
            <div class="tab_content">
                <form action="options.php" method="post">
                    <?php
                    $view = \app\mihanwp_notification_bar_views::get('admin.settings-' . $active_tab);
                    include $view;
                    if($view)
                    {
                        submit_button();
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
</div>