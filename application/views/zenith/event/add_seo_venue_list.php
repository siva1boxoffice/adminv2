<style>
   .choices__inner{ height : auto  !important;}
   .cust-switch {
    display: flex;
    align-items: center;
    justify-content: left !important;
    color: #96B0B7;
    font-weight: 400;
    font-size: 12px;
    margin: 5px 0;
}
   </style>
<?php $tab = @$_GET['tab'] ? $_GET['tab'] : "home";
; ?>

<?php 
$this->load->view(THEME . 'common/header'); ?>


<!-- Begin main content -->
<div class="main-content">
   <!-- content -->
   <div class="page-content">
      <!-- page header -->
      <div class="page-title-box tick_details">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-8">
                  <h5 class="card-title">SEO Stadium </h5>
               </div>
               <div class="col-sm-4">
                  <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                    </div>
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
                              <a href="#home-b1" data-id="home" data-toggle="tab" aria-expanded="false"
                                 class="nav-link <?php echo $tab == "home" ? "active" : ""; ?>">
                                 Add or Edit SEO Stadium
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="#profile-b1" data-id="content" data-toggle="tab" aria-expanded="true"
                                 class="nav-link  <?php echo $tab == "content" ? "active" : ""; ?>"
                                 id="profile-b1-link">
                                 SEO Content 
                              </a>
                           </li>

                           <li class="nav-item">
                              <a href="#profile-b2" data-id="page_content" data-toggle="tab" aria-expanded="true"
                                 class="nav-link  <?php echo $tab == "page_content" ? "active" : ""; ?>"
                                 id="profile-b2-link">
                                 Page Content 
                              </a>
                           </li>

                        </ul>
                        <!--  -->
                        <div class="tab-content">
                           <div class="tab-pane show <?php echo $tab == "home" ? "active" : ""; ?>" id="home-b1">
                           <form id="match-form" method="post"
                                          class="<?php echo (isset($tournaments->v_id)) ? 'validate_form_edit' : 'validate_form_v1'; ?> login-wrapper"
                                          action="<?php echo base_url(); ?>settings/seo_venue_list/save"
                                          class="match-form-class">
                                          <input type="hidden" name="seocountryId" value="<?php if (isset($tournaments->v_id)) {
                                             echo $tournaments->v_id;
                                          } ?>">
                              <div class="row">                              
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">SEO Stadium</h5>
                                          <p>Fill the following SEO Stadium information</p>
                                       </div>
                                       <div class="row">
                                       <div class="col-8">
                                       <div class="">
                                                   <div class="row column_modified">
                                                      <div class="col-lg-6" style="display:none">
                                                         <div class="form-group">
                                                            <label for="country_name">Country Name <span
                                                                  class="text-danger">*</span> </label>
                                                            <input required type="text" name="name" id="country_name" class="form-control" placeholder="Enter Country Name" value="<?php if (isset($tournaments->country_name)) {
                                                                  echo $tournaments->country_name;
                                                               } ?>">
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="example-select">Country <span class="text-danger">*</span></label>
                                                      <select class="custom-select change_country" id="country" name="venue_country" onchange="get_state_city(this.value);" required>
                                                                     <option value="">Select Country</option>
                                                                     <?php foreach($countries as $country){ ?>
                                                                     <option <?php if($tournaments->venue_country == $country->id){?> selected <?php } ?> value="<?php echo $country->id;?>"><?php echo $country->name;?></option>
                                                                     <?php } ?>
                                                               </select> 
                                                   </div> 
                                                 </div> 
                                                      <div class="col-lg-6">
                                                         <div class="form-group city_dropdown">
                                                      <label for="example-select">City<span class="text-danger">*</span></label>
                                                      <?php $cityArray = $this->General_Model->get_state_cities($tournaments->venue_country);      
                                                                     $top_city_ids = explode(',', $tournaments->venue_city);     
                                                                              
                                                      ?>                                           
                                                         <select class="custom-select change_city" id="city" name="venue_city" required >
                                                         <!-- <select name='top_city[]' id="selectize-maximum"
                                                               class="form-control" multiple="multiple"> -->
                                                                  <option value="">Select City</option>
                                                                  <?php    
                                                                  
                                                                  
                                 foreach ($cityArray as $cityArr) {
                                    ?>
                                    <option value="<?= $cityArr->id; ?>" <?php                             
                                       if (in_array($cityArr->id, $top_city_ids)) {
                                          echo 'selected';
                                       }
                                    ?>><?= $cityArr->name; ?></option>

                                             <?php
                                       }
                                                                        ?>
                                                               </select>
                                                </div> 
                                                      </div>
                                                      
                                                      <div class="col-lg-6">
                                                            <div class="form-group">
                                                               <label for="example-select">Stadium<span class="text-danger">*</span></label>

                                                               <select class="custom-select change_stadium" id="venue" name="top_venue[]" required >
                                                                              <option value="">Select Stadium</option>
                                                                              <?php 
                                                                              $top_venue_ids = explode(',', $tournaments->top_venue); 
                                                                              foreach($stadiums as $stadium){
                                                                                 $stadium_name = $stadium->stadium_name;
                                                                                 if($stadium->stadium_variant != ''){
                                                                                    $stadium_name = $stadium->stadium_name.'-'.$stadium->stadium_variant;
                                                                                 }
                                                                              ?>
                                                                              <option <?php 
                                                                              if (in_array($stadium->s_id, $top_venue_ids)) {
                                                                                 echo 'selected';
                                                                              } ?>                                                    
                                                                              value="<?php echo $stadium->s_id;?>" data-value="<?php

                                                                              $stdName = strtolower($stadium->stadium_name); 
                                                                              $keyword = "stadium";
                                                                               if (strpos($stdName, $keyword) === false) {
                                                                                 $stdName .= " ".$keyword;
                                                                              }
                                                                              echo $stdName;
                                                                               //echo $stadium->stadium_name;
                                                                               ?>"><?php echo $stadium_name;?>
                                                                           </option>
                                                                              <?php } ?>
                                                                        </select>  

                                                            </div> 
                                                          </div>

                                                          <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="simpleinput">URL Key</label>
                                                            <input  type="text" id="url_key" name="url_key"
                                                               class="form-control" placeholder="Enter URL Key" value="<?php
                                                               echo isset($tournaments->url_key) ? $tournaments->url_key : ''; ?>">
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="example-select">Venue Image <span
                                                                  class="text-danger">*</label>
                                                            <div class="prev_back_img">
                                                               <label class="custom-upload mb-0"><input type="hidden"
                                                                     name="exs_file" value="<?php if (isset($tournaments->venue_image)) {
                                                                        echo $tournaments->venue_image;
                                                                     } ?>"><input type="file" class="form-control-file input"
                                                                     name="tournament_image" id="tournament_image" value=""
                                                                     onchange="loadFiles(event,'blog_img_file')"  <?php if($tournaments->v_id==""){?> required <?php } ?> accept="image/*"> Upload JPEG
                                                                  File</label>
                                                               <p>Preview Venue Image </p>
            <a id="blog_img_file_link" target="_blank"
               href="javascript:void(0);" onclick="return popitup('<?php if (isset($tournaments->venue_image)) { echo UPLOAD_PATH . 'uploads/seo_venue/' . $tournaments->venue_image; } ?>')" class="view_bg">
               <img width="30" height="30" src="<?php if (isset($tournaments->venue_image)) {
                  echo UPLOAD_PATH . 'uploads/seo_venue/' . $tournaments->venue_image;
               } else {
                  echo UPLOAD_PATH . 'uploads/general_settings/no-image.png';
               } ?>" id="blog_img_file">
                                                               </a>
                                                            </div>
                                                         </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="example-select">Venue Icon <span
                                                            class="text-danger">*</label>
                                                      <div class="prev_back_img">
                                                         <label class="custom-upload mb-0"><input type="hidden"
                                                               name="exs_file_icon" value="<?php if (isset($tournaments->venue_icon)) {
                                                                  echo $tournaments->venue_icon;
                                                               } ?>"><input type="file" class="form-control-file input"
                                                               name="venue_icon" id="venue_icon" value=""
                                                               onchange="loadFiles_icon(event,'blog_img_file_icon')"  <?php if($tournaments->v_id==""){?> required <?php } ?> accept="image/*"> Upload JPEG
                                                            File</label>
                                                         <p>Preview Venue Icon </p>
                                                         <a id="blog_img_file_icon_link" target="_blank"
                                                            href="javascript:void(0);" onclick="return popitup('<?php if (isset($tournaments->venue_icon)) { echo UPLOAD_PATH . 'uploads/seo_venue_icon/' . $tournaments->venue_icon; } ?>')" class="view_bg">
                                                            <img width="30" height="30" src="<?php if (isset($tournaments->venue_icon)) {
                                                               echo UPLOAD_PATH . 'uploads/seo_venue_icon/' . $tournaments->venue_icon;
                                                            } else {
                                                               echo UPLOAD_PATH . 'uploads/general_settings/no-image.png';
                                                            } ?>" id="blog_img_file_icon">
                                                         </a>
                                                      </div>
                                                   </div>
                                                </div>

                                                   </div> <!-- end col -->
                                                </div> <!-- end card-body -->
                                       </div>

                                       <div class="col-4">
                                       <div class="card">
                                    <div class="row column_modified">
                                       <div class="col-lg-12">
                                          <div class="data_edit">
                                             <table style="width: 100%;"> 
                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Status</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch19" name="status" value="1" <?php if ($tournaments->status==1 || $tournaments->status=='' ) { echo 'checked';  }?> ><label class="custom-control-label" for="customSwitch19"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                                <tr>
                                                   <td><label for="sellers" class="mb-0">Top Stadium</label></td>
                                                   <td>
                                                      <div class="form-group mb-1 cust-switch">
                                                         No / Yes
                                                         <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch20" name="top_venue_status" value="1" <?php if ($tournaments->top_venue_status==1 ) { echo 'checked';  }?> ><label class="custom-control-label" for="customSwitch20"></label>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>

                                             </table>
                                            </div>
                                            </div></div>
                                                         </div>
                                       </div>
                                       </div>



                                          <div class="clearfix"></div>
                                          <div class="col-lg-12">
                                             <div class="tick_details border-top">
                                                <div class="row">
                                                   <div class="col-sm-8">
                                                      <!-- <h5 class="card-title">Matches</h5> -->
                                                   </div>
                                                   <div class="col-sm-4">
                                                      <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                                                         <a href="<?php echo base_url(); ?>settings/seo_venue_list/"
                                                            class="btn btn-primary mb-2 mt-3">Back</a>
                                                         <button type="submit"
                                                            class="btn btn-success mb-2 ml-2 mt-3">Save</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                    </div> <!-- end card -->
                                 </div><!-- end col -->
                              </div>
                              <!-- end row -->
                              </form>
                           </div>



                           <div class="tab-pane <?php echo $tab == "content" ? "active" : ""; ?>" id="profile-b1">
                              <div class="row">
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">SEO Content Info</h5>
                                          <p>Fill the SEO Content Information</p>
                                       </div>
                                       <div class="">
                                          <form id="seo_tab" method="post"
                                             class="<?php echo (isset($tournaments->v_id)) ? 'validate_edit_v2' : 'validate_form_v2'; ?>  login-wrapper"
                                             action="<?php echo base_url(); ?>settings/seo_venue_list/save/1">
                                             <input type="hidden" name="seocountryId" value="<?php if (isset($tournaments->v_id)) {
                                                echo $tournaments->v_id;
                                             } ?>">
                                             <input type="hidden" name="seo_country_name" value="<?php if (isset($tournaments->venue_name)) {
                                                echo $tournaments->venue_name;
                                             } ?>">
                                             <input type="hidden" name="flag" value="content">
                                             <div class="row column_modified">
                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Venue Name *</label>
                                                      <input disabled type="text" id="" name="" class="form-control"
                                                         placeholder="Enter Country  Name"
                                                         value="<?php
                                                         echo isset($tournaments->venue_name) ? $tournaments->venue_name : ''; ?>">

                                                   </div>
                                                </div>
                                                <?php //if ($this->session->userdata('role') != 7) { ?>
                                                   <div class="col-lg-6">
                                                      <div class="form-group">
                                                         <label for="simpleinput">Title *</label>
                                                         <input type="text" id="title" name="title" class="form-control"
                                                            placeholder="Enter Title" value="<?php if (isset($tournaments->page_title)) {
                                                               echo $tournaments->page_title;
                                                            } ?>">
                                                      </div>
                                                   </div>

                                                   <div class="col-lg-12">
                                                      <div class="form-group">
                                                         <label for="example-textarea">Meta Description *</label>
                                                         <textarea class="form-control height_auto " id="example-textarea"
                                                            rows="5" name="metadescription"
                                                            placeholder="Enter Meta Description"><?php echo isset($tournaments->meta_description) ? $tournaments->meta_description : ''; ?></textarea>
                                                      </div>
                                                   </div>

                                                <?php //} else { ?>
                                                   <!-- <input type="hidden" id="title" name="title" class="input"
                                                      placeholder="Enter Title" value="<?php 
                                                      // if (isset($tournaments->page_title)) {
                                                      //    echo $tournaments->page_title;
                                                      // } ?>">
                                                   <textarea style="display:none;" class="textarea" rows="4"
                                                      placeholder="Meta Description" name="metadescription"><?php 
                                                      // if (isset($tournaments->meta_description)) {
                                                      //    echo $tournaments->meta_description;
                                                      // } ?></textarea> -->
                                                <?php //} ?>
                                                                                            

                                                <div class="col-lg-12">
                                             <div class="form-group">
                                                 <label for="simpleinput">Seo Keywords</label>
                                                 <input type="text" id="choices-text-remove-button" class="form-control" placeholder="Enter Seo Keywords" value="<?php echo isset($tournaments->seo_keywords) ? $tournaments->seo_keywords : ''; ?>" name="seo_keywords">
                                               </div>
                                          </div> 

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Search Keywords</label>
                                                      <input type="text" id="search_keywords" name="search_keywords"
                                                         class="form-control" placeholder="Enter Keywords" value="<?php if (isset($tournaments->search_keywords)) {
                                                            echo $tournaments->search_keywords;
                                                         } ?>">
                                                   </div>
                                                </div>                                                

                                                <?php $url=(isset($tournaments->v_id)) ? 'venue_url_key' : 'url_key'; ?> 

                                                <div class="col-lg-6">
                                                   <div class="form-group">
                                                      <label for="simpleinput">Stadium URL Key</label>
                                                      <input type="text" id="url_key" name="url_key"
                                                         class="form-control" placeholder="Enter URL Key" value="<?php
                                                         echo isset($tournaments->$url) ? $tournaments->$url : ''; ?>">
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
                                                               <a href="<?php echo base_url(); ?>settings/seo_venue_list/"
                                                                  class="btn btn-primary mb-2 mt-3">Back</a>
                                                               <button type="submit"
                                                                  class="btn btn-success mb-2 ml-2 mt-3">Save</button>
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
                           

                           <div class="tab-pane <?php echo $tab == "page_content" ? "active" : ""; ?>" id="profile-b2">
                              <div class="row">
                                 <div class="col-12">
                                    <div class="card">
                                       <div class="">
                                          <h5 class="card-title">Page Info</h5>
                                          <p>Fill the Page Content Information</p>
                                       </div>
                                       <div class="">
                                          <form id="page_content_tab" method="post"
                                             class="<?php echo (isset($tournaments->v_id)) ? 'validate_edit_v1' : 'validate_form_v3'; ?>  login-wrapper"
                                             action="<?php echo base_url(); ?>settings/seo_venue_list/save">
                                             <input type="hidden" name="seocountryId" value="<?php if (isset($tournaments->v_id)) {
                                                echo $tournaments->v_id;
                                             } ?>">
                                             <input type="hidden" name="flag" value="page_content">
                                             <input type="hidden" name="status_flag" value="status_not_update">
                                             <div class="row column_modified">
                                             
                                             <?php //if (isset($tournaments->pcontent)) {     echo $tournaments->pcontent;    } ?>
                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="example-textarea">Stadium Content 1</label>
                                                      <textarea id="editor-4" name="country_content_1"
                                                         placeholder="Enter Stadium Content 1"><?php echo isset($tournaments->country_content_1) ? $tournaments->country_content_1 : ''; ?></textarea>
                                                   </div>
                                                </div>

                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="example-textarea">Stadium Content 2</label>
                                                      <textarea id="editor-5" name="country_content_2"   placeholder="Enter Stadium Content 2"><?php echo isset($tournaments->country_content_2) ? $tournaments->country_content_2 : ''; ?></textarea>
                                                   </div>
                                                </div>

                                                <div class="col-lg-12">
                                                   <div class="form-group">
                                                      <label for="example-textarea">Stadium Details</label>
                                                      <textarea id="editor2" name="venue_details"   placeholder="Enter Stadium details"><?php echo isset($tournaments->venue_details) ? $tournaments->venue_details : ''; ?></textarea>
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
                                                               <a href="<?php echo base_url(); ?>settings/seo_venue_list/"
                                                                  class="btn btn-primary mb-2 mt-3">Back</a>
                                                               <button type="submit"
                                                                  class="btn btn-success mb-2 ml-2 mt-3">Save</button>
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


                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <!-- main content End -->
         <?php $this->load->view(THEME . 'common/footer'); ?>
         <script>
            $(document).ready(function () {
             //  var $select = $(document.getElementById('selectize-maximum1')).selectize();
             new Choices(document.getElementById("choices-text-remove-button"), { delimiter: ",", editItems: !0, removeItemButton: !0 });

new Choices(document.getElementById("search_keywords"), { delimiter: ",", editItems: !0, removeItemButton: !0 });

               if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0, searchFields: ['label', 'value'], allowSearch: true });
               $('.validate_form_v1').validate({
                  submitHandler: function (form) {

                     var myform = $('#' + $(form).attr('id'))[0];

                     var formData = new FormData(myform);
                     var action = $(form).attr('action');
                     $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: action,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        success: function (data) {
                           if (data.status == 1) {

                              swal('Updated !', data.msg, 'success');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);
                           } else if (data.status == 0) {

                              swal('Updation Failed !', data.msg, 'error');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);

                           }
                        }
                     })
                     return false;
                  }
               });


               $('.validate_form_v2').validate({
                  submitHandler: function (form) {

                     var myform = $('#' + $(form).attr('id'))[0];

                     var formData = new FormData(myform);
                     var action = $(form).attr('action');
                     $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: action,
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",

                        success: function (data) {
                           if (data.status == 1) {

                              swal('Updated !', data.msg, 'success');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);
                           } else if (data.status == 0) {

                              swal('Updation Failed !', data.msg, 'error');
                              setTimeout(function () { window.location.href = data.redirect_url; }, 2000);

                           }
                        }
                     })
                     return false;
                  }
               });

               // <ul class="nav nav-tabs nav-bordered">

               // Execute this code when the page finishes loading

               <?php if (empty($tournaments->v_id)) { ?>
                     $(".change_stadium").change(function() { 
                       // selected_text= $(".change_stadium option:selected").text();
                        selected_text= $(".change_stadium option:selected").attr('data-value');
                        $('#country_name').val(selected_text);
                        var val = selected_text;
                        var slug = "";
                        if (val) {
                           slug = slugfly(val);
                           $("#url_key").val(slug+'-tickets');
                           $("#seo_url_key").val(slug+'-tickets');                
                        }
                     });
               <?php  } ?>     

            });


   <?php if (empty($tournaments->v_id)) { ?>
               $("body").on("keyup", "#country_name", function () {
                  var val = $("#country_name").val();
                  var slug = "";
                  if (val) {
                     slug = slugfly(val);
                   
                     $("#url_key").val(slug+'-tickets');
                     $("#seo_url_key").val(slug+'-tickets');
                     
                  }

               });
 <?php } ?>

               function slugfly(str) {
                  str = str.replace(/^\s+|\s+$/g, ''); // trim
                  str = str.toLowerCase();

                  // remove accents, swap ñ for n, etc
                  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                  var to = "aaaaaeeeeeiiiiooooouuuunc------";
                  for (var i = 0, l = from.length; i < l; i++) {
                     str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                  }

                  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                     .replace(/\s+/g, '-') // collapse whitespace and replace by -
                     .replace(/-+/g, '-'); // collapse dashes

                  return str;
               }


            $(".nav-tabs a[data-toggle=tab]").on("click", function (e) {
               var href = $(this).data("id");
      <?php if (empty($tournaments->v_id)) { ?>
         if (href != "home") {
                     swal('Attention!', ' Please Fill The Stadium Details', 'error');
                     return false;
                  }
     <?php } else {
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

            function popitup(url, temp = '') {

               newwindow = window.open(url, 'name', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,,height=500,width=700');

               if (window.focus) { newwindow.focus() }
               return false;
            }

            var loadFiles = function(event,team_bg_file) {

var formData = new FormData();
formData.append('file', event.target.files[0]);

$.ajax({
     url : "<?php echo base_url();?>settings/upload_files",
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

var loadFiles_icon = function(event,team_bg_file) {

var formData = new FormData();
formData.append('file', event.target.files[0]);

$.ajax({
     url : "<?php echo base_url();?>settings/upload_files",
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
function get_state_city(country_id,city_id="") {
        if(country_id != ''){ 
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
</script>