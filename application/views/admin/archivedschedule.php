
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Schedule Management

      </h1>
    </section>
    
    <section class="content">
        <div class="row">   
        <div class="col-xs-6 text-center">
                <div class="form-group">                    
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>               
                </div>
            </div>   

        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Schedule Archived List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url() ?>archivedschedule" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText"  class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>                     
                        <th>Grade Level</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Teacher</th>
                        <th>Term</th>
                        <th>School Year</th>                      
                        <th>Status</th>
                        <th class="text-center"></th>
                    </tr>

                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                    <td><?php echo $record->id ?></td>
                        <td><?php echo $record->gradelevel ?></td>
                        <td><?php echo $record->section ?></td>
                        <td><?php echo $record->subject ?></td>
                        <td><?php echo $record->room ?></td>
                        <td><?php echo $record->day ?></td>
                        <td><?php echo $record->time ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->term ?></td>
                        <td><?php echo $record->schoolyear ?></td>
                        <td><?php echo $record->status ?></td>
                        <td class="text-center">
                       
                        <a class="btn btn-sm btn-danger archiveAppt" href="#" data-id="<?php echo $record->id; ?>" title="Restore"><i class="fa fa-check"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
 
                  </table>
                  
                </div><!-- /.box-body -->

                <!-- Medium modal -->
                <div class="modal fade" id="archive-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="<?php echo base_url() ?>retreieveschedule" method="POST">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1 class="modal-title" style="font-size:24px;font-weight:bold;" id="myLargeModalLabel">Are you sure to retrive this record?</h1>
                                    <input type="hidden" class="form-control" id="archiveid" name="archiveid" value="">
                                </div>


                                <div class="modal-footer">
                                    <button type="submit" name="archive-student" id="archive-student" class="btn btn-primary" >Yes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script>
jQuery(document).ready(function(){

    jQuery(document).on("click", ".archiveAppt", function(){

var id = $(this).data("id");
document.getElementById("archiveid").value= $(this).data("id");

$("#archive-modal").modal('show');

});
    
	
});
</script>

