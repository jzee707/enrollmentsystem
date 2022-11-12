
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student Management
        <small>Edit Student</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>editOldStudent" method="post" role="form">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="type">Student Type</label>
                                        <select name="studenttype" id="studenttype"  class="form-control">
                                            <option value="Old">Old</option>
                                            <option value="New">New</option>
                                            <option value="Transferee">Transferee</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">LRN</label>
                                        <input type="number" class="form-control" id="lrn" name="lrn" value="<?php echo $studentInfo->lrn;?>" maxlength="128" required>
                                        <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $studentInfo->id;?>" maxlength="128" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $studentInfo->firstname;?>" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Middle Name</label>
                                        <input type="text" class="form-control"id="middlename" name="middlename"  value="<?php echo $studentInfo->middlename;?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"  value="<?php echo $studentInfo->lastname;?>" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Suffix</label>
                                        <input type="text" class="form-control"  id="suffix" name="suffix"  value="<?php echo $studentInfo->suffix;?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" data-date-format="mm/dd/yyyy" value="<?php echo date("Y-m-d", strtotime($studentInfo->birthdate));?>" maxlength="128">
                                        </div>
                                    </div>     
                                                           
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Gender</label>
                                            <br>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Religion</label>
                                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $studentInfo->religion;?>" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Nationality</label>
                                        <input type="text" class="form-control" id="nationality"  name="nationality" value="<?php echo $studentInfo->nationality;?>" maxlength="128">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Province</label>
                                            <br>
                                            <select name="province" id="province"  class="form-control">
                                                 <?php
                                                            foreach($province->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["province"].'">'.$row["province"].'</option>';
                                                            }
                                                            ?>
    
                                            </select>
                                        </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="last_name">City</label>
                                            <br>
                                            <select name="city" id="city" class="form-control">
                                            <option selected disabled>Choose...</option>
                                            <?php
                                                            foreach($city->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["city"].'">'.$row["city"].'</option>';
                                                            }
                                                            ?>
                                            </select>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="last_name">Barangay</label>
                                            <br>
                                            <select name="barangay" id="barangay"  class="form-control">
                                            <option selected disabled>Choose...</option>
                                            <?php
                                                            foreach($barangay->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["id"].'">'.$row["barangay"].'</option>';
                                                            }
                                                            ?>
                                            </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Address</label>
                                        <input type="text" class="form-control" id="address"  name="address" value="<?php echo $studentInfo->address;?>" maxlength="128">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother" name="mother" value="<?php echo $studentInfo->mother;?>" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Father's Name</label>
                                        <input type="text" class="form-control" id="father"  name="father"  value="<?php echo $studentInfo->father;?>"maxlength="128">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Guardian</label>
                                        <input type="text" class="form-control" id="guardian" name="guardian" value="<?php echo $studentInfo->guardian;?>" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="contactno"  name="contactno" value="<?php echo $studentInfo->contactno;?>" maxlength="11">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $studentInfo->email;?>" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Status</label>
                                            <br>
                                            <select name="status" id="status" class="form-control">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                </div> 
                            </div>


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a class="btn btn-primary" href="<?php echo base_url() ?>student">Cancel</a>
                        </div>
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

<script type="text/javascript">
$(document).ready(function(){
    
$('#province').change(function(){
    var province = $('#province').val();
    if(province != '')
    {
    $.ajax({
        url:"<?php echo base_url(); ?>faculty/getCity",
        method:"POST",
        data:{province:province},
        success:function(data)
        {
        $('#city').html(data);
        $('#barangay').html('<option value="">Select Barangay</option>');
        }
    });
    }
    else
    {
    $('#city').html('<option value="">Select City</option>');
    }
});

$('#city').change(function(){
    var city = $('#city').val();
    if(city != '')
    {
    $.ajax({
        url:"<?php echo base_url(); ?>faculty/getBarangay",
        method:"POST",
        data:{city:city},
        success:function(data)
        {
        $('#barangay').html(data);
        }
    });
    }
    else
    {
    $('#barangay').html('<option value="">Select Barangay</option>');
    }
});

});

        document.getElementById("province").value= "<?php echo $studentInfo->province ?>";
        document.getElementById("city").value= "<?php echo $studentInfo->city ?>";
        document.getElementById("barangay").value = "<?php echo $studentInfo->addid ?>";

        document.getElementById("gender").value= "<?php echo $studentInfo->gender ?>";
        document.getElementById("studenttype").value= "<?php echo $studentInfo->studenttype ?>";
        document.getElementById("status").value= "<?php echo $studentInfo->status ?>";

       

    </script>