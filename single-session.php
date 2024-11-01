<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The Template for displaying all single sessions
 *
 * @package WordPress
 */
get_header();	
while ( have_posts() ) : the_post();  
    $session_details = get_post($post->ID);
    $session_postmeta = get_post_meta($post->ID);
endwhile; 
$conference_details = get_post($session_postmeta['session_conference'][0]);
$conference_postmeta = get_post_meta($session_postmeta['session_conference'][0]);    
$se_image = '';
$post_thumbnail_id = get_post_thumbnail_id($session_details->ID);
if ($post_thumbnail_id) {
    $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
    $se_image = $post_thumbnail_img[0];
}     
if($se_image == "") {
    if(isset($session_postmeta['session_conference'])) {
        $post_thumbnail_id = get_post_thumbnail_id($session_postmeta['session_conference'][0]);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'medium');
            $se_image = $post_thumbnail_img[0];
        }  
    }
}
$session_location = '';
if(isset($session_postmeta['session_location'])) {
    
    $session_location = $session_postmeta['session_location'][0];
}
$download_url = '';
$link_text = '';
if(isset($session_postmeta['download_url']) AND isset($session_postmeta['link_text'])) { 
    $download_url = $session_postmeta['download_url'][0];
    $link_text = $session_postmeta['link_text'][0];
}
$speaker_array = array();
if(isset($session_postmeta['session_speakers'])) { 
    $speakers = unserialize($session_postmeta['session_speakers'][0]);   
    foreach($speakers as $speaker) {
        $speaker_details = get_post($speaker['speaker_id']);
        $speaker_postmeta = get_post_meta($speaker['speaker_id']);

        $image = '';
        $post_thumbnail_id = get_post_thumbnail_id($speaker['speaker_id']);
        if ($post_thumbnail_id) {
            $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
            $image = $post_thumbnail_img[0];
        }      
        $job_title = '';
        if(isset($speaker_postmeta['job_title'])) { 

            $job_title = $speaker_postmeta['job_title'][0];
        }
        $company = '';
        if(isset($speaker_postmeta['company_name'])) { 

            $company = $speaker_postmeta['company_name'][0];
        }
        $company_logo = '';
        if(isset($speaker_postmeta['company_logo'])) { 

            $company_logo = $speaker_postmeta['company_logo'][0];
        }                    
        $moderator = 2;
        if(isset($speaker['moderator'])) {
            $moderator = 1;
        }     
        $sorting_name = '';
        if(isset($speaker_postmeta['sorting_name'])) { 

            $sorting_name = $speaker_postmeta['sorting_name'][0];
        }
        $speaker_array[$speaker['speaker_id']] = array(
            'name'         => $speaker['speaker_name'],
            'image'        => $image,
            'bio'          => $speaker_details->post_content,
            'job_title'    => $job_title,
            'company_name' => $company,
            'company_logo' => $company_logo,
            'moderator'    => $moderator,
            'sorter'       => $moderator.'_'.preg_replace('/\s+/', '_', $sorting_name)
        ); 
    } 
}
$speakers_array = array();
if(!empty($speaker_array)) {
    $speakers_array = aasort_array($speaker_array, 'sorter');
}
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
function aasort_array(&$array, $key) {
    $sorter = array();
    $ret = array();
    $array_count = count($array);
    if ($array_count != 0) {
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
        return $array;
    }
}
//echo '<pre>'; print_r($session_details); echo '</pre>'; //print_r($session_postmeta);    
?>
<div class="smartbuli_details_section wp_conference_container">
    <div class="container">
        <div class="row">
            <?php if($se_image != "") { ?>
                        <div class="details_image_section">
                            <div class="for_image">
                                <?php echo '<img src="'.$se_image.'">'; ?>
                            </div>
                        </div>
            <?php } ?>
            <div class="details_text_section" <?php if($se_image == "") { echo 'style="width:100%;"'; } ?>>
                <div class="details_t_text"><span><?php echo date('F j', strtotime($session_postmeta['session_date'][0])); ?> |</span><span> <?php echo date('G:i', strtotime($session_postmeta['session_start_time'][0])); ?>-<?php echo date('G:i', strtotime($session_postmeta['session_end_time'][0])); ?> |</span><span> <?php echo $conference_details->post_title; ?> </span><?php if(!empty($tracks_array)) { ?><span> | <?php echo $tracks_array['track_name']; ?></span><?php } ?></div>
                <div class="session_name"><?php echo $session_details->post_title; ?></div>
                
                <div class="session_location_title">Session Location</div>
                <div class="session_location_desc"><?php echo $session_location; ?></div>
                
<!--                <div class="abstract_text session_abstract_title">Abstract</div>-->
                <div class="abstract_infor_text session_abstract_desc"><?php echo apply_filters('the_content', $session_details->post_content); ?></div>
                
                <?php if($download_url != '' AND $link_text != '') { echo '<div class="session_download_url"><a href="'.$download_url.'" target="_blank">'.$link_text.'</a></div>'; } ?>
                                
                <div class="session_speakers_container">
                        <?php
                        if(!empty($speakers_array)) {
                            foreach($speakers_array as $speaker_id => $speaker) {                            
                        ?>        
                                <div class="box2">
                                    <div class="box_information_part">
                                        <div class="box_image_part">
                                            <?php
                                                if($speaker['image'] != "") {
                                                    echo '<img src="'.$speaker['image'].'">';
                                                } else {
                                                    echo '<img src="'.plugin_dir_url(__FILE__).'images/profile-placeholder-thumbnail.png">';
                                                }
                                            ?>
                                        </div>
                                        <div class="card_info_topright">
                                                <div class="box_text_part <?php echo $speaker['moderator'] == 2 ? 'text_part_extended' : ''; ?>">
                                                    <div class="name_text"><a href="<?php echo get_permalink($speaker_id); ?>?conf=<?php echo $conference_details->ID; ?>"><?php echo $speaker['name']; ?></a></div>                                                    
                                                    <div class="profession_text"><?php echo $speaker['job_title']; ?></div>
                                                </div>
                                                <?php echo $speaker['moderator'] == 1 ? '<div class="bt_moderator">Moderator</div>' : ''; ?>        
                                        </div>
                                    </div>
                                    <div class="box_information_lower_part">
                                        <div class="lower_img_part">
                                            <?php
                                                if($speaker['company_logo'] != "") {
                                                    echo '<img src="'.$speaker['company_logo'].'">';
                                                }
                                            ?>
                                        </div>
                                        <div class="lower_text_part"><?php echo $speaker['company_name']; ?></div>
                                    </div>
                                </div>
                        <?php        
                            }
                        }
                        ?>
                </div>
                <a href="javascript:history.back()"><div class="middle_portion"><div class="back_style_bt">Back</div></div></a>                    
            </div>
        </div>
    </div>
</div>              
<?php get_footer(); ?>