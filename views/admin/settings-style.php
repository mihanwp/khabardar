<div id="color">
    <?php settings_fields('mw_mihanwp_notification_bar_settings-color'); \app\mihanwp_notification_bar_assets::load_media_uploader(); ?>
    <table class="form-table">
        <tr>
            <th><span><?php _e('Background Mode', 'mihanwp-notification-bar'); ?></span></th>
            <td>
                <?php $bg_modes = \app\mihanwp_notification_bar_options::get_bg_modes();
                foreach($bg_modes as $mode_key => $mode_name):
                ?>
                    <p>
                        <input type="radio" <?php checked($mode_key, \app\mihanwp_notification_bar_options::get_bg_mode()); ?> name="mihanwp_notification_bar_bg_mode" id="bg_mode_<?php echo $mode_key?>" value="<?php echo $mode_key; ?>">
                        <label for="bg_mode_<?php echo $mode_key; ?>"><?php echo $mode_name; ?></label>
                    </p>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr class="hide" on-gradient="on" on-solid="on" on-image="on">
            <th><label for="bg_color"><?php _e('Backgrond Color', 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_bg_color" id="bg_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_bg_color()?>" /></td>
        </tr>
        <tr class="hide" on-gradient="on">
            <th><label for="bg_second_color"><?php _e('Backgrond Second Color', 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_bg_second_color" id="bg_second_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_bg_second_color()?>" /></td>
        </tr>
        <tr class="hide" on-gradient="on">
            <th><label for="bg_gradient_direction"><?php _e('Gradient Direction', 'mihanwp-notification-bar'); ?></label><small id="mihanwp_notification_bar_gradient_direction_value">(<?php echo \app\mihanwp_notification_bar_options::get_bg_gradient_direction(); ?>)</small></th>
            <td><input type="range" name="mihanwp_notification_bar_bg_gradient_direction" id="bg_gradient_direction" class="regular-text" min="0" max="360" value="<?php echo \app\mihanwp_notification_bar_options::get_bg_gradient_direction(); ?>" /></td>
        </tr>
        <tr class="hide" on-image="on">
            <th><label for="bg_image"><?php _e("Backgroud Image", 'mihanwp-notification-bar'); ?><small><a class="mihanwp_notification_bar_media" href="#"> (<?php _e('Media'); ?>)</a></small></label></th>
            <td><input type="text" name="mihanwp_notification_bar_bg_image" value="<?php echo \app\mihanwp_notification_bar_options::get_bg_image(); ?>" class="regular-text"></td>
        </tr>
        <tr class="hide" on-image="on">
            <th>
                <label for="bg_repeat"><?php _e("Background Repeat", "mihanwp_notification_bar"); ?></label>
            </th>
            <td>
                <?php $bg_repeat_mode = \app\mihanwp_notification_bar_options::get_bg_repeat_mode(); ?>
                <p>
                    <input type="radio" <?php checked('no-repeat', $bg_repeat_mode); ?> name="mihanwp_notification_bar_bg_repeat_mode" id="mihanwp_notification_bar_bg_no_repeat" value="no-repeat">
                    <label for="mihanwp_notification_bar_bg_no_repeat"><?php _e('No Repeat', 'mihanwp-notification-bar');?></label>
                </p>
                <p>
                    <input type="radio" <?php checked('repeat', $bg_repeat_mode); ?> name="mihanwp_notification_bar_bg_repeat_mode" id="mihanwp_notification_bar_bg_repeat" value="repeat">
                    <label for="mihanwp_notification_bar_bg_repeat"><?php _e('Repeat', 'mihanwp-notification-bar');?></label>
                </p>
                <p>
                    <input type="radio" <?php checked('repeat', $bg_repeat_mode); ?> name="mihanwp_notification_bar_bg_repeat_mode" id="mihanwp_notification_bar_bg_repeat_x" value="repeat-x">
                    <label for="mihanwp_notification_bar_bg_repeat_x"><?php _e('Repeat-X', 'mihanwp-notification-bar');?></label>
                </p>
                <p>
                    <input type="radio" <?php checked('repeat', $bg_repeat_mode); ?> name="mihanwp_notification_bar_bg_repeat_mode" id="mihanwp_notification_bar_bg_repeat_y" value="repeat-y">
                    <label for="mihanwp_notification_bar_bg_repeat_y"><?php _e('Repeat-Y', 'mihanwp-notification-bar');?></label>
                </p>
            </td>
        </tr>
        <tr class="hide" on-image="on">
            <th><label for="bg_size"><?php _e("Background Size", "mihanwp_notification_bar"); ?></label></th>
            <td>
                <?php $bg_size = \app\mihanwp_notification_bar_options::get_bg_size(); ?>
                <p>
                    <input type="radio" <?php checked('auto', $bg_size)?> name="mihanwp_notification_bar_bg_size" id="mihanwp_notification_bar_bg_size_auto" value="auto">
                    <label for="mihanwp_notification_bar_bg_size_auto"><?php _e("Auto", 'mihanwp-notification-bar'); ?></label>
                </p>
                <p>
                    <input type="radio" <?php checked('contain', $bg_size)?> name="mihanwp_notification_bar_bg_size" id="mihanwp_notification_bar_bg_size_contain" value="contain">
                    <label for="mihanwp_notification_bar_bg_size_contain"><?php _e("Contain", 'mihanwp-notification-bar'); ?></label>
                </p>
                <p>
                    <input type="radio" <?php checked('cover', $bg_size)?> name="mihanwp_notification_bar_bg_size" id="mihanwp_notification_bar_bg_size_cover" value="cover">
                    <label for="mihanwp_notification_bar_bg_size_cover"><?php _e("Cover", 'mihanwp-notification-bar'); ?></label>
                </p>
            </td>
        </tr>
        <tr class="hide" on-image="on">
            <th>
                <label for="bg_position"><?php _e("Background Position", "mihanwp_notification_bar"); ?></label>
            </th>
            <td class="mihanwp_notification_bar_bg_position_preview">
                <?php $bg_position = \app\mihanwp_notification_bar_options::get_bg_position();?>
                
                    <input type="radio" <?php checked('top left', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="top left" id="mihanwp_notification_bar_bg_position_top_left">
                    <label for="mihanwp_notification_bar_bg_position_top_left"></label>

                    <input type="radio" <?php checked('top center', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="top center" id="mihanwp_notification_bar_bg_position_top_center">
                    <label for="mihanwp_notification_bar_bg_position_top_center"></label>

                    <input type="radio" <?php checked('top right', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="top right" id="mihanwp_notification_bar_bg_position_top_right">
                    <label for="mihanwp_notification_bar_bg_position_top_right"></label>

                    
                    <input type="radio" <?php checked('center left', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="center left" id="mihanwp_notification_bar_bg_position_center_left">
                    <label for="mihanwp_notification_bar_bg_position_center_left"></label>
                    
                    <input type="radio" <?php checked('center center', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="center center" id="mihanwp_notification_bar_bg_position_center_center">
                    <label for="mihanwp_notification_bar_bg_position_center_center"></label>
                    
                    <input type="radio" <?php checked('center right', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="center right" id="mihanwp_notification_bar_bg_position_center_right">
                    <label for="mihanwp_notification_bar_bg_position_center_right"></label>


                    <input type="radio" <?php checked('bottom left', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="bottom left" id="mihanwp_notification_bar_bg_position_bottom_left">
                    <label for="mihanwp_notification_bar_bg_position_bottom_left"></label>
                    
                    <input type="radio" <?php checked('bottom center', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="bottom center" id="mihanwp_notification_bar_bg_position_bottom_center">
                    <label for="mihanwp_notification_bar_bg_position_bottom_center"></label>
                    
                    <input type="radio" <?php checked('bottom right', $bg_position); ?> name="mihanwp_notification_bar_bg_position" value="bottom right" id="mihanwp_notification_bar_bg_position_bottom_right">
                    <label for="mihanwp_notification_bar_bg_position_bottom_right"></label>
                
            </td>
        </tr>
        <tr>
            <th><label for="text_color"><?php _e("Text color", 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_text_color" id="text_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_text_color()?>" /></td>
        </tr>

        <tr>
            <th><label for="link_color"><?php _e("Link color", 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_link_color" id="link_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_link_color()?>" /></td>
        </tr>
        
        <tr>
            <th><label for="link_btn_color"><?php _e("Link button color", 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_link_btn_color" id="link_btn_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_link_btn_color()?>" /></td>
        </tr>
        <tr>
            <th><label for="close_btn_color"><?php _e("Close button color", 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_close_btn_color" id="close_btn_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_close_btn_color()?>" /></td>
        </tr>
        <tr>
            <th><label for="close_btn_bg_color"><?php _e("Close button background color", 'mihanwp-notification-bar'); ?></label></th>
            <td><input type="text" name="mihanwp_notification_bar_close_btn_bg_color" id="close_btn_bg_color" class="mw_color_picker regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_close_btn_bg_color()?>" /></td>
        </tr>
        <tr>
            <th><label for="title_font_size"><?php _e('Title font size', 'mihanwp-notification-bar'); ?>(px)</label></th>
            <td><input type="number" id="title_font_size" class="regular-text" name="mihanwp_notification_bar_title_font_size" value="<?php echo \app\mihanwp_notification_bar_options::get_title_font_size();?>"></td>
        </tr>
        <tr>
            <th><label for="timer_font_size"><?php _e('Timer font size', 'mihanwp-notification-bar'); ?>(px)</label></th>
            <td><input type="number" id="timer_font_size" class="regular-text" name="mihanwp_notification_bar_count_down_font_size" value="<?php echo \app\mihanwp_notification_bar_options::get_count_down_font_size();?>"></td>
        </tr>
        <tr>
            <th><label for="cta_font_size"><?php _e('Button font size', 'mihanwp-notification-bar'); ?>(px)</label></th>
            <td><input type="number" id="cta_font_size" class="regular-text" name="mihanwp_notification_bar_cta_font_size" value="<?php echo \app\mihanwp_notification_bar_options::get_cta_font_size();?>"></td>
        </tr>
    </table>
</div>