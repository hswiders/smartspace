<?php
    
     $contact_info = DB::table('admin_contact_details')->where('id' , 1)->first();
     $social_links = DB::table('social_links')->where('id' , 1)->first();
?>
<footer class="footer-area style-two" style="background: url('<?php echo e(asset('assets/frontend/images/footer-banner.jpg')); ?>') no-repeat center/cover;">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget widget_about">
                            <h4 class="widget-title">Smart Space Finder</h4>
                            <div class="details">
                                <p><?php echo e($contact_info->info_details); ?></p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="widget widget_newsfeed">
                            <h4 class="widget-title">Company</h4>
                            <ul>

                                <li><a href="<?php echo e(route('terms')); ?>">Terms & Condition</a></li>
                                <li><a href="<?php echo e(route('privacy')); ?>">Privacy Policy</a></li>
                                <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                                <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-9">
                        
                        <div class="widget widget_about widget-tags pt-2">
                            <h5 class="widget-title mb-3 ">Get in Touch</h5>
                            <div class="details">
                                
                                <p><i class="fas fa-map-marker-alt"></i> <?php echo e($contact_info->address); ?> </p>
                                <p><i class="fas fa-phone-volume"></i> <?php echo e($contact_info->phone); ?> </p>
                                <p><i class="fas fa-envelope"></i> <?php echo e($contact_info->email); ?> </p>
                            </div>
                            <ul class="social-area">
                                <li><a href="<?php echo e($social_links->facebook); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo e($social_links->youtube); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="<?php echo e($social_links->instagram); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <p>© 2022, Copy Right By Smart Space Finder. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>" ></script>
   
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('assets/frontend/js/vendor.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <?php if(Auth::id()): ?>
    <script>
var tmrAjax;

function timers() {
    //alert('focus')
  tmrAjax = setInterval(function () {
    $.ajax({
          url:"<?php echo e(route('user.update-activity')); ?>",
          method:"POST",
          data:{"_token": '<?php echo e(csrf_token()); ?>'},
          dataType:"json",
            success : function(res)
            {
                
            }
        });
  }, 20000);
}
$(function() {
    timers();
});


// $(window).blur(function () {
//     //alert('')
//   clearInterval(tmrAjax);
// }).focus(timers);
    

</script> 
    <?php endif; ?>
    <script type="text/javascript">
        function redirect_to (route) {
            window.location.href = '<?php echo e(route('login')); ?>';
        }
    </script>
     <script type="text/javascript">
     
        let type = "<?php echo e(Session::get('msg_type')); ?>";
        let msg = "<?php echo e(Session::get('msg')); ?>";
        switch (type) {
            case 'info':
                toastr['info'](msg, 'Information!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });

                break;

            case 'warning':
                toastr['warning'](msg, 'Warning!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });

                break;

            case 'success':
                toastr['success'](msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });
               // toastr.success('Have fun storming the castle!', 'Miracle Max Says')
                break;

            case 'error':
                toastr['error'](msg, 'Oops..!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });
                break;
        }
    
 </script>
 <script type="text/javascript" id="add_to_fav_script_js">
     function addToFav(id) {

      var formData = new FormData();
      formData.append('_token', '<?php echo e(csrf_token()); ?>');
      formData.append('property_id', id);
      formData.append('status', status);
      $.ajax({
        url: "<?php echo e(route('property.add-to-fav')); ?>",
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $.blockUI();
        },
        success: function (data) {
          $.unblockUI();
          if (data.status == 1) 
          {
            $('.property_heart_'+id).addClass('fas')
            $('.property_heart_'+id).removeClass('far')

          }
          else
          {
            $('.property_heart_'+id).addClass('far')
            $('.property_heart_'+id).removeClass('fas')
          }
          toastr['success'](data.msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });
          
        },
        error: function (response) {
            $.unblockUI();
            toastr['error'](data.msg, 'Oops..!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                    
                });
            window.location.href = '<?php echo e(route('login')); ?>';
        
        }
      });
    }
  
 </script>
</body>
</html><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/includes/footer.blade.php ENDPATH**/ ?>