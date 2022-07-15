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
			<h2 class="mb-3 me-auto">Category List</h2>
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
			<div class="customer-search mb-sm-0 mb-3">
				
			</div>
			<div class="d-flex align-items-center flex-wrap">
				<a href="javascript::void(0)" class="btn btn-primary btn-rounded me-3 mb-2"  data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-user-friends me-2"></i>+ Add Category</a>
				
			</div>
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
								<th>Sn.</th>
								<th>Category</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!blank($properyCategory)): ?>
								<?php $sn = 1; ?>
								<?php $__currentLoopData = $properyCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td class="tbl-bx"><?php echo e($sn); ?></td>
										<td><?php echo e($row->title); ?></td>
										<td><img src="<?php echo e(asset($row->image)); ?>" class="img-fluid" width="100" height="200"></td>
										
										<td>
                                            <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updateCategoryModal<?php echo e($row->id); ?>"><i class="fas fa-pencil-alt"></i></a>
                                             <a href="javascript:void(0)" onclick="delCategory(<?php echo e($row->id); ?>)" id="delBtn<?php echo e($row->id); ?>" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>

                                        </td>
									</tr>


<div class="modal fade" id="updateCategoryModal<?php echo e($row->id); ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv<?php echo e($row->id); ?>"></div>
            <form method="post" onsubmit="return updateCategory(event, '<?php echo e($row->id); ?>')" id="updateCategory<?php echo e($row->id); ?>" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Category Name</label>
                                <input type="text"  name="title" placeholder="Category name.." class="form-control" value="<?php echo e($row->title); ?>" required>
                             	<p id="title_err<?php echo e($row->id); ?>"></p>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Image</label>
                                <input type="file"  name="image" class="form-control" value="">
                                <br>
                                <img src="<?php echo e(asset($row->image)); ?>" class="img-fluid" width="300" height="200">

                            </div>
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



<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv<?php echo e($row->id); ?>"></div>
            <form method="post" onsubmit="return addCategory(event)" id="addCategory" enctype="multipart/form-data">
            	<?php echo csrf_field(); ?>
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Category Name</label>
                                <input type="text"  name="title" placeholder="Category name.." class="form-control" value="" required>
                             	<p id="title_err"></p>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Image</label>
                                <input type="file"  name="image" class="form-control" value="">
                            </div>
                        </div>
                        
                        <button class="btn btn-primary" id="upbtn" type="submit">Add</button>
                </div>
            </form>
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
    	function updateCategory(event,  fid) {
		    event.preventDefault();
		    $('.alert-danger').remove();
		    var data = new FormData($('#updateCategory'+fid)[0]);
		    $.ajax({
		        url: '<?php echo e(url("admin/update-category")); ?>',
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
		            if(result.status==1){
	              		window.location.reload();
		        	}else{
		        		$('#title_err'+fid).html('<div class="alert alert-danger" role="alert">'+result.message+'</div>');
		        	}
		            // window.location.reload();
		        },
		        error: function(err){
			        var title = err.responseJSON.errors.title; 
			        if(typeof  title!=="undefined" && title!==null){
			            $('#title_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.title[0]+'</div>');
			        }
			        $('#upbtn'+fid).prop('disabled' , false);
			     }
		    });
		    return false;
		  }



		  function addCategory(event) {
		    event.preventDefault();
		    $('.alert-danger').remove();
		    var data = new FormData($('#addCategory')[0]);
		    $.ajax({
		        url: '<?php echo e(url("admin/add-category")); ?>',
		        data: data,
		        processData: false,
		        contentType: false,
		        type: 'POST',
		        dataType:'json',
		        beforeSend: function() {        
		            $('#upbtn').prop('disabled' , true);
		            $('#upbtn').text('Processing..');
		          },
		        success: function(result){
		            $('#upbtn').prop('disabled' , false);
		            $('#upbtn').text('Update');
		              window.location.reload();
		        },
		        error: function(err){
			        var title = err.responseJSON.errors.title; 
			        if(typeof  title!=="undefined" && title!==null){
			            $('#title_err').html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.title[0]+'</div>');
			        }
		            $('#upbtn').text('Add');

			        $('#upbtn').prop('disabled' , false);
			     }
		    });
		    return false;
		  }


		  function delCategory(id) {
		    if(confirm('Are you soure want to delete?')){
			    $.ajax({
			        url: '<?php echo e(url("admin/del-category")); ?>',
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
    </script><?php /**PATH D:\xampp\htdocs\zubair\smartSpaceFinder\resources\views/admin/category-list.blade.php ENDPATH**/ ?>