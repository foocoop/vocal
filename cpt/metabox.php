<?


add_action('admin_init', 'foo_add_meta_boxes', 1);
function foo_add_meta_boxes() {
	add_meta_box( 'links_proyecto', 'Links', 'foo_links_proyecto', 'proyecto', 'normal', 'default');
}

function foo_links_proyecto() {
	global $post;

	$links_proyecto = get_post_meta($post->ID, 'links_proyecto', true);
	//~ $options = foo_get_sample_options();

	wp_nonce_field( 'foo_links_proyecto_nonce', 'foo_links_proyecto_nonce' );
	?>
	<script type="text/javascript">
	jQuery(document).ready(function( $ ){
		$( '#add-row' ).on('click', function() {
			var row = $( '.empty-row.screen-reader-text' ).clone(true);
			row.removeClass( 'empty-row screen-reader-text' );
			row.insertBefore( '#links_proyecto-one tbody>tr:last' );
			return false;
		});
  	
		$( '.remove-row' ).on('click', function() {
			$(this).parents('tr').remove();
			return false;
		});
	});
	</script>
  
	<table id="links_proyecto-one" width="100%">
	<thead>
		<tr>
			<th width="32%">Name</th>
<!--
			<th width="12%">Select</th>
-->
			<th width="40%">URL</th>
			<th width="8%"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	if ( $links_proyecto ) :
	
	foreach ( $links_proyecto as $field ) {
	?>
	<tr>
		<td><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" /></td>
	

		<td><input type="text" class="widefat" name="url[]" value="<?php if ($field['url'] != '') echo esc_attr( $field['url'] ); else echo 'http://'; ?>" /></td>
	
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php
	}
	else :
	// show a blank one
	?>
	<tr>
		<td><input type="text" class="widefat" name="name[]" /></td>
	

		<td><input type="text" class="widefat" name="url[]" value="http://" /></td>
	
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	<?php endif; ?>
	
	<!-- empty hidden one for jQuery -->
	<tr class="empty-row screen-reader-text">
		<td><input type="text" class="widefat" name="name[]" /></td>
	

		<td><input type="text" class="widefat" name="url[]" value="http://" /></td>
		  
		<td><a class="button remove-row" href="#">Remove</a></td>
	</tr>
	</tbody>
	</table>
	
	<p><a id="add-row" class="button" href="#">Add another</a></p>
<?php
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
