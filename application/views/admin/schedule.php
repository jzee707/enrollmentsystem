
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Schedule Management

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
                
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNewSchedule"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Schedule List</h3>
                    <div class="box-tools">

                        <form action="<?php echo base_url() ?>schedule" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText"  class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
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
                        <th>Teacher</th>
                        <th>Term</th>
                        <th>School Year</th>                      
                        <th>Status</th>
                        <th class="text-center"></th>
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
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->term ?></td>
                        <td><?php echo $record->schoolyear ?></td>
                        <td><?php echo $record->status ?></td>
                        <td class="text-center">
                       
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'editSchedule/'.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'archivedschedule/'.$record->id; ?>" title="Archive"><i class="fa fa-trash"></i></a> 
                        </td>
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



