<ul class="nav nav-tabs" id="myTab">
      <li class="active"><a href="#inbox" data-toggle="tab"><i class="fa fa-envelope-o"></i> Inbox</a></li>
      <li><a href="#sent" data-toggle="tab"><i class="fa fa-reply-all"></i> Sent</a></li>
      <li><a href="#assignment" data-toggle="tab"><i class="fa fa-file-text-o"></i> Assignment</a></li>
      <li><a href="#event" data-toggle="tab"><i class="fa fa-clock-o"></i> Event</a></li>
    </ul>
    
    <div class="tab-content">
      <div class="tab-pane active" id="inbox">
        <a type="button" data-toggle="collapse" data-target="#a1">
            <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
              <div class="btn-group"><input type="checkbox"></div>
              <div class="btn-group col-md-3">Admin Kumar</div>
              <div class="btn-group col-md-8"><b>Hi Check this new Bootstrap plugin</b> <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:10 PM <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-share-square-o"> Reply</i></button></div> </div>
            </div>
        </a>
        <div id="a1" class="collapse out well">This is the message body1</div>
        <br>
        <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
      </div>
     
       
      <div class="tab-pane" id="sent">
            <a type="button" data-toggle="collapse" data-target="#s1">
            <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
              <div class="btn-group"><input type="checkbox"></div>
              <div class="btn-group col-md-3">Kumar</div>
              <div class="btn-group col-md-8"><b>This is reply from Bootstrap plugin</b> <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:30 AM</div> </div>
            </div>
        </a>
        <div id="s1" class="collapse out well">
        	<?php

$t5=$wpdb->prefix.'t_penawaran';
$current_user = wp_get_current_user();
$hasil=$wpdb->get_results("SELECT * FROM $t5 WHERE status='1' AND id='".$current_user->ID."'");
if($hasil){
	$arrpen=array();
	foreach($hasil as $key => $value) {
		$wew=get_post($value->kd_prod);
		$arrpen[]="<a href='".get_permalink($wew->ID)."' target='blank'>".$wew->post_title."</a>";
	}
	echo "penawaran produk yang meliputi <b>".implode(',',$arrpen)."</b> telah kami konfirmasi,silahkan cek email anda";	
}else{
	echo "Mohon menunggu ,penawaran produk anda belum kami konfirmasi";
}
?>
        </div>
        <br>
        <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
      </div>
      
      
     <div class="tab-pane" id="assignment">
        <a href=""><div class="well well-sm" style="margin:0px;">Open GL Assignments <span class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:20 AM 20 Dec 2014 </span></div></a>        
     </div>
     
     <div class="tab-pane" id="event">
       <div class="media">
                  <a class="pull-left" href="#">
                    <img class="media-object img-thumbnail" width="100" src="http://cfi-sinergia.epfl.ch/files/content/sites/cfi-sinergia/files/WORKSHOPS/Workshop1.jpg" alt="...">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">Animation Workshop</h4>
                    2Days animation workshop to be conducted
                  </div>
            </div>
</div>
</div>
</div>







