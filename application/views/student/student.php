
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
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $dashboardInfo->subject; ?></h3>
                  <p>Total Subjects</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
               
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $dashboardInfo->dropped; ?></h3>
                  <p>Dropped Subjects</p>
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
                  <p><?php echo $dashboardInfo->semester; ?> Semester</p>
                </div>

               
              </div>
              </div><!-- ./col -->
            

      </div>

      
    </section>
</div>

