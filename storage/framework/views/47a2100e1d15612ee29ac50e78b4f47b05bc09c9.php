


		
		
        <!--**********************************
            Header start
        ***********************************-->
        <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--********************************Header end ti-comment-alt********************************-->
<style type="text/css">
    .discript{width: 250px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
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
                        <h4 class="card-title">Update Property</h4>
                    </div>
                    <div class="card-body">
    			        <form class="" method="post" id="handleAjax" action="<?php echo e(route('user.property.store')); ?>" name="postform">
            <div class="row">
               <div class="col-12">
                    <label class="single-input-inner style-bg-border">
                        <span class="label">Property Title</span>   
                        <input type="text" name="property_heading" value="<?php echo e($property->property_heading); ?>" >
                        <?php echo csrf_field(); ?>
                    </label>
                </div> 
            </div>
            
            <div class="btn btn-base hover-none">Location</div>
            <div class="property-form-grid">

                <div class="row">
                     <div class="col-md-12">
                         <div id="myMap"></div><br/>
                     </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Property Type</span>
                            <select name="property_type" class="form-control">
                                <option value="">Choose Property Type</option>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option <?php echo e(($property->property_type == $element->id) ? 'selected' : ''); ?> value="<?php echo e($element->id); ?>"><?php echo e($element->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option value="">No categories found</option>
                                <?php endif; ?>
                                
                               
                            </select>
                        </label>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Address</span>
                           <input type="text" name="address" value="<?php echo e($property->address); ?>" id="address">
                           <input type="hidden" name="lat" value="<?php echo e($property->lat); ?>" id="lat">
                           <input type="hidden" name="lng" value="<?php echo e($property->lng); ?>" id="lng">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property State</span>
                            <input type="text" name="state" value="<?php echo e($property->state); ?>" id="state" class="form-control">
                             
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property City</span>
                            <input type="text" name="city" value="<?php echo e($property->city); ?>" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Zip</span>
                           <input type="text" name="zip" value="<?php echo e($property->zip); ?>" id="zip">
                        </div>
                    </div>
               
                </div>
            </div>
            <div class="btn btn-base hover-none">Property Details</div>
            <div class="property-form-grid">
                <div class="row">
                   
                   
                    <div class="col-md-6">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bedrooms</span>
                            <select name="bedrooms" class="form-control">
                                <option value="">Choose Bedroom</option>
                                <option <?php echo e(($property->berooms == 1) ? 'selected' : ''); ?> value="1">1 Bedroom</option>
                                <option <?php echo e(($property->berooms == 2) ? 'selected' : ''); ?> value="2">2 Bedroom</option>
                                <option <?php echo e(($property->berooms == 3) ? 'selected' : ''); ?> value="3">3 Bedroom</option>
                                <option <?php echo e(($property->berooms == 4) ? 'selected' : ''); ?> value="4">4 Bedroom</option>
                                <option <?php echo e(($property->berooms == 5) ? 'selected' : ''); ?> value="5">5 Bedroom</option>
                                <option <?php echo e(($property->berooms == 6) ? 'selected' : ''); ?> value="6">6 Bedroom</option>
                                <option <?php echo e(($property->berooms == 7) ? 'selected' : ''); ?> value="7">7 Bedroom</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bathrooms</span>
                            <select name="bathrooms" class="form-control">
                                <option value="">Choose Bathroom</option>

                                <option<?php echo e(($property->bathrooms == 1) ? 'selected' : ''); ?> value="1">1</option>
                                <option<?php echo e(($property->bathrooms == 2) ? 'selected' : ''); ?> value="2">2</option>
                                <option<?php echo e(($property->bathrooms == 3) ? 'selected' : ''); ?> value="3">3</option>
                                <option<?php echo e(($property->bathrooms == 4) ? 'selected' : ''); ?> value="4">3</option>
                                <option<?php echo e(($property->bathrooms == 5) ? 'selected' : ''); ?> value="5">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Fully Furnished ?</span>
                            <label><input <?php echo e(($property->furnished == 1) ? ' checked' : ''); ?> type="radio" name="furnished" class="radio" value="1"> Yes </label><br>
                            <label><input <?php echo e(($property->furnished == 0) ? ' checked' : ''); ?> type="radio" name="furnished" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Utilities included ?</span>
                            <label><input<?php echo e(($property->utilities == 1) ? ' checked' : ''); ?> type="radio" name="utilities" class="radio" value="1"> Yes </label><br>
                            <label><input<?php echo e(($property->utilities == 0) ? ' checked' : ''); ?> type="radio" name="utilities" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            <div class="btn btn-base hover-none">Unit Details</div>
            <div class="property-form-grid">
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Unit Type</span>
                            <label> <input <?php echo e(($property->unit_type == 'Seperate Unit') ? ' checked' : ''); ?> type="radio" name="unit_type" class="radio" value="Seperate Unit"> Seperate Unit</label><br>
                            <label> <input <?php echo e(($property->unit_type == 'Seperate room in a unit') ? ' checked' : ''); ?> type="radio" name="unit_type" class="radio" value="Seperate room in a unit"> Seperate room in a unit</label><br>
                        </div>
                    </div> 
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bath Type</span>
                            <label> <input <?php echo e(($property->bath_type == 'Private Bath') ? ' checked' : ''); ?> type="radio" name="bath_type" class="radio" value="Private Bath"> Private Bath</label><br>
                            <label> <input <?php echo e(($property->bath_type == 'Shared Bath') ? ' checked' : ''); ?> type="radio" name="bath_type" class="radio" value="Shared Bath"> Shared Bath</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Entrance Type</span>
                            <label>  <input <?php echo e(($property->entrance_type == 'private entrance') ? ' checked' : ''); ?> type="radio" name="entrance_type" class="radio" value="private entrance"> private</label><br>
                            <label> <input <?php echo e(($property->entrance_type == 'shared entrance') ? ' checked' : ''); ?> type="radio" name="entrance_type" class="radio" value="shared entrance"> shared entrance</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Washer & Dryer</span>
                            <label> <input <?php echo e(($property->washer_and_dryer == 'In-unit') ? ' checked' : ''); ?> type="radio" name="washer_and_dryer" class="radio" value="In-unit"> In-unit</label><br>
                            <label> <input <?php echo e(($property->washer_and_dryer == 'On the Premises') ? ' checked' : ''); ?> type="radio" name="washer_and_dryer" class="radio" value="On the Premises"> On the Premises</label><br>
                            <label><input type="radio" <?php echo e(($property->washer_and_dryer == 'None') ? ' checked' : ''); ?> name="washer_and_dryer" class="radio" value="None"> None</label><br>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Pets Allowed ?</span>
                            <label><input <?php echo e(($property->pets_allowed == 1) ? ' checked' : ''); ?> type="radio" name="pets_allowed" class="radio" value="1"> Yes </label><br>
                            <label><input <?php echo e(($property->pets_allowed == 0) ? ' checked' : ''); ?> type="radio" name="pets_allowed" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Monthly rent </span>
                           <input type="number" step="0.1" placeholder="Eg: 2000" name="monthly_rent" value="<?php echo e($property->monthly_rent); ?>" >
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            <div class="btn btn-base hover-none">Fees </div>
            <div class="property-form-grid">
                <div class="row">

                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee</span>
                            <select name="fee_1" class="form-control">
                                <option value="">Choose Property Type</option>
                                <?php $__empty_1 = true; $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option <?php echo e(($property->fee_1 == $element->id) ? 'selected' : ''); ?> value="<?php echo e($element->id); ?>"><?php echo e($element->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option value="">No fees found</option>
                                <?php endif; ?>
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount </span>
                            <input type="number"  name="fee_1_amount" value="<?php echo e($property->fee_1_amount); ?>" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee </span>
                            <select name="fee_2" class="form-control">
                                <option value="">Choose Property Type</option>
                                <?php $__empty_1 = true; $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option <?php echo e(($property->fee_2 == $element->id) ? 'selected' : ''); ?> value="<?php echo e($element->id); ?>"><?php echo e($element->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option value="">No fees found</option>
                                <?php endif; ?>
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_2_amount" value="<?php echo e($property->fee_2_amount); ?>" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee</span>
                            <select name="fee_3" class="form-control">
                                <option value="">Choose Property Type</option>
                                <?php $__empty_1 = true; $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option <?php echo e(($property->fee_3 == $element->id) ? 'selected' : ''); ?> value="<?php echo e($element->id); ?>"><?php echo e($element->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option value="">No fees found</option>
                                <?php endif; ?>
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_3_amount" value="<?php echo e($property->fee_3_amount); ?>" class="form-control">
                                
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="btn btn-base hover-none">Amenities </div>
            <div class="property-form-grid">
                <div class="row">

                    <div class="col-12">
                        <ul>
                            <?php $__empty_1 = true; $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="single-select-inner style-bg-border">
                                    <?php
                                        $aminities = explode(',', $property->animities)
                                    ?>
                                <label><input <?php echo e((in_array($element->id, $aminities)) ? ' checked' : ''); ?> type="checkbox" name="animities[]" class="checkbox" value="<?php echo e($element->id); ?>"> <?php echo e($element->name); ?> </label>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="alert alert-danger">No Amenities found</li>
                            <?php endif; ?>
                           
                            
                        </ul>
                    </div>
                    <div class="col-12">
                        <span class="label">Describe public Transportation</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea  name="public_transport" rows="3" placeholder="Describe public Transportation"><?php echo e($property->public_transport); ?></textarea>
                        </label>
                    </div>
                    <div class="col-12">
                        <span class="label">Describe Parking type</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea  name="parking_type" rows="3" placeholder="Eg: Garage , approved , carpote , underground , assigned place"><?php echo e($property->parking_type); ?></textarea>
                        </label>
                    </div>
                    <div class="col-12">
                        <span class="label">Description</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea placeholder="Description" rows="5" name="description"><?php echo e($property->description); ?></textarea>
                        </label>
                    </div>
            </div>
            <div class="btn btn-base hover-none">Property Photos </div>
            <div class="property-form-grid">
                <div class="row" id="uploaded_file">
                     <?php $__empty_1 = true; $__currentLoopData = $property_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-3" id="img_<?php echo e($element->id); ?>">
                                <span class="remove_img" data-id="img_<?php echo e($element->id); ?>" data-type="1">X</span>
                                <img src="<?php echo e(asset($element->image)); ?>" class="w-100" >

                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                    <?php endif; ?>   
                </div>
                <div class="row">

                     <div class="col-12" id="drop_file_area">
                        <div name="property_images" ></div>
                        <div class="avatar-upload-input text-center">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            <h2>Upload your photo</h2>
                            <p>Its must be a clean photo</p>
                            <div class="avatar-edit-input">
                                <input class="btn btn-base" type="file" multiple   id="imageUpload1" accept=".png, .jpg, .jpeg">
                                <label class="btn btn-base" for="imageUpload1">Click here to Upload</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="btn btn-base hover-none">Contact Details</div>
            <div class="property-form-grid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="text" name="name" value="<?php echo e($property->name); ?>" placeholder="Name">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="email" name="email" value="<?php echo e($property->email); ?>" placeholder="Email">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="number" name="phone" value="<?php echo e($property->phone); ?>" placeholder="Phone">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="text" name="website" value="<?php echo e($property->website); ?>" placeholder="Website">
                        </label>
                    </div>
                    
                    <div class="col-12 text-center mb-4">
                        <button type="submit" class="btn btn-base">Update Now</button>
                    </div>
                </div>
            </div>
        </form> 
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

</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/admin/edit-property.blade.php ENDPATH**/ ?>