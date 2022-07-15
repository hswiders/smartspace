


		
		
        <!--**********************************
            Header start
        ***********************************-->
        @include('admin.includes.header')

<!--********************************Header end ti-comment-alt********************************-->
<style type="text/css">
    .discript{width: 250px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
</style>
<!--**********************************
Sidebar start
***********************************-->
        @include('admin.includes.sidebar')

        	
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
    			        <form class="" method="post" id="handleAjax" action="{{route('user.property.store')}}" name="postform">
            <div class="row">
               <div class="col-12">
                    <label class="single-input-inner style-bg-border">
                        <span class="label">Property Title</span>   
                        <input type="text" name="property_heading" value="{{ $property->property_heading }}" >
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
                            <span class="label">Property Type</span>
                            <select name="property_type" class="form-control">
                                <option value="">Choose Property Type</option>
                                @forelse ($categories as $element)
                                    <option {{ ($property->property_type == $element->id) ? 'selected' : '' }} value="{{$element->id}}">{{$element->title}}</option>
                                @empty
                                    <option value="">No categories found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Address</span>
                           <input type="text" name="address" value="{{ $property->address }}" id="address">
                           <input type="hidden" name="lat" value="{{ $property->lat }}" id="lat">
                           <input type="hidden" name="lng" value="{{ $property->lng }}" id="lng">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property State</span>
                            <input type="text" name="state" value="{{ $property->state }}" id="state" class="form-control">
                             
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property City</span>
                            <input type="text" name="city" value="{{ $property->city }}" id="city" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Property Zip</span>
                           <input type="text" name="zip" value="{{ $property->zip }}" id="zip">
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
                                <option {{ ($property->berooms == 1) ? 'selected' : '' }} value="1">1 Bedroom</option>
                                <option {{ ($property->berooms == 2) ? 'selected' : '' }} value="2">2 Bedroom</option>
                                <option {{ ($property->berooms == 3) ? 'selected' : '' }} value="3">3 Bedroom</option>
                                <option {{ ($property->berooms == 4) ? 'selected' : '' }} value="4">4 Bedroom</option>
                                <option {{ ($property->berooms == 5) ? 'selected' : '' }} value="5">5 Bedroom</option>
                                <option {{ ($property->berooms == 6) ? 'selected' : '' }} value="6">6 Bedroom</option>
                                <option {{ ($property->berooms == 7) ? 'selected' : '' }} value="7">7 Bedroom</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bathrooms</span>
                            <select name="bathrooms" class="form-control">
                                <option value="">Choose Bathroom</option>

                                <option{{ ($property->bathrooms == 1) ? 'selected' : '' }} value="1">1</option>
                                <option{{ ($property->bathrooms == 2) ? 'selected' : '' }} value="2">2</option>
                                <option{{ ($property->bathrooms == 3) ? 'selected' : '' }} value="3">3</option>
                                <option{{ ($property->bathrooms == 4) ? 'selected' : '' }} value="4">3</option>
                                <option{{ ($property->bathrooms == 5) ? 'selected' : '' }} value="5">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Fully Furnished ?</span>
                            <label><input {{ ($property->furnished == 1) ? ' checked' : '' }} type="radio" name="furnished" class="radio" value="1"> Yes </label><br>
                            <label><input {{ ($property->furnished == 0) ? ' checked' : '' }} type="radio" name="furnished" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Utilities included ?</span>
                            <label><input{{ ($property->utilities == 1) ? ' checked' : '' }} type="radio" name="utilities" class="radio" value="1"> Yes </label><br>
                            <label><input{{ ($property->utilities == 0) ? ' checked' : '' }} type="radio" name="utilities" class="radio" value="0"> No </label><br>
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
                            <label> <input {{ ($property->unit_type == 'Seperate Unit') ? ' checked' : '' }} type="radio" name="unit_type" class="radio" value="Seperate Unit"> Seperate Unit</label><br>
                            <label> <input {{ ($property->unit_type == 'Seperate room in a unit') ? ' checked' : '' }} type="radio" name="unit_type" class="radio" value="Seperate room in a unit"> Seperate room in a unit</label><br>
                        </div>
                    </div> 
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Bath Type</span>
                            <label> <input {{ ($property->bath_type == 'Private Bath') ? ' checked' : '' }} type="radio" name="bath_type" class="radio" value="Private Bath"> Private Bath</label><br>
                            <label> <input {{ ($property->bath_type == 'Shared Bath') ? ' checked' : '' }} type="radio" name="bath_type" class="radio" value="Shared Bath"> Shared Bath</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Entrance Type</span>
                            <label>  <input {{ ($property->entrance_type == 'private entrance') ? ' checked' : '' }} type="radio" name="entrance_type" class="radio" value="private entrance"> private</label><br>
                            <label> <input {{ ($property->entrance_type == 'shared entrance') ? ' checked' : '' }} type="radio" name="entrance_type" class="radio" value="shared entrance"> shared entrance</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Washer & Dryer</span>
                            <label> <input {{ ($property->washer_and_dryer == 'In-unit') ? ' checked' : '' }} type="radio" name="washer_and_dryer" class="radio" value="In-unit"> In-unit</label><br>
                            <label> <input {{ ($property->washer_and_dryer == 'On the Premises') ? ' checked' : '' }} type="radio" name="washer_and_dryer" class="radio" value="On the Premises"> On the Premises</label><br>
                            <label><input type="radio" {{ ($property->washer_and_dryer == 'None') ? ' checked' : '' }} name="washer_and_dryer" class="radio" value="None"> None</label><br>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-4">
                        <div class="single-select-inner style-bg-border">
                            <span class="label">Pets Allowed ?</span>
                            <label><input {{ ($property->pets_allowed == 1) ? ' checked' : '' }} type="radio" name="pets_allowed" class="radio" value="1"> Yes </label><br>
                            <label><input {{ ($property->pets_allowed == 0) ? ' checked' : '' }} type="radio" name="pets_allowed" class="radio" value="0"> No </label><br>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="single-input-inner style-bg-border">
                            <span class="label">Monthly rent </span>
                           <input type="number" step="0.1" placeholder="Eg: 2000" name="monthly_rent" value="{{ $property->monthly_rent }}" >
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
                                @forelse ($fees as $element)
                                    <option {{ ($property->fee_1 == $element->id) ? 'selected' : '' }} value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount </span>
                            <input type="number"  name="fee_1_amount" value="{{ $property->fee_1_amount }}" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee </span>
                            <select name="fee_2" class="form-control">
                                <option value="">Choose Property Type</option>
                                @forelse ($fees as $element)
                                    <option {{ ($property->fee_2 == $element->id) ? 'selected' : '' }} value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_2_amount" value="{{ $property->fee_2_amount }}" class="form-control">
                                
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-select-inner style-bg-border">
                            <span class="label">Fee</span>
                            <select name="fee_3" class="form-control">
                                <option value="">Choose Property Type</option>
                                @forelse ($fees as $element)
                                    <option {{ ($property->fee_3 == $element->id) ? 'selected' : '' }} value="{{$element->id}}">{{$element->name}}</option>
                                @empty
                                    <option value="">No fees found</option>
                                @endforelse
                                
                               
                            </select>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <span class="label">Fee Amount</span>
                            <input type="number" name="fee_3_amount" value="{{ $property->fee_3_amount }}" class="form-control">
                                
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="btn btn-base hover-none">Amenities </div>
            <div class="property-form-grid">
                <div class="row">

                    <div class="col-12">
                        <ul>
                            @forelse ($amenities as $element)
                                <li class="single-select-inner style-bg-border">
                                    @php
                                        $aminities = explode(',', $property->animities)
                                    @endphp
                                <label><input {{ (in_array($element->id, $aminities)) ? ' checked' : '' }} type="checkbox" name="animities[]" class="checkbox" value="{{$element->id}}"> {{ $element->name }} </label>
                            </li>
                            @empty
                                <li class="alert alert-danger">No Amenities found</li>
                            @endforelse
                           
                            
                        </ul>
                    </div>
                    <div class="col-12">
                        <span class="label">Describe public Transportation</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea  name="public_transport" rows="3" placeholder="Describe public Transportation">{{$property->public_transport}}</textarea>
                        </label>
                    </div>
                    <div class="col-12">
                        <span class="label">Describe Parking type</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea  name="parking_type" rows="3" placeholder="Eg: Garage , approved , carpote , underground , assigned place">{{$property->parking_type}}</textarea>
                        </label>
                    </div>
                    <div class="col-12">
                        <span class="label">Description</span>
                        <label class="single-input-inner style-bg-border">
                            <textarea placeholder="Description" rows="5" name="description">{{$property->description}}</textarea>
                        </label>
                    </div>
            </div>
            <div class="btn btn-base hover-none">Property Photos </div>
            <div class="property-form-grid">
                <div class="row" id="uploaded_file">
                     @forelse ($property_images as  $element)
                            <div class="col-md-3" id="img_{{$element->id}}">
                                <span class="remove_img" data-id="img_{{$element->id}}" data-type="1">X</span>
                                <img src="{{ asset($element->image) }}" class="w-100" >

                            </div>
                    @empty
                        {{-- empty expr --}}
                    @endforelse   
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
                            <input type="text" name="name" value="{{ $property->name }}" placeholder="Name">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="email" name="email" value="{{ $property->email }}" placeholder="Email">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="number" name="phone" value="{{ $property->phone }}" placeholder="Phone">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="single-input-inner style-bg-border">
                            <input type="text" name="website" value="{{ $property->website }}" placeholder="Website">
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
        @include('admin.includes.footer')
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