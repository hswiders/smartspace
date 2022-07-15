@include('frontend.includes.header')
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
  <div class="breadcrumb-area bg-overlay-2" style="background-image:url('{{asset('')}}assets/frontend/images/breadcrumb-2.jpg')">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title text-center">
                    <h2 class="page-title">Favorites Property</h2>
                    <ul class="page-list">
                        <li><a href="index.php">Home</a></li>
                        <li> Favorites Property</li>
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
                                <h5>{{ $properties->total() }} Properties</h5>
                            </div>
                            
                        </div>
                    </div>                  
                    <div class="row">
                        @forelse ($properties as $element)
                        @php

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
                        @endphp 
                        <div class="col-lg-4 col-md-4">
                            <div class="single-product-wrap">
                                <div class="thumb">
                                    <a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">
                                                <img src="{{ asset($element->image->image) }}" alt="img">
                                     </a> 
                                    <div class="btn-area">
                                        @if ($element->property_type == 1)
                                            <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                        @elseif($element->property_type == 2)
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                        @else
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Plot</a>
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="product-wrap-details">
                                        <div class="media">
                                            <div class="author">
                                                <img src="{{asset($element->owner->image)}}" alt="img" width="50px" height="50px">                                    
                                            </div>
                                            <div class="media-body">
                                                <h6><a href="#">{{ $element->owner->first_name }}</a></h6>
                                                <p><img src="{{asset('/assets/frontend/images/location.png')}}" alt="img"> {{$element->address}} </p>
                                            </div>
                                            <a class="fav-btn float-right" href="javascript:;" onclick="addToFav({{$element->id}})"><i class="{{$icon_class}} fa-heart property_heart_{{$element->id}}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-details-inner">
                                            <h4><a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">{{$element->property_heading}}</a></h4>
                                            <ul class="meta-inner">
                                                <li><img src="{{ asset('') }}assets/frontend/images/location2.png" alt="img">{{$element->city.' , '.$element->state }}</li>
                                                
                                            </ul>
                                            <p>{{ mb_strimwidth($element->description, 0, 97, '...') }}</p>
                                        </div>
                                        <div class="product-meta-bottom">
                                            <span class="price">${{$element->monthly_rent }}</span>
                                            <span>{{$element->created_at->diffForHumans()}}</span>
                                        </div> 
                                

                            </div>
                        </div>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-danger">No properties found</div>
                            </div>
                        @endforelse
                        
                      
                    </div>
                    <div class="pagination-area text-center mt-4">
                        {{-- <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="la la-angle-double-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="la la-angle-double-right"></i></a></li>
                        </ul> --}}
                        <div id="pagination">
                          {{ $properties->links('pagination.ajax_pagination') }}
                        </div>
                    </div>
    </div>
</div>

    
    
@include('frontend.includes.footer')
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
</script>