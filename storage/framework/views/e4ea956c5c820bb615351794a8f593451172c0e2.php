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
    <!-- row -->
	<div class="container-fluid">
		<div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
			<h2 class="mb-3 me-auto">Admin Social Detail</h2>
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
			<div class="customer-search mb-sm-0 mb-3">
				
			</div>
			<!-- <div class="d-flex align-items-center flex-wrap">
				<a href="javascript::void(0)" class="btn btn-primary btn-rounded me-3 mb-2"  data-bs-toggle="modal" data-bs-target="#addContactTypeModal"><i class="fas fa-user-friends me-2"></i>+ Add Contact Type</a>
				
			</div> -->
		</div>
		<div class="row">
			<?php if( Session::has('success')): ?> 
            <div class="alert alert-success" role="alert">
                <?php echo e(Session::get('success')); ?>

            </div>
            <?php endif; ?>
			<div class="col-xl-12">
				<div class="table-responsive">
					<table id="example3" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>Facebook</th>
								<th>Instagram</th>
								<th>Youtube</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!blank($adminSocialLinks)): ?>
								<tr>
									<td><?php echo e($adminSocialLinks->facebook); ?></td>
									<td><?php echo e($adminSocialLinks->youtube); ?></td>
									<td><?php echo e($adminSocialLinks->instagram); ?></td>
									
									<td>
                                        <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updateContactTypeModal<?php echo e($adminSocialLinks->id); ?>"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
								</tr>
								



<div class="modal fade" id="updateContactTypeModal<?php echo e($adminSocialLinks->id); ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv<?php echo e($adminSocialLinks->id); ?>"></div>
            <form method="post" onsubmit="return updateSocial(event, '<?php echo e($adminSocialLinks->id); ?>')" id="updateSocial<?php echo e($adminSocialLinks->id); ?>" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($adminSocialLinks->id); ?>">
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Facebook</label>
                                <input type="url"  name="facebook" placeholder="Enter facebook url.." class="form-control" value="<?php echo e($adminSocialLinks->facebook); ?>" required>
                             	<p id="facebook_err<?php echo e($adminSocialLinks->id); ?>"></p>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Youtube</label>
                                <input type="url"  name="youtube" placeholder="Enter youtube url.." class="form-control" value="<?php echo e($adminSocialLinks->youtube); ?>" required>
                             	<p id="youtube_err<?php echo e($adminSocialLinks->id); ?>"></p>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Instagram</label>
                                <input type="url"  name="instagram" placeholder="Enter instagram url.." class="form-control" value="<?php echo e($adminSocialLinks->instagram); ?>" required>
                             	<p id="instagram_err<?php echo e($adminSocialLinks->id); ?>"></p>
                            </div>

                        </div>
                        
                        <button class="btn btn-primary" id="upbtn<?php echo e($adminSocialLinks->id); ?>" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
							<?php endif; ?>
							</pre>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
    </div>
</div>




<!-- Modal -->
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
    	function updateSocial(event,  fid) {
		    event.preventDefault();
		    $('.alert-danger').remove();
		    var data = new FormData($('#updateSocial'+fid)[0]);
		    $.ajax({
		        url: '<?php echo e(url("admin/update-admin-social")); ?>',
		        data: data,
		        processData: false,
		        contentType: false,
		        type: 'POST',
		        dataType:'json',
		        beforeSend: function() {        
		            $('#upbtn'+fid).prop('disabled' , true);
		            $('#upbtn'+fid).text('Processing..');
		          },
		        success: function(result){
		            $('#upbtn'+fid).prop('disabled' , false);
		            $('#upbtn'+fid).text('Update');
		              window.location.reload();
		        },
		        error: function(err){
			        var facebook = err.responseJSON.errors.facebook; 
			        if(typeof  facebook!=="undefined" && facebook!==null){
			            $('#facebook_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.facebook[0]+'</div>');
			        }
			        var youtube = err.responseJSON.errors.youtube; 
			        if(typeof  youtube!=="undefined" && youtube!==null){
			            $('#youtube_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.youtube[0]+'</div>');
			        }
			        var instagram = err.responseJSON.errors.instagram; 
			        if(typeof  instagram!=="undefined" && instagram!==null){
			            $('#instagram_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.instagram[0]+'</div>');
			        }

			        
			        $('#upbtn'+fid).prop('disabled' , false);
			     }
		    });
		    return false;
		  }



		  // function addContactType(event) {
		  //   event.preventDefault();
		  //   $('.alert-danger').remove();
		  //   var data = new FormData($('#addContactType')[0]);
		  //   $.ajax({
		  //       url: '<?php echo e(url("admin/add-contact-type")); ?>',
		  //       data: data,
		  //       processData: false,
		  //       contentType: false,
		  //       type: 'POST',
		  //       dataType:'json',
		  //       beforeSend: function() {        
		  //           $('#upbtn').prop('disabled' , true);
		  //           $('#upbtn').text('Processing..');
		  //         },
		  //       success: function(result){
		  //           $('#upbtn').prop('disabled' , false);
		  //           $('#upbtn').text('Update');
		  //             window.location.reload();
		  //       },
		  //       error: function(err){
			 //        var contact_type = err.responseJSON.errors.contact_type; 
			 //        if(typeof  contact_type!=="undefined" && contact_type!==null){
			 //            $('#contact_type_field_err').html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.contact_type[0]+'</div>');
			 //        }
			 //        $('#upbtn').prop('disabled' , false);
			 //     }
		  //   });
		  //   return false;
		  // }


		  // function deleContactType(id) {
		  //   if(confirm('Are you soure want to delete?')){
			 //    $.ajax({
			 //        url: '<?php echo e(url("admin/del-contact-type")); ?>',
			 //        data: { "_token": "<?php echo e(csrf_token()); ?>", "id": id},
			 //        type: 'POST',
			 //        dataType:'json',
			 //        beforeSend: function() {        
		  //           	$('#delBtn'+id).prop('disabled' , true);
		  //         	},
			 //        success: function(result){
			 //            $('#delBtn'+id).prop('disabled' , false);
			 //              window.location.reload();
			 //        },
			 //    });
		  //   }
		  //   return false;
		  // }
    </script><?php /**PATH D:\Hakimuddin\Laravel Sites Local\smartSpaceFinder\resources\views/admin/admin-social.blade.php ENDPATH**/ ?>