
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Pre-Enrollment Management

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
               
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pre-Enrolled List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url() ?>preenrollmentlist" method="POST" id="searchList">
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
                        <th>Grade Level</th>
                        <th>Section</th>
                        <th>Strand</th>
                        <th>Term</th>
                        <th>School Year</th> 
                        <th>Date Requested</th> 
                        <th>Date Enrolled</th>                           
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
                        <td><?php echo $record->student ?></td>
                        <td><?php echo $record->gradelevel ?></td>
                        <td><?php echo $record->section ?></td>        
                        <td><?php echo $record->strandcode ?></td>                
                        <td><?php echo $record->term ?></td>
                        <td><?php echo $record->schoolyear ?></td>
                        <td><?php echo $record->date_requested ?></td>
                        <td><?php echo $record->date_enrolled ?></td>
                        <td><?php echo $record->status ?></td>
                        <td class="text-center">

                            <a class="btn btn-sm btn-info detailsAppt" href="#" data-id="<?php echo $record->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-info"href="<?php echo base_url().'enrollment/approvedRequest/'.$record->id; ?>" data-id="<?php echo $record->id; ?>" title="Approve"><i class="fa fa-check"></i></a> 
                            <a class="btn btn-sm btn-info"href="<?php echo base_url().'enrollment/declinedRequest/'.$record->id; ?>" data-id="<?php echo $record->id; ?>" title="Decline"><i class="fa fa-close"></i></a> 
                           
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
 
                  </table>

                   <!-- Medium modal -->
				      <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">

										<div class="modal-header">
											<h5 class="modal-title" style="font-size:18px;font-weight:bold;" id="myLargeModalLabel">Enrollment Details</h5>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>


										<div class="modal-body" id="sched_data">

                                                    
                                                

										</div>

                                        


										<div class="modal-footer">
										    <button type="submit" name="download-appointment" id="download-appointment" class="btn btn-primary" >Print</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
                  
                </div><!-- /.box-body -->
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
    

    
		
	
});
</script>