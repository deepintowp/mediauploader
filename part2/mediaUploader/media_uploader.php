<?php 

// Plugin Name: media
function media_meta_scripts_n_styles(){
	global $typenow, $pagenow;
	var_dump($typenow);//post
	var_dump( $pagenow);//post-new.php post.php
	if($typenow == 'post' && ($pagenow = 'post-new.php' || $pagenow = 'post.php' ) ){
		wp_enqueue_style('media-css', plugin_dir_url( __FILE__ ) . 'css/media.css' );
		wp_enqueue_script('media_js', plugin_dir_url( __FILE__ ) . 'js/media.js', array('jquery'), '6.5.2016', true );
		
		
	}
	
	
	
	
}
add_action('admin_enqueue_scripts','media_meta_scripts_n_styles');



function meadia_add_metabox(){
	add_meta_box(
		'meadi_meta_id',
		'Media',
		'meadia_add_metabox_callback',
		'post'
	
	);
}
add_action('add_meta_boxes','meadia_add_metabox');

function meadia_add_metabox_callback(){
	wp_nonce_field(basename(__FILE__), 'media_nonce_name' );
	$value = get_post_meta(get_the_ID());
	
	?>
	<div style="background-image:url(<?php  if($value['media_input_name'][0]){
		echo $value['media_input_name'][0]; } ?>);" class="image_con  <?php if($value['media_input_name'][0]){
			echo 'back-img';
		} ?>" id="image_con"></div>
	<label for="media_input_id"> Media:
		<input type="hidden" id="media_input_id" name="media_input_name" value="<?php if($value){
			echo $value['media_input_name'][0];
		}  ?>" />
	</label>
	<input type="button" id="add_meia" value="Add Media" />
	<input type="button" id="remove_meia" value="Remove Media" />
	<?php
}

function media_save_meta_field(){
	$is_autosave = wp_is_post_autosave(get_the_ID());
	$is_revision = wp_is_post_revision(get_the_ID());
	
	if($is_autosave || $is_revision ){
		return;
	}
	if(!wp_verify_nonce($_POST['media_nonce_name'], basename(__FILE__) )){
				return;
		
	}
	
	if(isset($_POST['media_input_name'])){
		update_post_meta(get_the_ID(), 'media_input_name', $_POST['media_input_name'] );
	}
	
	
}
add_action('save_post','media_save_meta_field');


