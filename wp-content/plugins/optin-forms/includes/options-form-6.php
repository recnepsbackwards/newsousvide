<?php ?>
                    <div class="clear"></div><br><br>

                    <div class="toggle-wrap">
                    	<span class="trigger">
                            <a><?php echo __('Form Options', 'optin-forms'); ?></a>
                        </span>

                        <div class="toggle-container" style="display: none;">

                            <div class="optiongroup">
                                <div class="optionleft"></div>
                                <div class="optionmiddle">
                                    <input type="checkbox" name="optinforms_form6_hide_confirm_checkbox" value="1" id="optinforms_form6_hide_confirm_checkbox" <?php if (get_option('optinforms_form6_hide_confirm_checkbox') == '1') { echo 'checked="checked"'; } ?> /> <label for="optinforms_form6_hide_confirm_checkbox" class="nopointer"><?php echo __('Hide the confirm checkbox', 'optin-forms'); ?></label>
                                </div><!--optionmiddle-->
                                <div class="optionlast"></div>
                                <div class="clear"></div>
                            </div><!--optiongroup-->

                            <div class="optiongroup">
                                <div class="optionleft">
                                    <label for="optinforms_form6_confirm_checkbox" class="nopointer"><?php echo __('Confirm checkbox text', 'optin-forms'); ?></label>
                                </div><!--optionleft-->
                                <div class="optionmiddle">
                                    <input type="text" id="optinforms_form6_confirm_checkbox" name="optinforms_form6_confirm_checkbox" value="<?php echo esc_attr( optinforms_form6_default_confirm_checkbox() ); ?>" />
                                </div><!--optionmiddle-->
                                <div class="optionlast">
                                    
                                </div><!--optionlast-->
                                <div class="clear"></div>
                            </div><!--optiongroup-->

                        </div><!--toggle-container-->
                        <div class="clear"></div>
                    </div><!--toggle-wrap-->

<?php ?>