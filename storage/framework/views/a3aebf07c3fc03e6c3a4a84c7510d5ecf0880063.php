


		
		
        <!--**********************************
            Header start
        ***********************************-->
        <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--********************************Header end ti-comment-alt********************************-->
<style type="text/css">
    .discript{width: 250px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
    div#carouselExampleControls img {
    height: 200px;
    object-fit: contain;
}
</style>
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
		
		
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View Property</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                           <div class="col-md-4">Owner Name</div>
                                <?php 
                                  $username = DB::table('users')->where('id', $property->user_id)->take(1)->first();
                                ?>
                            <div class="col-md-8"><b><?php echo e($username->first_name); ?> <?php echo e($username->last_name); ?></b></div>
                            </div>
                            <hr>
    			        
    				       <div class="row">
                                <div class="col-md-4">Property Name</div>

                                <div class="col-md-8"><b><?php echo e($property->property_heading); ?></b></div>
                            </div>
                            <hr>
    				   <div class="row">
                            <div class="col-md-4">Is Featured</div>

                              <div class="col-md-8"><b><?php if($property->is_featured==0): ?> No <?php else: ?> Yes <?php endif; ?></b></div>
                    </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">Bathrooms</div>
                            <div class="col-md-8"><b><?php echo e($property->bathrooms); ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Bedrooms</div>
                            <div class="col-md-8"><b><?php echo e($property->bedrooms); ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Furnished</div>
                            <div class="col-md-8"><b><?php if($property->furnished==1): ?>
                                                        Yes
                                                     <?php else: ?>
                                                        No
                                                    <?php endif; ?>
                                </b></div>
                        </div>
                        <hr>

                          <div class="row">
                            <div class="col-md-4">Animities</div>
                            <div class="col-md-8"><b><?php $__currentLoopData = explode(',', $property->animities); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $animities = DB::table('animities')->where('id', $animi)->take(1)->first();
                                                ?>
                                                <?php if(!empty($animities->name)): ?>
                                                    <?php echo e($animities->name); ?>,
                                                 <?php endif; ?> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </b></div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">Utilities</div>
                            <div class="col-md-8"><b><?php if($property->utilities==1): ?>
                                                        Yes
                                                     <?php else: ?>
                                                        No
                                                    <?php endif; ?>
                                </b></div>
                        </div>
                        <hr>
                         <!-- <div class="row">
                            <div class="col-md-4">Minimum Terms</div>
                            <div class="col-md-8"><b><?php echo e($property->minimum_term); ?></b></div>
                        </div>
                        <hr> -->
                         <div class="row">
                            <div class="col-md-4">Unit Type</div>
                            <div class="col-md-8"><b><?php if($property->unit_type==1): ?>
                                                        Seprate Room Unit
                                                     <?php else: ?>
                                                        Seprate
                                                    <?php endif; ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Bath Type</div>
                            <div class="col-md-8"><b><?php if($property->bath_type==1): ?>
                                                        Shared
                                                     <?php else: ?>
                                                        Private
                                                    <?php endif; ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Entrance Type</div>
                            <div class="col-md-8"><b><?php if($property->entrance_type==1): ?>
                                                        Shared Entrance
                                                     <?php else: ?>
                                                        Private Entrance
                                                    <?php endif; ?></b></div>
                        </div>
                        <hr>
                           <div class="row">
                            <div class="col-md-4">Washer And Dryer</div>
                            <div class="col-md-8"><b><?php if($property->washer_and_dryer==0): ?>
                                                        In Unit
                                                     <?php elseif($property->washer_and_dryer==1): ?>
                                                        On the Permises
                                                    <?php else: ?>
                                                        None
                                                    <?php endif; ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Pets Allowed</div>
                            <div class="col-md-8"><b><?php if($property->pets_allowed==1): ?>
                                                        Yes
                                                     <?php else: ?>
                                                        NO
                                                    <?php endif; ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Monthly Rent</div>
                            <div class="col-md-8"><b>$<?php echo e($property->monthly_rent); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Address</div>
                            <div class="col-md-8"><b><?php echo e($property->address); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">City</div>
                            <div class="col-md-8"><b><?php echo e($property->city); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">State</div>
                            <div class="col-md-8"><b><?php echo e($property->state); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Zipcode</div>
                            <div class="col-md-8"><b><?php echo e($property->zip); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Latitude</div>
                            <div class="col-md-8"><b><?php echo e($property->lat); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Longitude</div>
                            <div class="col-md-8"><b><?php echo e($property->lng); ?></b></div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">Description</div>
                            <div class="col-md-8"><b><?php echo e($property->description); ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Public Transport</div>
                            <div class="col-md-8"><b><?php echo e($property->public_transport); ?></b></div>
                        </div>
                        <hr>
                          <div class="row">
                            <div class="col-md-4">Parking Type</div>
                            <div class="col-md-8"><b><?php echo e($property->parking_type); ?></b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">Name</div>
                            <div class="col-md-8"><b><?php echo e($property->name); ?></b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-8"><b><?php echo e($property->email); ?></b></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">Phone</div>
                            <div class="col-md-8"><b><?php echo e($property->phone); ?></b></div>
                        </div>
                        <hr>
                         <div class="row">
                            <div class="col-md-4">Website</div>
                            <div class="col-md-8"><b><?php echo e($property->website); ?></b></div>
                        </div>
                        <hr>
                         <?php if($property->fee_1): ?>
                        <div class="row">
                            <?php 
                                $fees_1 = DB::table('property_fees')->where('id', $property->fee_1)->take(1)->first();
                             ?>
                            <div class="col-md-4"><?php echo e($fees_1->name); ?></div>
                            <div class="col-md-8"><b>$<?php echo e($property->fee_1_amount); ?></b></div>
                        </div>
                        <hr>
                        <?php endif; ?>
                         <?php if($property->fee_2): ?>
                       <div class="row">
                            <?php 
                                $fees_2 = DB::table('property_fees')->where('id', $property->fee_2)->take(1)->first();
                             ?>
                             <div class="col-md-4"><?php echo e($fees_2->name); ?></div>
                            <div class="col-md-8"><b>$<?php echo e($property->fee_2_amount); ?></b></div>
                        </div>
                        <hr>
                    <?php endif; ?>
                    <?php if($property->fee_3): ?>
                        <div class="row">
                             <?php 
                                $fees_3 = DB::table('property_fees')->where('id', $property->fee_3)->take(1)->first();
                             ?>
                            <div class="col-md-4"><?php echo e($fees_3->name); ?></div>
                            <div class="col-md-8"><b>$<?php echo e($property->fee_3_amount); ?></b></div>
                        </div>
                        <hr>
                    <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">Property Image</div>
                            <div class="col-md-12">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                <?php $__currentLoopData = $property_image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="carousel-item <?php echo e(($key == 0) ? 'active' : ''); ?>">
                                  <img src="<?php echo e(asset($row->image)); ?>" class="d-block w-100" alt="...">
                                </div>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                              </div>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                            </div>
                            </div>

                        </div>
                        <hr>
				    </div>
			
		        </div>
	       </div>
        </div>
    </div>
</div>





        <!--**********************************
            Footer start
        ***********************************-->
        <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--**********************************
            Footer end
        ***********************************-->
<script type="text/javascript">

  function addArea(event) {
    event.preventDefault();
    $('.alert-danger').remove();
    var data = new FormData($('#addArea')[0]);

    $.ajax({
        url: 'Admin/AreaServed/add_area',
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'json',
        beforeSend: function() {        
            $('#addbtn').prop('disabled' , true);
            $('#addbtn').text('Processing..');
          },
        success: function(result){
            $('#addbtn').prop('disabled' , false);
            $('#addbtn').text('Add');
            if(result.status == 1)
            {
              window.location.href = result.redirect;
            }
            else
            {
              console.log(result.message);
              for (var err in result.message) {
            
              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
              }
            }
        }
    });
    return false;
  }

</script>
<?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/view-property.blade.php ENDPATH**/ ?>