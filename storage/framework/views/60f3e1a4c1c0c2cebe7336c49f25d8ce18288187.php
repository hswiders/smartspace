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
			<h2 class="mb-3 me-auto">Customers</h2>
			<!-- <div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0)">Customers</a></li>
				</ol>
			</div> -->
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
			<div class="customer-search mb-sm-0 mb-3">
				<!-- <div class="input-group search-area">
					<input type="text" class="form-control" placeholder="Search here......">
					<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
				</div> -->
			</div>
			<!-- <div class="d-flex align-items-center flex-wrap">
				<a href="javascript:void(0);" class="btn btn-primary btn-rounded me-3 mb-2"><i class="fas fa-user-friends me-2"></i>+ Add New Customer</a>
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
								<th>Sn.</th>
								<th>Name</th>
								<th>Image</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Phone Verified</th>
								<th>Email Verified</th>
								<th>Status</th>
								<!-- <th>Join Date</th> -->
								<th>Action</th>
							</tr>
						</thead>
							<tbody>
								<?php if(!blank($users)): ?>
									<?php $sn = 0; ?>
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php $sn++; ?>

										<tr>
											<td><?php echo e($sn); ?></td>
											<td><?php echo e($row->first_name); ?> <?php echo e($row->last_name); ?></td>
											<td><img src="<?php echo e(asset($row->image)); ?>" class="img-fluid"></td>
											<td><?php echo e($row->email); ?></td>
											<td><?php echo e($row->phonecode); ?>-<?php echo e($row->phone); ?></td>
											<td><?php echo e($row->address); ?></td>
											<td>
												<?php if($row->phone_verified==1): ?>
													<a class="dropdown-item text-success" href="javascript:void(0);"><i class="far fa-check-circle me-1 text-success"></i>Yes</a> 
												<?php else: ?> 
													<a class="dropdown-item text-danger " href="javascript:void(0);"><i class="far fa-times-circle me-1 text-danger"></i>No</a>
												<?php endif; ?>
											</td>
											<td>
												<?php if($row->email_verified_at!==null): ?>
													<a class="dropdown-item text-success" href="javascript:void(0);"><i class="far fa-check-circle me-1 text-success"></i>Yes</a> 
												<?php else: ?> 
													<a class="dropdown-item text-danger " href="javascript:void(0);"><i class="far fa-times-circle me-1 text-danger"></i>No</a>
												<?php endif; ?>
											</td>
											<td>
												<?php if($row->status==0): ?>
													<a class="dropdown-item text-success" href="javascript:void(0);"><i class="far fa-check-circle me-1 text-success"></i>Active</a> 
												<?php else: ?> 
													<a class="dropdown-item text-danger " href="javascript:void(0);"><i class="far fa-times-circle me-1 text-danger"></i>Blocked</a>
												<?php endif; ?>
											</td>
											<!-- <td><?php echo e(date('d-m-Y H:i a', strtotime($row->created_at))); ?></td> -->
											<td>
												<?php if($row->status==0): ?>
													<a href="<?php echo e(url('admin/block-unblock')); ?>?id=<?php echo e(Crypt::encryptString($row->id)); ?>" onclick="return confirm('Are you soure want to do block?')" class="btn btn-danger shadow btn-xs">Block</a>
												<?php else: ?> 
													<a href="<?php echo e(url('admin/block-unblock')); ?>?id=<?php echo e(Crypt::encryptString($row->id)); ?>" onclick="return confirm('Are you soure want to do active?')" class="btn btn-success shadow btn-xs">Active</a>

												<?php endif; ?>
											</td>
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
    ***********************************<?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/user-list.blade.php ENDPATH**/ ?>