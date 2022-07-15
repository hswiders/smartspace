<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset($property->images[0]->image)); ?>')">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title text-center">
                    <h2 class="page-title"><?php echo e($property->property_heading); ?></h2>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="<?php echo e(route('search-property')); ?>">Single property</a></li>
                        <li> <?php echo e($property->property_heading); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="property-page-area pd-top-120 pd-bottom-90 body-bg">
        <div class="container">
            <div class="property-details-top pd-bottom-70">
                <div class="property-details-top-inner">
                    <div class="row">
                        <div class="col-lg-7">
                            <h3><?php echo e($property->property_heading); ?></h3>
                            <p><img src="<?php echo e(asset('')); ?>assets/frontend/images/location2.png" alt="img"> <?php echo e($property->address); ?></p>
                            <ul>
                                <li><?php echo e($property->bedrooms); ?> Bedroom</li>
                                <li><?php echo e($property->bathrooms); ?> Bathroom</li>
                                
                            </ul>
                        </div>
                        <div class="col-lg-5 text-lg-right">
                            <h4>$<?php echo e($property->monthly_rent); ?></h4>
                            <div class="btn-wrap">
                                <?php if($property->property_type == 1): ?>
                                    <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                    <?php
                                        $property_type = "Residential";
                                    ?>
                                <?php elseif($property->property_type == 2): ?>
                                    <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                    <?php
                                        $property_type = "Office";
                                    ?>
                                <?php else: ?>
                                    <a class="btn btn-blue btn-sm p_type" href="javascript:;">Plot</a>
                                    <?php
                                        $property_type = "Plot";
                                    ?>
                                <?php endif; ?>
                                
                            </div>
                            <ul>
                                <li><img src="<?php echo e(asset('')); ?>assets/frontend/images/calender.png" alt="img"><?php echo e($property->created_at->format('M d , Y')); ?></li>
                                <li><img src="<?php echo e(asset('')); ?>assets/frontend/images/eye.png" alt="img"><?php echo e($property->property_views); ?></li>
                                <li><img src="<?php echo e(asset('')); ?>assets/frontend/images/comment.png" alt="img"><?php echo e(count($reviews)); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-thumbnail-wrapper">
                    <div class="single-thumbnail-slider">
                        <?php $__empty_1 = true; $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="slider-item">
                            <img src="<?php echo e(asset($image->image)); ?>" alt="img">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="slider-item">
                                <img src="<?php echo e(asset('')); ?>assets/frontend/images/slider-2.jpg" alt="img">
                            </div>
                        <?php endif; ?>
                        
                        
                    </div>
                    <div class="product-thumbnail-carousel">
                        <?php $__empty_1 = true; $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="single-thumbnail-item">
                            <img src="<?php echo e(asset($image->image)); ?>" alt="img">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="single-thumbnail-item">
                                <img src="<?php echo e(asset('')); ?>assets/frontend/images/slider-2.jpg" alt="img">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-property-details-inner">
                        <h4>Description</h4>
                        <p><?php echo e($property->description); ?></p>
                        <div class="single-property-grid">
                            <h4>Poperty Details</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="row">
                                        <li class="col-md-4">Bedrooms: <?php echo e($property->bedrooms); ?></li>
                                        <li class="col-md-4">Bathrooms: <?php echo e($property->bathrooms); ?></li>
                                        <li class="col-md-4">Category: <?php echo e($property->category->title); ?></li>
                                        <li class="col-md-4">Type: <?php echo e($property_type); ?></li>
                                    </ul>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="single-property-grid">
                            <h4>Parking Type</h4>
                            <div class="row">
                                
                                <div class="col-md-12">
                                  
                                    <ul class="row">
                                        <?php $__empty_1 = true; $__currentLoopData = $property->parking_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                           <li class="ml-3"><i class="fa fa-check"></i><?php echo e($parking->title); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li>No Parking found</li>
                                        <?php endif; ?>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        <div class="single-property-grid">
                            <h4>Amenities</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="row">
                                         <?php $__empty_1 = true; $__currentLoopData = $property->animities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                           <li class="ml-3"><i class="fa fa-check"></i><?php echo e($amenities->name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li>No Amenities found</li>
                                        <?php endif; ?>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>

                        <div class="single-property-grid">
                            <h4>Estate Location</h4>
                            <div class="property-map">
                                
                                <iframe src="//maps.google.com/maps?q=<?php echo e($property->lat); ?>,<?php echo e($property->lng); ?>&z=15&output=embed"></iframe>
                            </div>
                        </div>

                        <div class="single-property-grid">
                            <h4>Whats people says?</h4>
                            <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                 $element->user = App\Models\User::where('id' , $element->user_id)->first();
                            ?>
                            <div class="media single-review-inner">
                                <div class="media-left">
                                    <div class="thumb">
                                        <img width="50px" height="50px" src="<?php echo e(asset($element->user->image)); ?>" class="rounded-circle" alt="img">
                                    </div>
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5><?php echo e($element->user->first_name.' '.$element->user->last_name); ?></h5>
                                            <p><?php echo e($element->review); ?></p>
                                        </div>
                                        <div class="col-md-4 text-md-right">
                                            <p class="ratting-title"><span><?php echo e($element->created_at->format('M d , Y')); ?></span></p>
                                                <div class="ratting-inner">
                                                    <?php for($i = 0; $i < $element->rating ; $i++): ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php endfor; ?>
                                                    
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                               <div class="alert alert-danger">No Reviews Found</div>
                            <?php endif; ?>
                            
                        </div>
                        

                        <form class="single-property-comment-form " id="handleAjax" action="<?php echo e(route('user.do-review')); ?>">
                            <?php
                                $review_class = 'logged_in';
                            ?>
                            <?php if(!Auth::id() || $is_reviewed ): ?>
                                <?php
                                    $review_class = 'not_logged_in';
                                ?>
                                <div class="login_btn">
                                    <?php if($is_reviewed): ?>
                                        <p class="text-white text-center">This property has already been reviewed, so you cannot review it again</p>
                                        
                                    <?php else: ?>

                                    <p class="text-white text-center">In order to review, you need to login</p>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Login</a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="single-property-grid bg-black <?php echo e($review_class); ?>" >
                                <div class="single-property-form-title">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4>Post Your Comment</h4>
                                        </div>
                                        <div class="col-md-4 text-md-right">
                                            
                                            <div class="starrating risingstar d-flex justify-content-right flex-row-reverse">
                                                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 star"></label>
                                                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 star"></label>
                                                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 star"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 star"></label>
                                                <input type="radio" id="star1" checked name="rating" value="1" /><label for="star1" title="1 star"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="single-input-inner style-bg">
                                            <span class="label">Your Name</span>
                                            <input disabled type="text" placeholder="Your name here...." value="<?php echo e((Auth::user()) ? Auth::user()->first_name.' '.Auth::user()->last_name : ''); ?>">
                                            <input type="hidden" name="property_id" value="<?php echo e($property->id); ?>">
                                             <?php echo csrf_field(); ?>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="single-input-inner style-bg">
                                            <span class="label">Enter Your Mail</span>
                                            <input disabled type="text" placeholder="Your name here...." value="<?php echo e((Auth::user()) ? Auth::user()->email  : ''); ?>">
                                        </label>
                                    </div>
                                    <div class="col-12">
                                        <label class="single-input-inner style-bg">
                                            <span class="label">Enter Your Messege</span>
                                            <textarea name="review" placeholder="Enter your messege here...."></textarea>
                                        </label>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <button type="submit" class="btn btn-base radius-btn">Submit Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        <div class="widget widget-author text-center">
                            <div class="thumb">
                                <img src="<?php echo e(asset($property->owner->image )); ?>" alt="img">
                            </div> 
                            <div class="details">
                                <h5><?php echo e($property->owner->first_name.' '.$property->owner->last_name); ?></h5>
                               
                                <ul class="d-flex flex-column align-items-start">
                                    <li><a href="javascript:;" onclick="alert('comming soon')"><i class="fa-solid fa-comment-dots"></i> Chat Now</a></li>
                                    
                                </ul>
                            </div>        
                        </div>
                        <div class="widget widget-place">
                            <h5 class="widget-title">Categories</h5>
                            <ul class="search_categories">
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="<?php echo e(($property->category->id == $element->id) ? 'active' : ''); ?>"><a href="<?php echo e(route('search.category' , ['slug' => Str::slug($element->title) , 'id' => $element->id])); ?>"><?php echo e($element->title); ?> </a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li class="alert alert-danger"> No Category found</li>
                                <?php endif; ?>
                                
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <script id="review_add_script_js">
    $(function() {
    // handle submit event of form
      $(document).on("submit", "#handleAjax", function() {
        var e = this;
        // change login button text before ajax
        $(this).find("[type='submit']").html("Processing..");
         $('.alert-danger').remove();
        $.post($(this).attr('action'), $(this).serialize(), function(data) {

          $(e).find("[type='submit']").html("Submit Now");
          if (data.status) { // If success then redirect to login url
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: data.msg,
              showConfirmButton: false,
              timer: 1500
            }).then((result) => {
              location.reload();
            })
            
          }
        }).fail(function(response) {
            // handle error and show in html
          $(e).find("[type='submit']").html("Submit Now");
          $(".alert").remove();
          var erroJson = JSON.parse(response.responseText);
          
          for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
            $("[name='" + err + "']").focus();
          }
        });
        return false;
      });
    });
  </script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/single-property.blade.php ENDPATH**/ ?>