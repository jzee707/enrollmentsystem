
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Pre-Enrollment
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enrollment Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>auth/addEnrollment" method="post" role="form">
                        <div class="box-body">

                        <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Grade Level</label>
                                            <br>
                                            <select name="gradelevel" id="gradelevel" class="form-control">
                                                <option selected disabled value=""></option>
                                                <option value="Grade 7">Grade 7</option>
                                                <option value="Grade 8">Grade 8</option>
                                                <option value="Grade 9">Grade 9</option>
                                                <option value="Grade 10">Grade 10</option>
                                                <option value="Grade 11">Grade 11</option>
                                                <option value="Grade 12">Grade 12</option>
                                            </select>
                                        </div>
                                </div> 

                                <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="strand">Strand</label>
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
                                            <option disabled value=""></option>
     
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Grade Level</label>
                                            <br>
                                            <select name="etype" id="etype" class="form-control">
                                                <option selected disabled value=""></option>
                                                <option value="Regular">Regular</option>
                                                <option value="Irregular">Irregular</option>
                                            </select>
                                        </div>
                                </div> 


                            </div>


                            <div id="sched_data" class="box-body table-responsive no-padding">

                            </div><!-- /.box-body -->


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
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

    document.getElementById("etype").value = "Regular";

     
    }

    else
    {
        $('#strand').html('');
        $('#sched_data').html('');

        document.getElementById("etype").setAttribute("disabled", "disabled");

        document.getElementById("etype").value = "Regular";
 

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
    if(section != '')
    {
    $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_sched",
        method:"POST",
        data:{section:section},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });
    }
    else
    {
    $('#sched_data').html('');
    }


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

    
});

    </script>