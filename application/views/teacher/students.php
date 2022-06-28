
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Student List 

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
                    <h3 class="box-title">Student List</h3>
                    <div class="box-tools">

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>    
                        <th>ID No.</th>
                        <th>Student</th>
                        <th>Address</th>
                        <th>Student Type</th>                  
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
                        <td><?php echo $record->idno ?></td>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->address ?></td>
                        <td><?php echo $record->type ?></td>
                        <td><?php echo $record->status ?></td>

                        <td class="text-center">

                        <?php 
                        if($record->status == "Dropped")
                        {
                            ?>

                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'restorestudent/'.$record->id; ?>" title="Restore"><i class="fa fa-check"></i></a>
                        
                        <?php 
                        }

                        else
                        {
                            ?>

                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'dropstudent/'.$record->id; ?>" title="Drop Student"><i class="fa fa-trash"></i></a>

                        <?php 
                        }

                         ?>

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



