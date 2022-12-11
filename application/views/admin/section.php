
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Section Management

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

            <div class="col-xs-6  text-right">
                <div class="form-group">       
               
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewSection"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Section List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url() ?>section" method="POST" id="searchList">
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
                        <th>Adviser</th>
                        <th>Section</th>
                        <th>Strand</th>
                        <th>Limit</th>

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
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->section ?></td>
                        <td><?php echo $record->strandcode ?></td>
                        <td><?php echo $record->level ?></td>

                        <td class="text-center">
                       
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'editSection/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger archiveAppt" href="#" data-id="<?php echo $record->id; ?>" title="Archive"><i class="fa fa-trash"></i></a> 
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
                        <form action="<?php echo base_url() ?>archivesection" method="POST">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1 class="modal-title" style="font-size:24px;font-weight:bold;" id="myLargeModalLabel">Are you sure to delete this record?</h1>
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


