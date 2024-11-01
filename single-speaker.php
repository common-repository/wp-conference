<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The Template for displaying all single speakers
 *
 * @package WordPress
 */
get_header();	
$sp_image = '';
$job_title = '';
$company = '';
$company_logo = '';
$social_medias = array();
$website = '';
$email = '';
$phone = '';
while ( have_posts() ) : the_post();     
    $post_thumbnail_id = get_post_thumbnail_id($post->ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
        $sp_image = $post_thumbnail_img[0];
    }     
    $speaker_postmeta = get_post_meta($post->ID);    
    if(isset($speaker_postmeta['job_title'])) { 

        $job_title = $speaker_postmeta['job_title'][0];
    }
    if(isset($speaker_postmeta['company_name'])) { 

        $company = $speaker_postmeta['company_name'][0];
    }
    if(isset($speaker_postmeta['company_logo'])) { 

        $company_logo = $speaker_postmeta['company_logo'][0];
    }  
    if(isset($speaker_postmeta['social_medias'])) { 

        $social_medias = unserialize($speaker_postmeta['social_medias'][0]);
    }  
    if(isset($speaker_postmeta['website'])) { 

        $website = $speaker_postmeta['website'][0];
    }  
    if(isset($speaker_postmeta['email'])) { 

        $email = $speaker_postmeta['email'][0];
    } 
    if(isset($speaker_postmeta['phone'])) { 

        $phone = $speaker_postmeta['phone'][0];
    } 
endwhile; 
$conference_details = array();
$conference_postmeta = array();
$sessions = array();
if($_GET['conf']) {    
    $conference_details = get_post($_GET['conf']);
    $conference_postmeta = get_post_meta($_GET['conf']); 
    $sessions = get_posts(array(
            'post_type'  => 'session',
            'posts_per_page' => -1,
            'meta_key'   => 'session_conference',
            'meta_value' => $_GET['conf'],
            'orderby' => 'session_start_time',
            'order' => 'ASC',
        )
    );                    
    foreach($sessions as $key => $session) { 
        $postmeta = get_post_meta( $session->ID);  
        $speaker_exists = 0;
        if(isset($postmeta['session_speakers'])) {  
            $speakers = unserialize($postmeta['session_speakers'][0]);                               
            foreach($speakers as $speaker) { 
                if($speaker['speaker_id'] == $post->ID) {
                    $speaker_exists = 1;
                }
            }
        }
        if($speaker_exists == 0) {
            unset($sessions[$key]);
        }
    }    
}
//echo '<pre>'; print_r(unserialize($speaker_postmeta['social_medias'][0])); echo '</pre>'; 
?>    
<div class="smartbuli_details_section wp_conference_container">
    <div class="container">
        <div class="row">
            <?php if(!empty($conference_details)) { ?>
                        <h1 class="listing_page_style"><?php echo $conference_details->post_title; ?></h1>
            <?php } ?>
            <div class="details_image_section">
                <div class="for_image">
                    <?php
                        if($sp_image != "") {
                            echo '<img src="'.$sp_image.'">';
                        } else {
                            echo '<img src="'.plugin_dir_url(__FILE__).'images/profile-placeholder-medium.png">';
                        }
                    ?>
                </div>
                <div class="image_bottom_info_container">
                    <?php
                        if($website != "") { echo '<div class="speaker_web"><span class="glyphicon glyphicon-link"></span><a href="'.$website.'" target="_blank">'.$website.'</a></div>'; }
                        if($email != "") { echo '<div class="speaker_e-mail"><span class="glyphicon glyphicon-envelope"></span><a href="mailto:'.$email.'" target="_top">'.$email.'</a></div>'; }
                        if($phone != "") { echo '<div class="speaker_ph"><span class="glyphicon glyphicon-phone"></span>'.$phone.'</div>'; }
                    ?>
                </div>
            </div>
            <div class="details_text_section">
                <div class="list_text"><?php echo $post->post_title; ?></div>                
                <?php if(count($social_medias) > 0) {
                            echo '<div class="icon_listing">
                                    <ul class="icon_listing_style">';
                                        foreach($social_medias as $social) { 
                                            if(array_key_exists("Facebook", $social)) {
                                                echo '<li><a href="'.$social['Facebook'].'" target="_blank" title="Facebook"><img src="'.plugin_dir_url(__FILE__).'images/facebook.png" class="img_tag_first" alt="Facebook"></a></li>';
                                            } else if(array_key_exists("Google Plus", $social)) {
                                                echo '<li><a href="'.$social['Google Plus'].'" target="_blank" title="Google Plus"><img src="'.plugin_dir_url(__FILE__).'images/googleplus.png" class="img_tag_first" alt="Google Plus"></a></li>';
                                            } else if(array_key_exists("Instagram", $social)) {
                                                echo '<li><a href="'.$social['Instagram'].'" target="_blank" title="Instagram"><img src="'.plugin_dir_url(__FILE__).'images/instagram.png" class="img_tag_first" alt="Instagram"></a></li>';
                                            } else if(array_key_exists("LinkedIn", $social)) {
                                                echo '<li><a href="'.$social['LinkedIn'].'" target="_blank" title="LinkedIn"><img src="'.plugin_dir_url(__FILE__).'images/linkedin.png" class="img_tag" alt="LinkedIn"></a></li>';
                                            } else if(array_key_exists("Picasa", $social)) {
                                                echo '<li><a href="'.$social['Picasa'].'" target="_blank" title="Picasa"><img src="'.plugin_dir_url(__FILE__).'images/picasa.png" class="img_tag1" alt="Picasa"></a></li>';
                                            } else if(array_key_exists("Pinterest", $social)) {
                                                echo '<li><a href="'.$social['Pinterest'].'" target="_blank" title="Pinterest"><img src="'.plugin_dir_url(__FILE__).'images/pinterest.png" class="img_tag2" alt="Pinterest"></a></li>';
                                            } else if(array_key_exists("RSS", $social)) {
                                                echo '<li><a href="'.$social['RSS'].'" target="_blank" title="RSS"><img src="'.plugin_dir_url(__FILE__).'images/rss.png" class="img_tag3" alt="RSS"></a></li>';
                                            } else if(array_key_exists("Tumblr", $social)) {
                                                echo '<li><a href="'.$social['Tumblr'].'" target="_blank" title="Tumblr"><img src="'.plugin_dir_url(__FILE__).'images/tumblr.png" class="img_tag4" alt="Tumblr"></a></li>';
                                            } else if(array_key_exists("Twitter", $social)) {
                                                echo '<li><a href="'.$social['Twitter'].'" target="_blank" title="Twitter"><img src="'.plugin_dir_url(__FILE__).'images/twitter.png" class="img_tag5" alt="Twitter"></a></li>';
                                            } else if(array_key_exists("Youtube", $social)) {
                                                echo '<li><a href="'.$social['Youtube'].'" target="_blank" title="Youtube"><img src="'.plugin_dir_url(__FILE__).'images/youtube.png" class="img_tag6" alt="Youtube"></a></li>';
                                            }
                                        }
                              echo '</ul>
                                  </div>';                    
                       }
                ?>                
<!--                <div class="list_editor_text">Editor</div>-->
                            <div class="bond_img_text">
                                <span class="details_company_logo">
                                    <?php
                                        if($company_logo != "") {
                                            echo '<img src="'.$company_logo.'">';
                                        }
                                    ?>
                                </span>
                                <span class="zig_zag_inner_text">
                                    <b><?php echo $company; ?></b>
                                </span>                                
                                <div class="details_managing_dir_text">
                                    <?php echo $job_title; ?>
                                </div>
                            </div>

                            <div class="abstract_text">biography</div>

                            <div class="abstract_infor_text"><?php echo apply_filters('the_content', $post->post_content); ?></div>

                            <?php if(!empty($conference_details) AND !empty($sessions)) { ?>
                                        <h2 class="list_speaker_style">
                                            <?php if(count($sessions) > 1) { echo 'Sessions'; } else { echo 'Session'; } ?> with this speaker
                                        </h2>
                                        <?php 
                                        foreach($sessions as $session) { 
                                                $session_postmeta = get_post_meta($session->ID);     
                                                $conference_details = get_post($session_postmeta['session_conference'][0]);
                                                $conference_postmeta = get_post_meta($session_postmeta['session_conference'][0]); 
                                                $tracks_array = array();
                                                if(isset($session_postmeta['session_tracks'])) { 
                                                    $selected_tracks = unserialize($session_postmeta['session_tracks'][0]); 
                                                    $conference_tracks = unserialize($conference_postmeta['tracks'][0]);
                                                    foreach($conference_tracks as $track) {
                                                        if(array_key_exists($track['track_name'],$selected_tracks)) {
                                                            $tracks_array = $track;
                                                        }
                                                    }                                
                                                }
                                        ?>
                                                <div class="magnet_style">
                                                    <span class="magnet_style_span"><?php echo date('F j', strtotime($session_postmeta['session_date'][0])); ?> | </span>
                                                    <span class="magnet_style_span"><?php echo date("G:i", strtotime($session_postmeta['session_start_time'][0])).'-'.date("G:i", strtotime($session_postmeta['session_end_time'][0])); ?> | </span>
                                                    <span class="magnet_style_span"><?php echo $conference_details->post_title; ?></span><?php if(!empty($tracks_array)) { echo '<span class="magnet_style_span"> | '.$tracks_array['track_name'].'</span>'; } ?></div>
                                                    <div class="details_retail_style"><span class="magnet_style_span"><a href="<?php echo get_permalink($session->ID); ?>"><?php echo $session->post_title; ?></a></span>
                                                </div>
                                        <?php                                         
                                        }  
                                   } ?>
                            <a href="javascript:history.back()"><div class="middle_portion"><div class="back_style_bt">Back</div></div></a>
            </div>
        </div>
    </div>
</div>     
<?php get_footer(); ?>