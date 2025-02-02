   <table class="table table-hover table-nowrap table_details_new">
                                             <thead class="">
                                                <tr>
                                                   <th data-priority="1">Active</th>
                                                   <th data-priority="1">Seller</th>
                                                   <th data-priority="1">Listing ID</th>
                                                   <th data-priority="3">Type</th>
                                                   <th data-priority="1">Qty</th>
                                                   <th data-priority="1">Sold</th>
                                                   <th data-priority="3">Category</th>
                                                   <th data-priority="3">Block</th>
                                                   <th data-priority="6">Row</th>
                                                   <th data-priority="6">Split Type</th>
                                                   <th data-priority="1">Notes</th>
                                                   <th data-priority="1">Price</th>
                                                   <th>&nbsp;</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php  $i=24 ;


                                               //echo "<pre>";print_r($listings);exit;
                                                if($listings){
                                                foreach ($listings as $ticket) { 
                                                   // echo "<pre>";print_r($ticket);
                                                    // $condition['stadium_id'] = $match_details[0]->venue;
                                                    // $condition['category'] = $ticket->ticket_category;
                                                    // $blocks_data = $this->General_Model->getAllItemTable('stadium_details', $condition)->result();
                                                    
                                                    $i++;?>
                                                <tr>

                                                   <td>
                                                      <div class="custom-control custom-switch">
                                                         <input type="checkbox"  data-ticket="<?php echo $ticket->s_no; ?>"  class="custom-control-input sell_ticket_status" id="customSwitch<?php echo $i;?>" name="status" <?php if ($ticket->status == 1) { ?> checked="checked" <?php } ?> value="1" >
                                                        <label class="custom-control-label" for="customSwitch<?php echo $i;?>"></label>
                                                      </div>
                                                   </td>
                                                   <td><?php echo $ticket->admin_name." ".$ticket->admin_last_name; ?></td>
                                                   <td data-priority="1">
                                                      <span class="bg_clr_id"><?php echo $ticket->ticketid; ?><br>
                                                       </span>
                                                   </td>
                                                   <td><?php
                                                  echo $ticket->ticket_types_name;
                                                   
                                                   
                                                   ?></td>
                                                   <td><?php echo $ticket->quantity; ?></td>
                                                   <td><?php echo $ticket->sold; ?></td>
                                                   <td><?php echo $ticket->stadium_seat_category; ?></td>
                                                   <td>
                                                    <?php
                                                    
                                                     if($ticket->ticket_block_name){
                                                      echo  $ticket_block = end(explode("-", $ticket->ticket_block_name) );
                                                      
                                                     }
                                                   ?></td>
                                                   <td><?php echo $ticket->row; ?></td>
                                                   <td>
                                                   <?php
                                                   //foreach ($split_types as $split_type) { 
                                                    //if ($ticket->split == $split_type->id) {
                                                        echo $ticket->split_name;
                                                    //}
                                                    //} 
                                                   ?>
                                                   </td>
                                                   <td>
                                                    <?php
                                                    $seller_notes_input="";
                                                    $seller_notes="";
                                                       $listing_note=$this->General_Model->get_seller_notes($ticket->listing_note); 
                                                       if(!empty($listing_note))
                                                       {        
                                                         foreach ($listing_note as $notes)
                                                         {
                                                           $seller_notes_input.=$notes->ticket_name."<br/>";
                                                          
                                                         }
                                               
                                                       
                                                    ?>
                                                      <a class="tooltip_texts" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $seller_notes_input; ?>" aria-describedby="tooltip_<?php echo $ticket->ticketid; ?>" data-html="true"><i class="fas fa-comment-dots" ></i></a>
                                                    <?php } ?>
                                                   </td>
                                                   <td><?php echo $ticket->price_type; ?> <?php echo $ticket->price; ?></td>
                                                   <td>
                                                      <div class="dropdown">
                                                         <a href="javascript:void(0)" class="btn-icon btn-icon-sm btn-icon-soft-primary"
                                                            data-toggle="dropdown">
                                                            <i class="mdi mdi-dots-vertical fs-sm"></i>
                                                         </a>
                                                         <div class="dropdown-menu dropdown-menu-right">
                                                             <a data-ticket-id="<?php echo $ticket->s_no; ?>" href="javascript:void(0);" class="edit_ticket dropdown-item edit_ticket_btn">Edit</a>
                                                            <a data-ticket-id="<?php echo $ticket->s_no; ?>" href="javascript:void(0);" class="ticket_clone dropdown-item edit_clone_info">Clone </a>
                                                            <a href="javascript:void(0);" data-match="<?php echo $ticket->match_id; ?>" data-s_no="<?php echo $ticket->s_no; ?>" data-ticket="<?php echo $ticket->ticketid; ?>" id="ticket-delete-<?php echo $ticket->ticketid; ?>" class="dropdown-item ticket_delete">Delete </a>
                                                            <a  target="_blank" href="<?php echo base_url();?>event/ticket_logs/<?php echo $ticket->s_no; ?>" class="dropdown-item">Ticket Logs </a>
                                                         </div>
                                                      </div>
                                                   </td>
                                                </tr>
                                              <?php }  }else {?>
               <tr><td colspan="12" class="text-center">No Ticket Available</td></tr>
            <?php } ?>
                                                </tbody>
                                          </table>
<script type="text/javascript">
  $(document).ready(function() {
    if($('[data-toggle="tooltip"]').length){ 
      $('[data-toggle="tooltip"]').tooltip()
   }

   toolTipShow();
 });

 function toolTipShow() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
         return new bootstrap.Tooltip(tooltipTriggerEl)
      })
   }
</script>