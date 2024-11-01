<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* 
Plugin Name: WP Conference
Plugin URI: https://www.ablion.com/blog/wordpress-conference-plugin/
Description: WP Conference Plugin. Use shortcode [conferenceoverview conferenceid="XX" view="alongside"] to get an overview of a conference. 'conferenceid' must be set to the target conference's id; 'view' must be set to 'alongside' or 'tabbed' to get 'side by side' or 'tab' view of the tracks respectively; Use shortcode [speakeroverview conferenceid="XX"] to get the list of the speakers of a conference. 'conferenceid' must be set to the target conference's id;
Author: ABLION
Author URI: https://www.ablion.com
Version: 1.2
*/

function wcp_create_PostTypes() {
    
    /// Speaker post type
    $labels = array(
            'name'               => _x( 'Speakers', 'post type general name', 'your-plugin-textdomain' ), /// Post type page main title
            'singular_name'      => _x( 'Speaker', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Speakers', 'admin menu', 'your-plugin-textdomain' ), /// On admin menu
            'name_admin_bar'     => _x( 'Speakers', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Add New', 'New speaker', 'your-plugin-textdomain' ), /// Admin sub menu
            'add_new_item'       => __( 'Add New Speaker', 'your-plugin-textdomain' ), /// Add new page's title
            'new_item'           => __( 'New speaker', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit speaker', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View speaker', 'your-plugin-textdomain' ),
            'all_items'          => __( 'All speakers', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Search speakers', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent speaker', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No speaker found', 'your-plugin-textdomain' ), /// If no team member found
            'not_found_in_trash' => __( 'No speaker found in trash', 'your-plugin-textdomain' ),
    );

    $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'speaker' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-universal-access',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes'),            
            //'taxonomies'         => array( 'category' )
    );

    register_post_type( 'speaker', $args );
    
    /// Session post type 
    $labels = array(
            'name'               => _x( 'Sessions', 'post type general name', 'your-plugin-textdomain' ), /// Post type page main title
            'singular_name'      => _x( 'Session', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Sessions', 'admin menu', 'your-plugin-textdomain' ), /// On admin menu
            'name_admin_bar'     => _x( 'Sessions', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Add New', 'New session', 'your-plugin-textdomain' ), /// Admin sub menu
            'add_new_item'       => __( 'Add New Session', 'your-plugin-textdomain' ), /// Add new page's title
            'new_item'           => __( 'New session', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit session', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View session', 'your-plugin-textdomain' ),
            'all_items'          => __( 'All sessions', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Search sessions', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent session', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No session found', 'your-plugin-textdomain' ), /// If no team member found
            'not_found_in_trash' => __( 'No session found in trash', 'your-plugin-textdomain' ),
    );

    $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'session' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-universal-access',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes'),            
            //'taxonomies'         => array( 'category' )
    );

    register_post_type( 'session', $args );
    
    /// Conference post type 
    $labels = array(
            'name'               => _x( 'Conferences', 'post type general name', 'your-plugin-textdomain' ), /// Post type page main title
            'singular_name'      => _x( 'Conference', 'post type singular name', 'your-plugin-textdomain' ),
            'menu_name'          => _x( 'Conferences', 'admin menu', 'your-plugin-textdomain' ), /// On admin menu
            'name_admin_bar'     => _x( 'Conferences', 'add new on admin bar', 'your-plugin-textdomain' ),
            'add_new'            => _x( 'Add New', 'New conference', 'your-plugin-textdomain' ), /// Admin sub menu
            'add_new_item'       => __( 'Add New Conference', 'your-plugin-textdomain' ), /// Add new page's title
            'new_item'           => __( 'New conference', 'your-plugin-textdomain' ),
            'edit_item'          => __( 'Edit conference', 'your-plugin-textdomain' ),
            'view_item'          => __( 'View conference', 'your-plugin-textdomain' ),
            'all_items'          => __( 'All conferences', 'your-plugin-textdomain' ),
            'search_items'       => __( 'Search conferences', 'your-plugin-textdomain' ),
            'parent_item_colon'  => __( 'Parent conference', 'your-plugin-textdomain' ),
            'not_found'          => __( 'No conference found', 'your-plugin-textdomain' ), /// If no team member found
            'not_found_in_trash' => __( 'No conference found in trash', 'your-plugin-textdomain' ),
    );

    $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => false,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'conference' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-universal-access',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes'),            
            //'taxonomies'         => array( 'category' )
    );

    register_post_type( 'conference', $args );
}

register_activation_hook(__FILE__,'wcp_create_PostTypes'); /// Hook the function when the pugin gets activated

add_action( 'init', 'wcp_create_PostTypes' );

/// Custom speaker columns on speaker post type list
function wcp_speaker_columns_Heads( $columns ) {
    
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Full Name',             
        'sorting_name' => 'Sorting Name',                
        'date' => 'Date'
    );
    return $columns;
}

add_filter('manage_speaker_posts_columns' , 'wcp_speaker_columns_Heads');

function wcp_speaker_columns_Contents($column_name, $post_id) {
    
    echo get_post_meta( $post_id, $column_name, true ); 
}

add_action('manage_speaker_posts_custom_column', 'wcp_speaker_columns_Contents', 10, 2);

function wcp_speaker_sortable_Columns( $columns ) {
    
    $columns['sorting_name'] = 'sorting_name';
    return $columns;
}

add_filter( 'manage_edit-speaker_sortable_columns', 'wcp_speaker_sortable_Columns' );

/// Custom session columns on session post type list
function wcp_session_columns_Heads( $columns ) {
    
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',             
        'session_conference_name' => 'Conference',                
        'date' => 'Date'
    );
    return $columns;
}

add_filter('manage_session_posts_columns' , 'wcp_session_columns_Heads');

function wcp_session_columns_Contents($column_name, $post_id) {
    
    if ($column_name == 'session_conference_name') {
        $session_postmeta = get_post_meta($post_id);
        $conference_details = get_post($session_postmeta['session_conference'][0]);
        echo $conference_details->post_title; 
    } else {
        echo get_post_meta( $post_id, $column_name, true ); 
    }
}

add_action('manage_session_posts_custom_column', 'wcp_session_columns_Contents', 10, 2);

function wcp_session_sortable_Columns( $columns ) {
    
    $columns['session_conference_name'] = 'session_conference_name';
    return $columns;
}

add_filter( 'manage_edit-session_sortable_columns', 'wcp_session_sortable_Columns' );

/// Custom conference columns on conference post type list
function wcp_conference_columns_Heads( $columns ) {
    
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Conference Name',             
        'conference_id' => 'Conference Id',                
        'date' => 'Date'
    );
    return $columns;
}

add_filter('manage_conference_posts_columns' , 'wcp_conference_columns_Heads');

function wcp_conference_columns_Contents($column_name, $post_id) {
    
    if ($column_name == 'conference_id') {
        echo $post_id; 
    } else {
        echo get_post_meta( $post_id, $column_name, true ); 
    }
}

add_action('manage_conference_posts_custom_column', 'wcp_conference_columns_Contents', 10, 2);

add_action( 'pre_get_posts', 'manage_wp_posts_be_qe_pre_get_posts', 1 );
function manage_wp_posts_be_qe_pre_get_posts( $query ) {

   /**
    * We only want our code to run in the main WP query
    * AND if an orderby query variable is designated.
    */
   if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {

      switch( $orderby ) {

         // If we're ordering by 'film_rating'
         case 'sorting_name':

            // set our query's meta_key, which is used for custom fields
            $query->set( 'meta_key', 'sorting_name' );
				            
            $query->set( 'orderby', 'meta_value' );
				
            break;
        case 'session_conference_name':

            // set our query's meta_key, which is used for custom fields
            $query->set( 'meta_key', 'session_conference_name' );
				            
            $query->set( 'orderby', 'meta_value' );
				
            break;

      }

   }

}

function wcp_admin_MainMenu() { /// Create menu and submenu items

    /// Add menu item
    /// Parameters : $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position
    add_menu_page(__('Conferences'),'WP Conference', 8,'edit.php?post_type=conference', NULL, 'dashicons-groups');

    /// Add sub menu item 
    /// Parameters : $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function    
    add_submenu_page( 'edit.php?post_type=conference', 'Conferences', 'Conferences', 8, 'edit.php?post_type=conference', NULL );
    add_submenu_page( 'edit.php?post_type=conference', 'Sessions', 'Sessions', 8, 'edit.php?post_type=session', NULL );
    add_submenu_page( 'edit.php?post_type=conference', 'Speakers', 'Speakers', 8, 'edit.php?post_type=speaker', NULL );        
}

add_action('admin_menu', 'wcp_admin_MainMenu'); /// Hook the function with admin menu

function wcp_plugin_ui_enqueue_Scripts() {
    
    // Load jQuery
    if ( !is_admin() ) {
       //wp_deregister_script('jquery');   
    }
    
    /// Add css files       
    wp_register_style('style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_style('style');
    
    wp_register_style('media', plugin_dir_url(__FILE__) . 'css/media.css');
    wp_enqueue_style('media');
    
    wp_register_style('bootstrap-min', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-min');
    
    wp_register_style('bootstrap-theme-min', plugin_dir_url(__FILE__) . 'css/bootstrap-theme.min.css');
    wp_enqueue_style('bootstrap-theme-min');    
    
    /// Add js files          
    wp_enqueue_script('jquery'); 
            
    wp_register_script('bootstrap-min', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', null);
    wp_enqueue_script('bootstrap-min');          
}

add_action( 'wp_enqueue_scripts', 'wcp_plugin_ui_enqueue_Scripts' );

function wcp_load_admin_ScriptsAndStyles() {
    
    // Styles
    wp_enqueue_style('thickbox');
    
    wp_register_style('jquery-ui', plugin_dir_url(__FILE__) . 'css/jquery-ui.css');
    wp_enqueue_style('jquery-ui');
    
    wp_register_style('jquery-timepicker', plugin_dir_url(__FILE__) . 'css/jquery.timepicker.css');
    wp_enqueue_style('jquery-timepicker');
    
    // Scripts
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');            
    
    wp_register_script('jquery-timepicker', plugin_dir_url(__FILE__) . 'js/jquery.timepicker.js', null);
    wp_enqueue_script('jquery-timepicker');
    
    if ( 'session' == get_post_type() ) {
        wp_register_script('custom', plugin_dir_url(__FILE__) . 'js/custom.js', null);
        wp_enqueue_script('custom'); 
    } 
}

add_action( 'admin_enqueue_scripts', 'wcp_load_admin_ScriptsAndStyles' );

function wcp_load_admin_MetaBoxes() {                
                
    add_meta_box("wcp_speaker_speaker_info", "Speaker Info", "wcp_speaker_info_MetaBox", "speaker", "normal", "high");
    add_meta_box("wcp_speaker_social_media", "Social Media", "wcp_speaker_social_media_MetaBox", "speaker", "normal", "high");    
    add_meta_box("wcp_speaker_homepage_flag", "Show On Homepage", "wcp_speaker_homepage_MetaBox", "speaker", "side", "low");
    
    add_meta_box("wcp_session_speakers", "Speakers", "wcp_session_speakers_MetaBox", "session", "normal", "high");
    add_meta_box("wcp_session_session_info", "Session Info", "wcp_session_info_MetaBox", "session", "normal", "high");  
    add_meta_box("wcp_session_conference", "Conferences", "wcp_session_conference_MetaBox", "session", "side", "low"); 
    add_meta_box("wcp_session_break", "'Break' Type Session", "wcp_session_break_MetaBox", "session", "side", "low"); 
    add_meta_box("wcp_session_hide_track", "Hide Track Details", "wcp_session_hide_track_MetaBox", "session", "side", "low"); 
    
    add_meta_box("wcp_conference_tracks", "Tracks", "wcp_conference_tracks_MetaBox", "conference", "normal", "high");
    add_meta_box("wcp_conference_conference_speakers", "Speakers", "wcp_conference_speakers_MetaBox", "conference", "side", "low");
    add_meta_box("wcp_conference_break_bgcolor", "Color Code For Breaks", "wcp_break_bgcolor_MetaBox", "conference", "side", "low");                
}

add_action("admin_init", "wcp_load_admin_MetaBoxes");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Speaker meta boxes
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function wcp_speaker_info_MetaBox(){
    global $post;
    
    echo '<input type="hidden" name="mytheme_meta_box_nonce" id="mytheme_meta_box_nonce" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    $sorting_name = get_post_meta($post->ID, 'sorting_name', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="sorting_name">Sorting Name</label></div>'
       . '<div><input type="text" name="sorting_name" id="sorting_name" value="' . $sorting_name . '" /></div>';
    
    $job_title = get_post_meta($post->ID, 'job_title', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="job_title">Job Title</label></div>'
       . '<div><input type="text" name="job_title" id="job_title" value="' . $job_title . '" /></div>';
       
    $company_name = get_post_meta($post->ID, 'company_name', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="company_name">Company Name</label></div>'
       . '<div><input type="text" name="company_name" id="company_name" value="' . $company_name . '" /></div>';
    
    $company_logo = get_post_meta($post->ID,'company_logo', true); ?>
    <div style="width:100%; margin-top:12px; font-weight:bold;"><label for="company_logo">Company Logo</label></div>
    <div>
        <input id="company_logo" name="company_logo" type="text" value="<?php echo $company_logo;?>"  style="width:400px;" />
        <input id="my_upl_button" type="button" value="Upload Image" /><br/>
        <img src="<?php echo $company_logo;?>" style="max-width:200px;" id="picsrc" />
        <script type="text/javascript">
            var $ =jQuery.noConflict();
            $(document).ready(function() {            
                $('#my_upl_button').click(function() {
                    window.send_to_editor = function(html) {
                        imgurl = $(html).attr('src')
                        $('#company_logo').val(imgurl);
                        $('#picsrc').attr("src",imgurl);
                        tb_remove();
                    }
                    formfield = $('#company_logo').attr('name');
                    tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
                    return false;
                });
            });
        </script>
    </div>
<?php
    
    $phone = get_post_meta($post->ID, 'phone', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="phone">Phone</label></div>'
       . '<div><input type="text" name="phone" id="phone" value="' . $phone . '" /></div>';
    
    $email = get_post_meta($post->ID, 'email', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="email">E-Mail</label></div>'
       . '<div><input type="text" name="email" id="email" value="' . $email . '" /></div>';
    
    $website = get_post_meta($post->ID, 'website', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="website">Website</label></div>'
       . '<div><input type="text" name="website" id="website" value="' . $website . '" /></div>';       
}

function wcp_speaker_social_media_MetaBox() {    
    global $post;
    
    $social_medias = array('Facebook', 'Google Plus', 'Instagram', 'LinkedIn', 'Picasa', 'Pinterest', 'RSS', 'Tumblr', 'Twitter', 'Youtube');
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="add_social_media">Add Social Media</label></div>'
       . '<div>'
            . '<select name="add_social_media" id="add_social_media">';
                foreach($social_medias as $media) {
                    echo '<option value="'.$media.'">'.$media.'</option>';
                }
         echo '</select>'
       . '</div>'
       . '<span class="add_social"><button type="button" class="button button-primary button-small" style="margin-top: 10px;">ADD</button></span>';
    
    echo '<div id="meta_inner_social" style="margin-top:10px;">';
    
    $social_medias = get_post_meta($post->ID,'social_medias',true);

    $c = 0;
    if ( count( $social_medias ) > 0 ) {
        if(is_array($social_medias)){
            foreach( $social_medias as $sc_item ) {
                foreach($sc_item as $key => $value) {
                    echo '<div style="margin-bottom:5px;">  
                             <label style="width:100px;display:inline-block;">'.$key.'</label><input type="text" name="social_medias['.$c.']['.$key.']" value="'.$value.'" style="margin:0px 15px"/>      
                             <span class="remove_social" style="display:inline-block;position:relative;top:6px;"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span> 
                          </div>';                    
                    $c = $c +1;                    
                }
            }      
        }
    }        
    ?>
    <script type="text/javascript">
        var $ =jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
                        
            $(".add_social").on("click",function() {
                var text = $("#add_social_media option:selected").text();
                count = count + 1;

                $('#meta_inner_social').append(
                '<div style="margin-bottom:5px;">\n\
                    <label style="width:100px;display:inline-block;">'+text+'</label><input type="text" name="social_medias['+count+']['+text+']" value="" style="margin:0px 15px"/>\n\
                    <span class="remove_social" style="display:inline-block;position:relative;top:6px;"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span>\n\
                 </div>');
                return false;
            });
            $(".remove_social").live('click', function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div>
    <?php
}

function wcp_speaker_homepage_MetaBox() {
    global $post;
    
    $home = get_post_meta($post->ID, 'homepage_show', true);    
                            
    $checked = '';
    if(isset($home) AND $home == 1) {         
        $checked = 'checked="checked"';        
    }
    echo '<p><label><input type="checkbox" name="homepage_show" value="1" '.$checked.'/>Check here to show this speaker on homepage</label></p>'; 
}

add_action('save_post', 'wcp_save_Speaker'); 

function wcp_save_Speaker(){
    global $post;
    
    /// Verify this came from the our screen and with proper authorization,
    /// because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['mytheme_meta_box_nonce'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
    
    /// Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }

    $speaker_data['sorting_name'] = sanitize_text_field($_POST['sorting_name']);
    $speaker_data['job_title'] = sanitize_text_field($_POST['job_title']);
    $speaker_data['company_name'] = sanitize_text_field($_POST['company_name']);
    $speaker_data['company_logo'] = esc_url_raw($_POST['company_logo']);
    $speaker_data['phone'] = sanitize_text_field($_POST['phone']);
    $speaker_data['email'] = sanitize_email($_POST['email']);
    $speaker_data['website'] = esc_url_raw($_POST['website']);
    $speaker_data['social_medias'] = isset( $_POST['social_medias'] ) ? (array) $_POST['social_medias'] : array();
    //$speaker_data['session'] = $_POST['session'];
    $speaker_data['homepage_show'] = sanitize_text_field($_POST['homepage_show']);
    $speaker_data['my_image_URL'] = esc_url_raw($_POST['my_image_URL']);
                
    if ( get_post_type() == 'speaker' ) {
        
        foreach ($speaker_data as $key => $value) {
            
            /// Don't store custom data twice
            if( $post->post_type == 'revision' ) return;
            
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            
            if(!$value) delete_post_meta($post->ID, $key);
        }
    }        
}
/// End of speaker meta boxes ///////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Session meta boxes
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function wcp_session_speakers_MetaBox() {    
    global $post;
           
    echo '<input type="hidden" name="mytheme_meta_box_nonce2" id="mytheme_meta_box_nonce2" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    $speakers = get_posts(array('post_type'=> 'speaker', 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));       
    if(!empty($speakers)) {        
        echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="session_speaker">Select Speakers</label></div>'
           . '<div>'
                . '<select name="add_session_speaker" id="add_session_speaker">';
                        foreach($speakers as $speaker) {                             
                            echo '<option value="'.$speaker->ID.'">'.$speaker->post_title.'</option>';
                        }
             echo '</select>'
           . '</div>'
           . '<span class="add_speaker"><button type="button" class="button button-primary button-small" style="margin-top: 10px;">ADD</button></span>';
    
    echo '<div id="meta_inner_session" style="margin-top:10px;">';
    
    $session_speakers = get_post_meta($post->ID,'session_speakers',true);

    $c = 0;
    if ( count( $session_speakers ) > 0 ) {
        if(is_array($session_speakers)){
            foreach( $session_speakers as $speaker ) {  
                $checked = '';
                if(isset($speaker['moderator'])) {
                    $checked = 'checked="checked"';
                }
                echo '<div class="speaker_container" style="margin-bottom:10px;border:1px solid #eee;padding: 6px 6px 10px;">  
                         <label style="width:50%;display:inline-block;">'.$speaker['speaker_name'].'</label>
                         <input type="hidden" name="session_speakers['.$c.'][speaker_id]" value="'.$speaker['speaker_id'].'" style="margin:0px 15px"/> 
                         <input type="hidden" name="session_speakers['.$c.'][speaker_name]" value="'.$speaker['speaker_name'].'" style="margin:0px 15px"/> 
                         <label><input type="checkbox" name="session_speakers['.$c.'][moderator]" value="'.$speaker['speaker_id'].'" '.$checked.'/>Moderator</label>&nbsp;&nbsp;&nbsp;&nbsp;
                         <span class="remove_speaker"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span> 
                      </div>';                    
                $c = $c +1;                                    
            }      
        }
    }        
    ?>
    <script type="text/javascript">
        var $ =jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
                        
            $(".add_speaker").on("click",function() {
                var text = $("#add_session_speaker option:selected").text();
                var value = $("#add_session_speaker option:selected").val();
                count = count + 1;

                $('#meta_inner_session').append(
                '<div class="speaker_container" style="margin-bottom:10px;border:1px solid #eee;padding: 6px 6px 10px;">\n\
                    <label style="width:50%;display:inline-block;">'+text+'</label>\n\
                    <input type="hidden" name="session_speakers['+count+'][speaker_id]" value="'+value+'" style="margin:0px 15px" />\n\
                    <input type="hidden" name="session_speakers['+count+'][speaker_name]" value="'+text+'" style="margin:0px 15px" />\n\
                    <label><input type="checkbox" name="session_speakers['+count+'][moderator]" value="'+value+'"/>Moderator</label>&nbsp;&nbsp;&nbsp;&nbsp;\n\
                    <span class="remove_speaker"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span>\n\
                 </div>');
                return false;
            });
            $(".remove_speaker").live('click', function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div>
    <?php
    }
}

function wcp_session_info_MetaBox(){
    global $post;
    
    $session_date = get_post_meta($post->ID, 'session_date', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="session_date">Session Date</label></div>'
       . '<div><input type="text" name="session_date" id="session_date" value="' . $session_date . '" /></div>';
       
    $session_start_time = get_post_meta($post->ID, 'session_start_time', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="session_start_time">Session Start Time</label></div>'
       . '<div><input type="text" name="session_start_time" id="session_start_time" value="' . $session_start_time . '" /></div>';
    
    $session_end_time = get_post_meta($post->ID, 'session_end_time', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="session_end_time">Session End Time</label></div>'
       . '<div><input type="text" name="session_end_time" id="session_end_time" value="' . $session_end_time . '" /></div>';
    
    $session_location = get_post_meta($post->ID, 'session_location', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="session_location">Session Location</label></div>'
       . '<div><input type="text" name="session_location" id="session_location" value="' . $session_location . '" /></div>';
    
    $download_url = get_post_meta($post->ID, 'download_url', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="download_url">Document Download URL</label></div>'
       . '<div><input type="text" name="download_url" id="download_url" value="' . $download_url . '" /></div>';    
    
    $link_text = get_post_meta($post->ID, 'link_text', true);    
    echo '<div style="width:100%; margin-top:12px; font-weight:bold;"><label for="link_text">Link Text For Document Download URL</label></div>'
       . '<div><input type="text" name="link_text" id="link_text" value="' . $link_text . '" /></div>';    
}

function wcp_session_conference_MetaBox() {
    global $post;
    
    $conferences = get_posts(array('post_type'=> 'conference', 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));     
    $conf = get_post_meta($post->ID, 'session_conference', true);    
    $confname = get_post_meta($post->ID, 'session_conference_name', true);
    $trac = get_post_meta($post->ID, 'session_tracks', true);    
      
    if(!empty($conferences)) {                   
        echo '<p><select name="session_conference" id="session_conference">';
                echo '<option value="">Select Conference</option>';
                foreach($conferences as $conference) {  
                    $selected = '';
                    if($conference->ID == $conf) { 
                        $selected = 'selected="selected"';
                    }
                    echo '<option value="'.$conference->ID.'" '.$selected.'>'.$conference->post_title.'</option>';
                }
        echo '</select><input type="hidden" name="session_conference_name" id="session_conference_name" value="'.$confname.'"></p>';        
        
        echo '<div id="session_tracks_container">';
                if(isset($conf) AND $conf != "") {
                    $tracks = get_post_meta($conf, 'tracks', true);
    
                    echo 'Select Tracks <br>';   
                    foreach($tracks as $t) {        
                        $checked = '';
                        if(is_array($trac) AND count($trac) > 0) { 
                            if(array_key_exists($t['track_name'], $trac)) {
                                $checked = 'checked="checked"';
                            }
                        }
                        echo '<p><label><input type="checkbox" name="session_tracks['.$t['track_name'].']" value="1" '.$checked.'/>'.$t['track_name'].'</label></p>';   
                    }
                }
        echo '</div>';  
        ?>
        <script type="text/javascript">
            var $ =jQuery.noConflict();
            $(document).ready(function() {
                $("#session_conference").on("change", function() {
                    $("#session_conference_name").val($("#session_conference option:selected").text());
                });
            });
        </script>
        <?php
    }    
}

function get_tracks_callback() {
    global $wpdb;
    global $post;
    
    $conference = sanitize_text_field($_POST['conference']);    
    $tracks = get_post_meta($conference, 'tracks', true);
    
    $string = 'Select Tracks <br>';   
    foreach($tracks as $t) {           
        $string .= '<p><label><input type="checkbox" name="session_tracks['.$t['track_name'].']" value="1"/>'.$t['track_name'].'</label></p>';   
    }
    
    echo $string;
    wp_die();
}

add_action('wp_ajax_get_tracks', 'get_tracks_callback' );
add_action('wp_ajax_nopriv_get_tracks', 'get_tracks_callback' );

function wcp_session_break_MetaBox() {
    global $post;
    
    $break = get_post_meta($post->ID, 'break', true);    
                            
    $checked = '';
    if(isset($break) AND $break == 1) {         
        $checked = 'checked="checked"';        
    }
    echo '<p><label><input type="checkbox" name="break" value="1" '.$checked.'/>Check here to set this session as a break</label></p>';            
}

function wcp_session_hide_track_MetaBox() {
    global $post;
    
    $hide_track = get_post_meta($post->ID, 'hide_track', true);    
                            
    $checked = '';
    if(isset($hide_track) AND $hide_track == 1) {         
        $checked = 'checked="checked"';        
    }
    echo '<p><label><input type="checkbox" name="hide_track" value="1" '.$checked.'/>Check here to hide track details from conference pages</label></p>';
}

add_action('save_post', 'wcp_save_Session'); 

function wcp_save_Session(){
    global $post;
    
    /// Verify this came from the our screen and with proper authorization,
    /// because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['mytheme_meta_box_nonce2'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
    
    /// Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }
  
    $session_data['session_speakers'] = isset( $_POST['session_speakers'] ) ? (array) $_POST['session_speakers'] : array();
    $session_data['session_date'] = sanitize_text_field($_POST['session_date']);
    $session_data['session_start_time'] = sanitize_text_field($_POST['session_start_time']);
    $session_data['session_end_time'] = sanitize_text_field($_POST['session_end_time']);
    $session_data['session_location'] = sanitize_text_field($_POST['session_location']);
    $session_data['download_url'] = esc_url_raw($_POST['download_url']);
    $session_data['link_text'] = sanitize_text_field($_POST['link_text']);
    $session_data['session_conference'] = sanitize_text_field($_POST['session_conference']);
    $session_data['session_conference_name'] = sanitize_text_field($_POST['session_conference_name']);
    $session_data['session_tracks'] = isset( $_POST['session_tracks'] ) ? (array) $_POST['session_tracks'] : array();
    $session_data['break'] = sanitize_text_field($_POST['break']);
    $session_data['hide_track'] = sanitize_text_field($_POST['hide_track']);
                    
    if ( get_post_type() == 'session' ) {
        
        foreach ($session_data as $key => $value) {
            
            /// Don't store custom data twice
            if( $post->post_type == 'revision' ) return;
            
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key);
        }
    }        
}
/// End of session meta boxes ///////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Conference meta boxes
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function wcp_conference_tracks_MetaBox() {    
    global $post;
           
    echo '<input type="hidden" name="mytheme_meta_box_nonce3" id="mytheme_meta_box_nonce3" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
            
    echo '<span class="add_track"><button type="button" class="button button-primary button-small" style="margin-top: 10px;">ADD</button></span>'
       . '<div id="meta_inner_conference" style="margin-top:10px;">';
    
    $tracks = get_post_meta($post->ID,'tracks',true);

    $c = 0;
    if ( count( $tracks ) > 0 ) {
        if(is_array($tracks)){
            foreach( $tracks as $track ) {                  
                echo '<div style="margin-bottom:8px;border:1px solid #eee;padding: 10px 5px;">         
                         <div class="track_box"><label style="display:block;">Track Name</label>
                         <input type="text" name="tracks['.$c.'][track_name]" value="'.$track['track_name'].'" style="width:90%;"/></div> 
                         <div class="track_box"><label style="display:block;">Track Description</label>
                         <textarea name="tracks['.$c.'][track_desc]" style="width:90%;">'.$track['track_desc'].'</textarea></div>   
                         <div class="track_box"><label style="display:block;">Color Code</label>
                         <input type="color" name="tracks['.$c.'][color_code]" value="'.$track['color_code'].'" style="padding:0px;width:50px;height:30px;"/></div>
                         <span class="remove_track" style="display:inline-block;position:relative;top:6px;"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span> 
                      </div>';                    
                $c = $c +1;                                    
            }      
        }
    }        
    ?>
    <script type="text/javascript">
        var $ =jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
                        
            $(".add_track").on("click",function() {                
                
                if(count < 4) {
                    count = count + 1;
                    
                    $('#meta_inner_conference').append(
                    '<div style="margin-bottom:8px;border:1px solid #eee;padding: 10px 5px;">\n\
                        <div class="track_box"><label style="display:block;">Track Name</label>\n\
                        <input type="text" name="tracks['+count+'][track_name]" value="" style="width:90%;"/></div>\n\
                        <div class="track_box"><label style="display:block;">Track Description</label>\n\
                        <textarea name="tracks['+count+'][track_desc]" style="width:90%;"></textarea></div>\n\
                        <div class="track_box"><label style="display:block;">Color Code</label>\n\
                        <input type="color" name="tracks['+count+'][color_code]" value="" style="padding:0px;width:50px;height:30px;"/></div>\n\
                        <span class="remove_track" style="display:inline-block;position:relative;top:6px;"><button type="button" class="button button-primary button-small" style="float:right">Remove</button></span>\n\
                     </div>');
                } else {
                    alert("Maximum 4 tracks are allowed!")
                }
                return false;
            });
            $(".remove_track").live('click', function() {
                $(this).parent().remove();
                count = count - 1;                
            });
        });
    </script>
    </div>
    <?php
}

function wcp_conference_speakers_MetaBox(){
    global $post;
    
    $speakers = get_posts(array('post_type'=> 'speaker', 'post_status'=> 'publish', 'suppress_filters' => false, 'posts_per_page'=>-1));            
    $spea = get_post_meta($post->ID, 'conference_speakers', true);    
                
    if(!empty($speakers)) {
        foreach($speakers as $speaker) {            
            $checked = '';
            if(is_array($spea) AND count($spea) > 0) { 
                if(array_key_exists($speaker->ID, $spea)) {
                    $checked = 'checked="checked"';
                }
            }
            echo '<p><label><input type="checkbox" name="conference_speakers['.$speaker->ID.']" value="1" '.$checked.'/>'.$speaker->post_title.'</label></p>';
        }
    }
}

function wcp_break_bgcolor_MetaBox() {
    global $post;
    
    $break_bgcolor = get_post_meta($post->ID, 'break_bgcolor', true);
    
    echo '<label style="display:block;">Color Code</label>
          <input type="color" name="break_bgcolor" value="'.$break_bgcolor.'" style="padding:0px;width:50px;height:30px;"/>';
}

add_action('save_post', 'wcp_save_Conference'); 

function wcp_save_Conference(){
    global $post;
    
    /// Verify this came from the our screen and with proper authorization,
    /// because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['mytheme_meta_box_nonce3'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
    
    /// Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID )) {
        return $post->ID;
    }
  
    $conference_data['tracks'] = isset( $_POST['tracks'] ) ? (array) $_POST['tracks'] : array();
    $conference_data['conference_speakers'] = isset( $_POST['conference_speakers'] ) ? (array) $_POST['conference_speakers'] : array();
    $conference_data['break_bgcolor'] = sanitize_text_field($_POST['break_bgcolor']);
                    
    if ( get_post_type() == 'conference' ) {
        
        foreach ($conference_data as $key => $value) {
            
            /// Don't store custom data twice
            if( $post->post_type == 'revision' ) return;
            
            if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                update_post_meta($post->ID, $key, $value);
            } else { // If the custom field doesn't have a value
                add_post_meta($post->ID, $key, $value);
            }
            if(!$value) delete_post_meta($post->ID, $key);
        }
    }        
}
/// End of conference meta boxes ///////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Front end display
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function wcp_tabbed_detailedView($atts) {
    global $content;
    ob_start();
    $atts = shortcode_atts( array(
        'conferenceid' => 78,
        'view' => 'tabbed',
        'contenttype' => 'detailed'
    ), $atts );    
    if($atts['view'] == "tabbed" AND $atts['contenttype'] == "detailed") {
        include "tabbed_detailed_view.php";
    } else if($atts['view'] == "tabbed" AND $atts['contenttype'] == "minimal") {
        include "tabbed_minimal_view.php";
    } else if($atts['view'] == "alongside" AND $atts['contenttype'] == "detailed") {
        include "alongside_detailed_view.php";
    } else if($atts['view'] == "alongside" AND $atts['contenttype'] == "minimal") {
        include "alongside_minimal_view.php";
    }
    $output = ob_get_clean();
    return $output;
}

add_shortcode('conferenceoverview','wcp_tabbed_detailedView');

function wcp_speakerListing($atts) {
    global $content;
    ob_start();
    $atts = shortcode_atts( array(
        'conferenceid' => 78,
        'headertext'  => ''
    ), $atts );    
    include "speaker_listing.php";
    $output = ob_get_clean();
    return $output;
}

add_shortcode('speakeroverview','wcp_speakerListing');

function wcp_my_customTemplate($single) {
    global $wp_query, $post;

    /* Checks for single template by post type */
    if ($post->post_type == "speaker"){ 
        if( file_exists(plugin_dir_path(__FILE__) . 'single-speaker.php'))
            return plugin_dir_path(__FILE__) . 'single-speaker.php';
    } else if ($post->post_type == "session"){ 
        if( file_exists(plugin_dir_path(__FILE__) . 'single-session.php'))
            return plugin_dir_path(__FILE__) . 'single-session.php';
    }
    return $single;
}

add_filter('single_template', 'wcp_my_customTemplate');
?>
