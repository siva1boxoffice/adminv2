<?php 

  $total_quantity =0 ;
  $total_sold =0 ;
  if($match_details[0]->tickets){

      $total_quantity  = array_sum(array_column($match_details[0]->tickets,'quantity'));
      $total_sold  = array_sum(array_column($match_details[0]->tickets,'sold'));

      $total_quantity = $total_quantity + $total_sold;
  }

  $tab = @$_GET['tab'] ?  $_GET['tab'] :"home";

  ?>

<?php 
 $this->load->view(THEME.'common/header');
//echo isset($matches->m_id) ? $matches->m_id : 'ddddddd'; 
?>
<div id="overlay" style="display: none;">
<div id="loader">
<!-- Add your loading spinner HTML or image here -->
<img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
</div>
</div>
<style type="text/css">
   
   .data_edit_2{
      min-height: 230px;
   }
    #overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
    }


</style>
<!-- Begin Begin main content -->
    <div class="main-content">
      <!-- content -->
      <div class="page-content">
        <!-- page header -->
        <div class="page-title-box tick_details">
          <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">Matches</h5>
               </div>
               <div class="col-sm-4">
                  <!-- <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                     <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">Back</a>
                        <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">Save</a>
                  </div> -->
               </div>
            </div>
          </div>
        </div>
        <!-- page content -->
        <div class="page-content-wrapper mt--45 box-details">
          <div class="container-fluid">
            <div class="card">
               <div class="card-body">            
                  <div class="row">
                     <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-bordered">

                          
                            

                            <li class="nav-item">
                              <a href="#home"   data-id="home"data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="home" ? "active" : ""  ;?>">
                                Add or Edit Match
                              </a>
                            </li>
                     
                            
                            <li class="nav-item">
                              <a href="#content"  data-id="content" data-toggle="tab" aria-expanded="true" class="nav-link  <?php echo $tab=="content" ? "active" : ""  ;?>">
                                Content Info
                              </a>
                            </li>
                            
                 
                          

                            <li class="nav-item">
                              <a href="#tickets"  data-id="tickets" data-toggle="tab" aria-expanded="false" class="nav-link <?php echo $tab=="tickets" ? "active" : ""  ;?>">
                                Ticket Details
                              </a>
                            </li>
                       
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane <?php echo $tab =="home" ? "show active" : ""  ;?>" id="home">
                            <form id="match-form" method="post" class="validate_event_form login-wrapper" action="<?php echo base_url();?>event/matches/save_matches" duplicate-check="<?php echo base_url();?>event/matches/duplicateCheck" class="match-form-class" data-type="<?php echo $matches->m_id ? "edit" : "add";?>">
                                    <input type="hidden" name="matchId" value="<?php echo $matches->m_id;?>">
                              <div class="team_info_details mt-3">
                                <h5 class="card-title">Team Info</h5>
                                <p>Fill the following Team information</p>
                              </div>
                              <input type="hidden" id="eventType" name="event_type" value="<?php echo $matches->event_type ? $matches->event_type   : "match";?>">
                              <div class="row">
                                <div class="col-8">
                                  <div class="card">
                                      <div class="row column_modified">

                                      <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Event Category <span class="text-danger">*</span></label>
                                                 <select class="custom-select" id="gamecategory" name="gamecategory" required>
                                                      <option value="">Select Category</option>
                                                      <?php foreach ($gcategory as $category) { ?>
                                                            <option value="<?php echo $category->id; ?>" <?php if (isset($matches->category)) {
                                                               if ($matches->category == $category->id) {
                                                                  echo ' selected  ';
                                                               }
                                                               } ?>><?php echo $category->category_name; ?></option>
                                                            <?php
                                                               } ?>                                                        
                                                 </select>
                                          </div> 
                                       </div> 

                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Team 1 <span class="text-danger">*</span></label>
                                             
                                              <select class="custom-select" id="team1" name="team1" required onchange="display_match();">
                                              <option value="">Select Team 1</option>
                                                        </select> 
                                          </div> 
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Team 2 <span class="text-danger">*</span></label>
                                             <select class="custom-select" id="team2" name="team2" required onchange="display_match();">
                                             <option value="">Select Team 2</option>  
                                                        </select> 
                                          </div> 
                                       </div> 
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Tournament <span class="text-danger">*</span></label>
                                             
                                                <select class="custom-select" id="tournament" name="tournament" required>
                                                            <option value="">Select Tournament</option>
                                                           
                                                        </select> 
                                          </div> 
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Home Team <span class="text-danger">*</span></label>
                                                <select class="custom-select" id="hometown" name="hometown" required>
                                                            <option value="">Select Home Team</option>
                                                            
                                                        </select> 
                                          </div> 
                                       </div> 
                                       <input type="hidden" name="state" id="state" value="">
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Venue(Stadium Name) <span class="text-danger">*</span></label>

                                               <select class="custom-select" id="venue" name="venue" required>
                                                            <option value="">Select Venue</option>
                                                             
                                                        </select>  

                                          </div> 
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                           <label for="simpleinput">Match Name <span class="text-danger">*</span></label>
                                           <input type="text" name="matchname" id="matchname" class="form-control" placeholder="Enter Match Name" value="<?php echo $matches->match_name;?>" required>
                                          </div>
                                       </div>
                                       <div class="col-lg-4 column_modified_new">
                                          <div class="form-group">
                                           <label for="simpleinput">Event Sub-Title</label>
                                           <input type="text" id="match_label" name="match_label" class="form-control" placeholder="Enter Event Sub-Title" value="<?php echo $matches->match_label;?>" >
                                          </div>
                                       </div>
                                     
                                       <div class="col-lg-4">
                                           <div class="form-group">
                                              <label for="simpleinput">Url Key <span class="text-danger">*</span></label>
                                              <input type="text" id="event_url" name="event_url" value="<?php echo $matches->slug;?>" class="form-control" placeholder="Enter Url Key" required>
                                            </div>
                                       </div>

                                       
                                        
                                    </div> <!-- end col -->
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                                <div class="col-4">
                                   <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-lg-12">
                                          <div class="data_edit">
                                             <table style="width: 100%;">
                                             <!-- <tr>
                                                   <td><label for="sellers" class="mb-0">Event Visible On 1Box </label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch13" name="store[]" value="13" <?php
                                                            
                                                         /*   $storefront_ids = explode(',', $matches->storefronts);
                                                                                    // if (in_array(13,$storefront_ids)) {
                                                                                    //    echo 'checked';
                                                                                    // }
                                                                                    if ($matches->m_id == "" || in_array(13, $storefront_ids)) {
                                                                                       echo 'checked';
                                                                                   }*/
                                                            ?> >
                                                            <label class="custom-control-label" for="customSwitch13"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr> -->
                                                <tr>
                                                   <td><label for="customSwitch18" class="mb-0">Availability</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch18"  value="1"  <?php if($matches->status == '1'|| $matches->status == ''){?> checked <?php } ?> name="is_active">
                                                            <label class="custom-control-label" for="customSwitch18"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                              
                                                <!-- <tr>
                                                   <td> <label for="sellers" class="mb-0">Availability</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="customSwitch19" class="custom-control-input is-switch" name="availability" value="1" <?php //if($matches->availability == '1'){?> checked <?php // } ?>>
                                                            <label class="custom-control-label" for="customSwitch19"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr> -->
                                                <tr>
                                                   <td><label for="customSwitch20" class="mb-0">Top Game</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                          <input type="checkbox" id="customSwitch20" class="is-switch custom-control-input" name="top_games" value="1" <?php if($matches->top_games == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch20"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="customSwitch21" class="mb-0">Popular Events</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" id="customSwitch21" class="custom-control-input" name="upcomingevents" <?php if($matches->upcoming_events == '1'){?> checked <?php } ?> value="1">
                                                            <label class="custom-control-label" for="customSwitch21"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="customSwitch22" class="mb-0">Almost Sold Ticket?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                             <input type="checkbox" id="customSwitch22" class="is-switch custom-control-input" name="almost_sold" value="1" <?php if($matches->almost_sold == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch22"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="customSwitch23" class="mb-0">High Demand Ticket ?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                           <input type="checkbox" id="customSwitch23" class="is-switch custom-control-input" name="high_demand" value="1" <?php if($matches->high_demand == '1'){?> checked <?php } ?> >
                                                            <label class="custom-control-label" for="customSwitch23"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <?php if ($matches->m_id != "" && (strtotime($matches->match_date) <= strtotime(date("Y-m-d")))) { ?>
                                                <tr>
                                                   <td><label for="customSwitch233" class="mb-0">Copy Content ? *</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                           <input type="checkbox" id="customSwitch23322s" class="is-switch custom-control-input copy_content" name="copy_content" value="1">
                                                            <label class="custom-control-label" for="customSwitch23322s"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td><label for="customSwitch233" class="mb-0">Duplicate Match ?</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                           <input type="checkbox" id="customSwitch2335" class="is-switch custom-control-input duplicate" name="duplicate" value="1">
                                                            <label class="custom-control-label" for="customSwitch2335"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                              <?php } ?>

                                              <tr>
                                                <td><label for="customSwitch017" class="mb-0">To Be Confirmed</label></td>
                                                <td>
                                                <div class="form-group mb-1 cust-switch">
                                                Disable / Enable
                                                <div class="custom-control custom-switch">
                                                <input type="checkbox" id="customSwitch017" class="is-switch custom-control-input" name="tbc_status" value="1" <?php if($matches->tbc_status == '1'){?> checked <?php } ?> >
                                                <label class="custom-control-label" for="customSwitch017"></label>
                                                </div>
                                                </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <td> <label for="customSwitch018" class="mb-0">Keep Active After Start Time</label></td>
                                                <td>
                                                <div class="form-group mb-1 cust-switch">
                                                Disable / Enable
                                                <div class="custom-control custom-switch">
                                                <input type="checkbox" id="customSwitch018" class="is-switch custom-control-input" name="ignoreautoswitch" value="1" <?php if($matches->ignoreautoswitch == '1'|| $matches->ignoreautoswitch == ''){?> checked <?php } ?> >
                                                <label class="custom-control-label" for="customSwitch018"></label>
                                                </div>
                                                </div>
                                                </td>
                                                </tr>

                                                <tr>
                                                <td> <label for="customSwitch019" class="mb-0">Is this final match</label></td>
                                                <td>
                                                <div class="form-group mb-1 cust-switch">
                                                Disable / Enable
                                                <div class="custom-control custom-switch">
                                                <input type="checkbox" id="customSwitch019" class="is-switch custom-control-input" name="final_match" value="1" <?php if ($matches->final_match == '1') { ?> checked <?php } ?>>
                                                            <label class="custom-control-label" for="customSwitch019"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                </div>
                          
                              </div>
                              <!-- end row -->
                              <div class="clearfix"></div>

                              <div class="match_info_details">
                                <h5 class="card-title">Match Info</h5>
                                <p>Fill the following Match information</p>
                              </div>
                              <div class="row">
                                <div class="col-8">
                                  <div class="card">
                                      <div class="row column_modified">
                                       <div class="col-lg-4">
                                          <div class="form-group calander">
                                             <label for="example-date">Match Date <span class="text-danger">*</span></label>
                                             <input class="form-control" id="MyTextbox2" type="text" name="matchdate" placeholder="Match Date" value="<?php
                                              if(isset($matches->match_date))
                                              {
                                              echo date('d-m-Y', strtotime($matches->match_date));
                                              }
                                              ?>" autocomplete="off" required>
                                              <i class="bx bx-calendar-week"></i>
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                             <label>Match Time <span class="text-danger">*</span></label>
                                             <input class="form-control input" type="time" name="matchtime" placeholder="hh:mm" required value="<?php echo date('H:i', strtotime($matches->match_date));?>" >
                                          </div>
                                       </div> 
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Currency <span class="text-danger">*</span></label>
                                               <select class="custom-select" id="price_type" name="price_type" required>
                                                    <option value="">Select Currency</option>
                                                        <?php foreach($currencies as $currency){ ?>
                                                    <option value="<?php echo trim($currency->currency_code);?>" <?php if($matches->price_type == trim($currency->currency_code)){?> selected <?php } ?>><?php echo $currency->currency_code;?> (<?php echo $currency->symbol;?>)</option>
                                                    <?php } ?>
                                                </select> 
                                          </div> 
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Country <span class="text-danger">*</span></label>
                                              <select class="custom-select" id="country" name="country" onchange="get_state_city(this.value);" required>
                                                            <option value="">Select Country</option>
                                                              <?php foreach($countries as $country){ ?>
                                                            <option <?php if($matches->country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                            <?php } ?>
                                                        </select> 
                                          </div> 
                                       </div> 
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">City</label>
                                              <?php $cityArray = $this->General_Model->get_state_cities($matches->country);
                                                    ?>                                                
                                                 <select class="custom-select" id="city" name="city" >
                                                            <option value="">Select City</option>
                                                            <?php

                                                                
                                                                foreach ($cityArray as $cityArr) {
                                                                    ?>
                                                                    <option value="<?= $cityArr->id; ?>" <?php
                                                                    if ($matches->city): if ($matches->city == $cityArr->id) {
                                                                            echo 'selected';
                                                                        } endif;
                                                                    ?>><?= $cityArr->name; ?></option>
                                                                            <?php
                                                                        }
                                                                ?>
                                                        </select>
                                          </div> 
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                           <label for="simpleinput">Total Tickets</label>
                                            <input type="text" id="matchticket" name="matchticket" class="form-control input" placeholder="Enter No. Of tickets" value="<?php echo ($matches->matchticket == 0) ? 1000 : $matches->matchticket; ?>">
                                          </div>
                                       </div>
                                       <div class="col-lg-4">
                                          <div class="form-group">
                                              <label for="example-select">Countries That Are Denied Access</label>
                                               <select name='bcountry[]' id="selectize-maximum" class="form-control" multiple="multiple">
                                                <option value="">Select denied Countries</option>
                                                            <?php foreach($countries as $country){ ?>
                                                            <option <?php 
                                                            if(isset($ban_arr)){
                                                            if(in_array($country->id, $ban_arr)){
                                                                 echo 'selected="selected"';
                                                                            } }
                                                                ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                            <?php } ?>
                                                </select>
                                          </div> 
                                       </div>
                                       <div class="col-lg-8">
                                           <div class="form-group">
                                              <label for="simpleinput">Search Keywords</label>
                                               <input type="text" class="input form-control" placeholder="Enter Search Keywords" name="search_keywords" id="search_keywords"  placeholder="Enter URL Key" value="<?php echo $matches->search_keywords;?>" >
                                            </div>
                                       </div>

                                            <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="example-select">Blog Image</label>
                                                <div class="prev_back_img">
                                                  <label class="custom-upload mb-0"><input type="hidden" name="exs_file" value="<?php if (isset($matches->blog_image)) {
                                                echo $matches->blog_image;
                                                } ?>"><input type="file"  class="form-control-file input"  name="blog_image" id="blog_image" value="" onchange="loadFiles(event,'blog_img_file')"> Upload JPEG File</label>
                                                  <p>Previous Blog Image</p>
                                                  <a id="blog_img_file_link" target="_blank" href="javascript:void(0);" onclick="return popitup('<?php if (isset($matches->blog_image)) {
                                                echo UPLOAD_PATH.'uploads/blog_image/'.$matches->blog_image;
                                                } ?>')" class="view_bg">
                                                <img width="30" height="30" src="<?php if (isset($matches->blog_image)) {
                                                echo UPLOAD_PATH.'uploads/blog_image/'.$matches->blog_image;
                                                }else { echo UPLOAD_PATH.'uploads/general_settings/no-image.png';} ?>" id="blog_img_file">
                                            </a>
                                                </div>
                                            </div> 
                                         </div>
                                        
                                    </div> <!-- end col -->
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                              
                              </div>
                              <!-- end row -->

                              <div class="clearfix"></div>

<div class="team_info_details mt-3">
  <h5 class="card-title">API Share</h5>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="row column_modified">
            <div class="col-lg-4">
               <div class="data_edit data_edit_2">
                  <table style="width: 100%;">
                  <?php foreach ($partners as $partner) { ?>
                     <tr>
                        <td><label for="partner_<?php echo $partner->admin_id; ?>" class="mb-0"><?php echo $partner->company_name ; ?></label></td>
                        <td>
                              <div class="form-group mb-1 cust-switch">
                              Disable / Enable
                                 <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="partner[]" id="partner_<?php echo $partner->admin_id; ?>" value="<?php echo $partner->admin_id; ?>" <?php
                                    $partner_ids = $ap_arr;
                                    // if (in_array($partner->admin_id, $partner_ids)) {
                                    //       echo 'checked';
                                    // }

                                    if ($matches->m_id == "" || in_array($partner->admin_id, $partner_ids)) {
                                       echo 'checked';
                                   }
                                    ?>>
                                    <label class="custom-control-label" for="partner_<?php echo $partner->admin_id; ?>"></label>
                                 </div>
                              </div>
                        </td>
                     </tr>
                  <?php } ?>

                  <?php foreach ($partners_api as $partner_api) { 
                    if($partner_api->api_id == 1){ 
                      $inpt_status = "tixstock_status";
                    }
                    else if($partner_api->api_id == 2){ 
                      $inpt_status = "oneclicket_status";
                    }
                    else if($partner_api->api_id == 3){ 
                      $inpt_status = "xs2event_status";
                    }
                    ?>
                     <tr>
                        <td><label for="sellers" class="mb-0"><?php echo $partner_api->api_name ; ?></label></td>
                        <td>
                              <div class="form-group mb-1 cust-switch">
                              Disable / Enable
                                 <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="partner_api[]" id="partner_api_<?php echo $partner_api->api_id; ?>" value="<?php echo $partner_api->api_id; ?>" <?php
                                      

                                    if ($matches->m_id == "" ||  $matches->$inpt_status==1 ) { echo 'checked';  } ?>>
                                    <label class="custom-control-label" for="partner_api_<?php echo $partner_api->api_id; ?>" ></label>
                                 </div>
                              </div>
                        </td>
                     </tr>
                  <?php } ?>
                  </table>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="data_edit data_edit_2">
                  <table style="width: 100%;">                                                  
                  <?php foreach ($afiliates as $afiliate) { ?>
                        <tr>
                           <td><label for="afiliate_<?php echo $afiliate->admin_id; ?>" class="mb-0"><?php 
                           // $afiliate->admin_name . ' ' . $afiliate->admin_last_name .
                           echo  $afiliate->company_name ; ?></label></td>
                           <td>
                                 <div class="form-group mb-1 cust-switch">
                                 Disable / Enable
                                    <div class="custom-control custom-switch">
                                       <input type="checkbox" class="custom-control-input" id="afiliate_<?php echo $afiliate->admin_id; ?>" name="afiliate[]" value="<?php echo $afiliate->admin_id; ?>" <?php
                                       $afiliate_ids = explode(',', $matches->afiliates);
                                       // if (in_array($afiliate->admin_id, $afiliate_ids)) {
                                       //       echo 'checked';
                                       // }
                                       if ($matches->m_id == "" || in_array($afiliate->admin_id, $afiliate_ids)) {
                                          echo 'checked';
                                      }
                                       ?>>
                                       <label class="custom-control-label" for="afiliate_<?php echo $afiliate->admin_id; ?>"></label>
                                    </div>
                                 </div>
                           </td>
                        </tr>
                     <?php } ?>
                    
                  </table>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="data_edit data_edit_2">
                  <table style="width: 100%;">

                 
                     <?php foreach ($storefronts as $storefront) {
                           if($storefront->store_id  != 238){
                                  ?>
                                    <tr>
                                          <td><label for="store_<?php echo $storefront->store_id; ?>" class="mb-0"><?php echo $storefront->site_value ; ?></label></td>
                                          <td>
                                             <div class="form-group mb-1 cust-switch">
                                             Disable / Enable
                                                <div class="custom-control custom-switch">
                                                      <input type="checkbox" class="custom-control-input" id="store_<?php echo $storefront->store_id; ?>" name="store[]" value="<?php echo $storefront->store_id; ?>" <?php
                                                      $storefront_ids = explode(',', $matches->storefronts);
                                                      // if (in_array($storefront->id, $storefront_ids)) {
                                                      //    echo 'checked';
                                                      // }
                                                      if ($matches->m_id == "" || in_array($storefront->store_id, $storefront_ids)) {
                                                         echo 'checked';
                                                     }
                                                      ?>>
                                                      <label class="custom-control-label" for="store_<?php echo $storefront->store_id; ?>"></label>
                                                </div>
                                             </div>
                                          </td>
                                    </tr>
                                 <?php
                              } }  ?>

                    
                  </table>
               </div>
            </div>
         </div>
     </div>
  </div>
</div>


<div class="clearfix"></div>

<div class="team_info_details mt-3">
   <h5 class="card-title">User Restrictions</h5>
 </div>

 <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                      <div class="row column_modified">
                                         <div class="col-lg-12 mb-5">
                                          
                                             <div class="form-group">
                                                 <label for="sellers">Select Sellers</span> </label>
                                                 <select class="actionpayout roleuser form-control" multiple  name="seller[]" id="sellers">
                                                   
                                                    <?php foreach($sellers as $seller){ ?>
                                                    <option 
                                                         <?php
                                                         $seller_ids = explode(',', $matches->sellers);
                                                         if (in_array($seller->admin_id, $seller_ids)) {
                                                               echo 'selected';
                                                         }
                                                         ?>                                                   
                                                   value="<?php echo $seller->admin_id;?>" ><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                                                                                   <?php } ?>
                                                </select>
                                               
                                             <div class="sort_filters">
                                               
                                             </div>
                                          </div>
                                                 
                                             </div> 
                                          </div>
                                      </div>
                                   </div>
                                </div>
                              <div class="tick_details border-top">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">

                                          <?php 
                                             $page_name = "matches/upcoming";
                                            if($matches->event_type == 'other'){
                                                $page_name = "other_events/upcoming";
                                               }
                                          ;?>
                                          <a href="<?php echo base_url() . 'event/'.$page_name;?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                                </form>
                           </div>
                            <div class="tab-pane <?php echo $tab=="content" ? "show active" : ""  ;?>" id="content">
                              <div class="row">
                                <div class="col-12">
                                  <div class="card">
                                    <div class=" mt-3">
                                      <h5 class="card-title">Match Content Info</h5>
                                      <p>Fill the Match Content Information</p>
                                    </div>
                                    <div class="">
                                    <form id="branch-form" method="post" class="<?php echo $matches->m_id ? 'validate_form_edit' : 'validate_form_v1' ;?> login-wrapper" action="<?php echo base_url();?>event/matches/save_matches_content">
                           <input type="hidden"  id="matchId" name="matchId" value="<?php  echo isset($matches->m_id) ? $matches->m_id : ''; ?>">
                            <input type="hidden" name="flag" value="content">
                                       <div class="row column_modified">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="simpleinput">Match Title *</label>
                                                 <!-- <input type="text" id="simpleinput" class="form-control" placeholder="Enter Tournament Name" <?php //echo $matches->match_name;?> value="<?php echo $matches->match_name;?>"> -->
                                                 <input disabled type="text" id="" name="" class="form-control" placeholder="Enter Match Title" value="<?php
                                                 echo isset($matches->match_name) ? $matches->match_name : '';?>">
                                                          <input  type="hidden" id="matchname" name="matchname" class="input" placeholder="Enter Match Title" required value="<?php echo $matches->match_name;?>">
                                               </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="simpleinput">Meta Title <span class="text-danger">*</span></label>
                                                 <input type="text" id="simpleinput" class="form-control" placeholder="Enter Meta Title" name="metatitle" required value="<?php echo isset($matches_lang->meta_title) ? $matches_lang->meta_title : '';?>">
                                               </div>
                                          </div>
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="example-textarea">Meta Description </label>
                                                 <textarea class="form-control height_auto" id="example-textarea" rows="5" name="metadescription" placeholder="Enter Meta Description"><?php echo isset($matches_lang->meta_description) ? $matches_lang->meta_description : ''; ?></textarea>
                                               </div>
                                          </div> 
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="example-textarea">Match Description</label>
                                                 <textarea id="editor-4" name="description" placeholder="Enter Match Description"><?php echo isset($matches_lang->description) ? $matches_lang->description : ''; ?></textarea>
                                               </div>
                                          </div>

                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="example-textarea">Long Description</label>
                                                 <textarea id="editor-5" name="long_description" placeholder="Enter Long Description"><?php echo isset($matches_lang->long_description) ? $matches_lang->long_description : ''; ?></textarea>
                                               </div>
                                          </div>    
                                          <!-- <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="example-textarea">Short Description</label>
                                                 <textarea id="editor-6" name="short_description" placeholder="Enter Short Description"><?php echo isset($matches_lang->short_description) ? $matches_lang->short_description : ''; ?></textarea>
                                               </div>
                                          </div>  -->
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="simpleinput">Seo Keywords</label>
                                                 <input type="text" id="choices-text-remove-button" class="form-control" placeholder="Enter Seo Keywords" value="<?php echo isset($matches_lang->seo_keywords) ? $matches_lang->seo_keywords : ''; ?>" name="seo_keywords">
                                               </div>
                                          </div> 
                                          <div class="col-lg-12">
                                              <div class="tick_details border-top">
                                 <div class="row">
                                    <div class="col-sm-8">
                                       <!-- <h5 class="card-title">Matches</h5> -->
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                          <a href="<?php echo base_url() . 'event/matches/upcoming';?>" class="btn btn-primary mb-2 mt-3">Back</a>
                                             <button type="submit" class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>    
                              </div>               
                                       </div> <!-- end col -->
                                </form>
                                    </div> <!-- end card-body -->
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                              </div>
                           </div>
                           <div class="tab-pane <?php echo $tab=="tickets" ? "show active" : ""  ;?>" id="tickets">
                              <div class="row">
                                <div class="col-12">
                                  <div class="card listing_details">
                                    <div class="ticket_details_as  mt-3">
                                       <div class="row">
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Event Name</h4> 
                                                    <p><?php 
                                                      if(isset($matches->match_name))
                                                    {
                                                      $match_name_inpt = $matches->match_name;

                                                      $match_name_array = explode(" Vs ", $match_name_inpt);
                                                      $match_name = $match_name_array[0];
                                                      
                                                      if (!empty($match_name_array[1])) {
                                                        $match_name .= " Vs <br/>" . $match_name_array[1];
                                                      }
                                                      
                                                      echo $match_name;
                                                    }
                                                     ?> </p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Tournament</h4>
                                                    <p><?php
                                                    if(isset($matches->tournament_name))
                                                    { echo $matches->tournament_name;
                                                    }?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Date & Time</h4>
                                                    <p><?php
                                                   // echo "dfdd";
                                                   if(isset($matches->match_date))
                                                   {                                       
                                                         $dateString = $matches->match_date;
                                                        $dateTime = new DateTime($dateString);
                                                        $formattedDate = $dateTime->format("l, j F Y");
                                                        
                                                       echo $formattedDate." ".date('H:i A',strtotime($match_details->match_time));
                                                   }
                                                    ?>
                                                    <!-- Saturday, 26 March 2023 1:30 PM -->
                                                </p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Stadium</h4>
                                                    <p><?php  echo $matches->stadium_name; ?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>City</h4>
                                                    <p><?php echo $matches->city_name; ?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Country</h4>
                                                    <p><?php echo $matches->country_name; ?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Available Tickets </h4>
                                                    <p>
                                                 <?php echo $total_quantity;
                                                     ?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Quantity Sold </h4>
                                                    <p><?php echo $total_sold;
                                                     ?></p>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2">
                                                 <div class="event_name">
                                                    <h4>Price Range</h4>
                                                    <p>
                                                    <?php 
                                                    // if(isset($match_details[0]->tickets))
                                                    // {

                                                    
                                                    // //  echo min(array_column($match_details[0]->tickets, 'price')); 
                                                    // //  echo " - ";
                                                    // //  echo max(array_column($match_details[0]->tickets, 'price'));
                                                    // }


                                                      if (!empty($match_details[0]->tickets)) {
                                                        $prices = array_column($match_details[0]->tickets, 'price');
                                                        $minPrice = min($prices);
                                                        $maxPrice = max($prices);
                                                    
                                                        echo $minPrice . " - " . $maxPrice;
                                                    }
                                                    

                                                      
                                                    ?>

<?php echo strtoupper($match_details[0]->price_type); ?>
                                                    </p>
                                                 </div>
                                              </div>
                                       </div>
                                    </div>
                                    <div class="table-responsive" id="list_body">
                                       
                                    </div>  
                                  </div> <!-- end card -->
                                </div><!-- end col -->
                              </div>
                           </div>
                        </div>
                     </div> 
                  </div>
               </div>
            </div>
            <div class="edit_modal_popup">
               

      <div class="modal fade bd-example-modal-lg" id="edit_ticket" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close edit_ticket_close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="ticket_edit_body">
              <div class="row">
                <div class="team_name">
                <h3 style="text-align: center;"><i class="fa fa-spinner fa-spin" style="color:#color: #325edd;"></i>&nbsp;Please Wait ...</h3>
              </div>
            </div>
             
            </div>
          </div>
        </div>
      </div>


                
            </div>
          </div>
        </div>
      </div>



  <div class="modal fade" id="clone-listing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="">
        
        <p class="text-right"><button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><img src="<?php echo base_url();?>assets/img/close.svg" ></span></span>
        </button></p>

        <div class="modal-body clone-listing" id="ticket_clone_body">

        </div>
         
        </div>
      </div>
    </div>


      
      <!-- main content End -->
<?php  $this->load->view(THEME.'common/footer'); ?>
<script>
    
     function popitup(url,temp='')
   {

      newwindow=window.open(url,'name','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

      if (window.focus) {newwindow.focus()}
      return false;
   }


 var loadFiles = function(event,team_bg_file) {

  var formData = new FormData();
formData.append('file', event.target.files[0]);

$.ajax({
       url : "<?php echo base_url();?>event/upload_files",
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       dataType: 'json',
       success : function(data) {

          if(data.uploaded_file){
            var src = "<?php echo UPLOAD_PATH;?>uploads/temp/"+data.uploaded_file;
            var output = document.getElementById(team_bg_file);
            output.src = src;
            $("#"+team_bg_file+"_link").attr("onclick", "return popitup('"+src+"');");
          }
           
     

       }
});

   
  };

    $(document).ready(function(){ 

      function fetchTeamData(team1,team2,venue,tournament,hometown) {
   var selectedValue = $('#gamecategory').val();


      $.ajax({
         type: 'POST',
         url: '<?php echo base_url(); ?>event/get_selected_teams_edit',
         data: {
            'gamecategory'          : selectedValue,
            'selected_team1'        : team1,
            'selected_team2'        : team2,
            'selected_venue'        : venue,
            'selected_tournament'   : tournament,
            'selected_hometown'     : hometown
         },
         dataType: "json",
         success: function(data) {  
               $('#team1').html(data.result.teams);   
               $('#team2').html(data.result.teams2);
               $('#team2 option[value=""]').text("Select Team 2"); 
               $('#venue').html(data.result.stadium);
               $('#tournament').html(data.result.tournament); 
               $('#hometown').html(data.result.hometown); 
               $('#hometown option[value=""]').text("Select Home Team");   
         }
      });
}
<?php if (!empty($matches->team_1)) { ?>
   fetchTeamData('<?php echo $matches->team_1; ?>', '<?php echo $matches->team_2; ?>', '<?php echo $matches->venue; ?>', '<?php echo $matches->tournament; ?>', '<?php echo $matches->hometown; ?>');
<?php } ?>

    
      $("body").on("change","#gamecategory ",function(){
         var selectedValue = $(this).val();
        
         if(selectedValue == 1 ){
            $("#eventType").val("match");
         }
         else {
            $("#eventType").val("other");
         }


        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>event/get_selected_teams',
            data: {
               'gamecategory': selectedValue,
            },
            dataType: "json",
            success: function(data) {              
               $('#team1').html(data.result.teams);   
               $('#team2').html(data.result.teams);
               $('#team2 option[value=""]').text("Select Team 2"); 
               $('#venue').html(data.result.stadium);
               $('#tournament').html(data.result.tournament); 
               $('#hometown').html(data.result.hometown); 
               $('#hometown option[value=""]').text("Select Home Team");                
            }
         });
         
      });

      $("body").on('click', '.dropdown-menu-custom .check_box, .seat_category_check_box', function (e) {
         //    alert('dd');
         e.stopPropagation();
      });


      $(".search_box").on('keyup', function(){
              var value = $(this).val().toLowerCase();

                

           $(this).parents(".dropdown-menu").find(".custom-checkbox").each(function () {
                 if ($(this).find("label").text().toLowerCase().search(value) > -1) {
                    $(this).show();
                
                 } else {
                    $(this).hide();
                 }
              });
           });
load_tickets_details("<?php echo $matches->m_id;?>");

 $(".edit_ticket_btn").click(function(){ 
             $('#bs-example-modal-lg').modal();
              $("#content_1").mCustomScrollbar({
          scrollButtons:{
            enable:true
          }
        });
      });

       $(".edit_clone_info").click(function(){
             $('#clone-example-modal-lg').modal();
      });

  new Choices(document.getElementById("choices-text-remove-button"), { delimiter: ",", editItems: !0, removeItemButton: !0 });

  new Choices(document.getElementById("search_keywords"), { delimiter: ",", editItems: !0, removeItemButton: !0 });



//$('.ticket_clone').on('click',function(){
       $(document).on('click', '.ticket_clone', function(){
      var ticket_id = $(this).attr('data-ticket-id');
      //$('#clone-listing-modal').modal();  

      $('.edit_ticket_close').trigger('click');  
      
      setTimeout(
      function() 
      {
      $('#clone-listing-modal').modal({
      backdrop: 'static',
      keyboard: false
      })

      $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/index/get_ticket',
            data: {
               'ticket_id': ticket_id,
               'type': 'clone'
            },
            dataType: "json",
            success: function(data) {

                if(data.status == 1){
                  $('#ticket_clone_body').html(data.html);
                }

            }
         });
      }, 500);

    })

       
 $(document).on('click', '.edit_ticket', function(){ 

      var ticket_id = $(this).attr('data-ticket-id');
      $('#edit_ticket').modal();  
       $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>tickets/index/get_ticket',
            data: {
               'ticket_id': ticket_id,
               'type': 'edit'
            },
            dataType: "json",
            success: function(data) {

                if(data.status == 1){
                  $('#ticket_edit_body').html(data.html);
                }

            }
         });


    })

$('#team1').on('change', function(event) {

  var team_id = $(this).val();
  if(team_id != ''){
    
    $("#hometown").val(team_id);
  /*  $.ajax({
        url: "<?php echo base_url();?>event/get_team_basic",
        method: "POST",
        data : {"team_id" : team_id},
        dataType: 'json',
        success: function (result) { 

         if(result.status == 1) {

          var country_id = result.data.country;
          var city_id = result.data.city;
          var stadium_id = result.data.stadium;
          $("#country").val(country_id);
          $("#venue").val(stadium_id);
          get_state_city(country_id,city_id);

         }else if(result.status == 0) {
           notyf.error(result.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
          
        }
        
        }
      });*/

  }
});

$('#venue').on('change', function(event) {

   selected_venue_value= $("#venue option:selected").val();
      $.ajax({
        type: "POST",
        dataType: "json",
        url: base_url + 'event/matches/get_venue',
        data: {'venue' : selected_venue_value},
        success: function(res_data) {
          $("#country").val(res_data.selected_country);
          get_state_city(res_data.selected_country,res_data.selected_city);       

        }
      })

  var venue = $(this).val();
  if(venue != ''){
    
 
    $.ajax({
        url: "<?php echo base_url();?>event/get_venue_basic",
        method: "POST",
        data : {"venue" : venue},
        dataType: 'json',
        success: function (result) { 

         if(result.status == 1) {

          var country_id = result.data.country;
          var city_id = result.data.city;
          $("#country").val(country_id);
          get_state_city(country_id,city_id);

         }else if(result.status == 0) {
           notyf.error(result.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          
          
        }
        
        }
      });

  }
});

    /////////////////////////////////

      // Initialize the datepicker
      $("#MyTextbox2").datepicker({
         // onSelect: function (datesel) {
         //    $('#MyTextbox2').trigger('change')
         // }, maxDate: new Date()
          dateFormat: 'dd-mm-yy' ,
           changeMonth: true,
            changeYear: true,
          minDate:0
      });

      function slugfly(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
        for (var i = 0, l = from.length; i < l; i++) {
          str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                 .replace(/\s+/g, '-') // collapse whitespace and replace by -
                 .replace(/-+/g, '-'); // collapse dashes

        return str;
   }
   <?php if(empty($matches->m_id)) { ?>
   $("body").on("keyup","#matchname",function(){
      create_slug();
   });

   function create_slug(){
      var val = $("#matchname").val();
      // Remove "( 1boxoffice )" substring
      val = val.replace(/\( 1boxoffice \)|\( Xs2event \)|\( oneclicket \)|\( tixstock \)/g, "");

console.log(val);


      var tournament;
      if($("#tournament").val()){
          tournament = $("#tournament option:selected").attr('data-slug');
         tournament =  tournament.replace("-tickets","")
      }
      var slug ="";
      if(val){
         if(tournament)  val = tournament +" "+ val;
         slug = slugfly(val + "-tickets");
         $("#event_url").val(slug );
         $("#tixtransfer_url").val(slug );
      }
    
   }

   $("body").on("change","#tournament",function(){
      //"#myselect option:selected" 
     var selected_tournament= $('#tournament option:selected').text();
     var val = $("#event_url").val();
     slug = slugfly(val + "-"+selected_tournament);
     $("#tixtransfer_url").val(slug );

     create_slug();
   });
   <?php } ?>


   $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
        var href =  $(this).data("id");
      <?php if(empty($matches->m_id)){ ?>
         if(href != "home"){
            swal('Attention!', ' Please Fill The Match Details', 'error');
            return false;
         }
     <?php  } else{
      ?>
       
         // Get current URL parts
         const path = window.location.pathname;
         const params = new URLSearchParams(window.location.search);
         const hash = window.location.hash;
         // Update query string values
         params.set('tab', href);

         window.history.replaceState({}, '', `${path}?${params.toString()}${hash}`);
      <?php } ?>
   });

   if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0,   searchFields: ['label', 'value'] ,allowSearch: true});

})

function get_state_city(country_id,city_id="") {

        if(country_id != ''){ 

         $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'event/matches/get_sortname',
            data: {'country_id' : country_id},
            success: function(response) {
               $("#price_type").val(response.currency);               
            }
          })


          $('#city').html('');
          $.ajax({
            type: "POST",
            dataType: "json",
            url: base_url + 'event/matches/get_city',
            data: {'country_id' : country_id},
            success: function(res_data) {
      
                var state_city = JSON.parse(JSON.stringify(res_data));
               
      
              $('#city').html(state_city.city);
              $('#state').val(state_city.state);
              if(city_id != "'"){
                   $('#city').val(city_id);
                }
            }
          })
      
        }
      }

 $(document).on('change', '.sell_ticket_status', function () {
        var ticket_id = $(this).data('ticket');
        var ticket_status_check = $(this).is(':checked');
            var ticket_status = ticket_status_check ? 1 : 0;
        var flag = "";
        // Make an AJAX POST request
        $.ajax({
          url: base_url + 'tickets/index/event_ticket_update_status',
          type: 'POST',
          dataType: 'json',
          data: {
            "ticket_id": ticket_id,
            "ticket_status": ticket_status,
            "flag": flag
          },
          success: function (data) {
            if (data.status == 1) {
              swal('Updated !', data.msg, 'success');

            } else if (data.status == 0) {

              swal('Updation Failed !', data.msg, 'error');

            }
            // setTimeout(function () { window.location.reload(); }, 2000);
          },
          error: function (xhr, status, error) {
            // Handle the error here
            console.log(error);
          }
        });
      //}
    });
</script>
