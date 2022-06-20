
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Account Management
        <small>Change Password</small>
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


                    <form role="form" id="addUser" action="<?php echo base_url() ?>admin/changedpassword" method="post" role="form">
                        <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="input-group">

                                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>

                                    <div class="input-group-btn">
                                        <button class="form-control" type="button" id="btnshow" name="btnshow" onclick="tooglePassword()">Show</button>
                                    </div>
                                </div>
                        </div>
                            </div>

                        <div class="row">
                            <div class="col-md-6">

                        <div class="input-group">

                            <input type="password" class="form-control" id="copassword" name="copassword" placeholder="Confirm Password" required>
                        
                        </div>

                        </div>
                            </div>


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
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

var  password = document.getElementById("password");
var  copassword = document.getElementById("copassword");

var btn = document.getElementById("btnshow");
 
    function tooglePassword() {
 
     if(btn.childNodes[0].nodeValue == 'Show') {
        password.setAttribute('type', 'text');
        copassword.setAttribute('type', 'text');
        btn.childNodes[0].nodeValue = "Hide";
 
     } 
     
     else {
        password.setAttribute('type', 'password');
        copassword.setAttribute('type', 'password');
        btn.childNodes[0].nodeValue = "Show";
        
    } 
 
   }


</script>