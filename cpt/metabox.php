<?


add_action('admin_init', 'foo_add_meta_boxes', 1);
function foo_add_meta_boxes() {
	add_meta_box( 'links_proyecto', 'Links', 'foo_links_proyecto', 'proyecto', 'normal', 'default');
}

function foo_links_proyecto() {
}

add_action('save_post', 'foo_links_proyecto_save');
function foo_links_proyecto_save($post_id) {
	if ( ! isset( $_POST['foo_links_proyecto_nonce'] ) ||
	! wp_verify_nonce( $_POST['foo_links_proyecto_nonce'], 'foo_links_proyecto_nonce' ) )
		return;
	
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	
	if (!current_user_can('edit_post', $post_id))
		return;
	
	$old = get_post_meta($post_id, 'links_proyecto', true);
	$new = array();
	//~ $options = foo_get_sample_options();
	
	$names = $_POST['name'];
	$urls = $_POST['url'];
	
	$count = count( $names );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $names[$i] != '' ) :
			$new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
		
			if ( $urls[$i] == 'http://' )
				$new[$i]['url'] = '';
			else
				$new[$i]['url'] = stripslashes( $urls[$i] ); // and however you want to sanitize
		endif;
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'links_proyecto', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'links_proyecto', $old );
}
?>
