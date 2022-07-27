<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
              
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                       
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                    <img  src="<?php echo base_url(); ?>assets/img/logos.png" width="200" height="200" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Reset Password</h1>

                        <div class="row">
                            <div class="col-md-12">
                                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                            </div>
                        </div>

                        <?php
                            $this->load->helper('form');
                            $error = $this->session->flashdata('error');
                            if($error)
                            {
                                ?>
                                <div class="alert alert-danger alert-dismissable">

                                    <?php echo $error; ?>                    
                                </div>
                            <?php }
                            $success = $this->session->flashdata('success');
                            if($success)
                            {
                                ?>
                                <div class="alert alert-success alert-dismissable">

                                    <?php echo $success; ?>                    
                                </div>
                        <?php } ?>


                        <form action="<?php echo base_url().'resetpassword/'.$link->link; ?>" method="post">
                            

                            <div class="form-group">
                                <div class="input-group mb-2">

                                    <input type="password" class="form-control border-0" id="password" name="password" placeholder="Password" style="height: 55px;">
                                    <input type="hidden" class="form-control" id="sid" name="sid" value="<?php echo $link->accountid;?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" style="height:55px" type="button" id="btnshow" name="btnshow" onclick="tooglePassword()" tabindex="-1">Show</button>
                                    </div>

                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="input-group mb-2">

                                <input type="password" class="form-control border-0" id="copassword" name="copassword" placeholder="Confirm Password" style="height: 55px;">

                                </div>
                            </div> 

                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Submit</button>
                                </div>

                                <p class="mb-4" ><a href="<?php print site_url();?>login" style="color:white">Already have an Account? Log In Here.</a></p>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->


  

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