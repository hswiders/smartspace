<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <div class="signin-page-area pd-top-220 pd-bottom-120 body-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <?php echo Session::get('msg'); ?>

                    <form class="signin-inner" method="post" id="handleAjax" action="<?php echo e(route('do-login')); ?>" name="postform">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Welcome Back!</h3>
                                <div name="0" id="errors-list"></div>
                            </div>
                            
                            
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="email" name="email" placeholder="email" value="<?php echo e(old('email')); ?>"  />
                                    <?php echo csrf_field(); ?>
                                </label>
                            </div>
                            
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border mb-0">
                                    <input type="password" name="password" placeholder="password" />
                                </label>
                            </div>
                            <div class="col-12 text-right mb-4">
                                <a href="<?php echo e(route('forgot')); ?>">Forgot password?</a>
                            </div>
                            <div class="col-12 mb-1">
                                <button type="submit" class="btn btn-base w-100">Sign In</button>
                            </div>
                        
                            <div class="col-12 text-center">
                                <span>Create an account?</span>
                                <a href="<?php echo e(route('register')); ?>"><strong>Signup</strong></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <script>
    $(function() {
    // handle submit event of form
      $(document).on("submit", "#handleAjax", function() {
        var e = this;
        // change login button text before ajax
        $(this).find("[type='submit']").html("Processing..");
         $('.alert-danger').remove();
        $.post($(this).attr('action'), $(this).serialize(), function(data) {

          $(e).find("[type='submit']").html("LOGIN");
          if (data.status) { // If success then redirect to login url
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
              window.location = data.redirect_location;
            })
            
          }
        }).fail(function(response) {
            // handle error and show in html
          $(e).find("[type='submit']").html("LOGIN");
          $(".alert").remove();
          var erroJson = JSON.parse(response.responseText);
          
          for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }
        });
        return false;
      });
    });
  </script><?php /**PATH D:\Hakimuddin\Laravel Sites Local\smartSpaceFinder\resources\views/frontend/login.blade.php ENDPATH**/ ?>