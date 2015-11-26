			<!-- footer -->
			
			<div class="div-spacer">&nbsp;</div>
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright" style="text-align:center">
					<!--&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.-->
					Privacy Policy | Shipping Policies | Site Map | <a style="color: #006f43;" href="/press/">Press</a> | <a style="color: #006f43;" href="/contact/">Contact</a>
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-69412308-1', 'auto');
		ga('send', 'pageview');

				
		function Ajaxion(theForm) 
		{
			console.log(theForm);
			// we cannot submit a file through AJAX, so this needs to return true to submit the form normally if a file formfield is present
			file_upload_elements = jQuery.makeArray( jQuery( 'input[type="file"]', jQuery( theForm ) ) );
			if(file_upload_elements.length > 0) 
			{
				return true;
			} 
			else 
			{

				var action_buttons = jQuery( 'input[name="wpsc_ajax_action"]', jQuery( theForm ) );

				var action;
				if ( action_buttons.length > 0 ) {
					action = action_buttons.val();
				} else {
					action = 'add_to_cart';
				}

				form_values = jQuery(theForm).serialize() + '&action=' + action;

				// Sometimes jQuery returns an object instead of null, using length tells us how many elements are in the object, which is more reliable than comparing the object to null
				if ( jQuery( '#fancy_notification' ).length === 0 ) {
					jQuery( 'div.wpsc_loading_animation', theForm ).css( 'visibility', 'visible' );
				}

				var success = function( response ) {
					if ( ( response ) ) {
						if ( response.hasOwnProperty('fancy_notification') && response.fancy_notification ) {
							if ( jQuery( '#fancy_notification_content' ) ) {
								jQuery( '#fancy_notification_content' ).html( response.fancy_notification );
								jQuery( '#loading_animation').css( 'display', 'none' );
								jQuery( '#fancy_notification_content' ).css( 'display', 'block' );
							}
						}
						jQuery('div.shopping-cart-wrapper').html( response.widget_output );
						jQuery('div.wpsc_loading_animation').css('visibility', 'hidden');

						jQuery( '.cart_message' ).delay( 3000 ).slideUp( 500 );

						//Until we get to an acceptable level of education on the new custom event - this is probably necessary for plugins.
						if ( response.wpsc_alternate_cart_html ) {
							eval( response.wpsc_alternate_cart_html );
						}

						jQuery( document ).trigger( { type : 'wpsc_fancy_notification', response : response } );
					}

					if ( jQuery( '#fancy_notification' ).length > 0 ) {
						jQuery( '#loading_animation' ).css( "display", 'none' );
					}
				};

				jQuery.post( wpsc_ajax.ajaxurl, form_values, success, 'json' );

				wpsc_fancy_notification(theForm);
				console.log(form_values);
				return false;
			}
		}
		</script>

	</body>
</html>
