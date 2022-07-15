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
			<h2 class="mb-3 me-auto">Property List</h2>
			<!-- <div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
				</ol>
			</div> -->
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
		</div>
		<div class="row">
			<?php if( Session::has('success')): ?> 
                <div class="alert alert-success alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> <?php echo e(Session::get('success')); ?>

                </div>
            
            <?php endif; ?>
            <?php if( Session::has('failed')): ?> 
                <div class="alert alert-danger alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> <?php echo e(Session::get('failed')); ?>

                </div>
            
            <?php endif; ?>
			<div class="col-xl-12">
				<div class="table-responsive">
					<table id="example3" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Is Featured</th>
								<th>Image</th>
								<th>Owner Name</th>
								<th>Title</th>
								<th>Location</th>
								<th>Property Details</th>
								<!-- <th>Animities</th> -->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!blank($property)): ?>
							<?php $sn = 1; ?>
								<?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($sn); ?></td>
										<td class="tbl-bx">
											<div class="form-check ms-2" onclick="makeFeatured(<?php echo e($row->id); ?>)">
											  <input <?php echo e(($row->is_featured ) ? 'checked' : ''); ?> class="form-check-input" type="checkbox" value="" id="customCheckBox1" >
											  <label class="form-check-label" for="customCheckBox1">
											  </label>
											</div>


										</td>
										<?php 
                                          $image = DB::table('property_images')->where('property_id', $row->id)->take(1)->first();
                                         ?>
                                         <?php if($image): ?>
										<td><img src="<?php echo e(asset($image->image)); ?>" width="50"></td>
										<?php else: ?>
											<td>Null</td>
										<?php endif; ?>
										 <?php 
                                          $username = DB::table('users')->where('id', $row->user_id)->take(1)->first();
                                         ?>
										<td><?php echo e($username->first_name); ?> <?php echo e($username->last_name); ?></td>
										
										<td><?php echo e($row->property_heading); ?></td>
										<td>
											<p><b>Address</b> :<?php echo e($row->address); ?></p> 
				                            <p><b>State</b> :<?php echo e($row->state); ?></p>
				                            <p><b>City</b> :<?php echo e($row->city); ?></p>
				                            <p><b>Zip</b> :<?php echo e($row->zip); ?></p>

										</td>
										<td>
											 <p><b>Is Furnished</b> :<?php echo e(($row->furnished) ? 'Yes' : 'No'); ?></p>
                                            <p><b>Utilities Included</b> :<?php echo e(($row->utilities) ? 'Yes' : 'No'); ?></p>
                                           <p><b>Bedrooms </b>:<?php echo e($row->bedrooms); ?></p>
                                            <p><b>Bathrooms </b>:<?php echo e($row->bathrooms); ?></p> 
										</td>
								

										
										<!-- <td>
											<?php $__currentLoopData = explode(',', $row->animities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php
											 		$animities = DB::table('animities')->where('id', $animi)->take(1)->first();
											 	?>
											 	<?php if(!empty($animities->name)): ?>
												 	<?php echo e($animities->name); ?>,
												 <?php endif; ?> 
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</td> -->
									<td>
										<!-- <a href="<?php echo e(url('admin/edit-property?id='.$row->id)); ?>" class="btn btn-primary shadow btn-xs"><i class="fas fa-pencil-alt"></i></a> -->
										<a href="<?php echo e(url('admin/delete-property?id='.$row->id)); ?>" onclick="return confirm('are you sure?')" class="btn btn-danger shadow btn-xs"><i class="fas fa-trash"></i></a>
										<a href="<?php echo e(url('admin/view-property?id='.$row->id)); ?>" class="btn btn-info shadow btn-xs">View</a>

							<?php if($row->block_unblock == 1): ?>
                                <button onclick="changeStatus(<?php echo e($row->id); ?> , 0)" class="btn btn-sm btn-danger">Disable</button>
                            <?php else: ?>
                                <button onclick="changeStatus(<?php echo e($row->id); ?> , 1)" class="btn btn-sm btn-success">Enable</button>
                            <?php endif; ?>
										
									</td>
									</tr>
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
    	// function makeFeatured(rowId){

    	// }

    	function makeFeatured(id) {
		    if(confirm('Are you soure want to update featured property?')){
			    $.ajax({
			        url: '<?php echo e(url("admin/make-featured")); ?>',
			        data: { "_token": "<?php echo e(csrf_token()); ?>", "id": id},
			        type: 'POST',
			        dataType:'json',
			        beforeSend: function() {        
		            	
		          	},
			        success: function(result){
			        	msg = "Property Marked as featured successfully";
			        	if (result.status == 0) {
			        		msg = "Property Removed from featured successfully";
			        	};
			            Swal.fire(
		                  'Changed!',
		                  msg,
		                  'success'
		                )
			        },
			    });
		    }
		    return false;
		  }

function changeStatus (id , status) 
    {
    	//alert('hello');
        form_data = new FormData();
        form_data.append('_token', '<?php echo e(csrf_token()); ?>');
        
        form_data.append('id', id);
        form_data.append('status', status);
        $.ajax({
            url: "<?php echo e(url('admin/block_unblock')); ?>",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
               /* $.blockUI();*/
            },
            success: function (data) {
               /*$.unblockUI();*/
                Swal.fire(
                  'Changed!',
                  'Your Property Status has been Changed.',
                  'success'
                ).then(function() {
                    location.reload();
                })
                //alert('hello');
                
            }
            
          });
    }
  
 </script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/property-list.blade.php ENDPATH**/ ?>