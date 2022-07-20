
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Enrollment Management
        <small>Edit Enrollment</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Enrollment Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>editOldEnrollment" method="post" role="form">
                        <div class="box-body">

                            <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Student</label>
                                            <br>
                                            <select name="student" id="student" class="form-control select2">
                                            <option selected disabled value="">Select Student</option>
                                                            <?php
                                                            foreach($student->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                                            }
                                                            ?>
                                            </select>
                                        </div>
                                </div> 
                            </div>

                            <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Grade Level</label>
                                            <br>
                                            <select name="gradelevel" id="gradelevel" class="form-control">
                                                <option selected disabled value="">Select Grade Level</option>
                                                <?php
                                                            foreach($grade->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["gradelevel"].'">'.$row["gradelevel"].'</option>';
                                                            }
                                                            ?>
                                            </select>
                                        </div>
                                </div> 

                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="strand" id="lblstrand">Strand</label>
                                                    <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $enrollmentInfo->id;?>" >
                                                    <br>
                                                    <select name="strand" id="strand" class="form-control">                                                  
                                                    </select>
                                                </div>
                                </div> 

                                 
                            </div>

                            <div class="row"> 

                                <div class="col-md-6">
                                    
                                        <div class="form-group">
                                            <label for="last_name">Section</label>
                                            <br>
                                            <select name="section" id="section" class="form-control">
                                            <option selected disabled value="">Select Section</option>
                                                            <?php
                                                            foreach($section->result_array() as $row)
                                                            {
                                                                echo '<option value="'.$row["id"].'">'.$row["section"].'</option>';
                                                            }
                                                            ?>
     
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Student Type</label>
                                            <input type="hidden" class="form-control" id="stype" name="stype"  value="<?php echo $enrollmentInfo->type ?>">
                                            <br>
                                            <select name="etype" id="etype" class="form-control">
                                                <option selected disabled value="">Select Type</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Irregular">Irregular</option>
                                            </select>
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

                            <a class="btn btn-primary" hidden id="addbtn" name="addbtn" href="<?php echo base_url() ?>">Add Subject</a>

                            <div id="sched_data" class="box-body table-responsive no-padding">

                            </div><!-- /.box-body -->


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a class="btn btn-primary" href="<?php echo base_url() ?>enrollment">Cancel</a>

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

    load_sched();
    
    
$('#gradelevel').change(function(){
    var gradelevel = $('#gradelevel').val();
    if(gradelevel != '')
    {
        if(gradelevel == 'Grade 11' || gradelevel == 'Grade 12')
    {

        document.getElementById('strand').style.visibility = 'visible';
        document.getElementById('lblstrand').style.visibility = 'visible';

        $.ajax({
        url:"<?php echo base_url(); ?>schedule/getStrand",
        method:"POST",
        data:{gradelevel:gradelevel},
        success:function(data)
        {
        $('#strand').html(data);

        }
    });

    $('#section').html('');
    $('#sched_data').html('');

    

    document.getElementById("etype").removeAttribute("disabled");
    document.getElementById("etype").value = "";
    document.getElementById("stype").value = "";

     
    }

    else
    {
        $('#strand').html('');
        $('#sched_data').html('');

        document.getElementById('strand').style.visibility = 'hidden';
        document.getElementById('lblstrand').style.visibility = 'hidden';

        document.getElementById("etype").setAttribute("disabled", "disabled");

        document.getElementById("etype").value = "Regular";
        document.getElementById("stype").value = "Regular";
 

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/getSection",
        method:"POST",
        data:{gradelevel:gradelevel},
        success:function(data)
        {
        $('#section').html(data);

        }
    });



    }


    }
    else
    {
    $('#section').html('');
    }


});

$('#section').change(function(){
    var section = $('#section').val();
    var gradelevel = $('#gradelevel').val();

    if(section != '')
    {
        if(gradelevel == 'Grade 11' || gradelevel == 'Grade 12')
        {
        

        }

        else
        {

            $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_sched",
        method:"POST",
        data:{section:section,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });

        }


   
    }
    else
    {
    $('#sched_data').html('');
    }


});

$('#etype').change(function(){
    var etype = $('#etype').val();   

    document.getElementById("stype").value = etype;
});


$('#strand').change(function(){
    var gradelevel = $('#gradelevel').val();
    var strand = $('#strand').val();
    

    if(strand != '')
    {

        $.ajax({
        url:"<?php echo base_url(); ?>schedule/getSectionSHS",
        method:"POST",
        data:{gradelevel:gradelevel,strand:strand},
        success:function(data)
        {
        $('#section').html(data);

        }
    });

     
    }

    


});

document.getElementById('addbtn').style.visibility = 'hidden';

$('#etype').change(function(){
    var etype = $('#etype').val();
    var section = $('#section').val();
    var gradelevel = $('#gradelevel').val();
    

    if(etype == 'Regular')
    {

        document.getElementById('addbtn').style.visibility = 'hidden';

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_sched",
        method:"POST",
        data:{section:section,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });
    
    }

    else
    {

        document.getElementById('addbtn').style.visibility = 'visible';

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_schedirg",
        method:"POST",
        data:{section:section,etype:etype,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });

    }

});



});

function load_sched() {

    var section = $('#section').val();
    var gradelevel = $('#gradelevel').val();
    var etype = $('#etype').val();

    if(gradelevel == 'Grade 11' || gradelevel == 'Grade 12')
    {

            if(etype == 'Regular')
    {

        document.getElementById('addbtn').style.visibility = 'hidden';

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_sched",
        method:"POST",
        data:{section:section,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });
    
    }

    else
    {

        document.getElementById('addbtn').style.visibility = 'visible';

        $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_schedirg",
        method:"POST",
        data:{section:section,etype:etype,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });

    }
        

        }

        else
        {

            $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_sched",
        method:"POST",
        data:{section:section,gradelevel:gradelevel},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });

        }

}

        document.getElementById('strand').style.visibility = 'hidden';
        document.getElementById('lblstrand').style.visibility = 'hidden';


document.getElementById("student").value= "<?php echo $enrollmentInfo->studentid ?>";
document.getElementById("gradelevel").value= "<?php echo $enrollmentInfo->gradelevel ?>";
document.getElementById("section").value= "<?php echo $enrollmentInfo->sectionid ?>";
document.getElementById("etype").value= "<?php echo $enrollmentInfo->type ?>";
document.getElementById("strand").value= "<?php echo $enrollmentInfo->strandid ?>";
document.getElementById("status").value= "<?php echo $enrollmentInfo->status ?>";

    </script>