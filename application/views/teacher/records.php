
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> My Records 

      </h1>
    </section>
    
    <section class="content">
        <div class="row">   
        <div class="col-xs-6 text-center">
                <div class="form-group">                    
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
                </div>
            </div>   

            <div class="col-xs-6  text-right">
                <div class="form-group">       
            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Schedule List</h3>
                    <div class="box-tools">

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>    
                        <th>Grade Level</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Term</th>
                        <th>School Year</th>                      
                        <th>Status</th>

                    </tr>

                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->id ?></td>
                        <td><?php echo $record->gradelevel ?></td>
                        <td><?php echo $record->section ?></td>
                        <td><?php echo $record->subject ?></td>
                        <td><?php echo $record->room ?></td>
                        <td><?php echo $record->day ?></td>
                        <td><?php echo date("h:i A", strtotime($record->timefrom)) . ' - ' . date("h:i A", strtotime($record->timeto)) ?></td>
                        <td><?php echo $record->term ?></td>
                        <td><?php echo $record->schoolyear ?></td>
                        <td><?php echo $record->status ?></td>

                    </tr>
                    <?php
                        }
                    }
                    ?>
 
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>



