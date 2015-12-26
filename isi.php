<?php 
            $loop = new WP_Query(array('post_type' => 'produks', 'posts_per_page' => -1, 'orderby'=> 'ASC')); 
            ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <?php if ( has_post_thumbnail() ) { ?>
      <div class="row">
        <div class="col-md-3">            
            <div class="thumbnail">
                <div class="caption-thumb">
                    <h4><?php the_title(); ?></h4>
                    <p><?php
              $hrg=get_post_meta($post->ID, "hrg", true);
              if($hrg!=''){
                if (strlen($hrg)>6) {
                  if(substr($hrg, 1,1)=='0')
                   {
                   echo "<p class='lead'>Rp&nbsp".substr($hrg, 0,1)." <b> . . .</b></p>";
                  } else {
                    
                     echo "<p class='lead'>Rp&nbsp".substr($hrg, 0,1).",".substr($hrg, 1,1)."<b> . . .</b></p>";
                  }
                }else
                {
                  echo "<b>Rp&nbsp".$hrg."</b>";
                }
                 
              } else {
                echo "<b>Rp&nbsp0,-</b>";
              }
              ?></p>
                    <p>    <?php
                                              $hrg=get_post_meta($post->ID, "hrg", true);
                                              if ($hrg!='') {
                                              ?>
                                            <i class="fa fa-shopping-cart"></i>
                                            <a href="<?php echo  get_site_url().'/keranjangs?action=add&id='.$post->ID;?>">
                                            Tambahkan&nbsp
                                            </a>
                                            <?php
                                              }else{?>
                                            <p>
                                          <a class="btn btn-primary btn-sm top_up" href = "javascript:void(0)" onclick = "document.getElementById('<?php echo $post->ID;?>').style.display='block';document.getElementById('fade').style.display='block'">
                                          <span class="glyphicon glyphicon-file"></span>&nbspBuat Penawaran
                                          </a>
                                          </p>
                                        <?php
                                          }?>
                                        <a href="<?php echo get_site_url().'/produks/'.$post->ID;?>" class="label label-default">More details</a></p>
                </div>
                <?php the_post_thumbnail(array(263,199),array('class'=>'img-responsive'));?>
                                    <?php
                                    }else { ?>
                                    <img src="<?php echo get_template_directory_uri().'/img/dthumb.png';?>" alt="...">
                                    <?php } ?>
              
            </div>
      </div>
      <?php endwhile; ?>