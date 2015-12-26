<nav class="navbar navbar-inverse container" role="navigation" style="border-radius:0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="cursor:default;">Welcome, <?php echo $userdata->display_name;?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
      <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user_identity;?><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li align="center" class="well">
                <div>
                  <?php $pp=get_user_meta( $userdata->ID,'pp',true);?>
                  <?php if(!empty($pp)):?>
                  <img class="img-responsive" style="padding:2%;" src="<?php echo get_user_meta( $userdata->ID,'pp',true);?>" alt="photo profile">      
                  <?php else:?>
                  <img class="img-responsive" style="padding:2%;" src="<?php echo get_template_directory_uri().'/img/photo.png';?>" alt="photo profile">
                    <?php endif;?>
                  <a class="change" data-toggle="modal" data-target="#ppuser" style="cursor:pointer;">Change Picture</a></div>
                <div class="btn-group">
                  <a href="<?php echo home_url('/masuk/4');?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span></a>
                  <a href="<?php echo wp_logout_url('index.php'); ?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-log-out"></span></a>
                </div>
            </li>
           </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">
  <div class="row well">
    <div class="col-md-2">
          <ul class="nav nav-pills nav-stacked well">
              <li
              <?php
              if(basename($_SERVER['REQUEST_URI'])=='1'):
                echo "class='active'";
              endif;
              ?>
              >
              <a href="<?php echo home_url('/masuk/1');?>"><i class="fa fa-envelope"></i> Compose</a></li>
              <li
              <?php
              if(basename($_SERVER['REQUEST_URI'])=='2'):
                echo "class='active'";
              endif;
              ?>
              ><a href="<?php echo home_url('/masuk/2');?>"><i class="fa fa-home"></i> Home</a></li>
              <li
              <?php
              if(basename($_SERVER['REQUEST_URI'])=='3'):
                echo "class='active'";
              endif;
              ?>
              ><a href="<?php echo home_url('/masuk/3');?>"><i class="fa fa-user"></i> Profile</a></li>
              <li
              <?php
              if(basename($_SERVER['REQUEST_URI'])=='4'):
                echo "class='active'";
              endif;
              ?>
              ><a href="<?php echo home_url('/masuk/4');?>"><i class="fa fa-key"></i> Security</a></li>
              <li><a href="<?php echo wp_logout_url('index.php'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <?php $coveruser=get_user_meta($userdata->ID,'cover',true);
            if(!empty($coveruser)): 
                  $urlcover=$coveruser;
             else: 
                  $urlcover=get_template_directory_uri().'/img/cover.png';
             endif; 
            ?>
            <?php if(isset($_GET['error2'])):?>
            <div class="alert alert-danger" role="alert">
              <a href="#" class="close" data-dismiss="alert">×</a>
              File size must be excately 2 MB
            </div>
            <?php endif;?>
            <?php if(isset($_GET['error1'])):?>
            <div class="alert alert-danger" role="alert">
              <a href="#" class="close" data-dismiss="alert">×</a>
              extension not allowed, please choose a JPEG or PNG file.
            </div>
            <?php endif;?>
            <?php if(isset($_GET['error3'])):?>
            <div class="alert alert-danger" role="alert">
              <a href="#" class="close" data-dismiss="alert">×</a>
              There was error uploading the file,please try again
            </div>
            <?php endif;?>
                <div class="panel" style="background-image:url('<?php echo $urlcover;?>');">

                  <?php $pp=get_user_meta( $userdata->ID,'pp',true);?>
                  <?php if(!empty($pp)):?>
                  <img class="pic img-circle" src="<?php echo get_user_meta( $userdata->ID,'pp',true);?>" alt="photo profile">      
                  <?php else:?>
                  <img class="pic img-circle" src="<?php echo get_template_directory_uri().'/img/photo.png';?>" alt="photo profile">
                    <?php endif;?>
                    <div class="name"><small><?php echo $user_identity;?></small></div>
                    <a data-toggle="modal" data-target="#changecover" class="btn btn-xs btn-primary pull-right" style="margin:10px;">
                    <span class="glyphicon glyphicon-picture">
                    </span> Change cover
                    </a>
                </div>

    <br><br><br>
    <?php
    $page=basename($_SERVER['REQUEST_URI']);
    switch($page){
      case '1':
        include(TEMPLATEPATH.'/usermsg.php');
        break;
      case '2':
          include(TEMPLATEPATH.'/beranda-user.php');
        break;
      case '3':
          include(TEMPLATEPATH.'/profilemember.php');
      break;
      case '4':
          include (TEMPLATEPATH.'/setting.php');
        break;
      default:
        #
        break;
    }
    ?>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ppuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Photo profile</h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo home_url('/prosesco/8');?>" method="post" enctype="multipart/form-data" name="front_end_upload" >
        <label>Upload Photo Profile
        <input type="file" name="coveruser">
        </label>
        <input type="hidden" name="idyangupload" value="<?php echo $userdata->ID;?>">
        <input type="submit" name="Upload" >
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="changecover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Cover profile</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo home_url('/prosesco/8');?>" method="post" enctype="multipart/form-data" name="front_end_upload" >
        <label>Upload cover size(953X112)
        <input type="file" name="coveruser">
        </label>
        <input type="hidden" name="idyangupload" value="<?php echo $userdata->ID;?>">
        <input type="hidden" name="tandacover" value="1">
        <input type="submit" name="Upload" >
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Balas pesan</h4>
      </div>
      <div class="modal-body">
        <div class="container">
          <form action="" method="post" role="form">
            <div class="well">
              <ul class="list-inline">
                <li><input type="text" class="form-control" name="" placeholder="to"></li>
                <li><input type="text" class="form-control" name="" placeholder="subject"></li>
              </ul>
            <textarea class="form-control" rows="3"></textarea>
            <div class="btn-group">
              <button type="reset" class="btn btn-sm btn-primary">clear</button>
              <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-send"></span>&nbspSend</button>
            </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>