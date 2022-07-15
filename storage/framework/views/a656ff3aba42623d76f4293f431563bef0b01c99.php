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
			<!-- <div class="customer-search mb-sm-0 mb-3">
				<div class="input-group search-area">
					<input type="text" class="form-control" placeholder="Search here......">
					<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
				</div>
			</div>
			<div class="d-flex align-items-center flex-wrap">
				<a href="<?php echo e(url('admin/add-property')); ?>" class="btn btn-primary btn-rounded me-3 mb-2"><i class="fas fa-user-friends me-2"></i>+ Add New Property</a>
				<a href="javascript:void(0);" class="btn bg-white btn-rounded me-2 mb-2 text-black shadow-sm"><i class="fas fa-calendar-times me-3 scale3 text-primary"></i>Filter<i class="fas fa-chevron-down ms-3 text-primary"></i></a>
				<a href="javascript:void(0);" class="btn btn-secondary btn-rounded mb-2"><i class="fas fa-sync"></i></a>
			</div> -->
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
								<th>
									  Make Featured
								</th>
								<th>Property Name</th>
								<th>Is Featured</th>
								<th>Property For</th>
								<th>Bathrooms</th>
								<th>Bedrooms</th>
								<th>Furnished</th>
								<th>Animities</th>
								<!-- <th>Customer Name</th>
								<th>Location</th>
								<th>Total Spent</th>
								<th>Last Order</th> -->
								
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(!blank($property)): ?>
								<?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td class="tbl-bx">
											<div class="form-check ms-2" onclick="makeFeatured(<?php echo e($row->id); ?>)">
											  <input class="form-check-input" type="checkbox" value="" id="customCheckBox1" >
											  <label class="form-check-label" for="customCheckBox1">
											  </label>
											</div>

										</td>
										<td><?php echo e($row->property_heading); ?></td>
										<td><?php if($row->is_featured==0): ?> No <?php else: ?> Yes <?php endif; ?></td>
										<td><?php if($row->property_type==0): ?> Sale <?php else: ?> Rent <?php endif; ?></td>
										<td>
											<?php 
											 	$bathrooms = DB::table('room_featured')->where('id', $row->bathrooms)->take(1)->first();
											?>
											 <?php if(!empty($bathrooms->featured)): ?>
											 	<?php echo e($bathrooms->featured); ?>

											 <?php endif; ?>
										</td>
										<td>
											<?php 
											 	$bedrooms = DB::table('room_featured')->where('id', $row->bedrooms)->take(1)->first();
											?>
											 <?php if(!empty($bedrooms->featured)): ?>
											 	<?php echo e($bedrooms->featured); ?>

											 <?php endif; ?>
										</td>
										<td>
											 <?php if($row->furnished==1): ?>
											 	Yes
											 <?php else: ?>
											 	No
											 <?php endif; ?>
										</td>
										<td>
											<?php $__currentLoopData = explode(',', $row->animities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php
											 		$animities = DB::table('animities')->where('id', $animi)->take(1)->first();
											 	?>
											 	<?php if(!empty($animities->name)): ?>
												 	<?php echo e($animities->name); ?>,
												 <?php endif; ?> 
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											
										</td>
										<td><a href="javascript:void(0)" onclick="return confirm('Coming Soon?')" class="btn btn-info shadow btn-xs">View</a></td>
									</tr>
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
		            	$('#delBtn'+id).prop('disabled' , true);
		          	},
			        success: function(result){

			            $('#delBtn'+id).prop('disabled' , false);
			              window.location.reload();
			        },
			    });
		    }
		    return false;
		  }
    </script><?php /**PATH D:\xampp\htdocs\anilsir\smartSpaceFinder\resources\views/admin/property-list.blade.php ENDPATH**/ ?>