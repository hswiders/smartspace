<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
    
@-webkit-keyframes loader-fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes  loader-fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@-webkit-keyframes loader-fadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
@keyframes  loader-fadeOut {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
@-webkit-keyframes loader-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes  loader-rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.loader, [data-loading]:after {
  width: 24px;
  height: 24px;
  border: 3px solid #c6dff9;
  border-top-color: #0080ff;
  border-radius: 50%;
  will-change: transform, opacity;
  -webkit-animation: loader-fadeIn 0.2s linear, loader-rotate 0.7s infinite linear;
          animation: loader-fadeIn 0.2s linear, loader-rotate 0.7s infinite linear;
}

[data-loading]:before {
  content: attr(data-loading-message);
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 90;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-bottom: 128px;
  font-size: 24px;
  line-height: 32px;
  text-align: center;
  color: #444;
  background: rgba(255, 255, 255, 0.75);
  will-change: opacity;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
  -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
  -webkit-animation-duration: 0.2s;
          animation-duration: 0.2s;
}
[data-loading]:after {
  content: "";
  position: fixed;
  top: 50%;
  left: 50%;
  z-index: 100;
  width: 56px;
  height: 56px;
  margin-top: -28px;
  margin-left: -28px;
  border: 5px solid #c6dff9;
  border-top-color: #0080ff;
}

[data-loading=true]:before {
  pointer-events: auto;
  -webkit-animation-name: loader-fadeIn;
          animation-name: loader-fadeIn;
}

[data-loading=false]:before {
  pointer-events: none;
  -webkit-animation-name: loader-fadeOut;
          animation-name: loader-fadeOut;
}

[data-loading=false]:after {
  content: initial;
}

</style>
<div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset('')); ?>assets/frontend/images/breadcrumb-2.jpg')">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title text-center">

                    <h2 class="page-title"><?php echo e(($sel_category) ? $sel_category->title : 'Explore Property'); ?></h2>
                    <ul class="page-list">
                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li> Property</li>
                         <?php echo ($sel_category) ? '<li>'.$sel_category->title.'</li>' : ''; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="blog-page-area pd-top-120 pd-bottom-120 body-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-12 filter_data" id="pagination_data">
                    
                </div>
                <div class="col-lg-4 order-lg-1">
                    <aside class="sidebar-area">
                        <div class="widget-search mb-4">
                            <div class="single-search-inner">
                                <input type="text" id="keyword" placeholder="Search your keyword" value="<?php echo e(request()->get('keyword','')); ?>">
                                <button onclick="filter_data(1)"><i class="la la-search"></i></button>
                            </div>
                        </div>

                        <div class="widget widget-place widget-filter">
                            <h5 class="widget-title">Find your house</h5>
                            
                            <div class="single-input-inner style-bg-border">
                                <span class="current"><i class="fa-solid fa-location-dot"></i> Location</span>
                                <input type="text" name="address" id="address">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                                <input type="hidden" name="category" id="category" value="<?php echo e(($sel_category) ? $sel_category->id : ''); ?>">
                            </div>
                            

                            <div class="single-select-inner mt-3">
                                <span class="current"><i class="fa-solid fa-house-chimney"></i> Property Type</span>
                                <select class="form-control common_selector" id="property_type">
                                    <option value="">Choose Property Type</option>
                                    <option <?php echo e((request()->has('property_type')) ? ((request()->get('property_type') == 1) ? 'selected' : '' ) : ''); ?> value="1">Residential</option>
                                    <option <?php echo e((request()->has('property_type')) ? ((request()->get('property_type') == 2) ? 'selected' : '' ) : ''); ?> value="2">Office</option>
                                    <option <?php echo e((request()->has('property_type')) ? ((request()->get('property_type') == 3) ? 'selected' : '' ) : ''); ?> value="3">Plots</option>
                                </select>
                                
                            </div>

                            

                            <div class="single-select-inner mt-3">
                                <span class="current"><i class="fa-solid fa-bed"></i> Bedrooms</span>
                                <select class="form-control common_selector" id="bedrooms">
                                    <option value=""> <i class="fa-solid fa-bed"></i>Choose Bedrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                   
                                </select>
                                
                            </div>
                            
                            <div class="single-select-inner mt-3">
                                <span class="current"><i class="fa-solid fa-toilet-paper"></i> Bathrooms</span>
                                <select class="form-control common_selector" id="bathrooms">
                                    <option value=""><i class="fa-solid fa-toilet-paper"></i>Choose Bathrooms</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                   
                                </select>
                                
                            </div>

                            

                            <div class="single-select-inner mt-3">
                                <h5>Amenities</h5>

                                <div class="amenities-col" style="column-count: 2;">
                                    <?php $__empty_1 = true; $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="form-check">
                                        <input class="form-check-input amenities common_selector" type="checkbox"  id="amenities_<?php echo e($element->id); ?>" value="<?php echo e($element->id); ?>">
                                        <label class="form-check-label" for="amenities_<?php echo e($element->id); ?>"><?php echo e($element->name); ?></label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="alert alert-danger"> No Amenities found</div>
                                    <?php endif; ?>
                                    

                                    
                                </div>
                            </div>

                           

                        </div>

                        <div class="widget widget-place">
                            <h5 class="widget-title">Categories</h5>
                            <ul class="search_categories">
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="<?php echo e(($sel_category) ? (($sel_category->id == $element->id) ? 'active' : '' ) : ''); ?>"><a href="<?php echo e(route('search.category' , ['slug' => Str::slug($element->title) , 'id' => $element->id])); ?>"><?php echo e($element->title); ?> </a></li>
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
<script>
    $(function() {
      $(document).on("click", "#pagination a,#search_btn", function() {

        //get url and make final url for ajax 
        console.log($(this));
        var page = $(this).data("page");
        if (page) {
            filter_data(page)
        }
        

    });
    });
  

    filter_data(1);

    function filter_data(page)
    {
        var sort_by = $('#pagination_data').find('#sort_by').val();
        $('.filter_data').html('<div class="loading" style="" ></div>');
        $('body').attr('data-loading' , true);
        var category = $('#category').val();
        var property_type = $('#property_type').val();
        var amenities = get_filter('amenities');
        var keyword = $('#keyword').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
        var property_type = $('#property_type').val();
        var bathrooms = $('#bathrooms').val();
        var bedrooms = $('#bedrooms').val();
        
        console.log(sort_by)
        $.ajax({
            url:"<?php echo e(route('do-search')); ?>?page="+page,
            method:"POST",
            //dataType:"JSON",
            data:{'_token':'<?php echo e(csrf_token()); ?>' , keyword:keyword , category:category , amenities:amenities, property_type:property_type, lat:lat, lng:lng, bedrooms:bedrooms, bathrooms:bathrooms, sort_by:sort_by},
            success:function(data)
            {
                $('body').attr('data-loading' , false);
                $('.filter_data').html(data);
                
            }
        })
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $(document).on('change','.common_selector' , function(){
        filter_data(1);
    });
    
    $(document).on('keyup', '.price_range', function(event){
       filter_data(1);
       });

     $(document).on('keyup', '.search_product', function(event){
       filter_data(1);
       });

 
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcpNpTtV_czTWzF9IJzqDpAnmcMI3yUlY&libraries=places&callback=initMap" async defer></script>


<script>
 getLocation(); 


var x = document.getElementById("address");


function getLocation() {
  if (navigator.geolocation) {
    console.log(navigator.geolocation);
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.value = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    console.log(position);
    document.getElementById('lat').value = position.coords.latitude;
    document.getElementById('lng').value = position.coords.longitude;
    getReverseGeocodingData();
}

 
function getReverseGeocodingData() 
{
     lat = $('#lat').val();
     lng = $('#lng').val();
    var latlng = new google.maps.LatLng(lat, lng);
    // This is making the Geocode request
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng },  (results, status) =>{
        if (status !== google.maps.GeocoderStatus.OK) {
            
        }
        // This is checking to see if the Geoeode Status is OK before proceeding
        if (status == google.maps.GeocoderStatus.OK) {
            console.log(results[0]);
            console.log(results[0].formatted_address);
            var address = (results[0].formatted_address);
           // $("#demo").html(results[0].formatted_address);
            var  value=address.split(",");
            count=value.length;
            country=value[count-1];
            state=value[count-2];
            city=value[count-3];
          //  x.innerHTML = "city name is: " + city;
            console.log(city+', '+state+', '+country);
            //console.log(address);
            add = city+', '+state+', '+country;
            $("#address").val(add);
            

        }
    });
}

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
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();
        filter_data(1);
        //getReverseGeocodingData()
  });
   


}
$('#address').on('focus', function() {
  selected = false;
  }).on('blur', function() {
    if (!selected) {
      $(this).val('');
      $('#lat').val('');
      $('#lng').val('');
      setTimeout(function () {
          $('#address').trigger('change')
      }, 500)
      
      //getReverseGeocodingData()
    }
  });
  $('#address').on('change', function() {
  if ($(this).val() == '') 
    {
        $('#lat').val('');
      $('#lng').val('') ;
      filter_data(1);
    }
  });
</script><?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/search-property.blade.php ENDPATH**/ ?>