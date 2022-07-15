
                    <div class="product-search-inner ">
                        <div class="row custom-gutters-20">
                            <div class="col-md-9 align-self-center">
                                <h5><?php echo e($properties->total()); ?> Properties</h5>
                            </div>
                            <div class="col-md-3 mt-2 mt-md-0 align-self-center">
                                <div class="single-select-inner">
                                    <select class="form-control common_selector" id="sort_by">
                                        <option value="">Sort By</option>
                                        <option <?php echo e(( $sort_by == 'is_featured' ) ? 'selected' : ''); ?> value="is_featured">Popular</option>
                                        <option <?php echo e(( $sort_by == 'l_to_h' ) ? 'selected' : ''); ?> value="l_to_h">Low to High</option>
                                        <option <?php echo e(( $sort_by == 'h_to_l' ) ? 'selected' : ''); ?> value="h_to_l">High to Low</option>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php

                            $element->image = App\Models\ProperyImages::where('property_id' , $element->id)->first();
                            $element->owner = App\Models\User::where('id' , $element->user_id)->first();
                            $element->property_category = App\Models\ProperyCategory::where('id' , $element->property_category)->first();
                            $icon_class = 'far';
                            if (Auth::id())
                            {
                                $is_favourite =  App\Models\Favourites::where(['property_id' => $element->id , 'user_id' => Auth::id()])->first();
                                if ($is_favourite)
                                {
                                    $icon_class = 'fas';
                                }
                                
                            }
                        ?> 
                        <div class="col-lg-6 col-md-6">
                            <div class="single-product-wrap">
                                <div class="thumb">
                                    <a href="<?php echo e(route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id])); ?>">
                                                <img src="<?php echo e(asset($element->image->image)); ?>" alt="img">
                                     </a> 
                                    <div class="btn-area">
                                        <?php if($element->property_type == 1): ?>
                                            <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                        <?php elseif($element->property_type == 2): ?>
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                        <?php else: ?>
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Plot</a>
                                        <?php endif; ?>
                                        
                                        
                                    </div>
                                    <div class="product-wrap-details">
                                        <div class="media">
                                            <div class="author">
                                                <img src="<?php echo e(asset($element->owner->image)); ?>" alt="img" width="50px" height="50px">                                    
                                            </div>
                                            <div class="media-body">
                                                <h6><a href="#"><?php echo e($element->owner->first_name); ?></a></h6>
                                                <p><img src="<?php echo e(asset('/assets/frontend/images/location.png')); ?>" alt="img"> <?php echo e($element->address); ?> </p>
                                            </div>
                                            <a class="fav-btn float-right" href="javascript:;" onclick="addToFav(<?php echo e($element->id); ?>)"><i class="<?php echo e($icon_class); ?> fa-heart property_heart_<?php echo e($element->id); ?>"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-details-inner">
                                            <h4><a href="<?php echo e(route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id])); ?>"><?php echo e($element->property_heading); ?></a></h4>
                                            <ul class="meta-inner">
                                                <li><img src="<?php echo e(asset('')); ?>assets/frontend/images/location2.png" alt="img"><?php echo e($element->city.' , '.$element->state); ?></li>
                                                
                                            </ul>
                                            <p><?php echo e(mb_strimwidth($element->description, 0, 97, '...')); ?></p>
                                        </div>
                                        <div class="product-meta-bottom">
                                            <span class="price">$<?php echo e($element->monthly_rent); ?></span>
                                            <span><?php echo e($element->created_at->diffForHumans()); ?></span>
                                        </div> 
                                

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-md-12">
                                <div class="alert alert-danger">No properties found</div>
                            </div>
                        <?php endif; ?>
                        
                      
                    </div>
                    <div class="pagination-area text-center mt-4">
                        
                        <div id="pagination">
                          <?php echo e($properties->links('pagination.ajax_pagination')); ?>

                        </div>
                    </div>
                <?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/ajax/filter_properties.blade.php ENDPATH**/ ?>