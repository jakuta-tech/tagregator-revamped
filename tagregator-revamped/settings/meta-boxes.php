<?php
//////////////////////////////////////////////////////
// Create MetaBoxes
//////////////////////////////////////////////////////

function tagregator_revamped_add_metaboxes() {
	global $wp_meta_boxes;
	add_meta_box(
		'tagrev_meta',
		'Tag Meta',
		'tagregator_revamped_metaboxes',
		array(
			'tagrev-twitter',
			'tagrev-instagram',
			'tagrev-googleplus',
			'tagrev-flickr',
		),
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'tagregator_revamped_add_metaboxes' );

function tagregator_revamped_metaboxes() {
	global $post;
	$custom = get_post_custom( $post->ID );
	$arr = array(
		'tagrev_meta_id' => 'ID',
		'tagrev_meta_name' => 'Name',
		'tagrev_meta_username' => 'Username',
		'tagrev_meta_profile_url' => 'Profile URL',
		'tagrev_meta_img' => 'Image',
		'tagrev_meta_url' => 'Url',
	);
	?>
	<table id="tagrev-meta">
		<?php
		foreach ( $arr as $key => $item ) {
			$value = isset( $custom[ $key ][0] ) ? $custom[ $key ][0] : '';
			?>
			<tr><td><?php echo $item . ':'; ?></td><td><input name="<?php echo $key; ?>" value="<?php echo $value; ?>"></td></tr>
			<?php
		}
		?>
	</table>
	<?php
}