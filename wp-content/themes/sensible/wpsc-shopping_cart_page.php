<?php
global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons, $wpsc_registration_error_messages;
$wpsc_checkout = new wpsc_checkout();
$alt = 0;
$coupon_num = wpsc_get_customer_meta('coupon');
if ($coupon_num)
    $wpsc_coupons = new wpsc_coupons($coupon_num);

if (wpsc_cart_item_count() < 1) :
    echo __('Oops, there is nothing in your cart.', 'wpsc') . '<a href=' . esc_url(get_option('product_list_url', '')) . ">" . __('Please visit our shop', 'wpsc') . '</a>';
    return;
endif;
?>
    <div id="checkout_page_container" class="container">
        <form class='wpsc_checkout_forms' action='<?php echo esc_url(get_option('shopping_cart_url')); ?>'
              method='post' enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div id="wpsc_shopping_cart_container">
                        <?php if (wpsc_show_user_login_form() && !is_user_logged_in()): ?>
                            <p><?php _e('You must sign in or register with us to continue with your purchase', 'wpsc'); ?></p>
                            <div class="wpsc_registration_form">
                                <fieldset class='wpsc_registration_form'>
                                    <h2><?php _e('Sign in', 'wpsc'); ?></h2>
                                    <?php
                                    $args = array(
                                        'remember' => false,
                                        'redirect' => get_option('shopping_cart_url')
                                    );
                                    wp_login_form($args);
                                    ?>
                                    <div class="wpsc_signup_text">
                                        <?php _e('If you have bought from us before please sign in here to purchase', 'wpsc'); ?>
                                    </div>
                                </fieldset>
                            </div>
                        <?php endif; ?>
                        <?php
                        /**
                         * Both the registration forms and the checkout details forms must be in the same form element as they are submitted together, you cannot have two form elements submit together without the use of JavaScript.
                         */
                        ?>
                        <?php if (wpsc_show_user_login_form()):
                            global $current_user;
                            get_currentuserinfo(); ?>

                            <div class="wpsc_registration_form">

                                <fieldset class='wpsc_registration_form wpsc_right_registration'>
                                    <h2><?php _e('Join up now', 'wpsc'); ?></h2>

                                    <label><?php _e('Username:', 'wpsc'); ?></label>
                                    <input type="text" name="log" id="log" value="" size="20"/><br/>

                                    <label><?php _e('Password:', 'wpsc'); ?></label>
                                    <input type="password" name="pwd" id="pwd" value="" size="20"/><br/>

                                    <label><?php _e('E-mail', 'wpsc'); ?>:</label>
                                    <input type="text" name="user_email" id="user_email" value="" size="20"/><br/>

                                    <div
                                        class="wpsc_signup_text"><?php _e('Signing up is free and easy! please fill out your details your registration will happen automatically as you checkout. Don\'t forget to use your details to login with next time!', 'wpsc'); ?></div>
                                </fieldset>

                            </div>
                            <div class="clear"></div>
                        <?php endif; // closes user login form
                        $misc_error_messages = wpsc_get_customer_meta('checkout_misc_error_messages');
                        if (!empty($misc_error_messages)): ?>
                            <div class='login_error'>
                                <?php foreach ($misc_error_messages as $user_error) { ?>
                                    <p class='validation-error'><?php echo $user_error; ?></p>
                                <?php } ?>
                            </div>

                            <?php
                        endif;
                        ?>

                        <?php ob_start(); ?>
                        <!--<table class='wpsc_checkout_table table-1'>-->
                        <?php $i = 0;
                        while (wpsc_have_checkout_items()) :
                        wpsc_the_checkout_item(); ?>

                    <?php if (wpsc_checkout_form_is_header() == true) {
                    $i++;
                    //display headers for form fields ?>
                    <?php if ($i > 1) { ?>
                        <!--</table>
                <div class='wpsc_checkout_table table-<?php echo $i; ?>'>-->
                    <?php } ?>

                        <div class="checkout-heading-row <?php echo wpsc_the_checkout_item_error_class(false); ?>">
                            <div <?php wpsc_the_checkout_details_class(); ?>>
                                <h4><?php echo wpsc_checkout_form_name(); ?></h4>
                            </div>
                        </div>

                    <?php if (wpsc_is_shipping_details()): ?>
                        <div class='row same_as_shipping_row'>
                            <div class="col-md-12">
                                <?php $checked = '';
                                $shipping_same_as_billing = wpsc_get_customer_meta('shippingSameBilling');
                                if (isset($_POST['shippingSameBilling']) && $_POST['shippingSameBilling'])
                                    $shipping_same_as_billing = true;
                                elseif (isset($_POST['submit']) && !isset($_POST['shippingSameBilling']))
                                    $shipping_same_as_billing = false;
                                wpsc_update_customer_meta('shippingSameBilling', $shipping_same_as_billing);
                                if ($shipping_same_as_billing)
                                    $checked = 'checked="checked"';
                                ?>
                                <div class="form-group">
                                    <div id="here" class="checkbox">
                                        <label for='shippingSameBilling'>
                                            <input id="doSame" type='checkbox' value='true' checked>
                                            <?php _e('Same as billing address', 'wpsc'); ?>
                                        </label>
                                    </div>
                                    <p class="help-block" id="shippingsameasbillingmessage">
                                        <?php _e('Your order will be shipped to the billing address', 'wpsc'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="shippingSection">
                            <?php endif;

                            // Not a header so start display form fields
                            } elseif ($wpsc_checkout->checkout_item->unique_name == 'billingemail') { ?>
                                <?php $email_markup =
                                    "<div class='wpsc_email_address'>
							  <p class='" . wpsc_checkout_form_element_id() . "'>
								 <h4 class='wpsc_email_address' for='" . wpsc_checkout_form_element_id() . "'>
								 " . __('Customer Information', 'wpsc') . "
								 </h4>
							  </p><p class='wpsc_email_address_p'>
							  <!--<img src='https://secure.gravatar.com/avatar/empty?s=60&amp;d=mm' id='wpsc_checkout_gravatar' />-->
							  " . wpsc_checkout_form_field();

                                if (wpsc_the_checkout_item_error() != '')
                                    $email_markup .= "<p class='validation-error'>" . wpsc_the_checkout_item_error() . "</p>";
                                $email_markup .= "</p></div>";

                            }
                            elseif ($wpsc_checkout->checkout_item->unique_name == 'billingfirstname'
                            || $wpsc_checkout->checkout_item->unique_name == 'shippingfirstname'
                            ) { ?>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>

                                <? } elseif ($wpsc_checkout->checkout_item->unique_name == 'billinglastname'
                                || $wpsc_checkout->checkout_item->unique_name == 'shippinglastname'
                                ) { ?>

                                <div class="col-md-6 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <? } elseif ($wpsc_checkout->checkout_item->unique_name == 'billingaddress'
                        || $wpsc_checkout->checkout_item->unique_name == 'shippingaddress'
                        ) { ?>

                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>

                                <? } elseif ($wpsc_checkout->checkout_item->unique_name == 'billing-apt-suite-etc-optional'
                                || $wpsc_checkout->checkout_item->unique_name == 'apt-suite-etc-optional'
                                ) { ?>

                                <div class="col-md-4 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <? } elseif ($wpsc_checkout->checkout_item->unique_name == 'billingcountry'
                        || $wpsc_checkout->checkout_item->unique_name == 'shippingcountry'
                        ) { ?>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>

                                <? } elseif ($wpsc_checkout->checkout_item->unique_name == 'billingstate'
                                    || $wpsc_checkout->checkout_item->unique_name == 'shippingstate'
                                ) { ?>

                                    <div class="col-md-4 form-group">
                                        <?php echo wpsc_checkout_form_field(); ?>
                                        <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                            <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                        <?php endif; ?>
                                    </div>

                                <? }
                                elseif ($wpsc_checkout->checkout_item->unique_name == 'shippingpostcode'
                                || $wpsc_checkout->checkout_item->unique_name == 'billingpostcode'
                                ) { ?>

                                <div class="col-md-4 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <? } else { ?>
                            <div class="row">
                                <!--
                                <td class='<?php echo wpsc_checkout_form_element_id(); ?>'>
                                    <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
                                        <?php echo wpsc_checkout_form_name(); ?>
                                    </label>
                                </td>
                                -->
                                <div class="col-md-12 form-group">
                                    <?php echo wpsc_checkout_form_field(); ?>
                                    <?php if (wpsc_the_checkout_item_error() != ''): ?>
                                        <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php }//endif;
                        ?>

                            <?php endwhile; ?>

                            <?php
                            $buffer_contents = ob_get_contents();
                            ob_end_clean();
                            if (isset($email_markup))
                                echo $email_markup;
                            echo $buffer_contents;
                            ?>


                            <?php if (wpsc_show_find_us()) : ?>
                                <div class="row">
                                    <!--
                                <td><label for='how_find_us'><?php _e('How did you find us', 'wpsc'); ?></label></td>
                                -->
                                    <div class="col-md-12 form-group">
                                        <select name='how_find_us' class="form-control">
                                            <option value='Word of Mouth'><?php _e('Word of mouth', 'wpsc'); ?></option>
                                            <option value='Advertisement'><?php _e('Advertising', 'wpsc'); ?></option>
                                            <option value='Internet'><?php _e('Internet', 'wpsc'); ?></option>
                                            <option value='Customer'><?php _e('Existing Customer', 'wpsc'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php do_action('wpsc_inside_shopping_cart'); ?>
                        </div>
                        <?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
                            <?php if (!wpsc_have_valid_shipping_zipcode()) : ?>
                                <p class='shipping_error'>
                                    <?php _e('Please provide a Zipcode and click Calculate in order to continue.', 'wpsc'); ?>
                                </p>
                            <?php else: ?>
                                <p class='shipping_error'>
                                    <?php _e('Sorry, shipping quotes could not be calculated with the details provided. Please double check your shipping address details.', 'wpsc'); ?>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-right">
                        <input id="calculateShipping" type='button' name='wpsc_submit_zipcode'
                               class="btn btn-default btn-lg"
                               value='<?php esc_attr_e('Calculate shipping', 'wpsc'); ?>'/>
                    </div>
                </div>
                <!-- Close col-md-6-->
                <div class="col-md-6">
                    <!--<h3><?php _e('Please review your order', 'wpsc'); ?></h3>-->
                    <br>
                    <table class="checkout_cart">
                        <tr class="header">
                            <th colspan="2"><?php _e('Product', 'wpsc'); ?></th>
                            <th><?php _e('Quantity', 'wpsc'); ?></th>
                            <th><?php _e('Price', 'wpsc'); ?></th>
                            <th><?php _e('Total', 'wpsc'); ?></th>
                            <th>&nbsp;</th>
                        </tr>
                        <?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>
                            <?php
                            $alt++;
                            if ($alt % 2 == 1)
                                $alt_class = 'alt';
                            else
                                $alt_class = '';
                            ?>
                            <?php //this displays the confirm your order html ?>

                            <?php do_action("wpsc_before_checkout_cart_row"); ?>
                            <tr class="product_row product_row_<?php echo wpsc_the_cart_item_key(); ?> <?php echo $alt_class; ?>">

                                <td class="firstcol wpsc_product_image wpsc_product_image_<?php echo wpsc_the_cart_item_key(); ?>">
                                    <?php if ('' != wpsc_cart_item_image()): ?>
                                        <?php do_action("wpsc_before_checkout_cart_item_image"); ?>
                                        <img src="<?php echo wpsc_cart_item_image(); ?>"
                                             alt="<?php echo wpsc_cart_item_name(); ?>"
                                             title="<?php echo wpsc_cart_item_name(); ?>" class="product_image"/>
                                        <?php do_action("wpsc_after_checkout_cart_item_image"); ?>
                                    <?php else:
                                        /* I dont think this gets used anymore,, but left in for backwards compatibility */
                                        ?>
                                        <div class="item_no_image">
                                            <?php do_action("wpsc_before_checkout_cart_item_image"); ?>
                                            <a href="<?php echo esc_url(wpsc_the_product_permalink()); ?>">
                                                <span><?php _e('No Image', 'wpsc'); ?></span>

                                            </a>
                                            <?php do_action("wpsc_after_checkout_cart_item_image"); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td class="wpsc_product_name wpsc_product_name_<?php echo wpsc_the_cart_item_key(); ?>">
                                    <?php do_action("wpsc_before_checkout_cart_item_name"); ?>
                                    <a href="<?php echo esc_url(wpsc_cart_item_url()); ?>"><?php echo wpsc_cart_item_name(); ?></a>
                                    <?php do_action("wpsc_after_checkout_cart_item_name"); ?>
                                </td>

                                <td class="wpsc_product_quantity wpsc_product_quantity_<?php echo wpsc_the_cart_item_key(); ?>"
                                    nowrap="nowrap">
                                    <form action="<?php echo esc_url(get_option('shopping_cart_url')); ?>" method="post"
                                          class="adjustform qty">
                                        <input type="text" name="quantity" size="2"
                                               value="<?php echo wpsc_cart_item_quantity(); ?>"/>
                                        <input type="hidden" name="key"
                                               value="<?php echo wpsc_the_cart_item_key(); ?>"/>
                                        <input type="hidden" name="wpsc_update_quantity" value="true"/>
                                        <input type='hidden' name='wpsc_ajax_action' value='wpsc_update_quantity'/>
                                        <input type="submit" class="btn btn-default"
                                               value="<?php _e('Update', 'wpsc'); ?>"/>
                                    </form>
                                </td>


                                <td><?php echo wpsc_cart_single_item_price(); ?></td>
                                <td class="wpsc_product_price wpsc_product_price_<?php echo wpsc_the_cart_item_key(); ?>"><span
                                        class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span></td>

                                <td class="wpsc_product_remove wpsc_product_remove_<?php echo wpsc_the_cart_item_key(); ?>">
                                    <form action="<?php echo esc_url(get_option('shopping_cart_url')); ?>" method="post"
                                          class="adjustform remove">
                                        <input type="hidden" name="quantity" value="0"/>
                                        <input type="hidden" name="key"
                                               value="<?php echo wpsc_the_cart_item_key(); ?>"/>
                                        <input type="hidden" name="wpsc_update_quantity" value="true"/>
                                        <input type='hidden' name='wpsc_ajax_action' value='wpsc_update_quantity'/>
                                        <input type="submit" class="btn btn-default"
                                               value="<?php _e('Remove', 'wpsc'); ?>"/>
                                    </form>
                                </td>
                            </tr>
                            <?php do_action("wpsc_after_checkout_cart_row"); ?>
                        <?php endwhile; ?>
                        <?php //this HTML displays coupons if there are any active coupons to use ?>

                        <?php do_action('wpsc_after_checkout_cart_rows'); ?>

                    </table>
                    <table class="table">
                        <tr class="wpsc_total_before_shipping">
                            <td><?php _e('Subtotal:', 'wpsc'); ?></td>
                            <td class="text-right">
                                <?php echo wpsc_cart_total_widget(false, false, false); ?>
                            </td>
                        </tr>

                        <?php
                        $wpec_taxes_controller = new wpec_taxes_controller();
                        if ($wpec_taxes_controller->wpec_taxes_isenabled()):
                            ?>
                            <tr class="total_price total_tax">
                                <td><?php echo wpsc_display_tax_label(true); ?></td>
                                <td class="text-right">
                            <span id="checkout_tax"
                                  class="pricedisplay checkout-tax"><?php echo wpsc_cart_tax(); ?></span>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (wpsc_uses_shipping()) : ?>
                            <tr>
                                <td>
                                    <?php _e('Total Shipping:', 'wpsc'); ?>
                                </td>
                                <td class="text-right">
                            <span id="checkout_shipping"
                                  class="pricedisplay checkout-shipping"><?php echo wpsc_cart_shipping(); ?></span>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php if (wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
                            <tr>
                                <td><?php _e('Discount:', 'wpsc'); ?></td>
                                <td class="text-right">
                                    <span id="coupons_amount" class=""><?php echo wpsc_coupon_amount(); ?></span>
                                </td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td><h4><?php _e('Total:', 'wpsc'); ?></h4></td>
                            <td class="text-right">
                                <h4 id='checkout_total'
                                    class="pricedisplay checkout-total"><?php echo wpsc_cart_total(); ?></h4>
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <?php

                        if (wpsc_uses_coupons()): ?>
                            <?php if (wpsc_coupons_error()): ?>
                                <div class="col-md-12 wpsc_coupon_error_row">
                                    <?php _e('Coupon is not valid.', 'wpsc'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <form class="row" method="post"
                                      action="<?php echo esc_url(get_option('shopping_cart_url')); ?>">
                                    <div class="col-md-7">
                                        <input type="text" name="coupon_num" id="coupon_num"
                                               value="<?php echo $wpsc_cart->coupons_name; ?>"
                                               placeholder="<?php _e('Enter coupon code here', 'wpsc'); ?>"/>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="btn btn-default" type="submit"
                                               value="<?php _e('Update', 'wpsc') ?>"/>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (wpsc_uses_shipping()): ?>
                        <p class="wpsc_cost_before"></p>
                    <?php endif; ?>
                    <?php //this HTML dispalys the calculate your order HTML   ?>

                    <?php if (wpsc_has_category_and_country_conflict()): ?>
                        <p class='validation-error'><?php echo esc_html(wpsc_get_customer_meta('category_shipping_conflict')); ?></p>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['WpscGatewayErrorMessage']) && $_SESSION['WpscGatewayErrorMessage'] != '') : ?>
                        <p class="validation-error"><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></p>
                        <?php
                    endif;
                    ?>

                    <?php do_action('wpsc_before_shipping_of_shopping_cart'); ?>

                    <?php if (wpsc_uses_shipping()) : ?>
                        <!--
                <div style="display: none;">
                    <h2><?php _e('Calculate Shipping Price', 'wpsc'); ?></h2>
                    <table class="productcart">
                        <tr class="wpsc_shipping_info">
                            <td colspan="5">
                                <?php _e('Please specify shipping location below to calculate your shipping costs', 'wpsc'); ?>
                            </td>
                        </tr>

                        <?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
                            <?php if (!wpsc_have_valid_shipping_zipcode()) : ?>
                                <tr class='wpsc_update_location'>
                                    <td colspan='5' class='shipping_error'>
                                        <?php _e('Please provide a Zipcode and click Calculate in order to continue.', 'wpsc'); ?>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr class='wpsc_update_location_error'>
                                    <td colspan='5' class='shipping_error'>
                                        <?php _e('Sorry, shipping quotes could not be calculated with the details provided. Please double check your shipping address details.', 'wpsc'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                        <tr class='wpsc_change_country'>
                            <td colspan='5'>
                                <form name='change_country' id='change_country' action='' method='post'>
                                    <?php echo wpsc_shipping_country_list(); ?>
                                    <input type='hidden' name='wpsc_update_location' value='true'/>
                                    <input type='submit' name='wpsc_submit_zipcode'
                                           value='<?php esc_attr_e('Calculate', 'wpsc'); ?>'/>
                                </form>
                            </td>
                        </tr>

                        <?php if (wpsc_have_morethanone_shipping_quote()) : ?>
                            <?php while (wpsc_have_shipping_methods()) : wpsc_the_shipping_method(); ?>
                                <?php if (!wpsc_have_shipping_quotes()) {
                            continue;
                        } // Don't display shipping method if it doesn't have at least one quote ?>
                                <tr class='wpsc_shipping_header'>
                                    <td class='shipping_header'
                                        colspan='5'><?php echo wpsc_shipping_method_name() . __(' - Choose a Shipping Rate', 'wpsc'); ?> </td>
                                </tr>
                                <?php while (wpsc_have_shipping_quotes()) : wpsc_the_shipping_quote(); ?>
                                    <tr class='<?php echo wpsc_shipping_quote_html_id(); ?>'>
                                        <td class='wpsc_shipping_quote_name wpsc_shipping_quote_name_<?php echo wpsc_shipping_quote_html_id(); ?>'
                                            colspan='3'>
                                            <label
                                                for='<?php echo wpsc_shipping_quote_html_id(); ?>'><?php echo wpsc_shipping_quote_name(); ?></label>
                                        </td>
                                        <td class='wpsc_shipping_quote_price wpsc_shipping_quote_price_<?php echo wpsc_shipping_quote_html_id(); ?>'
                                            style='text-align:center;'>
                                            <label
                                                for='<?php echo wpsc_shipping_quote_html_id(); ?>'><?php echo wpsc_shipping_quote_value(); ?></label>
                                        </td>
                                        <td class='wpsc_shipping_quote_radio wpsc_shipping_quote_radio_<?php echo wpsc_shipping_quote_html_id(); ?>'
                                            style='text-align:center;'>
                                            <?php if (wpsc_have_morethanone_shipping_methods_and_quotes()): ?>
                                                <input type='radio'
                                                       id='<?php echo wpsc_shipping_quote_html_id(); ?>' <?php echo wpsc_shipping_quote_selected_state(); ?>
                                                       onclick='switchmethod("<?php echo wpsc_shipping_quote_name(); ?>", "<?php echo wpsc_shipping_method_internal_name(); ?>")'
                                                       value='<?php echo wpsc_shipping_quote_value(true); ?>'
                                                       name='shipping_method'/>
                                            <?php else: ?>
                                                <input <?php echo wpsc_shipping_quote_selected_state(); ?>
                                                    disabled='disabled' type='radio'
                                                    id='<?php echo wpsc_shipping_quote_html_id(); ?>'
                                                    value='<?php echo wpsc_shipping_quote_value(true); ?>'
                                                    name='shipping_method'/>
                                                <?php wpsc_update_shipping_single_method(); ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <?php wpsc_update_shipping_multiple_methods(); ?>
                    </table>
                </div>-->
                    <?php endif; ?>

                    <!--
            <table class='wpsc_checkout_table wpsc_checkout_table_totals'>
                <?php if (wpsc_uses_shipping()) : ?>
                    <tr class="total_price total_shipping">
                        <td class='wpsc_totals'>
                            <?php _e('Total Shipping:', 'wpsc'); ?>
                        </td>
                        <td class='wpsc_totals'>
                            <span id="checkout_shipping"
                                  class="pricedisplay checkout-shipping"><?php echo wpsc_cart_shipping(); ?></span>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
            -->

                    <?php //this HTML displays activated payment gateways   ?>
                    <?php if (wpsc_gateway_count() > 1): // if we have more than one gateway enabled, offer the user a choice ?>
                        <div class="row">
                            <div class='col-md-12 wpsc_gateway_container'>
                                <h4><?php _e('Payment Type', 'wpsc'); ?></h4>
                                <?php wpsc_gateway_list(); ?>
                            </div>
                        </div>
                    <?php else: // otherwise, there is no choice, stick in a hidden form ?>
                        <div class="row">
                            <div class='col-md-12 wpsc_gateway_container'>
                                <?php wpsc_gateway_hidden_field(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (wpsc_has_tnc()) : ?>
                        <div class="row">
                            <div class='col-md-12'>
                                <label for="agree"><input id="agree" type='checkbox' value='yes'
                                                          name='agree'/> <?php printf(__("I agree to the <a class='thickbox' target='_blank' href='%s' class='termsandconds'>Terms and Conditions</a>", "wpsc"), esc_url(home_url("?termsandconds=true&amp;width=360&amp;height=400"))); ?>
                                    <span class="asterix">*</span></label>
                            </div>
                        </div>
                    <?php endif; ?>
                    <br>

                    <div class='row'>
                        <div class="col-md-12 text-right">
                            <?php if (!wpsc_has_tnc()) : ?>
                                <input type='hidden' value='yes' name='agree'/>
                            <?php endif; ?>
                            <input type='hidden' value='submit_checkout' name='wpsc_action'/>
                            <input type='submit' value='<?php _e('Purchase', 'wpsc'); ?>'
                                   class='make_purchase wpsc_buy_button btn btn-danger btn-lg'/>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
    <form name='change_country' id='calculateShippingForm' action='' method='post'>
        <div style="visibility: hidden;">
            <?php echo wpsc_shipping_country_list(); ?>
        </div>
        <input type='hidden' name='wpsc_update_location' value='true'/>
    </form>
    <!--close checkout_page_container-->
<?php
do_action('wpsc_bottom_of_shopping_cart');