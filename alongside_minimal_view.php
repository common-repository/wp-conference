<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;
$sessions = get_posts(array(
        'post_type'  => 'session',
        'posts_per_page' => -1,
        'meta_key'   => 'session_conference',
        'meta_value' => $atts['conferenceid']
    )
);
$conference_details = get_post($atts['conferenceid']);
$session_array = array();
if(!empty($sessions)) {
    foreach($sessions as $session) { 
        $postmeta = get_post_meta( $session->ID);                                 
        $session_start_time = strtotime($postmeta['session_date'][0].' '.$postmeta['session_start_time'][0]);
        $session_end_time = strtotime($postmeta['session_date'][0].' '.$postmeta['session_end_time'][0]);            
        $break = 0;
        if(isset($postmeta['break'])) {
            $break = 1;
        }            
        $speaker_array = array();
        if(isset($postmeta['session_speakers'])) { 
            $speakers = unserialize($postmeta['session_speakers'][0]);                
            foreach($speakers as $speaker) {
                $speaker_details = get_post($speaker['speaker_id']);
                $speaker_postmeta = get_post_meta($speaker['speaker_id']);
                  
                $job_title = '';
                if(isset($speaker_postmeta['job_title'])) { 

                    $job_title = $speaker_postmeta['job_title'][0];
                }
                $company = '';
                if(isset($speaker_postmeta['company_name'])) { 

                    $company = $speaker_postmeta['company_name'][0];
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
                    'bio'          => $speaker_details->post_content,
                    'job_title'    => $job_title,
                    'company_name' => $company,                    
                    'moderator'    => $moderator,
                    'sorter'       => $moderator.'_'.preg_replace('/\s+/', '_', $sorting_name)
                ); 
            }               
        }
        $speakers_array = array();
        if(!empty($speaker_array)) {
            $speakers_array = aasort_array($speaker_array, 'sorter');
        }
        $conference_postmeta = get_post_meta($postmeta['session_conference'][0]);
        $tracks_array = array();
        if(isset($postmeta['session_tracks'])) { 
            $selected_tracks = unserialize($postmeta['session_tracks'][0]); 
            $conference_tracks = unserialize($conference_postmeta['tracks'][0]);
            foreach($conference_tracks as $track) {
                if(array_key_exists($track['track_name'],$selected_tracks)) {
                    $tracks_array = $track;
                }
            }                                
        }
        $break_bgcolor = '';
        if(isset($conference_postmeta['break_bgcolor'])) { 

            $break_bgcolor = $conference_postmeta['break_bgcolor'][0];
        }
        $session_array[strtotime($postmeta['session_date'][0])][$tracks_array['track_name']][$session_start_time.'_'.$session_end_time][$session->ID] = array(
            'name' => $session->post_title,            
            'start_time' => $postmeta['session_start_time'][0],
            'end_time' => $postmeta['session_end_time'][0],
            'break' => $break,
            'speakers' => $speakers_array,
            'tracks' => $tracks_array
        );            
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
ksort($session_array);
foreach($session_array as $session_date => $tracks_array) {
    ksort($session_array[$session_date]);       
    foreach($tracks_array as $track_name => $sessions) {
        ksort($session_array[$session_date][$track_name]);  
    }
}       
//echo '<pre>'; print_r($session_array); echo '</pre>'; 
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#myTab li:eq(0) a").tab('show');
        $(".text_section_commercial").on("click", function() {
            $(".track_content").hide();
            $("#track_"+$(this).data("track")).show();
            $(".text_section_commercial").removeClass("active_track");
            $(this).addClass("active_track");
        });
        $(".text_section_commercial").eq(0).trigger("click");        
        $("#myTab a").on("click", function() { 
            $("#"+$(this).data("disdate")).find(".text_section_commercial").eq(0).trigger("click");
        });     
        
        var url = document.location.toString();
		  if (url.match('#')) { 
			   $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
		  } //add a suffix
			
		  // Change hash for page-reload
		  $('.nav-tabs a').on('shown.bs.tab', function (e) {
			   window.location.hash = e.target.hash;
		  });      
    });
</script>
<div class="main_conference_section wp_conference_container">
    <div class="container">
        <div class="row">
<!--            <div class="con_header_style"><?php echo $conference_details->post_title; ?></div>  -->
            <ul class="nav nav-tabs" id="myTab">
                <?php foreach($session_array as $day => $sessions) { ?>
                        <li><a data-toggle="tab" href="#<?php echo $day; ?>" data-disdate="<?php echo $day; ?>"><?php echo date('j F', $day); ?></a></li>                        
                <?php } ?>
            </ul>            
            <div class="tab-content">                    
                <?php           
                $counter = 0;
                foreach($session_array as $day => $tracks) { ?>
                      <div id="<?php echo $day; ?>" class="tab-pane fade <?php if($counter == 0) { echo 'in active'; } ?>">
                                <?php $counter++; ?>
                                <div class="section_one_commercial">
                                      <?php 
                                      $track_count = 0;
                                      foreach($tracks as $track_name => $sessionss) { ?>      
                                          <div class="text_section_commercial" data-track="<?php echo $day.'_'.$track_count; ?>"><?php echo $track_name; ?></div>
                                      <?php          
                                          $track_count++;
                                      } 
                                      ?>
                                </div>                                 
                                <?php 
                                $track_count = 0;
                                foreach($tracks as $track_name => $sessionss) { ?>
                                            <div class="track_content" id="track_<?php echo $day.'_'.$track_count; ?>" style="display:none;">
                                                   <?php     
                                                   foreach($sessionss as $times => $sessions) {
                                                       foreach($sessions as $session_id => $session) {
                                                          if($session['break'] == 0) { 
                                                   ?>
                                                              <div class="section_two">
                                                                  <div class="time_section"><?php echo date("G:i", strtotime($session['start_time'])).' - '.date("G:i", strtotime($session['end_time'])); ?></div>
                                                                  <div class="text_section_part_two" <?php if(isset($session['tracks']['color_code'])) { echo 'style="background-color:'.$session['tracks']['color_code'].'"'; } ?>>                                                                      
                                                                      <h3 class="opening_text_part_alongside"><a href="<?php echo get_permalink($session_id); ?>"><?php echo $session['name']; ?></a></h3>                                                                      
                                                                      <?php 
                                                                      if(count($session['speakers']) > 0) {
                                                                             foreach($session['speakers'] as $speaker_id => $speaker) {
                                                                      ?>
                                                                                  <div class="box_minimal_overview">                                                                                      
                                                                                        <div class="name_text_con"><a href="<?php echo get_permalink($speaker_id); ?>?conf=<?php echo $atts['conferenceid']; ?>"><?php echo $speaker['name']; ?><?php echo $speaker['moderator'] == 1 ? '<span>&nbsp;(Moderator)</span>' : ''; ?></a></div>                                                                                                   
                                                                                        <div class="lower_text_part_con"><?php echo $speaker['company_name']; ?></div>                                                                                                                                                                                      
                                                                                  </div>       
                                                                      <?php }
                                                                      }
                                                                      ?>
                                                                  </div>
                                                              </div>
                                                   <?php } else { ?>
                                                              <div class="section_five">
                                                                  <div class="time_section_five"></div>
                                                                  <div class="text_section_five" <?php if(isset($break_bgcolor)) { echo 'style="background-color:'.$break_bgcolor.'"'; } ?>>
                                                                      <div class="lunch_time_style"><?php echo date("G:i", strtotime($session['start_time'])).' - '.date("G:i", strtotime($session['end_time'])); ?></div>
                                                                      <div class="lunch_break_style"><?php echo $session['name']; ?></div>
                                                                  </div>
                                                              </div>
                                                   <?php }
                                                      }
                                                  }
                                                  ?>
                                            </div>
                                <?php 
                                    $track_count++;
                                } 
                                ?>
                      </div>
                <?php
                }          
                ?>               
             </div>
        </div>
    </div>
 </div>                          		