<ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                <li><a href="#messages" data-toggle="tab">Messages</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            <div class="tab-pane active" id="home">
                <h3>Welcome, <?php echo $user_identity;?></h3>
                <div class="usericon">
                <?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 60); ?>
                </div>
                <p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p><br/>
                <h3>Welcome back <?php the_author_meta( 'display_name', $current_user->ID );?></h3>
                <p>
                  <a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> | <?php //echo '<a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>';?>
                </p>
            </div>
            <div class="tab-pane" id="profile" style="padding:10px;">
                <?php include(TEMPLATEPATH.'/profilemember.php');?>
            </div>
            <div class="tab-pane" id="messages">
              <?php include (TEMPLATEPATH.'/usermsg.php');?>
            </div>
            <div class="tab-pane" id="settings">
                <?php include (TEMPLATEPATH.'/setting.php');?>
            </div>
            </div>