<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
    .hide{
        display: none;
    }
</style>
 <div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset('')); ?>assets/frontend/images/breadcrumb-2.jpg')">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title text-center">
                    <h2 class="page-title">Membership Plan</h2>
                    <ul class="page-list">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li>Membership plan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="membership my-5 py-5">
        <div class="container">
            <?php if(Session::has('success')): ?>
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><?php echo e(Session::get('success')); ?></p>
                        </div>
                    <?php endif; ?>
                <?php
                    $currPlanId = 0;
                ?>
            <?php if($user): ?>
            <div class="plan_details alert alert-primary text-center">
                
                
                <?php if($current_plan): ?>
                <?php
                    $currPlanId = $current_plan->id;
                ?>
                <p>Your current plan is : <b><?php echo e($current_plan->name); ?></b> </p>
                <p>Total used properties :<b> <?php echo e($current_plan->number_of_property - $user->property_count); ?>/<?php echo e($current_plan->number_of_property); ?></b> </p>
                <?php else: ?>
                <p>There is no active plan for you </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <div class="pricing flex-md-nowrap flex-wrap">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="plan <?php echo e(($currPlanId == $value->id) ? 'popular' : ''); ?>">
            <h2><?php echo e($value->name); ?></h2>
            <div class="price"><?php echo e(($value->price == '0.00') ? 'FREE' : '$'.$value->price); ?></div>
            <ul class="features">
                <li><i class="fas fa-building"></i>No. Of Property : <?php echo e($value->number_of_property); ?></li>
                <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><i class="fas <?php echo e((in_array($record->id , $value->addonId)) ?  'fa-check-circle' : 'fa-times-circle'); ?>"></i> <?php echo e($record->name); ?></li>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </ul>
            <?php if($user): ?>
     
                <button onclick="buy_plan('<?php echo e($value->id); ?>' , '<?php echo e($value->price); ?>')">Upgrade Now</button>
          
            <?php else: ?>
                <button onclick="redirect_to('login')">Subscribe Now</button>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
      
    </div>
        </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row text-center">
                        <h3 class="panel-heading">Payment Details</h3>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    
                    
                    <form role="form" action="<?php echo e(route('stripe.payment')); ?>" method="post" class="validation handleAjax"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="<?php echo e(env('STRIPE_KEY')); ?>"
                                                    id="payment-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="plan_id" id="plan_id" value="">
                        <input type="hidden" name="amount" id="amount" value="">
                        
                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-12 form-group card required'>
                                <label class='control-label'>Card Number</label> 
                                <input
                                    autocomplete='off' class='form-control card-num' size='20'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div class='col-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 415' size='4'
                                    type='text'>
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
  
                        <div class='form-row row'>
                            <div name="message"></div>
                            <div class='col-md-12 hide error form-group'>
                                <div class='alert-danger alert'></div>
                            </div>
                        </div>
  
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-danger btn-lg btn-block " id="pay_btn" type="submit">Pay Now (₹100)</button>
                            </div>
                        </div>
                          
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
      </div>
      
    </div>
  </div>
</div>
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>

    function buy_plan (plan_id , amount) {
        
        $('#plan_id').val(plan_id);
        $('#amount').val(amount);
        $('#pay_btn').text('Pay Now ($'+amount+')');
        $('#exampleModal').modal('show');
    }
 
$(function() {
    var $form         = $(".validation");
  $('form.validation').bind('submit', function(e) {
    var $form         = $(".validation"),
        inputVal = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputVal),
        $errorStatus = $form.find('div.error'),
        valid         = true;
        $errorStatus.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorStatus.removeClass('hide');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-num').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeHandleResponse);
    }
  
  });
  
  function stripeHandleResponse(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            charge_payment($form)
        }
    }
  
});

function charge_payment( $form) {
            event.preventDefault();
            $('.alert-danger').remove();
            var data = new FormData($form[0]);
            amount = $('#amount').val()
            $.ajax({
                url: $form.attr('action'),
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                beforeSend: function() {        
                    $form.find("[type='submit']").prop('disabled' , true);
                    $form.find("[type='submit']").text('Processing..');
                  },
                success: function(result){
                    $form.find("[type='submit']").prop('disabled' , false);
                    $form.find("[type='submit']").text('Pay Now ($'+amount+')');
                     Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          title: result.msg,
                          showConfirmButton: true,
                          // timer: 1500
                        }).then((result) => {
                          window.location.reload();
                        })
                    //window.location.reload();
                },
                error: function(response){
                     $form.find("[type='submit']").html('Pay Now ($'+amount+')');
                     $form.find("[type='submit']").prop('disabled' , false);
                      $(".alert").remove();
                      var erroJson = JSON.parse(response.responseText);
                      
                      for (var err in erroJson) {
                        
                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
                      }
                 }
            })
            return false;
          }
</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/membership.blade.php ENDPATH**/ ?>