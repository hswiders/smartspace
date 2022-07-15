<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
    .remove_img
    {
        cursor: pointer;
        background:red;
        color: #fff;
        padding: 5px;
    }
    textarea{
        height: auto!important;
    }
</style>

<div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset('')); ?>assets/frontend/images/breadcrumb.jpg')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title text-center">
                <h2 class="page-title">My Properties</h2>
                <ul class="page-list">
                    <li><a href="index.html">Home</a></li>
                    <li> My Properties</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="add-property-area pd-top-120 body-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="myproperties" class="table table-striped display dataTable no-footer">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Property Category</th>
                            <th>Property Details</th>
                            <th>Rent & Fees</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     <?php $__empty_1 = true; $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>  $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                       
                        <td><?php echo e($key+1); ?></td>
                        <td><img src="<?php echo e(asset($element->image->image)); ?>" width="50"></td>
                        <td><?php echo e($element->property_heading); ?></td>
                        <td>
                            <p><b>Address</b> :<?php echo e($element->address); ?></p>
                            <p><b>State</b> :<?php echo e($element->state); ?></p>
                            <p><b>City</b> :<?php echo e($element->city); ?></p>
                            <p><b>Zip</b> :<?php echo e($element->zip); ?></p>
                        </td>
                        <td><?php echo e($element->property_category->title); ?> </td>
                        <td>
                            <p><b>Is Furnished</b> :<?php echo e(($element->furnished) ? 'Yes' : 'No'); ?></p>
                            <p><b>Utilities Included</b> :<?php echo e(($element->utilities) ? 'Yes' : 'No'); ?></p>
                            <p><b>Bedrooms </b>:<?php echo e($element->bedrooms); ?></p>
                            <p><b>Bathrooms </b>:<?php echo e($element->bathrooms); ?></p> 
                        </td>
                        <td>
                            <p>Monthly Rent : $<?php echo e($element->monthly_rent); ?></p>
                            <?php echo ($element->fee_1) ? '<p> <b>'.$element->fee_1->name.'</b> : $'.$element->fee_1_amount.'</p>' : ''; ?>

                            <?php echo ($element->fee_2) ? '<p> <b>'.$element->fee_2->name.'</b>: $'.$element->fee_2_amount.'</p>' : ''; ?>

                            <?php echo ($element->fee_3) ? '<p> <b>'.$element->fee_3->name.'</b> : $'.$element->fee_3_amount.'</p>' : ''; ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('user.edit-property',[$element->id])); ?>" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="deleteProperty(<?php echo e($element->id); ?>)" class="btn btn-sm btn-danger">Delete</button>
                            <?php if($element->status == 1): ?>
                                <button onclick="changeStatus(<?php echo e($element->id); ?> , 0)" class="btn btn-sm btn-danger">Disable</button>
                            <?php else: ?>
                                <button onclick="changeStatus(<?php echo e($element->id); ?> , 1)" class="btn btn-sm btn-success">Enable</button>
                            <?php endif; ?>
                            
                            
                        </td>
                       
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            
                    <?php endif; ?>
                </table>
            </div>
        </div>
        
    </div>
</div>
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>


  <script type="text/javascript"> 
    function deleteProperty(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            
                form_data = new FormData();
                form_data.append('_token', '<?php echo e(csrf_token()); ?>');
                
                form_data.append('id', id);
                $.ajax({
                    url: "<?php echo e(route('user.property.delete')); ?>",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $.blockUI();
                    },
                    success: function (data) {
                       $.unblockUI();
                        Swal.fire(
                          'Deleted!',
                          'Your Property has been deleted.',
                          'success'
                        )
                        location.reload();
                    }
                    
                  });
            }
           
          
        })
    }
    function changeStatus (id , status) 
    {
        form_data = new FormData();
        form_data.append('_token', '<?php echo e(csrf_token()); ?>');
        
        form_data.append('id', id);
        form_data.append('status', status);
        $.ajax({
            url: "<?php echo e(route('user.property.changeStatus')); ?>",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $.blockUI();
            },
            success: function (data) {
               $.unblockUI();
                Swal.fire(
                  'Changed!',
                  'Your Property Status has been Changed.',
                  'success'
                )
                location.reload();
            }
            
          });
    }
  $(document).ready( function () {
    $('#myproperties').DataTable()
} );
  
</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/property/my-properties.blade.php ENDPATH**/ ?>