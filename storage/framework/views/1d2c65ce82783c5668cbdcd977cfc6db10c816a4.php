<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
span.online-user {
    background: #0e8700;
    width: 15px;
    height: 15px;
    position: absolute;
    border-radius: 100%;
    top: 18%;
    border: 2px solid #fff;
    padding: 0;
    left: 88%;
}
</style>
  <div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset('')); ?>assets/frontend/images/breadcrumb-2.jpg')">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title text-center">
                    <h2 class="page-title">Favourites Property</h2>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li> Favourites Property</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<div class="py-5 body-bg">
    <div class="container">
        <div class="product-search-inner ">
                        <div class="row custom-gutters-20">
                            <div class="col-md-9 align-self-center">
                                <h5><?php echo e($properties->total()); ?> Properties</h5>
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
                        <div class="col-lg-4 col-md-4">
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
    </div>
</div>

    
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <script>
    $(function(){

     /*Profile Pic On change ==========================*/   
     $(document).on("change", '#fileToUpload', function(){
        $("#handleImageAjax").submit();
     });

     /*Profile Pic Submit ==========================*/
     $(document).on("submit","#handleImageAjax",function(){
            var e=this;
            var formm = new FormData($('#handleImageAjax')[0]);
            console.log(formm)
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                cache:false,
                contentType: false,
                processData: false,
                data:formm,
                dataType: 'json',
                success : function(data){
                if(data.status){
                    Swal.fire({
                      position: '',
                      icon: 'success',
                      title: data.msg,
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                      location.reload();
                    })
                    
                }
              }
            }).fail(function(response) {
             
              $(".alert").remove();
               var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) 
               {
            
                    $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
               }

            });
        return false;
      });

    });

     /*Edit Profile Update==========================*/
      $(document).on("submit","#handleUpdateAjax",function(){
            var e=this;
       
            $(this).find("[type='submit']").html("Processing..");
            $('.alert-danger').remove();
            $.post($(this).attr('action'),$(this).serialize(),function(data){
              
              $(e).find("[type='submit']").html("Update Profile");
              if(data.status){
               Swal.fire({
                      position: '',
                      icon: 'success',
                      title: data.msg,
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                      location.reload();
                    })
              }
              

            }).fail(function(response) {
             
              $(e).find("[type='submit']").html("Update Profile");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }

            });
        return false;
      });

      $(document).on("submit","#handleChangePasswordAjax",function(){
            var e=this;
       
            $(this).find("[type='submit']").html("Processing..");
            $('.alert-danger').remove();
            $.post($(this).attr('action'),$(this).serialize(),function(data){
              
              $(e).find("[type='submit']").html("Change Password");
              if(data.status){
                Swal.fire({
                      position: '',
                      icon: 'success',
                      title: data.msg,
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                      location.reload();
                    })
              }
              

            }).fail(function(response) {
             //$(this).reset()
              $(e).find("[type='submit']").html("Change Password");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }

            });
        return false;
      });

  
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcpNpTtV_czTWzF9IJzqDpAnmcMI3yUlY&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
var selected = false;
function initMap() 
{
    //var input = document.getElementById('address');
    var input = document.getElementById('address');

    var autocomplete = new google.maps.places.Autocomplete(input);
   
   // autocomplete.setComponentRestrictions({'country': ['in']});     
    autocomplete.addListener('place_changed', function() 
    {
        var place = autocomplete.getPlace();
        console.log(place);
        selected = true;
          
      // document.getElementById('lattitude').value = place.geometry.location.lat();
      // document.getElementById('longitude').value = place.geometry.location.lng();
      
            if (place) 
      {
          var city = "";
          var state = "";
          var country = "";
          var zipcode = "";
          
         var address_components = place.address_components;
          
          for (var i = 0; i < address_components.length; i++) 
          {
             if (address_components[i].types[0] === "administrative_area_level_1" && address_components[i].types[1] === "political") {
                  state = address_components[i].long_name;    
              }
              if (address_components[i].types[0] === "locality" && address_components[i].types[1] === "political" ) {                                
                  city = address_components[i].long_name;   
              }
              
              if (address_components[i].types[0] === "postal_code" && zipcode == "") {
                  zipcode = address_components[i].long_name;

              }
              
              if (address_components[i].types[0] === "country") {
                  country = address_components[i].long_name;

              }
          }
        $('#city').val(city)
        $('#state').val(state)
        $('#country').val(country)
        $('#zip').val(zipcode)
     } 
     else 
     {
         window.alert('No results found');
     }
  });
   


}
$('#address').on('focus', function() {
  selected = false;
  }).on('blur', function() {
    if (!selected) {
      $(this).val('');
    }
  });
</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/user/fav-properties.blade.php ENDPATH**/ ?>