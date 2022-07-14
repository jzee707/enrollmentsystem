
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Enrollment Management
        <small>Add Enrollment</small>
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


                    <form role="form" id="addUser" action="<?php echo base_url() ?>addEnrollment" method="post" role="form">
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
                                            <option disabled value="">Select Section</option>
     
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Student Type</label>
                                            <input type="hidden" class="form-control" id="stype" name="stype" >
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

                            <div class="col-xs-152  text-right">     
                            
                                <a class="btn btn-primary addNew" hidden id="addbtn" name="addbtn" href="#">Add Subject</a>
                                
                            </div>

                           

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


<div id="modal-view-event-add" class="modal modal-top fade calendar-modal">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form id="add-event">
									<div class="modal-body">
										
                                        <div id="subject_data" class="box-body table-responsive no-padding">

                                        </div><!-- /.box-body -->
										

									</div>

								</form>
							</div>
						</div>
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
    $('#sched_data').html('');

    

    document.getElementById("etype").removeAttribute("disabled");
    document.getElementById("etype").value = "";
    document.getElementById("stype").value = "";


     
    }

    else
    {
        $('#strand').html('');
        $('#subject').html('');
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
        data:{section:section},
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

$('#etype').change(function(){
    var etype = $('#etype').val();   

    document.getElementById("stype").value = etype;
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
        data:{section:section},
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
        data:{section:section,etype:etype},
        success:function(data)
        {
        $('#sched_data').html(data);

        }
    });

    }

});

$("body").on("click", "#addSched", function(){

var schedid = $(this).closest("tr").find('td:eq(0)').text();
var subject = $(this).closest("tr").find('td:eq(1)').text();
var room = $(this).closest("tr").find('td:eq(2)').text();
var day = $(this).closest("tr").find('td:eq(3)').text();
var timesched = $(this).closest("tr").find('td:eq(4)').text();
var name = $(this).closest("tr").find('td:eq(5)').text();



var html = '<tr>';
html += '<td> <input type="hidden" name="schedid[]" value="'+ schedid+'" >'+schedid+'</td>';
html += '<td>'+subject+'</td>';
html += '<td>'+room+'</td>';
html += '<td>'+day+'</td>';
html += '<td>'+timesched+'</td>';
html += '<td>'+name+'</td>';
html += '<td ><a class="btn btn-sm btn-info" onclick="RemoveRow()" title="Remove Subject"><i class="fa fa-trash"></i></a></tr>';

$('#table_data').append(html);
$("#modal-view-event-add").modal('hide');
    



});


    
});

    </script>

<script>
jQuery(document).ready(function(){

	jQuery(document).on("click", ".addNew", function(){

        var gradelevel = $('#gradelevel').val();   
        var strand = $('#strand').val();   

         $.ajax({
        url:"<?php echo base_url(); ?>enrollment/load_allsched",
        method:"POST",
        data:{gradelevel:gradelevel,strand:strand},
        success:function(data)
        { 
            
        $("#modal-view-event-add").modal('show');
         $('#subject_data').html(data);

        }
    });
 
	});
	
		
	
});
</script>

<script>
  function RemoveRow() {
      // event.target will be the input element.
      var td = event.target.parentNode; 
      var tr = td.parentNode; // the row to be removed
      tr.parentNode.removeChild(tr);
  }
</script>
	
	