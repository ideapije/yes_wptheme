<?php
  global $current_user;
  
  $args = array(
    'post_type' => 'user_images',
    'post_status' => 'publish'    
  );
  
  $posts = new WP_Query($args);

  if($posts->post_count){;
  
    $out = '';
    $out .= '<table id="user_images">';
    $out .= '<thead><th>Image</th><th>Caption</th><th>Category</th><th>Posted By</th></thead>';
      
    foreach($posts->posts as $user_image){
    
      $user_info = get_userdata($user_image->post_author);    
    
      $user_image_cats = get_the_terms($user_image->ID, 'sui_image_category');
      
      foreach($user_image_cats as $cat){
      
        $user_image_cat = $cat->name;
      
      }
      
      $post_thumbnail_id = get_post_thumbnail_id($user_image->ID);   
  
      $out .= '<tr>';
      $out .= '<td>' . wp_get_attachment_link($post_thumbnail_id, 'thumbnail') . '</td>';    
      $out .= '<td>' . $user_image->post_title . '</td>';
      $out .= '<td>' . $user_image_cat . '</td>';    
      $out .= '<td>' . $user_info->user_login . '</td>';      
      $out .= '</tr>';
      
    }
  
    $out .= '</table>';
    
    echo $out;
  
  }else{
  
    echo 'No images have been approved for publication!';
  
  }

?>
