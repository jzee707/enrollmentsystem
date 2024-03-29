<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">

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


                        <form action="<?php print site_url();?>auth/sendvcode" method="post">

                            <div class="form-group">
                                <div class="input-group mb-2">

                                    <input type="email" class="form-control border-0" id="email" name="email" placeholder="Email" style="height: 55px;">

                                </div>
                            </div> 

                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Submit</button>
                            </div>

                            <p class="mb-4" style="color:white">Already have an Account? <a href="<?php print site_url();?>login" style="color:#ffc107">Log In Here.</a></p>                          
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


