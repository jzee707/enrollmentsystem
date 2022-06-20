
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> DASHBOARD

      </h1>
    </section>
    
    <section class="content">
        <div class="row">
         
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo number_format($dashboardInfo->student); ?></h3>
                  <p>Total Students</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
               
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo number_format($dashboardInfo->enrolled); ?></h3>
                  <p>Total Enrolled</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              
              </div>
            </div><!-- ./col -->
            
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo number_format($dashboardInfo->teacher); ?></h3>
                  <p>Teachers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
               
              </div>
              </div><!-- ./col -->

              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3 style="text-align:center"><?php echo $dashboardInfo->schoolyear; ?></h3>
                  <p>Active School Year</p>
                </div>

               
              </div>
              </div><!-- ./col -->
            

      </div>

      <div class="row">
         
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo number_format($dashboardInfo->section); ?></h3>
                  <p>Sections</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
               
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo number_format($dashboardInfo->subject); ?></h3>
                  <p>Subjects</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
            
            
            

      </div>
      
    </section>
</div>

