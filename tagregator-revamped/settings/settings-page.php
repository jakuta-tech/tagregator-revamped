<?php
//////////////////////////////////////////////////////
// Settings Page
//////////////////////////////////////////////////////

function tagregator_revamped_settings_page()
{
	?>
	<div class="wrap">
		<form method="post" action="options.php">
			<?php
			settings_fields( 'tagregator_revamped_options' );
			?>
			<h1>Tagregator Revamped</h1>
			<div id="dashboard-widgets-wrap">
				<div id="dashboard-widgets" class="metabox-holder">
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<div id="twitter-settings" class="postbox">
								<div class="inside">
									<div class="main">
										<div id="minor-publishing-actions" style="text-align:left;">
											<?php
											do_settings_sections( 'tagregator_revamped_twitter' );
											?>
											<p>Get your API Key & Secret at
												<a href="<?php echo TAGREGATOR_REVAMPED_TWITTER_DEV_PORTAL; ?>">Twitter's
													developer portal</a>.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<div id="flickr-settings" class="postbox">
								<div class="inside">
									<div class="main">
										<div id="minor-publishing-actions" style="text-align:left;">
											<?php
											do_settings_sections( 'tagregator_revamped_instagram' );
											?>
											<p>Instructions:</p>
											<p>1. You can obtain the Client ID &amp; Secret by logging into
												<a href="https://www.instagram.com/developer/">Instagram's developer
													portal</a>, and registering a new client. Copy them to the
												fields above and click <strong>'Save'</strong>.</p>
											<p></p>
											<p>2. Copy the Redirect URL from the field above and paste it in your
												<strong>Valid redirect URIs</strong> field in your Instagram API Client
												Settings.</p>
											<p></p>
											<p>3. <a href="" id="get_access_token">Click here to get your Access
													Token!</a> - After the Access Token is in the field please click
												<strong>'Save'</strong>.</p>
											<p></p>
											<p><strong>Note:</strong> Sandbox mode will retrieve your account's
												posts ignoring the #hashtag. Non-sandbox will retrieve the latest
												hashtags posts from all instagram as long as there is permission for
												'public_content' in your client.</p>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<div id="flickr-settings" class="postbox">
								<div class="inside">
									<div class="main">
										<div id="minor-publishing-actions" style="text-align:left;">
											<?php
											do_settings_sections( 'tagregator_revamped_googleplus' );
											?>
											<p>Get your API Key at
												<a href="<?php echo TAGREGATOR_REVAMPED_GOOGLEPLUS_DEV_PORTAL; ?>">Google
													Developers Console</a>.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<div id="flickr-settings" class="postbox">
								<div class="inside">
									<div class="main">
										<div id="minor-publishing-actions" style="text-align:left;">
											<?php
											do_settings_sections( 'tagregator_revamped_flickr' );
											?>
											<p>Get your API Key at
												<a href="<?php echo TAGREGATOR_REVAMPED_FLICKR_DEV_PORTAL; ?>">the App
													Garden</a>.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="submit" name="save" id="save" class="button button-primary button-large" value="Save"/>
		</form>
	</div>
	<?php

	$tr_insta_options = get_option( 'tagregator_revamped_options', array() );
	$access_token = '';
	$insta_client_id = '';

	if ( ! empty( $tr_insta_options ) ) {
		$insta_client_id = $tr_insta_options['tagregator_revamped_instagram_client_id'];
		$insta_client_secret = $tr_insta_options['tagregator_revamped_instagram_client_secret'];
		$insta_redirect_url = $tr_insta_options['tagregator_revamped_instagram_redirect_url'];
		$insta_access_token = $tr_insta_options['tagregator_revamped_instagram_access_token'];
	}

	if ( ! empty( $_GET['code'] ) ) {
		$instagram_code = sanitize_text_field( $_GET['code'] );
	} else {
		$instagram_code = '';
	}

	if ( $instagram_code !== '' && $insta_access_token === '' ) {
		$response = wp_remote_post(
			TAGREGATOR_REVAMPED_INSTAGRAM_API_TOKEN,
			array(
				'method' => 'POST',
				'timeout' => 45,
				'body' => array(
					'client_id' => $insta_client_id,
					'client_secret' => $insta_client_secret,
					'grant_type' => 'authorization_code',
					'redirect_uri' => $insta_redirect_url,
					'code' => $instagram_code,
				),
			)
		);

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
		} else {
			$decode_response = json_decode( $response['body'], true );
			$access_token = $decode_response['access_token'];
		}

		if ( $access_token != '' ) {
			?>
			<script>
				(function ( $ ) {
					$( document ).ready( function () {
						$( '#tagregator_revamped_instagram_access_token' ).val( '<?php echo $access_token; ?>' );
					} );
				})( jQuery );
			</script>
			<?php
		}
	}
	?>
	<script>
		(function ( $ ) {
			$( document ).ready( function () {
				$( '#tagregator_revamped_instagram_redirect_url' ).val( window.location.href );
				<?php if ( $insta_client_id != '' ) { ?>
				$( '#get_access_token' ).attr('href', 'https://www.instagram.com/oauth/authorize/?client_id=<?php echo $insta_client_id; ?>&redirect_uri=<?php echo $insta_redirect_url; ?>&response_type=code');
				<?php } ?>
			} );
		})( jQuery );
	</script>
<?php
} // end tagregator_revamped_settings_page
?>
