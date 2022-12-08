
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student Management

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
               
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewStudent"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url() ?>student" method="POST" id="searchList">
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
                        <th>LRN</th>
                        <th>Name</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Contact No.</th>
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
                        <td><?php echo $record->lrn ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo date("m-d-Y", strtotime($record->birthdate)) ?></td>
                        <td><?php echo $record->gender ?></td>
                        <td><?php echo $record->address ?></td>
                        <td><?php echo $record->contactno ?></td>
                        <td><?php echo $record->studenttype ?></td>
                        <td><?php echo $record->status ?></td>
                        <td class="text-center">
                       
                            <a class="btn btn-sm btn-info detailsAppt" href="#" data-id="<?php echo $record->id; ?>" title="View"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'editStudent/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
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
				      <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
                                <form action="<?php echo base_url() ?>auth/printStudentInfo" method="POST">
									<div class="modal-content">

										<div class="modal-header">
											<h5 class="modal-title" style="font-size:18px;font-weight:bold;" id="myLargeModalLabel">Student Details</h5>
                                            <input type="hidden" class="form-control" id="studentid" name="studentid" >
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>


										<div class="modal-body" id="infodata">

                                            <div class="row">
                                                <div class="col-md-3">                                
                                                    <div class="form-group">
                                                    <label for="last_name">Student Type</label>
                                                        <input type="text" class="form-control"id="studenttype" name="studenttype" readonly maxlength="128">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">LRN</label>
                                                        <input type="number" class="form-control" id="lrn" name="lrn"  readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">                                
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="firstname" name="firstname"  maxlength="128" readonly>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Middle Name</label>
                                                        <input type="text" class="form-control"id="middlename" name="middlename"  readonly maxlength="128">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">                                
                                                    <div class="form-group">
                                                        <label for="first_name">Last Name</label>
                                                        <input type="text" class="form-control" id="lastname" name="lastname"  maxlength="128" readonly>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Suffix</label>
                                                        <input type="text" class="form-control"  id="suffix" name="suffix"  readonly maxlength="128">
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Birthdate</label>
                                                            <input type="date" class="form-control" id="birthdate" name="birthdate" data-date-format="mm/dd/yyyy" maxlength="128" readonly>
                                                        </div>
                                                    </div>     
                                                                        
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="last_name">Gender</label>
                                                        <input type="text" class="form-control"id="gender" name="gender"  readonly maxlength="128">
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Religion</label>
                                                        <input type="text" class="form-control" id="religion" name="religion" readonly maxlength="128">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_no">Nationality</label>
                                                        <input type="text" class="form-control" id="nationality"  name="nationality" readonly maxlength="128">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="last_name">Province</label>
                                                        <input type="text" class="form-control"id="province" name="province" readonly maxlength="128">
                                                        </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="last_name">City</label>
                                                        <input type="text" class="form-control"id="city" name="city" readonly maxlength="128">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="last_name">Barangay</label>
                                                        <input type="text" class="form-control"id="barangay" name="barangay"  readonly maxlength="128">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_no">Address</label>
                                                        <input type="text" class="form-control" id="address"  name="address" readonly maxlength="128">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Mother's Name</label>
                                                        <input type="text" class="form-control" id="mother" name="mother" readonly maxlength="128">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_no">Father's Name</label>
                                                        <input type="text" class="form-control" id="father"  name="father"  readonly maxlength="128">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Guardian</label>
                                                        <input type="text" class="form-control" id="guardian" name="guardian" readonly maxlength="128">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact_no">Contact No.</label>
                                                        <input type="text" class="form-control" id="contactno"  name="contactno" readonly maxlength="11">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" readonly maxlength="128">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="last_name">Status</label>
                                                        <input type="text" class="form-control"id="status" name="status" readonly maxlength="128">
                                                        </div>
                                                </div> 
                                            </div>

                                                    
                                                

										</div>

                                        


										<div class="modal-footer">
										    <button type="submit" name="download-studentinfo" id="download-studentinfo" class="btn btn-primary" >Print</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
                                    </form>
								</div>
						</div>

                            <!-- Medium modal -->
                        <div class="modal fade" id="archive-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="<?php echo base_url() ?>archivestudent" method="POST">
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
        document.getElementById("studentid").value= $(this).data("id");

		

		$.ajax({
				url:"student/getStudentData",
				method:"POST",
				dataType:"json",
				data:{id:id},
				success:function(data){

				
					$("#success-modal").modal('show');
					$('#studenttype').val(data.record[0].studenttype);
                    $('#lrn').val(data.record[0].lrn); 
					$('#firstname').val(data.record[0].firstname); 
					$('#middlename').val(data.record[0].middlename); 	
                    $('#lastname').val(data.record[0].lastname); 	
                    $('#suffix').val(data.record[0].suffix); 	
					$('#birthdate').val(data.record[0].birthdate);
					$('#gender').val(data.record[0].gender); 		
					$('#religion').val(data.record[0].religion); 	
                    $('#nationality').val(data.record[0].nationality);
                    $('#province').val(data.record[0].province);
                    $('#city').val(data.record[0].city);
                    $('#barangay').val(data.record[0].barangay);
                    $('#address').val(data.record[0].address);
                    $('#mother').val(data.record[0].mother);
                    $('#father').val(data.record[0].father);
                    $('#guardian').val(data.record[0].guardian);
                    $('#contactno').val(data.record[0].contactno);
                    $('#email').val(data.record[0].email);
                    $('#status').val(data.record[0].status);


				}
			});

	});

jQuery(document).on("click", ".archiveAppt", function(){

var id = $(this).data("id");
document.getElementById("archiveid").value= $(this).data("id");

$("#archive-modal").modal('show');



});

	
});
</script>
