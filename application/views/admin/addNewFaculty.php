
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Faculty Management
        <small>Add Faculty</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Faculty Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>addFaculty" method="post" role="form">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="type">Faculty Type</label>
                                        <select name="facultytype" id="facultytype"  class="form-control">
                                            <option value="Administrator">Administrator</option>
                                            <option value="Teacher">Teacher</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">ID No.</label>
                                        <input type="text" disabled class="form-control" id="idno" name="idno" maxlength="128">
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Middle Name</label>
                                        <input type="text" class="form-control"id="middlename" name="middlename" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Suffix</label>
                                        <input type="text" class="form-control"  id="suffix" name="suffix" maxlength="128">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" maxlength="128">
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
                                            </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Address</label>
                                        <input type="text" class="form-control" id="address"  name="address" maxlength="128">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Contact Person</label>
                                        <input type="text" class="form-control" id="contactperson" name="contactperson" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="number" class="form-control" id="contactno"  name="contactno" maxlength="11">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" maxlength="128">
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" maxlength="128">
                                    </div>
                                </div>
                            

                            </div>

                            <div class="row">                     
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
                            <a class="btn btn-primary" href="<?php echo base_url() ?>faculty">Cancel</a>
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

function idno()
{

    $.ajax({
        url:"<?php echo base_url(); ?>faculty/getidno",
        method:"POST",
        dataType:"json",
        success:function(data)
        {
        $('#idno').html(data.record[0].idno);        
        document.getElementById("idno").value = data.record[0].idno;
        }
    });
}

setInterval(function(){
            idno();
		},1000);


    
});

    </script>