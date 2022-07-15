<!--**********************************
    Header start
***********************************-->
<?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

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
			<h2 class="mb-3 me-auto">Addons List</h2>
			
		</div>	
		
		<div class="row">
			<?php if( Session::has('success')): ?> 
                <div class="alert alert-success alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> <?php echo e(Session::get('success')); ?>

                </div>
            
            <?php endif; ?>
			<div class="col-xl-12">
				<div class="table-responsive">
					<table id="example3" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>Sn.</th>
								<th>Name</th>
								<!-- <th>Email Notification</th>
								<th>Number Of Email Notification</th>
								<th>SMS Notification</th>
								<th>Number Of SMS Notification</th>
								<th>Number Of Property</th> -->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!blank($addons)): ?>
								<?php $sn = 1; ?>
								<?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td class="tbl-bx"><?php echo e($sn); ?></td>
										<td><?php echo e($row->name); ?></td>
										<!-- <td class="wspace-no"><?php if($row->email_notification==0): ?>No <?php else: ?> Yes <?php endif; ?></td>
										<td><?php echo e($row->number_of_email_notification); ?></td>
										<td class="text-ov"><?php if($row->sms_notfication==0): ?>No <?php else: ?> Yes <?php endif; ?></td>
										<td class="text-ov"><?php echo e($row->number_of_sms_notfication); ?></td>
										<td class="text-ov"><?php echo e($row->number_of_property); ?></td> -->
										<td>
                                            <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updateAreaModal<?php echo e($row->id); ?>"><i class="fas fa-pencil-alt"></i></a>
                                             <!-- <a href="javascript:;" id="delbtn2" onclick="deleteRow(2)" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a> -->
                                        </td>
									</tr>


<div class="modal fade" id="updateAreaModal<?php echo e($row->id); ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Addons</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv<?php echo e($row->id); ?>"></div>
            <form method="post" onsubmit="return updateAddons(event, '<?php echo e($row->id); ?>')" id="updateAddons<?php echo e($row->id); ?>" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text"  name="name" placeholder="Addon name.." class="form-control" value="<?php echo e($row->name); ?>" required>
                                <p id="name_err<?php echo e($row->id); ?>"></p>
                            </div>
                            <!-- <div class="mb-3 col-md-12">
                                <label class="form-label">Email Notification</label>
                                <input type="checkbox" name="email_notification" id="email_notifi<?php echo e($row->id); ?>"  class="form-check-input" value="1" onclick="emailNotification('<?php echo e($row->id); ?>')" <?php if($row->email_notification==1): ?> checked <?php endif; ?>>
                            </div>

                            <div class="mb-3 col-md-12" id="email_number<?php echo e($row->id); ?>" style="display: <?php if($row->email_notification==0): ?> none <?php else: ?> block <?php endif; ?>">
                                <label class="form-label">Number Of Email Notification</label>
                                <input type="number" name="number_of_email_notification" placeholder="Number of email notification.." class="form-control" value="<?php echo e($row->number_of_email_notification); ?>" id="email_number_input<?php echo e($row->id); ?>">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">SMS Notification</label>
                                <input type="checkbox" name="sms_notfication" class="form-check-input" value="1" onclick="smsNotification('<?php echo e($row->id); ?>')" id="sms_notifi<?php echo e($row->id); ?>" <?php if($row->sms_notfication==1): ?> checked <?php endif; ?>>
                            </div>
                            <div class="mb-3 col-md-12" id="sms_number<?php echo e($row->id); ?>" style="display: <?php if($row->sms_notfication==0): ?> none <?php else: ?> block <?php endif; ?>">
                                <label class="form-label">Number Of SMS Notification</label>
                                <input type="number" name="number_of_sms_notfication" placeholder="Number of sms notification.." class="form-control" value="<?php echo e($row->number_of_sms_notfication); ?>" id="sms_number_input<?php echo e($row->id); ?>">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Number Of Property</label>
                                <input type="number" name="number_of_property" placeholder="Number of Property.." class="form-control" value="<?php echo e($row->number_of_property); ?>">
                            </div> -->
                        </div>
                        
                        <button class="btn btn-primary" id="upbtn<?php echo e($row->id); ?>" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

									<?php $sn++; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</tbody>
					</table>
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
   //  	function emailNotification(rid){
   //  		if ($("#email_notifi"+rid).is(":checked")) {
   //  			$('#email_number'+rid).css('display', 'block');
   //  			$('#email_number_input'+rid).attr('required', 'required');

			// }else{
   //  			$('#email_number'+rid).css('display', 'none');
   //  			$('#email_number_input'+rid).removeAttr('required');
   //  			$('#email_number_input'+rid).val('');


			// }
   //  	}

   //  	function smsNotification(rid){
   //  		if ($("#sms_notifi"+rid).is(":checked")) {
   //  			$('#sms_number'+rid).css('display', 'block');
   //  			$('#sms_number_input'+rid).attr('required', 'required');
			// }else{
   //  			$('#sms_number'+rid).css('display', 'none');
   //  			$('#sms_number_input'+rid).removeAttr('required');
   //  			$('#sms_number_input'+rid).val('');
			// }
   //  	}

function updateAddons(event,  fid) {
    event.preventDefault();
    $('.alert-danger').remove();
    var data = new FormData($('#updateAddons'+fid)[0]);


    $.ajax({
        url: '<?php echo e(url("admin/update-addons")); ?>',
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
              console.log(result);
              window.location.reload();

            // if(result.status == 1)
            // {
            //   window.location.reload();
            // }
            // else
            // {
            //   console.log(result.message);
            //   for (var err in result.message) {
            
            //   $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
            //   }
            // }
        },
        error: function(err){
            var name = err.responseJSON.errors.name; 
            // console.log(name);
            if(typeof  name!=="undefined" && name!==null){
                $('#name_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.name[0]+'</div>');
            }
            $('#upbtn'+fid).prop('disabled' , false);
         }
    });
    return false;
  }




    </script>


<?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/addons-list.blade.php ENDPATH**/ ?>