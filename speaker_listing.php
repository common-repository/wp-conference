<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;
$conference_details = get_post($atts['conferenceid']);
$postmeta = get_post_meta($atts['conferenceid']);   
$speaker_array = array();                                                     
if(isset($postmeta['conference_speakers'])) { 
    $speakers = unserialize($postmeta['conference_speakers'][0]);         
    foreach($speakers as $sp_id => $speaker) {
        $speaker_details = get_post($sp_id);
        $speaker_postmeta = get_post_meta($sp_id);

        $homepage_show = 0;
        if(isset($speaker_postmeta['homepage_show'])) { 
            $homepage_show = $speaker_postmeta['homepage_show'][0];
        }    
        if($homepage_show != 0) {
            $image = '';
            $post_thumbnail_id = get_post_thumbnail_id($sp_id);
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
            $sorting_name = '';
            if(isset($speaker_postmeta['sorting_name'])) { 

                $sorting_name = $speaker_postmeta['sorting_name'][0];
            }  
            $speaker_array[$sp_id] = array(
                'name'         => $speaker_details->post_title,
                'image'        => $image,
                'bio'          => $speaker_details->post_content,
                'job_title'    => $job_title,
                'company_name' => $company,
                'company_logo' => $company_logo,                
                'sorting_name' => $sorting_name,
                'sorter'       => preg_replace('/\s+/', '_', $sorting_name)
            ); 
        }   
    }               
}                                    
if($_POST['search'] AND trim($_POST['search']) != "") {
    if(!empty($speaker_array)) {
        foreach($speaker_array as $spId => $speaker) {
            if (strpos(strtolower($speaker['name']), strtolower($_POST['search'])) === false AND strpos(strtolower($speaker['company_name']), strtolower($_POST['search'])) === false) {  
                unset($speaker_array[$spId]);
            }
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
$speakers_array = array();
if(!empty($speaker_array)) {
    $speakers_array = aasort_array($speaker_array, 'sorter');
}
//echo '<pre>'; print_r($speakers_array); echo '</pre>'; 
?>   
<div class="speaker_listing_section wp_conference_container">
    <div class="container">
        <div class="row">
            <div class="header_list_part">
                <div class="header_list_text">
                    <?php //echo $conference_details->post_title; ?>
                    <?php
                        if(isset($atts['headertext'])) {
                            echo $atts['headertext'];
                        }
                    ?>
                </div>
<!--                <div class="header_list_search">
                    <div class="search_biswa_text_section_main">
                       <div class="search_biswa_text_section">
                           <div class="newsearch-form">
                                <form action="" id="form1" name="form1" onsubmit="return validateForm()" method="post" accept-charset="utf-8">
                                    <input type="text" name="search" value="" id="search" class="inputtext" placeholder="SEARCH" required>
                                    <input type="submit" value="" id="search-button">
                                </form>                               
                           </div>
                       </div>
                    </div>
                </div>-->
            </div>

            <div class="box_contain">
                <?php 
                if(count($speakers_array) > 0) {
                       foreach($speakers_array as $speaker_id => $speaker) {
                ?>
                            <div class="box2">
                                <div class="box_information_part listpage_speaker_top">
                                    <div class="box_image_part">
                                        <?php
                                            if($speaker['image'] != "") {
                                                echo '<img src="'.$speaker['image'].'">';
                                            } else {
                                                echo '<img src="'.plugin_dir_url(__FILE__).'images/profile-placeholder-thumbnail.png">';
                                            }
                                        ?>
                                    </div>
                                    <div class="box_text_part listpage_speaker_topright">
                                        <div class="name_text listing-name_text"><a href="<?php echo get_permalink($speaker_id); ?>?conf=<?php echo $atts['conferenceid']; ?>"><?php echo $speaker['name']; ?></a></div>                                        
                                        <div class="profession_text"><?php echo $speaker['job_title']; ?></div>
                                    </div>
<!--                                    <a data-fancybox data-src="#speaker_<?php echo $speaker_id; ?>" href="javascript:;"><div class="bt_bio">Bio</div></a>
                                    <div class="fancy_container" id="speaker_<?php echo $speaker_id; ?>">                                                                                
                                            <p style="padding: 15px;"><?php echo $speaker['bio']; ?></p>
                                    </div>-->
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
                <?php }
                } else {
                    echo 'No matching result found!';
                }
                ?>
            </div>
        </div>
    </div>
</div>                               		