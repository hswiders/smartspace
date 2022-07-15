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
			<h2 class="mb-3 me-auto">Subscription List</h2>
			
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
								<th>User</th>
                                <th>Plan</th>
                                <th>Price</th>
                                <th>Payment Id</th>
                                <th>Created Date</th>
							</tr>
						</thead>
						<tbody>
                            
							<?php if(!blank($subscribers)): ?>
								<?php $sn = 1; ?>
								<?php $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td class="tbl-bx"><?php echo e($sn); ?></td>
                                        <td class="tbl-bx"><?php echo e($row['firstname']); ?> <?php echo e($row['lastname']); ?></td>
                                        <td class="tbl-bx"><?php echo e($row['planname']); ?></td>
                                        <td class="tbl-bx">$<?php echo e($row['price']); ?></td>
                                        <td class="tbl-bx">#<?php echo e($row['payment_id']); ?></td>
                                        <td class="tbl-bx"><?php echo e($row['created_at']); ?></td>
										
										
									</tr>
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


<?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/subscription-list.blade.php ENDPATH**/ ?>