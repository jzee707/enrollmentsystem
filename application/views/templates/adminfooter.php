

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
    <script src="<?php echo base_url(); ?>assets/dist/select2/js/select2.full.min.js"></script>
    <script>
      
  $(function () {

    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })

    </script>

    
  </body>
</html>