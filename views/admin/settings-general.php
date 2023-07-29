<div id="general">
                    <?php
                    settings_fields('mw_mihanwp_notification_bar_settings');
                    ?>
                    <table class="form-table">
                        <tr>
                            <th><label for="is_banner_active"><?php _e('Is banner active?', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input type="checkbox" name="mihanwp_notification_bar_is_active" id="is_banner_active" value=1 <?php checked(1, \app\mihanwp_notification_bar_options::is_active_banner());?>></td>
                        </tr>
                        <tr>
                            <th><label for="mihanwp_notification_bar_title"><?php _e('Title', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input type="text" class="regular-text" name="mihanwp_notification_bar_title" id="mihanwp_notification_bar_title" value="<?php echo \app\mihanwp_notification_bar_options::get_title(); ?>" /></td>
                        </tr>

                        <tr>
                            <th>
                                <label for="mihanwp_notification_bar_width"><?php _e("Width", 'mihanwp-notification-bar'); ?></label>
                                <small id="mihanwp_notification_bar_width_value">(<?php echo \app\mihanwp_notification_bar_options::get_width(); ?> px)</small>
                            </th>
                            <td>
                                <input type="range" class="regular-text" name="mihanwp_notification_bar_width" id="mihanwp_notification_bar_width" min="800" max="1200" value="<?php echo \app\mihanwp_notification_bar_options::get_width(); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="mihanwp_notification_bar_height"><?php _e("Height", 'mihanwp-notification-bar'); ?></label>
                                <small id="mihanwp_notification_bar_height_value">(<?php echo \app\mihanwp_notification_bar_options::get_height(); ?> px)</small>
                            </th>
                            <td>
                                <input type="range" class="regular-text" name="mihanwp_notification_bar_height" id="mihanwp_notification_bar_height" min="80" max="300" value="<?php echo \app\mihanwp_notification_bar_options::get_height(); ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="cta_title"><?php _e('Button title', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input type="text" name="mihanwp_notification_bar_cta_title" id="cta_title" class="regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_cta_title(); ?>"></td>
                        </tr>
                        <tr>
                            <th><label for="cta_url"><?php _e('Link URL', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input type="text" name="mihanwp_notification_bar_cta_url" id="cta_url" class="regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_cta_url(); ?>"></td>
                        </tr>
                        <tr>
                            <th><label for="has_close_btn"><?php _e('Has close button?', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input value="1" type="checkbox" name="mihanwp_notification_bar_has_close_btn" id="has_close_btn" <?php checked('1', \app\mihanwp_notification_bar_options::has_close_btn()); ?>/></td>
                        </tr>
                        <tr>
                            <th><label for="is_open_in_new_tab"><?php _e('Open in new tab?', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input value="1" type="checkbox" name="mihanwp_notification_bar_is_open_in_new_tab" id="is_open_in_new_tab" <?php checked('1', \app\mihanwp_notification_bar_options::is_open_in_new_tab()); ?>/></td>
                        </tr>
                        
                        <tr>
                            <th><label for="has_count_down"><?php _e('Has count down?', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input value="1" type="checkbox" id="has_count_down" name="mihanwp_notification_bar_has_count_down" <?php checked('1', \app\mihanwp_notification_bar_options::has_count_down()); ?>/></td>
                        </tr>
                        <tr>
                            <th><label for="end_date"><?php _e('End Date', 'mihanwp-notification-bar'); ?></label></th>
                            <td>
                                <input type="text" name="mihanwp_notification_bar_end_date" class="regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_end_date(); ?>"/></td>
                        </tr>
                        <tr>
                            <th><label for="expired_title_text"><?php _e('Expired text title', 'mihanwp-notification-bar'); ?></label></th>
                            <td><input type="text" name="mihanwp_notification_bar_expired_title_text" id="expired_title_text" class="regular-text" value="<?php echo \app\mihanwp_notification_bar_options::get_expired_title_text(); ?>"/></td>
                        </tr>
                        <tr>
                            <th><label for="count_down_content"><?php _e("Count down content", 'mihanwp-notification-bar'); ?></label></th>
                            <td>
                                <textarea class="regular-text" name="mihanwp_notification_bar_count_down_content" id="count_down_content" cols="30" rows="10"><?php echo \app\mihanwp_notification_bar_options::get_count_down_content(); ?></textarea>
                                <p class="description" id="mihanwp_notification_bar_count_down_content_description">
                                    <span><?php _e('You can use this:', 'mihanwp-notification-bar');?></span>
                                    <span><?php _e('{{d}} to show Day', 'mihanwp-notification-bar');?></span>
                                    <span><?php _e('{{h}} to show Hour', 'mihanwp-notification-bar');?></span>
                                    <span><?php _e('{{m}} to show Minutes', 'mihanwp-notification-bar');?></span>
                                    <span><?php _e('{{s}} to show Seconds', 'mihanwp-notification-bar');?></span>
                                </p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th><label for="mihanwp_notification_bar_url_blacklist"><?php _e('Url blacklist', 'mihanwp-notification-bar')?></label></th>
                            <td>
                                <textarea dir="ltr" class="regular-text" name="mihanwp_notification_bar_url_blacklist" id="mihanwp_notification_bar_url_blacklist" cols="30" rows="10"><?php echo \app\mihanwp_notification_bar_options::get_url_blacklist()?></textarea>
                            </td>
                        </tr>

                        
                    </table>
                </div>