
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student List 

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
                <form action="<?php echo base_url() ?>auth/printSched" method="POST">
                  <input type="hidden" class="form-control" id="schedid" name="schedid" value="<?php echo $sched;?>" >

                  <button type="submit" name="download-sched" id="download-sched" class="btn btn-primary" ><i class="fa fa-print"></i>Print</button>

                </form>
            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url().'studentlist/'.$sched; ?> " method="POST" id="searchList">
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
                        <th>Student</th>
                        <th>Address</th>
                        <th>Student Type</th>                  
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
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->address ?></td>
                        <td><?php echo $record->type ?></td>
                        <td><?php echo $record->status ?></td>

                        <td class="text-center">

                        <?php 
                        if($record->status == "Dropped")
                        {
                            ?>

                            <a class="btn btn-sm btn-info enrollStudent" href="#" data-id="<?php echo $record->id; ?>" title="Enroll"><i class="fa fa-check"></i></a>
                        
                        <?php 
                        }

                        else
                        {
                            ?>

                            <a class="btn btn-sm btn-danger dropStudent" href="#" data-id="<?php echo $record->id; ?>" title="Drop Student"><i class="fa fa-trash"></i></a>

                        <?php 
                        }

                         ?>

                         </td>

                    </tr>
                    <?php
                        }
                    }
                    ?>
 
                  </table>
                  
                </div><!-- /.box-body -->

                 <!-- Medium modal -->
                 <div class="modal fade" id="drop-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="<?php echo base_url() ?>dropstudent" method="POST">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1 class="modal-title" style="font-size:24px;font-weight:bold;" id="myLargeModalLabel">Are you sure to drop this student?</h1>
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

                <!-- Medium modal -->
                <div class="modal fade" id="enroll-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="<?php echo base_url() ?>restorestudent" method="POST">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1 class="modal-title" style="font-size:24px;font-weight:bold;" id="myLargeModalLabel">Are you sure to re-enroll this student?</h1>
                                    <input type="hidden" class="form-control" id="dcid" name="dcid" value="">
                                </div>


                                <div class="modal-footer">
                                    <button type="submit" name="archive-student" id="archive-student" class="btn btn-primary" >Yes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h4 class="box-title" style="font-size:15px">Total Students: <?php echo $totalStudent;?></h4>

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

   
	jQuery(document).on("click", ".detailsAppt", function(){

        var id = $(this).data("id");

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_enrollmentdata",
        method:"POST",
        data:{id:id},
        success:function(data)
        {

        $("#success-modal").modal('show');
        $('#sched_data').html(data);

        }
    });

		

	});
    

    jQuery(document).on("click", ".dropStudent", function(){

var id = $(this).data("id");
document.getElementById("archiveid").value= $(this).data("id");

$("#drop-modal").modal('show');

});

jQuery(document).on("click", ".enrollStudent", function(){

var id = $(this).data("id");
document.getElementById("dcid").value= $(this).data("id");

$("#enroll-modal").modal('show');

});
		
	
});
</script>



