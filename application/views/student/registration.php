<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Western College</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/logo.ico">
  
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Western College</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/profile.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo  $this->session->userdata('name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <img src="<?php echo base_url(); ?>assets/dist/img/profile.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo  $this->session->userdata('name'); ?>
                      <small><?php echo  $this->session->userdata('usertype'); ?></small>
                    </p>
                    
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!--<a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>-->
                    </div>
                    <div class="pull-right">
                    <a href="" class="btn btn-default btn-flat"><i class="fa fa-info"></i> My Account</a>
                    <a href="" class="btn btn-default btn-flat"><i class="fa fa-gear"></i> Change Password</a>
                      <a href="<?php echo base_url(); ?>admin/signout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Registration Form
        
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->


                    <form role="form" id="addUser" method="post">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="type">Student Type</label>
                                        <select name="studenttype1" id="studenttype1"  class="form-control">
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
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="lrn1" name="lrn1" maxlength="128" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="firstname1" name="firstname1" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Middle Name</label>
                                        <input type="text" class="form-control"id="middlename1" name="middlename1" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="first_name">Last Name</label>
                                        <input type="text" class="form-control" id="lastname1" name="lastname1" maxlength="128" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Suffix</label>
                                        <input type="text" class="form-control"  id="suffix1" name="suffix1" maxlength="128">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Birthdate</label>
                                            <input type="date" class="form-control" id="birthdate1" name="birthdate1" data-date-format="mm/dd/yyyy" maxlength="128" required>
                                        </div>
                                    </div>     
                                                           
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Gender</label>
                                            <br>
                                            <select name="gender1" id="gender1" class="form-control">
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
                                        <input type="text" class="form-control" id="religion1" name="religion1" maxlength="128" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Nationality</label>
                                        <input type="text" class="form-control" id="nationality1"  name="nationality1" maxlength="128" required>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Province</label>
                                            <br>
                                            <select name="province" id="province1"  class="form-control">
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
                                            <select name="city" id="city1" class="form-control">
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
                                            <select name="barangay1" id="barangay1"  class="form-control">
                                            <option selected disabled>Choose...</option>
                                            </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Address</label>
                                        <input type="text" class="form-control" id="address1"  name="address1" maxlength="128">
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Mother's Name</label>
                                        <input type="text" class="form-control" id="mother1" name="mother1" maxlength="128" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Father's Name</label>
                                        <input type="text" class="form-control" id="father1"  name="father1" maxlength="128" required>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Guardian</label>
                                        <input type="text" class="form-control" id="guardian1" name="guardian1" maxlength="128" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_no">Contact No.</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="contactno1"  name="contactno1" maxlength="121">
                                        <input type="hidden" class="form-control" id="status1" name="status1" value="Requested">
                                    </div>
                                </div>  
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary"  onclick="dataConsent()" value="Submit" />
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

<div class="modal fade" id="dataconsent-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form role="form" action="<?php echo base_url() ?>student/addReStudent"  method="post">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h1 class="modal-title" style="font-size:24px;font-weight:bold;" id="myLargeModalLabel">Data Privacy Policy Consent form</h1>
       
                            </div>

                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td style="width:10%;height:75px;text-align:center;"><input type="checkbox" id="chk1" name="chk1" value="chk1"></td>
                                        <td style="width:90%;height:75px;text-align:left;">I accept that the Western Colleges Inc. holds personal data about me and I hereby consent to the processing by the school or any associated school of my personal data for any purpose related to the registration.</td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;height:75px;text-align:center;"><input type="checkbox" id="chk2" name="chk2" value="chk2"></td>
                                        <td style="width:90%;height:75px;text-align:left;">I also explicitly consent to the school processing any sensitive personal data relating for me.</td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;height:100px;text-align:center;"><input type="checkbox" id="chk3" name="chk3" value="chk3"></td>
                                        <td style="width:90%;height:100px;text-align:left;">Finally, I consent to the school providing my personal data third party where this necessary for the registration.</td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;height:50px;text-align:center;"></td>
                                        <td style="width:90%;height:50px;text-align:left;">Where consent has been given as the basis for processing my registration in the data privacy policy:</td>
                                    </tr>
                                    <tr>
                                        <td style="width:10%;height:75px;text-align:center;"><input type="checkbox" id="chk4" name="chk4" value="chk4"></td>
                                        <td style="width:90%;height:75px;text-align:left;">I have read the data privacy policy and understand that my data processed on a basis other than my consent.</td>
                                    </tr>
                                    
                                </table>

                                <div style="display:none">
    

                                    <input type="hidden" class="form-control" id="lrn" name="lrn">
                                    <input type="hidden" class="form-control" id="studenttype" name="studenttype">
                                    <input type="hidden" class="form-control" id="firstname" name="firstname">
                                    <input type="hidden" class="form-control" id="middlename" name="middlename">
                                    <input type="hidden" class="form-control" id="lastname" name="lastname">
                                    <input type="hidden" class="form-control" id="suffix" name="suffix">
                                    <input type="hidden" class="form-control" id="birthdate" name="birthdate">
                                    <input type="hidden" class="form-control" id="gender" name="gender">
                                    <input type="hidden" class="form-control" id="religion" name="religion">
                                    <input type="hidden" class="form-control" id="nationality" name="nationality">
                                    <input type="hidden" class="form-control" id="barangay" name="barangay">
                                    <input type="hidden" class="form-control" id="address" name="address">
                                    <input type="hidden" class="form-control" id="mother" name="mother">
                                    <input type="hidden" class="form-control" id="father" name="father">
                                    <input type="hidden" class="form-control" id="guardian" name="guardian">
                                    <input type="hidden" class="form-control" id="contactno" name="contactno">
                                    <input type="hidden" class="form-control" id="status" name="status">
                                

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" >ACCEPT</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">DECLINE</button>
   
                            </div>
                        </div>
                    </form>
                </div>
            </div>

<script type="text/javascript">
$(document).ready(function(){
    
$('#province1').change(function(){
    var province = $('#province1').val();
    if(province != '')
    {
    $.ajax({
        url:"<?php echo base_url(); ?>student/getCity",
        method:"POST",
        data:{province:province},
        success:function(data)
        {
        $('#city1').html(data);
        $('#barangay1').html('<option value="">Select Barangay</option>');
        }
    });
    }
    else
    {
    $('#city1').html('<option value="">Select City</option>');
    }
});

$('#city1').change(function(){
    var city = $('#city1').val();
    if(city != '')
    {
    $.ajax({
        url:"<?php echo base_url(); ?>student/getBarangay",
        method:"POST",
        data:{city:city},
        success:function(data)
        {
        $('#barangay1').html(data);
        }
    });
    }
    else
    {
    $('#barangay1').html('<option value="">Select Barangay</option>');
    }
});

   
});
</script>



<script type="text/javascript">

    
    
function saveStudent()
{
    $.ajax({
        url:"<?php echo base_url() ?>student/addReStudent",
        method:"POST",
        dataType:"json",
        data:{lrn:lrn,studenttype:studenttype,firstname:firstname,lastname:lastname,middlename:middlename,suffix:suffix,birthdate:birthdate,gender:gender,religion:religion,nationality:nationality,barangay:barangay,address:address,mother:mother,father:father,guardian:guardian,contactno:contactno,status:status},
        success:function(data){

        },

        error: function(error){
        alert(lrn + '' + studenttype +'' +firstname +'' + lastname +'' + middlename + '' +suffix +'' + birthdate +'' + gender + '' +religion+'' +nationality+'' +barangay+'' +address+'' +mother+'' +father+'' +guardian+'' +contactno+'' +status);

    }

    });

}


function dataConsent()
{
    var lrn = $('#lrn1').val();
    var studenttype = $('#studenttype1').val();  
    var firstname = $('#firstname1').val();
    var lastname = $('#lastname1').val();
    var middlename = $('#middlename1').val();
    var suffix = $('#suffix1').val();
    var birthdate = $('#birthdate1').val();
    var gender = $('#gender1').val();
    var religion = $('#religion1').val();
    var nationality = $('#nationality1').val();
    var barangay = $('#barangay1').val();
    var address = $('#address1').val();
    var mother = $('#mother1').val();
    var father = $('#father1').val();
    var guardian = $('#guardian1').val();
    var contactno = $('#contactno1').val();
    var status = $('#status1').val();
 
    if(document.getElementById("lrn1").value != "" && document.getElementById("firstname1").value != "" && document.getElementById("lastname1").value != "")
    {
        $('#lrn').val(lrn); 
        $('#studenttype').val(studenttype);  
        $('#firstname').val(firstname);
        $('#lastname').val(lastname);
        $('#middlename').val(middlename);
        $('#suffix').val(suffix);
        $('#birthdate').val(birthdate);
        $('#gender').val(gender);
        $('#religion').val(religion);
        $('#nationality').val(nationality);
        $('#barangay').val(barangay);
        $('#address').val(address);
        $('#mother').val(mother);
        $('#father').val(father);
        $('#guardian').val(guardian);
        $('#contactno').val(contactno);
        $('#status').val(status);
    
        $("#dataconsent-modal").modal('show');

    }    

}

</script>   

<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Western Colleges, Inc.</b> Admin Panel
        </div>
        <strong>Copyright &copy; <script>
                  document.write(new Date().getFullYear())
                </script> <a</a>.</strong> All rights reserved.
    </footer>
    
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
    
  </body>
</html>