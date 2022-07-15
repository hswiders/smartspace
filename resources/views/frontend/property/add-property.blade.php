@include('frontend.includes.header')
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
    .my_list > li {
        display: inline-block;
        padding: 5px;
        margin: 5px;
    }
    .radio_style.active
    {
        background: #57aee3!important;
        color: #fff!important;
    }
    .radio_style {
        background: #e7e9eb;
        padding: 10px;
        color: #000;
        width: 100%;
    }
    .property_type_text
    {
        background: #57aee3;
        padding: 10px;
        color: #fff;
        border: 1px solid #000;
    }    
</style>
<div class="breadcrumb-area bg-overlay-2" style="background-image:url('{{ asset('') }}assets/frontend/images/breadcrumb.jpg')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title text-center">
                <h2 class="page-title">Create Property</h2>
                <ul class="page-list">
                    <li><a href="index.html">Home</a></li>
                    <li> Create Property</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="add-property-area pd-top-120 body-bg">
    <div class="container">
        @if ($user->property_count != 0)
          <div class="row" id="select_type">
               <div class="col-12 mb-3">
                    
                    <h5 class="label">Choose Property Type</h5>   
                  
                </div> 
                <div class="col-4">
                    <label class="single-radio-inner style-bg-border radio_style">
                        <span class="label">Residential Property</span>   
                        <input type="radio" name="property_type" class="radio_style_input" value="1">
                        @csrf
                    </label>
                </div> 
                <div class="col-4">
                    <label class="single-radio-inner style-bg-border radio_style">
                        <span class="label">Office</span>   
                        <input type="radio" name="property_type" class="radio_style_input" value="2">
                        
                    </label>
                </div> 
                <div class="col-4">
                    <label class="single-radio-inner style-bg-border radio_style">
                        <span class="label">Lot</span>   
                        <input type="radio" name="property_type" class="radio_style_input" value="3">
                        
                    </label>
                </div> 
                 <div class="col-12 text-right mb-4">
                        <button type="button" class="btn btn-base next" >Next</button>
                </div> 
            </div>
          <form class="" method="post" id="handleAjax" action="{{route('user.property.store')}}" name="postform" style="display:none;">
            <div class="row">
               <div class="col-3 mb-3 property_type_text">
                    <span id="property_type_text">
                        
                    </span>
                    <input type="hidden" name="property_type" id="property_type" value="">
                    <span onclick="show_sel_type()"><i class="fa fa-pencil"></i></span>
                </div> 
                <div class="col-12">
                    <label class="single-input-inner style-bg-border">
                        <span class="label">Property Title</span>   
                        <input type="text" name="property_heading">
                        @csrf
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
                            <span class="label">Property Category</span>
                            <select name="property_category" class="form-control">
                                <option value="">Choose Property Category</option>
                                @forelse ($categories as $element)
                                    <option value="{{$element->id}}">{{$element->title}}</option>
                                @empty
                                    <option value="">No categories found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Address</span>
                           <input type="text" name="address" id="address">
                           <input type="hidden" name="lat" id="lat">
                           <input type="hidden" name="lng" id="lng">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property State</span>
                            <input type="text" name="state" id="state" class="form-control">
                             
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property City</span>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Zip</span>
                           <input type="text" name="zip" id="zip">
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
                                <option value="1">1 Bedroom</option>
                                <option value="2">2 Bedroom</option>
                                <option value="3">3 Bedroom</option>
                                <option value="4">4 Bedroom</option>
                                <option value="5">5 Bedroom</option>
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bathrooms</span>
                            <select name="bathrooms" class="form-control">
                                <option value="">Choose Bathroom</option>

                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                             
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Fully Furnished ?</span>
                            <label><input type="radio" name="furnished" class="radio" value="1"> Yes </label><br>
                            <label><input type="radio" name="furnished" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Utilities included ?</span>
                            <label><input type="radio" name="utilities" class="radio" value="1"> Yes </label><br>
                            <label><input type="radio" name="utilities" class="radio" value="0"> No </label><br>
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
                            <label> <input type="radio" name="unit_type" class="radio" value="Seperate Unit"> Seperate Unit</label><br>
                            <label> <input type="radio" name="unit_type" class="radio" value="Seperate room in a unit"> Seperate room in a unit</label><br>
                        </div>
                    </div> 
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bath Type</span>
                            <label> <input type="radio" name="bath_type" class="radio" value="Private Bath"> Private Bath</label><br>
                            <label> <input type="radio" name="bath_type" class="radio" value="Shared Bath"> Shared Bath</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Entrance Type</span>
                            <label>  <input type="radio" name="entrance_type" class="radio" value="private "> private</label><br>
                            <label> <input type="radio" name="entrance_type" class="radio" value="shared entrance"> shared entrance</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Washer & Dryer</span>
                            <label> <input type="radio" name="washer_and_dryer" class="radio" value="In-unit"> In-unit</label><br>
                            <label> <input type="radio" name="washer_and_dryer" class="radio" value="On the Premises"> On the Premises</label><br>
                            <label><input type="radio" name="washer_and_dryer" class="radio" value="None"> None</label><br>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Pets Allowed ?</span>
                            <label><input type="radio" name="pets_allowed" class="radio" value="1"> Yes </label><br>
                            <label><input type="radio" name="pets_allowed" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Monthly rent </span>
                           <input type="number" step="0.1" placeholder="Eg: 2000" name="monthly_rent" >
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
                                <option value="">Choose Fee</option>
                                @forelse ($fees as $element)
                                    <option value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount </span>
                            <input type="number" name="fee_1_amount" value="0.00" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee </span>
                            <select name="fee_2" class="form-control">
                                <option value="">Choose Fee</option>
                                @forelse ($fees as $element)
                                    <option value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_2_amount" value="0.00" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee</span>
                            <select name="fee_3" class="form-control">
                                <option value="">Choose Fee</option>
                                @forelse ($fees as $element)
                                    <option value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_3_amount" value="0.00" class="form-control">
                                
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="btn btn-base hover-none">Amenities and Other Details </div>
            <div class="property-form-grid">
                <div class="row">

                    <div class="col-12">
                        <h4 class="label">Amenites</h4>
                        <ul class="my_list row">
                            @forelse ($amenities as $element)
                            <li class="single-select-inner style-bg-border">
                                <label><input type="checkbox" name="animities[]" class="checkbox parent" value="{{$element->id}}"> <b>{{ $element->name }}</b> </label>
                                <ul class="" >
                                @foreach ($element->childs as $child)
                                    <li class="single-select-inner style-bg-border">
                                        <label><input type="checkbox" name="animities[]" class="checkbox" value="{{$child->id}}"> {{ $child->name }} </label>
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                            @empty
                                <li class="alert alert-danger">No Amenities found</li>
                            @endforelse
                           
                            
                        </ul>

                    </div>
                    
                    <div class="col-12">
                        <h4 class="label">Parking Type</h4>
                        <ul class="my_list">
                            @forelse ($parking_types as $element)
                                <li class="single-select-inner style-bg-border">
                                <label><input type="checkbox" name="parking_type[]" class="checkbox" value="{{$element->id}}"> {{ $element->title }} </label>
                            </li>
                            @empty
                                <li class="alert alert-danger">No Parking type found</li>
                            @endforelse
                           
                            
                        </ul>
                    </div>
                    <div class="col-12">
                        <span class="label">Description</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea placeholder="Description" rows="5" name="description"></textarea>
                        </label>
                    </div>
            </div>
            <div class="btn btn-base hover-none">Property Photos </div>
            <div class="property-form-grid">
                <div class="row" id="uploaded_file">
                        
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
                            <input type="text" name="name" value="{{ Auth::user()->first_name.' '.Auth::user()->last_name }}" placeholder="Name">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="number" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone">
                        </label>
                    </div>
                    
                    <div class="col-12 text-center mb-4">
                        <button type="submit" class="btn btn-base">Submit Now</button>
                    </div>
                </div>
            </div>
        </form>  
        @else 
        <div class="mt-2 mb-3 text-center">
            <div class="alert alert-danger">You Property add quota is full please upgrade membership to add more</div>
            <a href="{{ route('membership') }}" class="btn btn-primary">Upgrade Now</a>
            
        </div>
        @endif
        
    </div>
</div>
    
@include('frontend.includes.footer')
{{-- Property Submit Script====================================================== --}}

  <script id="property_add_script_js">
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
              window.location = data.redirect_location;
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
  </script>

{{-- Images Upload Script====================================================== --}}

  <script id="images_upload_script_js">
  $(document).ready(function () {
    $("html").on("dragover", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });
 
    $("html").on("drop", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });
 
    $('#drop_file_area').on('dragover', function () {
      $(this).addClass('drag_over');
      return false;
    });
 
    $('#drop_file_area').on('dragleave', function () {
      $(this).removeClass('drag_over');
      return false;
    });
 
    $('#drop_file_area').on('drop', function (e) {
      e.preventDefault();
      $(this).removeClass('drag_over');
      var formData = new FormData();
      formData.append('_token', '{{ csrf_token() }}');
      var files = e.originalEvent.dataTransfer.files;
      for (var i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
      }
      uploadFormData(formData);
    });
   
    $('input[type="file"]').on('change',function(){
      
      var formData = new FormData();
      formData.append('_token', '{{ csrf_token() }}');
      var files = this.files;
      for (var i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
      }
      uploadFormData(formData);
    });
    
    function uploadFormData(form_data) {
        $(".img_err").remove();
      $.ajax({
        url: "{{ route('user.property.images.store') }}",
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
          var files = data.allFiles;
          for (var i = files.length - 1; i >= 0; i--) {
              console.log(files[i].name)
              $('#uploaded_file').append(files[i].name);
          };
          
        },
        error: function (response) {
        $.unblockUI();
        
          var erroJson = JSON.parse(response.responseText);
          
          for (var err in erroJson) {
            
            $("[name='property_images']").after("<div  class='label img_err alert-danger'>" + erroJson[err] + "</div>");
            $("[name='property_images']").focus();
          }
        
    }
      });
    }
  });
  $(document).on('click' , '.remove_img' , function() {
      id = $(this).data('id');
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
            $('#'+id).remove();
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          }
        })
      
  })
</script>

{{-- Location Map  Script====================================================== --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcpNpTtV_czTWzF9IJzqDpAnmcMI3yUlY&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript" id="location_script">
$('#address').on('focus', function() {
  selected = false;
  }).on('blur', function() {
    if (!selected) {
      $(this).val('');
      $('#lat').val('');
      $('#lng').val('');
      
      //getReverseGeocodingData()
    }
  });
function initMap() 
{
    var input = document.getElementById('address');
    //var input = document.getElementById('autocomplete');

    var autocomplete = new google.maps.places.Autocomplete(input);
   
   // autocomplete.setComponentRestrictions({'country': ['in']});     
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place);
          
      document.getElementById('lat').value = place.geometry.location.lat();
      document.getElementById('lng').value = place.geometry.location.lng();
       initialize()
    });
   


}

function getCurrentloc()
{
    if ("geolocation" in navigator){ //check geolocation available 
    //try to get user current location using getCurrentPosition() method
    navigator.geolocation.getCurrentPosition(function(position){ 
            console.log("Found your location \nLat : "+position.coords.latitude+" \nLang :"+ position.coords.longitude);
            UpdateLocation(position.coords.latitude , position.coords.longitude)
             
        });
}else{
    console.log("Browser doesn't support geolocation!");
}
navigator.permissions && navigator.permissions.query({name: 'geolocation'})
    .then(function(PermissionStatus) {
        if (PermissionStatus.state == 'granted') {
              //alert('granted');
        } else if (PermissionStatus.state == 'prompt') {
              //alert('pending');
        } else {
            
        }
    })
}
function UpdateLocation (lat , lng) 
{
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
    $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng="+lat+","+ lng+"&key=AIzaSyAcpNpTtV_czTWzF9IJzqDpAnmcMI3yUlY", function(result){
            add  = result.results[1].formatted_address
            console.log(result.results)
            var results = result.results;
            console.log(add);
            $('#address').val(add);
            //$('#location').val(add);
            if (results[0]) 
            {
                var city = "";
                var state = "";
                var country = "";
                var zipcode = "";
                
               var address_components = results[0].address_components;
                
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
              //$('#country').val(country)
              $('#zip').val(zipcode)
           } 
           else 
           {
               window.alert('No results found');
           }
        });
    initialize()
    
}

$(document).ready(function() {
    getCurrentloc();
});
</script>
<style>
        #myMap {
           height: 350px;   
           width: 100%;
        }
        </style>
        
<script type="text/javascript"> 


function initialize(){
var var_lat1 = $('#lat').val() || 22.7081955;
var var_lat2 = $('#lng').val() || 75.8824422;

var map;
var marker;
var gmarkers = [];
var myLatlng = new google.maps.LatLng(var_lat1,var_lat2);
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var mapOptions = {
zoom: 18,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
};  

map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

marker = new google.maps.Marker({
map: map,
position: myLatlng,
draggable: true 
}); 
gmarkers.push(marker);
geocoder.geocode({'latLng': myLatlng }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
   
$('#address').val(results[0].formatted_address);

var mylat = marker.getPosition().lat();
var mylng = marker.getPosition().lng();

$('#lat').val(mylat);
$('#lng').val(mylng);

//infowindow.clase(map, marker);
   var cc =results[0].formatted_address;
   infowindow.setContent(cc);
infowindow.open(map, marker);
}   
}  
});
  
google.maps.event.addListener(marker, 'dragend', function() {

geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
if (results[0]) {
  
$('#address').val(results[0].formatted_address);
$('#lat').val(marker.getPosition().lat());  

$('#lng').val(marker.getPosition().lng());

var cc =results[0].formatted_address;
       //alert("drag");
       //alert(cc);
infowindow.setContent(cc);
infowindow.open(map, marker);
}
}  
});   
});

}   
//google.maps.event.addDomListener(window, 'load', initialize);


function mapload()
{
    for(i=0; i<gmarkers.length; i++)
    {
            gmarkers[i].setMap(null);
    }
  
    var deltaLat = 1.002;
    var deltaLng = -1.003;
    var lti=parseFloat($("#lat").val()+ deltaLat);
    var lgi=parseFloat($("#lng").val()+ deltaLng);
    $('#lat').val(marker.getPosition().lat());  
    $('#lng').val(marker.getPosition().lng());
    myLatlng = new google.maps.LatLng(lti,lgi);
    
    geocoder = new google.maps.Geocoder();
    infowindow = new google.maps.InfoWindow();

    $("#lat").val(lti);
    $("#lng").val(lgi);
   
   map.setCenter({lat:lti, lng:lgi});
   marker = new google.maps.Marker({
    map: map,
    position: myLatlng,
    draggable: true 
    });
    gmarkers.push(marker);
    //alert('custfun');
    infowindow.setContent(autocomplete); 
   infowindow.open(map, marker);

    
}

</script>
<script type="text/javascript">
$('.radio_style_input').on('change' , function() {
   
    $('.radio_style').removeClass('active');
    $(this).parent('.radio_style').addClass('active');
});

// $('.parent').on('change' , function() {
   
//    if ($(this).is(':checked')) 
//    {
//       $(this).parent().siblings('.my_list_child').show()
//    }
//    else
//    {
//         $(this).parent().siblings('.my_list_child').hide();
//         $(this).parent().siblings('.my_list_child').find('input').prop('checked' , false);
//    }
// });

$('.next').on('click' , function() {
   
    type = $('.radio_style_input:checked').val();
    text = $('.radio_style_input:checked').parent('label').text();
    if (type == 1) {
        $('#handleAjax').show();
        $('#property_type_text').text(text);
        $('#property_type').val(type);
        $('#select_type').hide();
    }
    else
    {
        //alert('Under Construction ! Comming Soon')
        Swal.fire({
              icon: 'info',
              title: 'Under Construction ! Comming Soon',
              showConfirmButton: true,
            }).then((result) => {
              
            })
    }
});
function show_sel_type () {
    $('#handleAjax').hide();
    $('#select_type').show();
}
</script>