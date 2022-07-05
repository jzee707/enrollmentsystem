
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Section Management
        <small>Edit Section</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Section Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" action="<?php echo base_url() ?>editOldSection" method="post" role="form">
                        <div class="box-body">

                        <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Grade Level</label>
                                            <br>
                                            <select name="gradelevel" id="gradelevel" class="form-control">
                                                <option value="Grade 7">Grade 7</option>
                                                <option value="Grade 8">Grade 8</option>
                                                <option value="Grade 9">Grade 9</option>
                                                <option value="Grade 10">Grade 10</option>
                                                <option value="Grade 11">Grade 11</option>
                                                <option value="Grade 12">Grade 12</option>
                                            </select>
                                        </div>
                                </div> 
                            </div>

                            <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name" id="lblstrand">Strand</label>
                                            <br>
                                            <select name="strand" id="strand" class="form-control">
                                            <?php
                                                            foreach($strand->result_array() as $row)
                                                            {
                                                                if($strandInfo->gradelevel=='Grade 11' || $strandInfo->gradelevel =='Grade 12')
                                                                {
                                                                    echo '<option value="'.$row["id"].'">'.$row["strandcode"].'</option>';

                                                                }
                                                                
                                                            }
                                                            ?>
                                            </select>
                                        </div>
                                </div> 
                            </div>


                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Section</label>
                                        <input type="text" class="form-control" id="section" name="section" maxlength="128" value="<?php echo $strandInfo->section;?>" required>
                                        <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $strandInfo->id;?>" maxlength="128" required>
                                    </div>
                                    
                                </div>
                            </div>

                          

                            <div class="row">                           
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Adviser</label>
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


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a class="btn btn-primary" href="<?php echo base_url() ?>section">Cancel</a>
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
    if(gradelevel == 'Grade 11' || gradelevel == 'Grade 12')
    {

        document.getElementById('strand').style.visibility = 'visible';
        document.getElementById('lblstrand').style.visibility = 'visible';


    $.ajax({
        url:"<?php echo base_url(); ?>admin/getStrand",
        method:"POST",
        data:{gradelevel:gradelevel},
        success:function(data)
        {
        $('#strand').html(data);
        //$('#barangay').html('<option value="">Select Barangay</option>');
        }
    });
    }
    else
    {
    $('#strand').html('');

        document.getElementById('strand').style.visibility = 'hidden';
        document.getElementById('lblstrand').style.visibility = 'hidden';

    }
});

        document.getElementById("strand").value= "<?php echo $strandInfo->strandid ?>";
        document.getElementById("gradelevel").value= "<?php echo $strandInfo->gradelevel ?>";
        document.getElementById("adviser").value = "<?php echo $strandInfo->adviserid ?>";

    
});

    </script>