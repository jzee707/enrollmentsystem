<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Verification</li>
 
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
                        <h1 class="text-white mb-4">Verify Account</h1>

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


                        <form action="<?php print site_url();?>adminlogin" method="post">

                            <div class="form-group">
                                <div class="input-group mb-2">

                                    <input type="password" class="form-control border-0" id="verificationcode" name="verificationcode" placeholder="Verification Code" style="height: 55px;">
                                
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" style="height:55px" type="button" id="btnshow" name="btnshow" tabindex="-1">Resend Email</button>
                                    </div>

                                </div>
                            </div> 

                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Verify Account</button>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <p class="mb-4" style="text-align:left"><a href="<?php print site_url();?>signup" style="color:white">Create Account</a></p>
                                    
                                </div>
                                <div class="col-6">                                       
                                    <p class="mb-4" style="text-align:right"><a href="<?php print site_url();?>forgotpassword" style="color:white">Sign Up</a></p>
                                </div>
                            </div>                               
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


