<!--**********************************
    Header start
***********************************-->
<?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--**********************************
    Header end ti-comment-alt
***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
<?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
		
       
		
		<div class="row page-titles" id="msgdivcont" style="display:none">
			
        </div>
        <!-- row -->
       
        <div class="row">
            <?php if( Session::has('success')): ?> 
            <div class="alert alert-success" role="alert">
                <?php echo e(Session::get('success')); ?>

            </div>
            <?php endif; ?>

            <?php if( Session::has('error')): ?> 
            <div class="alert alert-danger" role="alert">
                <?php echo e(Session::get('error')); ?>

            </div>
            <?php endif; ?> 

            <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger" role="alert">
                <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="alert alert-danger" role="alert">
                <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <div class="tab-content">
                                    <div id="my-posts" class="tab-pane fade active show">
                                        <div class="settings-form">
                                                <h4 class="text-primary">Update RV Rental</h4>
                                                <form method="post" onsubmit="return update_rv_rental(event)" id="update_rv_rental">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12" >
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="name" placeholder="Type name" value="<?php echo e($rv_rental->title); ?>" class="form-control" required readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">Link</label>
                                                            <input type="url" name="menu_link" placeholder="Enter Link" class="form-control" required value="<?php echo e($rv_rental->menu_link); ?>">
                                                        </div>
                                                    </div>
                                                    <button id="sub_btn" class="btn btn-primary" type="submit">Update</button>
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
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->


	  <!--**********************************
        Footer start
    ***********************************-->
        <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--**********************************
        Footer end
    ***********************************-->
<script type="text/javascript">

 function update_rv_rental(event) {
    event.preventDefault();
    $('.alert-danger').remove();
    $.ajax({
      url: '<?php echo e(url("admin/update-rv-rental")); ?>',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#update_rv_rental')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
          window.location.reload();
      }
    });
}

</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/rv-rental-list.blade.php ENDPATH**/ ?>