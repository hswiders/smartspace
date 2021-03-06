<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <div class="signin-page-area pd-top-220 pd-bottom-120 body-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12" id="success_msg"></div>
                <div class="col-xl-6 col-lg-7" id="formChange">
                    <form class="signin-inner" method="post" id="handleOtpAjax" action="<?php echo e(route('send-otp')); ?>" name="postform">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Create an account here</h3>
                                <div name="0" id="errors-list"></div>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" placeholder="First Name" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                    <?php echo csrf_field(); ?>
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" placeholder="Last Name" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="email" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>">
                                </label>
                            </div>
                            
                            <div class="col-12 input-group mb-4">
                                
                                <span class="input-group-text" style="width:25%">
                                    <select name="phonecode"class="form-control" >
                                        <?php $__currentLoopData = $phonecode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($value->phonecode); ?>"><?php echo e($value->phonecode); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </span>
                                <label class="single-input-inner style-bg-border m-0 w-75" >
                                    <input type="number" placeholder="phone" name="phone" value="<?php echo e(old('phone')); ?>">
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="password" placeholder="Password" name="password" >
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border mb-1">
                                    <input type="password" placeholder="Confirm Password" name="confirm_password" >
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-checkbox-inner">
                                    <input type="checkbox" name="agree_terms" value="1">
                                    Agree by <a href="#">Terms and Conditions</a>
                                </label>
                            </div>
                            <div class="col-12 mb-1">
                                <button type="submit" class="btn btn-base w-100">Create Account</button>
                            </div>
                            <div class="col-12 text-center">
                                <span>Already have an account?</span>
                                <a href="<?php echo e(route('login')); ?>"><strong>Sign in</strong></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <script>
    var UserData = '';
    var action = '';
    var is_otp_sent = false;
    
     
      $(document).on("submit","#handleOtpAjax",function(e){
        e.preventDefault();
        handleOtpAjax(this)
      });
      
      function handleOtpAjax (elem) {
            var e = elem;
            if(is_otp_sent == false)
            {
                UserData = $(elem).serialize();
                action = $(elem).attr('action');
                $(elem).find("[type='submit']").html("REGISTER...");
            }
            
            
            $('.alert-danger').remove();
            $.post(action , UserData ,function(data){
              
              $(e).find("[type='submit']").html("REGISTER");
              if(data.status){
                $('#success_msg').html(data.msg)
                Swal.fire({
                  position: '',
                  icon: 'success',
                  title: data.msg,
                  showConfirmButton: false,
                  timer: 1500
                })
                is_otp_sent = true;
                console.log(data.otp)
                $('#formChange').html(data.form);
                jQuery('html,body').animate({scrollTop:0},0);
              }
              

            }).fail(function(response) {
             
              $(e).find("[type='submit']").html("REGISTER");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) {
            
                $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }

            });
        return false;
      }
      $(document).on("submit","#handleRegisterAjax",function(){
            var e = this;

            UserData = UserData + "&" +$(this).serialize()
            $(this).find("[type='submit']").html("Submit OTP");
            $('.alert-danger').remove();
            $.post($(this).attr('action'),UserData,function(data){
              
              $(e).find("[type='submit']").html("Submit OTP");
              if(data.status){
                Swal.fire({
                  position: '',
                  icon: 'success',
                  title: data.msg,
                  showConfirmButton: true,
                  // timer: 1500
                }).then((result) => {
                  window.location = data.redirect_location;
                })
                
              }
              

            }).fail(function(response) {
             
              $(e).find("[type='submit']").html("Submit OTP");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) {
            
                $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }

            });
        return false;
      });

  
    function resend_otp () {
          handleOtpAjax($('#resend_otp'));
      }
  </script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/register.blade.php ENDPATH**/ ?>