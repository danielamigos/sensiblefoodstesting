<?php
global $wp_query;
$image_width = get_option('product_image_width');
$image_height = get_option('product_image_height');
?>
<!-- wpsc-grid_view.php -->

<div id="sociallinks">
    <div class="container">
        <div class="fb-like" data-href="https://www.facebook.com/Blend-LLC-dba-Sensible-Foods-1536550946619716/"
             data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
        &nbsp;
        <a href="https://www.facebook.com/Blend-LLC-dba-Sensible-Foods-1536550946619716/" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/img/fsensiblebuzz.png" alt="SENSIBLE BUZZ">
        </a> &nbsp;
        <a href="https://www.facebook.com/Blend-LLC-dba-Sensible-Foods-1536550946619716/notes" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/img/frecipies.png" alt="SENSIBLE RECIPIES">
        </a>
    </div>
</div>
<!--
<div class="centered-pills shop">
    <?php $menu = wp_get_nav_menu_items(3);
    if (!empty($menu)) {
        wp_nav_menu(
            array(
                'menu' => $menu->ID,
                'container' => 'div',
                'container_class' => 'menu-{menu slug}-container',
                'menu_class' => 'menu',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'items_wrap' => '<ul class="nav nav-pills">%3$s</ul>',
                'depth' => 0,
            )
        );
    }?>
</div>
-->
<div class="product_grid_display">

    <?php wpsc_output_breadcrumbs(); ?>

    <?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>


    <?PHP
    global $wpdb;

    $sql = "SELECT * FROM {$wpdb->posts} WHERE post_type IN('page','post') AND post_content LIKE '%[" . productspage . "]%'";

    $result = $wpdb->get_results($sql);
    $products_page_link = $result[0]->guid;
    ?>
    <div class="container">

        <?php if (wpsc_display_products()) { ?>


        <div class="group">

            <?php if (wpsc_has_pages_top()) { ?>
                <div class="wpsc_page_numbers_top group">
                    <?php wpsc_pagination(); ?>
                </div><!--close wpsc_page_numbers_top-->
            <?php } ?>
            <div class="row">
                <?php while (wpsc_have_products()) {
                wpsc_the_product(); ?>
                <div class="col-md-4">
                    <div class="product_grid_item product_view_<?php echo wpsc_the_product_id(); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <!--
                            <div class="col-md-3 overlay">
                                <a class="quickview-overlay" href="#"
                                   data-title="<?php echo wpsc_the_product_title(); ?>"
                                   data-variation-groups='<?PHP
                                    $variationGroups = array();
                                    while (wpsc_have_variation_groups()) {
                                        wpsc_the_variation_group();
                                        $variationGroup = array('variationGroupId' => wpsc_vargrp_id(), 'variationGroupFormId' => wpsc_vargrp_form_id(), 'variationGroupName' => wpsc_the_vargrp_name());
                                        $variations = array();
                                        while (wpsc_have_variations()) {
                                            wpsc_the_variation();
                                            $variation = array('variationId' => wpsc_the_variation_id(), 'variationOutOfStock' => wpsc_the_variation_out_of_stock(), 'variationName' => wpsc_the_variation_name());
                                            array_push($variations, $variation);
                                        }
                                        $variationGroup['variations'] = $variations;
                                        array_push($variationGroups, $variationGroup);
                                    }
                                    echo json_encode($variationGroups);
                                    ?>'

                                   data-description="<?php //echo wpsc_the_product_description(); ?>"
                                   data-image="<?php echo wpsc_the_product_thumbnail(200); ?>"
                                   data-product-id="<?php echo wpsc_the_product_id(); ?>"
                                   data-this-url="<?php echo wpsc_this_page_url(); ?>"
                                   data-has-stock="<?php echo wpsc_product_has_stock(); ?>"
                                   data-cart-id-key="<?php echo wpsc_the_cart_item_key(); ?>"
                                   data-loading-url="<?php echo wpsc_loading_animation_url(); ?>"
                                   data-price="<?PHP echo wpsc_the_product_price(); ?>"
                                    ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a><br/>
                                <a class="quickview-overlay" href="#"
                                   data-title="<?php echo wpsc_the_product_title(); ?>"
                                   data-variation-groups='<?PHP echo json_encode($variationGroups); ?>'
                                   data-description="<?php //echo wpsc_the_product_description(); ?>"
                                   data-image="<?php echo wpsc_the_product_thumbnail(200); ?>"
                                   data-product-id="<?php echo wpsc_the_product_id(); ?>"
                                   data-this-url="<?php echo wpsc_this_page_url(); ?>"
                                   data-has-stock="<?php echo wpsc_product_has_stock(); ?>"
                                   data-cart-id-key="<?php echo wpsc_the_cart_item_key(); ?>"
                                   data-loading-url="<?php echo wpsc_loading_animation_url(); ?>"
                                   data-price="<?PHP echo wpsc_the_product_price(); ?>">Add to Cart</a>
                            </div>
                            -->
                                    <?php if (wpsc_the_product_thumbnail()) { ?>
                                        <div class="item_image" style="margin-top:20px; margin-bottom:15px;">
                                            <a href="<?php echo wpsc_the_product_permalink(); ?>">
                                                <img style="max-height:300px" class="product_image"
                                                     id="product_image_<?php echo wpsc_the_product_id(); ?>"
                                                     alt="<?php echo wpsc_the_product_title(); ?>"
                                                     src="<?php echo wpsc_the_product_thumbnail(0, 300); ?>"/>
                                            </a>
                                        </div><!--close imte_image-->
                                    <?php } else { ?>
                                        <div class="item_no_image">
                                            <a href="<?php echo wpsc_the_product_permalink(); ?>">
                                                <img class="no-image"
                                                     id="product_image_<?php echo wpsc_the_product_id(); ?>"
                                                     alt="<?php esc_attr_e('No Image', 'wpsc'); ?>"
                                                     title="<?php echo wpsc_the_product_title(); ?>"
                                                     src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png"
                                                     width="<?php echo get_option('product_image_width'); ?>"
                                                     height="<?php echo get_option('product_image_height'); ?>"/>
                                            </a>
                                        </div><!--close item_no_image-->
                                    <?php } ?>
                                </div>

                                <?php if (wpsc_product_on_special()) { ?>
                                    <span class="sale"><?php _e('Sale', 'wpsc'); ?></span>
                                <?php } ?>

                                <?php if (get_option('show_images_only') != 1) { ?>
                                    <div class="col-md-12">
                                        <form class="product_form form-group" enctype="multipart/form-data"
                                              action="<?php echo wpsc_this_page_url(); ?>" method="post"
                                              name="product_<?php echo wpsc_the_product_id(); ?>"
                                              id="product_<?php echo wpsc_the_product_id(); ?>">
                                            <h2 class="prodtitle">
                                                <a href="<?php echo wpsc_the_product_permalink(); ?>"
                                                   title="<?php echo wpsc_the_product_title(); ?>">
                                                    <?php echo wpsc_the_product_title(); ?></a>
                                            </h2>

                                            <?php if ((wpsc_the_product_description() != '') && (get_option('display_description') == 1)) { ?>
                                                <div
                                                    class="grid_description"><?php echo wpsc_the_product_description(); ?></div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="price_container col-md-8">
                                                    <?php wpsc_the_product_price_display(array('output_you_save' => false)); ?>
                                                    <?php if (wpsc_show_pnp()) { ?>
                                                        <p class="pricedisplay"><?php _e('Shipping', 'wpsc'); ?>
                                                            :<span
                                                                class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span>
                                                        </p>
                                                    <?php }
                                                    // end price and shipping
                                                    ?>

                                                    <?php do_action('wpsc_product_form_fields_begin'); ?>
                                                    <input type="hidden"
                                                           value="<?php echo wpsc_the_product_id(); ?>"
                                                           name="product_id"/>

                                                    <?php if (get_option('display_variations') == 1) { ?>
                                                        <?php /** the variation group HTML and loop */ ?>
                                                        <?php if (wpsc_have_variation_groups()) { ?>
                                                            <?php while (wpsc_have_variation_groups()) {
                                                                wpsc_the_variation_group(); ?>
                                                                <select
                                                                    class="form-control wpsc_select_variation"
                                                                    name="variation[<?php echo wpsc_vargrp_id(); ?>]"
                                                                    id="<?php echo wpsc_vargrp_form_id(); ?>">
                                                                    <?php while (wpsc_have_variations()) {
                                                                        wpsc_the_variation();  if(wpsc_the_variation_id()){?>
                                                                        <option
                                                                            value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
                                                                    <?php }} //endwhile; ?>
                                                                </select>
                                                            <?php } //endwhile; ?>
                                                            <?php /** the variation group HTML and loop ends here */ ?>
                                                        <?php } ?>
                                                    <?php }
                                                    // end variations
                                                    ?>

                                                    <?php if (get_option('display_moredetails') == 1) { ?>
                                                        <a href="<?php echo wpsc_the_product_permalink(); ?>"
                                                           class="more_details"><?php esc_html_e('More Details', 'wpsc'); ?></a>
                                                    <?php }
                                                    // more details button?>
                                                </div>
                                                <?php if ((get_option('display_addtocart') == 1) && (get_option('addtocart_or_buynow') != '1')) { ?>
                                                    <div class="col-md-4">
                                                        <?php if (wpsc_product_has_stock()) { ?>
                                                            <?php if (wpsc_has_multi_adding()) { ?>
                                                                <div class="quantity_container">
                                                                    <label class="wpsc_quantity_update"
                                                                           for="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>"><?php _e('Quantity:', 'wpsc'); ?></label>
                                                                    <input type="text"
                                                                           id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>"
                                                                           name="wpsc_quantity_update" size="2"
                                                                           value="1"/>
                                                                    <input type="hidden" name="key"
                                                                           value="<?php echo wpsc_the_cart_item_key(); ?>"/>
                                                                    <input type="hidden" name="wpsc_update_quantity"
                                                                           value="true"/>
                                                                    <input type='hidden' name='wpsc_ajax_action'
                                                                           value='wpsc_update_quantity'/>
                                                                </div><!--close quantity_container-->
                                                                <?php
                                                            }
                                                            if (get_option('display_variations') != 1 && wpsc_product_has_variations(wpsc_the_product_id())) {
                                                                ?>
                                                                <a href="<?php echo esc_url(wpsc_the_product_permalink()); ?>"
                                                                   class="wpsc_buy_button"><?php _e('View Product', 'wpsc') ?></a>
                                                                <?php
                                                            } else {
                                                                ?>

                                                                <input type="hidden" value="add_to_cart"
                                                                       name="wpsc_ajax_action"/>
                                                                <input type="submit"
                                                                       value="<?php _e('Buy', 'wpsc'); ?>"
                                                                       name="Buy" class="add-cart btn btn-lg orange-bg"
                                                                       id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>

                                                                <!--
                                                        <a href="<?php echo wpsc_the_product_permalink(); ?>"
                                                           class="add-cart btn btn-lg orange-bg"
                                                           title="<?php echo wpsc_the_product_title(); ?>">
                                                            <?php _e('Buy', 'wpsc'); ?>
                                                        </a>
                                                                -->
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <p class="soldout"><?php _e('Sorry, sold out!', 'wpsc'); ?></p>
                                                        <?php } ?>

                                                        <div class="wpsc_loading_animation">
                                                            <img title="<?php esc_attr_e('Loading', 'wpsc'); ?>"
                                                                 alt="<?php esc_attr_e('Loading', 'wpsc'); ?>"
                                                                 src="<?php echo wpsc_loading_animation_url(); ?>"/>
                                                            <?php _e('Updating cart...', 'wpsc'); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php do_action('wpsc_product_form_fields_end'); ?>
                                        </form>
                                    </div>
                                    <div class="col-md-12 ingredients">
                                        <?php echo wpsc_the_product_additional_description(); ?>
                                    </div>
                                    <div class="col-md-6"><a href="<?php echo wpsc_the_product_permalink(); ?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/facts.png" style="vertical-align: top">
                                            <?php _e('Nutrition Facts', 'wpsc') ?>
                                        </a></div>
                                    <div class="col-md-6"><a href="/recipes/">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/recipies.png" style="vertical-align: top">
                                            <?php _e('Recipies with sensible', 'wpsc') ?>
                                        </a>
                                    </div>


                                    <?php if ((get_option('display_addtocart') == 1) && (get_option('addtocart_or_buynow') == '1')) { ?>
                                        <?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
                                    <?php } ?>

                                <?php } else { ?>
                                    <div class="grid_product_info">
                                        <h2 class="prodtitle"><a href="<?php echo wpsc_the_product_permalink(); ?>"
                                                                 title="<?php echo wpsc_the_product_title(); ?>"><?php echo wpsc_the_product_title(); ?></a>
                                        </h2>
                                    </div>
                                <?PHP } ?>
                            </div>
                        </div>
                    </div>
                    <!--close product_grid_item-->
                </div>
                <!--close col-md-3 -->


                <?php if ((get_option('grid_number_per_row') > 0) && ((($wp_query->current_post + 1) % get_option('grid_number_per_row')) == 0)) { ?>
            </div>
            <div class="row">
                <?php } ?>


                <?php } //endwhile; ?>

            </div>
            <!-- end row -->

            <?php if (wpsc_product_count() == 0) { ?>
                <p><?php _e('There are no products in this group.', 'wpsc'); ?></p>
            <?php } ?>

            <?php if (wpsc_has_pages_bottom()) { ?>
                <div class="wpsc_page_numbers_bottom group">
                    <?php wpsc_pagination(); ?>
                </div><!--close wpsc_page_numbers_bottom-->
            <?php } ?>
        </div>
        <!--close product_grid_display-->
    </div>
    <!-- end container-fluid -->

<?php } ?>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            $('.overlay').hover(function () {
                $(this).stop();
                $(this).fadeTo(400, 1);
            }, function () {
                $(this).stop();
                $(this).fadeTo(400, 0);
            });

            $('.quickview-overlay').click(function (event) {
                var $groups = $('<div></div>', {'class': 'wpsc_variation_forms'});
                var variationGroups = JSON.parse($(this).attr('data-variation-groups'));
                $.each(variationGroups, function (index, variationGroup) {
                    var $group = $('<div></div>', {'class': 'validation-group'}).append($('<label></label>', {'for': variationGroup.variationGroupFormId}).append(variationGroup.variationGroupName));
                    var $select = $('<select></select>', {
                        'class': 'wpsc_select_variation',
                        'name': 'variation[' + variationGroup.variationGroupId + ']',
                        'id': variationGroup.variationGroupFormId
                    });
                    $.each(variationGroup.variations, function (index2, variation) {
                        $select.append($('<option></option>', {'value': variation.variationId}).append(variation.variationName));
                    });
                    $group.append($select);
                    $groups.append($group);
                });
                //$variation = array('variationId'=>wpsc_the_variation_id(),'variationOutOfStock'=>wpsc_the_variation_out_of_stock(),'variationName'=>wpsc_the_variation_name());
                event.preventDefault();
                bootbox.dialog({
                    className: "quickview-modal",
                    title: "<span class='quickview-title-product-name'>" + $(this).attr('data-title') + "</span> Crunch Dried Fruit",
                    message: "<div class='containter-fluid'><div class='row'><div class='col-md-6'><img src='" + $(this).attr('data-image') + "'></div>" +
                    "<div class='col-md-6'><div style='text-align:left'>" +
                    $(this).attr('data-description') + '<br>' + $(this).attr('data-price') +
                    '<form class="product_form"  enctype="multipart/form-data" action="' + $(this).attr('data-this-url') + '" method="post" name="product_' + $(this).attr('data-product-id') + '" id="product_' + $(this).attr('data-product-id') + '" onSubmit="return Ajaxion(this);">' +
                    '<input type="hidden" value="' + $(this).attr('data-product-id') + '" name="product_id"/>' + $groups.html() +
                    '<div class="quantity_container">' +
                    '<label class="wpsc_quantity_update" for="wpsc_quantity_update_' + $(this).attr('data-product-id') + '">Quantity: </label>' +
                    '<input type="text" id="wpsc_quantity_update_' + $(this).attr('data-product-id') + '" name="wpsc_quantity_update" size="2" value="1" />' +
                    '<input type="hidden" name="key" value="' + $(this).attr('data-cart-id-key') + '"/>' +
                    '<input type="hidden" name="wpsc_update_quantity" value="true" />' +
                    '<input type="hidden" name="wpsc_ajax_action" value="wpsc_update_quantity" />' +
                    '</div>' +
                    '<div class="wpsc-add-to-cart-button" >' +
                    '<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>' +
                    '<input type="submit" value="Add To Cart" name="Buy" class="wpsc_buy_button btn btn-danger btn-lg" id="product_' + $(this).attr('data-product-id') + '_submit_button"/>' +
                    '</div>' +
                    '<div class="wpsc_loading_animation">' +
                    '<img title="Loading" alt="Loading" src="' + $(this).attr('data-loading-url') + '" />' +
                    'Updating cart...' +
                    '</div>' +
                    "</form></div></div></div></div>",

                });
            });
        });


    </script>

    <?php do_action('wpsc_theme_footer'); ?>

</div><!--close grid_view_products_page_container-->
