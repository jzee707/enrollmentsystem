
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Schedule Management
        <small>Add Schedule</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Schedule Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>addSchedule" method="post" role="form">
                        <div class="box-body">

                        <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Grade Level</label>
                                            <br>
                                            <select name="gradelevel" id="gradelevel" class="form-control">
                                            <option disabled selected value="">Select Grade Level</option>
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
                                                    <br>
                                                    <select name="strand" id="strand" class="form-control">                                                  
                                                    </select>
                                                </div>
                                    </div> 
                                
                                </div>


                            <div class="row">

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="section">Section</label>
                                            <br>
                                            <select name="section" id="section" class="form-control">
     
                                            </select>
                                        </div>
                                </div> 
                                    <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">Subject</label>
                                                    <br>
                                                    <select name="subject" id="subject" class="form-control">

                                                    </select>
                                                </div>
                                    </div>   

                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Room</label>
                                        <input type="text" class="form-control" id="room" name="room" maxlength="128" required>
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Day (M-T-W-TH-F)</label>
                                        <input type="text" class="form-control" id="day" name="day" maxlength="128" required style="text-transform:uppercase">
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Time Start</label>
                                        <input type="time" class="form-control" id="timestart" name="timestart" maxlength="128" required>
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Time End</label>
                                        <input type="time" class="form-control" id="timeend" name="timeend" maxlength="128" required>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Teacher</label>
                                            <br>
                                            <select name="adviser" id="adviser" class="form-control select2">
                                                            <?php
                                                            foreach($faculty->result_array() as $row)
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
                                            <label for="last_name">Term</label>
                                            <br>
                                            <select name="term" id="term" class="form-control">
                                                <option value=""></option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                            </select>
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
                            <a class="btn btn-primary" href="<?php echo base_url() ?>schedule">Cancel</a>
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
    $('#subject').html('');

    document.getElementById("term").removeAttribute("disabled");
    document.getElementById("term").value = "";

     
    }

    else
    {
        
        $('#strand').html('');
        $('#subject').html('');

        document.getElementById('strand').style.visibility = 'hidden';
        document.getElementById('lblstrand').style.visibility = 'hidden';

        document.getElementById("term").setAttribute("disabled", "disabled");

        document.getElementById("term").value = "";
 

        $.ajax({
        url:"<?php echo base_url(); ?>schedule/getSection",
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
    $('#subject').html('');
    $('#section').html('');
    }



});

$('#strand').change(function(){
    var gradelevel = $('#gradelevel').val();
    var strand = $('#strand').val();

    $('#subject').html('');
    

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

$('#section').change(function(){
    var gradelevel = $('#gradelevel').val();
    
    if(gradelevel != '')
    {

        $.ajax({
        url:"<?php echo base_url(); ?>schedule/getSubject",
        method:"POST",
        data:{gradelevel:gradelevel},
        success:function(data)
        {
        $('#subject').html(data);

        }
    });

     
    }


});

    
});

</script>