
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> My Account
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Account Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <div class="text-right">
                        <div class="form-group">       
                            <form action="<?php echo base_url() ?>auth/printStudentInfo" method="POST">
                                <input type="hidden" class="form-control" id="studentid" name="studentid" value="<?php echo $studentInfo->id;?>" >

                                <button type="submit" name="download-sched" id="download-sched" class="btn btn-primary" ><i class="fa fa-print"></i>Print</button>

                            </form>
                
                        </div>
                    </div>


                    <form role="form" id="addUser" action="" method="post" role="form">
                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="status" class="form-control" id="status" name="status" value="<?php echo $studentInfo->status;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">ID No.</label>
                                        <input type="text" class="form-control" id="idno" name="idno" value="<?php echo $studentInfo->idno;?>" maxlength="128" disabled>
                                        <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $studentInfo->id;?>" maxlength="128" disabled>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">LRN</label>
                                        <input type="text" class="form-control" id="lrn" name="lrn" value="<?php echo $studentInfo->lrn;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $studentInfo->firstname;?>" maxlength="128" disabled>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Middle Name</label>
                                        <input type="text" class="form-control"id="middlename" name="middlename"  value="<?php echo $studentInfo->middlename;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"  value="<?php echo $studentInfo->lastname;?>" maxlength="128" disabled>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Suffix</label>
                                        <input type="text" class="form-control"  id="suffix" name="suffix"  value="<?php echo $studentInfo->suffix;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" data-date-format="mm/dd/yyyy" value="<?php echo date("Y-m-d", strtotime($studentInfo->birthdate));?>" maxlength="128" disabled>
                                        </div>
                                    </div>     
                                                           
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $studentInfo->gender;?>" maxlength="128" disabled>
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Religion</label>
                                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $studentInfo->religion;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Nationality</label>
                                        <input type="text" class="form-control" id="nationality"  name="nationality" value="<?php echo $studentInfo->nationality;?>" maxlength="128" disabled>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <input type="text" class="form-control" id="province" name="province" value="<?php echo $studentInfo->province;?>" maxlength="128" disabled>
                                    </div>
                                </div> 
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"   value="<?php echo $studentInfo->city;?>" maxlength="128" disabled>
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barangay">Barangay</label>
                                        <input type="text" class="form-control" id="barangay" name="barangay"  value="<?php echo $studentInfo->barangay;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Address</label>
                                        <input type="text" class="form-control" id="address"  name="address" value="<?php echo $studentInfo->address;?>" maxlength="128" disabled>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother" name="mother" value="<?php echo $studentInfo->mother;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Father's Name</label>
                                        <input type="text" class="form-control" id="father"  name="father"  value="<?php echo $studentInfo->father;?>"maxlength="128" disabled>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Guardian</label>
                                        <input type="text" class="form-control" id="guardian" name="guardian" value="<?php echo $studentInfo->guardian;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="text" class="form-control" id="contactno"  name="contactno" value="<?php echo $studentInfo->contactno;?>" maxlength="121" disabled>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $studentInfo->email;?>" maxlength="128" disabled>
                                    </div>
                                </div>
                            
                                
                            </div>


                        </div><!-- /.box-body -->
    
                    </form>
                </div>
            </div>

            <div class="col-md-4">
            <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
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
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
