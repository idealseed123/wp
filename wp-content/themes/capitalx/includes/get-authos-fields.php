<?php
 function capitalx_get_image_id($url) {
    global $wpdb;
    
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$url'";
    $id = $wpdb->get_var($query);
    return $id;
}   
/*********ADD User Profile Pic*******************/
add_action( 'admin_enqueue_scripts', 'capitalx_profile_enqueue_scripts_styles' );
function capitalx_profile_enqueue_scripts_styles() {
    // Register
    wp_register_style( 'capitalx-user_admin_css', get_template_directory_uri() . '/assets/css/profile.css' , false, '1.0.0', 'all' );
    wp_register_script( 'capitalx-user_admin_js', get_template_directory_uri() . '/assets/js/profile-scripts.js' , array('jquery'), '1.0.0', true );
    
    // Enqueue
    wp_enqueue_style( 'capitalx-user_admin_css' );
    wp_enqueue_script( 'capitalx-user_admin_js' );
}
// Show the new image field in the user profile page.
add_action( 'show_user_profile', 'capitalx_profile_img_fields' );
add_action( 'edit_user_profile', 'capitalx_profile_img_fields' );
function capitalx_profile_img_fields( $user ) {
    if(!current_user_can('upload_files'))
        return false;
    // vars
    $capitalx_profile_url = get_the_author_meta( 'capitalx_profile_meta', $user->ID );
    $capitalx_upload_url = get_the_author_meta( 'capitalx_upload_meta', $user->ID );
    $capitalx_upload_edit_url = get_the_author_meta( 'capitalx_upload_edit_meta', $user->ID );
    if(!$capitalx_upload_url){
        $btn_text = 'Upload New Image';
    } else {
        $capitalx_upload_edit_url = get_home_url().get_the_author_meta( 'capitalx_upload_edit_meta', $user->ID );
        $btn_text = 'Change Current Image';
    }
    ?>
    
    <div id="cupp_container">
    <h3><?php esc_html_e( 'User Profile Photo', 'capitalx' ); ?></h3>
 
    <table class="form-table">
 
        <tr>
            <th><label for="capitalx_profile_url"><?php esc_html_e( 'Profile Photo', 'capitalx' ); ?></label></th>
            <td>
                <!-- Outputs the image after save -->
                <div id="current_img">
                    <?php if($capitalx_upload_url): ?>
                        <img src="<?php echo esc_url( $capitalx_upload_url ); ?>" class="cupp-current-img">
                        <div class="edit_options uploaded">
                            <a class="remove_img"><span><?php esc_html_e('Remove','capitalx');?></span></a>
                            <a href="<?php echo esc_url($capitalx_upload_edit_url); ?>" class="edit_img" target="_blank">
                            <span><?php esc_html_e('Edit','capitalx');?></span></a>
                        </div>
                    <?php elseif($capitalx_profile_url) : ?>
                        <img src="<?php echo esc_url( $capitalx_profile_url ); ?>" class="cupp-current-img">
                        <div class="edit_options single">
                            <a class="remove_img"><span><?php esc_html_e('Remove','capitalx');?></span></a>
                        </div>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.gif') ; ?>" class="cupp-current-img placeholder">
                    <?php endif; ?>
                </div>
                <!-- Select an option: Upload to WPMU or External URL --> 
                <div id="cupp_options">
                    <input type="radio" id="upload_option" name="img_option" value="upload" class="tog" checked="checked" />  
                    <label for="upload_option"><?php esc_html_e('Upload New Image','capitalx')?></label><br>
                   
                </div>
                <!-- Hold the value here if this is a WPMU image -->
                <div id="cupp_upload">
                    <input type="hidden" name="capitalx_placeholder_meta" id="cupp_placeholder_meta" value="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholder.gif') ; ?>" class="hidden" />
                    <input type="hidden" name="capitalx_upload_meta" id="cupp_upload_meta" value="<?php echo esc_url_raw( $capitalx_upload_url ); ?>" class="hidden" />
                    <input type="hidden" name="capitalx_upload_edit_meta" id="cupp_upload_edit_meta" value="<?php echo esc_url_raw( $capitalx_upload_edit_url ); ?>" class="hidden" />
                    <input type='button' class="cupp_wpmu_button button-primary" value="<?php echo sanitize_text_field($btn_text) ;?>" id="uploadimage"/><br />
                </div>  
                <!-- Outputs the text field and displays the URL of the image retrieved by the media uploader -->
                <div id="cupp_external">
                    <input type="text" name="capitalx_profile_meta" id="cupp_meta" value="<?php echo esc_url_raw( $capitalx_profile_url ); ?>" class="regular-text" />
                </div>
                <!-- Outputs the save button -->
                <span class="description"><?php esc_html_e( 'Upload a custom photo for your user profile ', 'capitalx' ); ?></span>
               
            </td>
        </tr>
 
    </table><!-- end form-table -->
</div> <!-- end #cupp_container -->
    <?php wp_enqueue_media(); // Enqueue the WordPress Media Uploader ?>
<?php }
// Save the new user  url.
add_action( 'personal_options_update', 'capitalx_save_img_meta' );
add_action( 'edit_user_profile_update', 'capitalx_save_img_meta' );
function capitalx_save_img_meta( $user_id ) {
    if ( !current_user_can( 'upload_files', $user_id ) )
        return false;
    // If the current user can edit Users, allow this.
    update_user_meta( $user_id, 'capitalx_profile_meta', $_POST['capitalx_profile_meta'] );
    update_user_meta( $user_id, 'capitalx_upload_meta', $_POST['capitalx_upload_meta'] );
    update_user_meta( $user_id, 'capitalx_upload_edit_meta', $_POST['capitalx_upload_edit_meta'] );
}
/**
 * Retrieve the appropriate image size
 */
function get_capitalx_meta( $user_id, $size ) {
    global $post;
    //allow the user to specify the image size
    if (!$size){
        $size = 'thumbnail'; // Default image size if not specified.
    }
    //$size='60';
    if(!$user_id || !is_numeric( $user_id ) ){
    $user_id = $post->post_author; 
    }
    
    // get the custom uploaded image
    $attachment_upload_url = esc_url( get_the_author_meta( 'capitalx_upload_meta', $user_id ) );
    
    // get the external image
    $attachment_ext_url = esc_url( get_the_author_meta( 'capitalx_profile_meta', $user_id ) );
    $attachment_url = '';
    $image_url = '';
    if($attachment_upload_url){
        $attachment_url = $attachment_upload_url;
        
        // grabs the id from the URL using the WordPress function attachment_url_to_postid @since 4.0.0
       // $attachment_id = attachment_url_to_postid( $attachment_url );
        $attachment_id = capitalx_get_image_id($attachment_url);
        // retrieve the thumbnail size of our image
        $image_thumb = wp_get_attachment_image_src( $attachment_id, $size );
       
        $image_url = $image_thumb[0];
       
    } elseif($attachment_ext_url) {
        $image_url = $attachment_ext_url;
    }
    if ( empty($image_url) )
        return;
    // return the image thumbnail
    return $image_url;
}
/**
 * WordPress Avatar Filter
 *
 * Replaces the WordPress avatar with your custom photo using the get_avatar hook.
 */
add_filter( 'get_avatar', 'capitalx_avatar' , 1 , 5 );
function capitalx_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    $id = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        
        $user = get_user_by( 'email', $id_or_email );   
    }
    if ( $user && is_object( $user ) ) {
        $custom_avatar = get_capitalx_meta($id, 'thumbnail');
        if (isset($custom_avatar) && !empty($custom_avatar)) {
            $avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }
    }
    return $avatar;
}
