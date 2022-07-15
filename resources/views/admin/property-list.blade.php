<!--**********************************
    Header start
***********************************-->
@include('admin.includes.header')

<!--**********************************
    Header end ti-comment-alt
***********************************-->

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
    <!-- row -->
	<div class="container-fluid">
		<div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
			<h2 class="mb-3 me-auto">Property List</h2>
			<!-- <div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
				</ol>
			</div> -->
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
		</div>
		<div class="row">
			@if( Session::has('success')) 
                <div class="alert alert-success alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            
            @endif
            @if( Session::has('failed')) 
                <div class="alert alert-danger alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ Session::get('failed') }}
                </div>
            
            @endif
			<div class="col-xl-12">
				<div class="table-responsive">
					<table id="example3" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Is Featured</th>
								<th>Image</th>
								<th>Owner Name</th>
								<th>Title</th>
								<th>Location</th>
								<th>Property Details</th>
								<!-- <th>Animities</th> -->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(!blank($property))
							@php $sn = 1; @endphp
								@foreach($property as $row)
									<tr>
										<td>{{$sn}}</td>
										<td class="tbl-bx">
											<div class="form-check ms-2" onclick="makeFeatured({{$row->id}})">
											  <input {{($row->is_featured ) ? 'checked' : ''}} class="form-check-input" type="checkbox" value="" id="customCheckBox1" >
											  <label class="form-check-label" for="customCheckBox1">
											  </label>
											</div>


										</td>
										@php 
                                          $image = DB::table('property_images')->where('property_id', $row->id)->take(1)->first();
                                         @endphp
                                         @if($image)
										<td><img src="{{ asset($image->image)}}" width="50"></td>
										@else
											<td>Null</td>
										@endif
										 @php 
                                          $username = DB::table('users')->where('id', $row->user_id)->take(1)->first();
                                         @endphp
										<td>{{$username->first_name}} {{$username->last_name}}</td>
										
										<td>{{$row->property_heading}}</td>
										<td>
											<p><b>Address</b> :{{ $row->address }}</p> 
				                            <p><b>State</b> :{{ $row->state }}</p>
				                            <p><b>City</b> :{{ $row->city }}</p>
				                            <p><b>Zip</b> :{{ $row->zip }}</p>

										</td>
										<td>
											 <p><b>Is Furnished</b> :{{ ($row->furnished) ? 'Yes' : 'No' }}</p>
                                            <p><b>Utilities Included</b> :{{ ($row->utilities) ? 'Yes' : 'No' }}</p>
                                           <p><b>Bedrooms </b>:{{ $row->bedrooms }}</p>
                                            <p><b>Bathrooms </b>:{{ $row->bathrooms }}</p> 
										</td>
								

										
										<!-- <td>
											@foreach(explode(',', $row->animities) as $animi)
												@php
											 		$animities = DB::table('animities')->where('id', $animi)->take(1)->first();
											 	@endphp
											 	@if(!empty($animities->name))
												 	{{$animities->name }},
												 @endif 
											@endforeach
											
										</td> -->
									<td>
										<!-- <a href="{{url('admin/edit-property?id='.$row->id)}}" class="btn btn-primary shadow btn-xs"><i class="fas fa-pencil-alt"></i></a> -->
										<a href="{{url('admin/delete-property?id='.$row->id)}}" onclick="return confirm('are you sure?')" class="btn btn-danger shadow btn-xs"><i class="fas fa-trash"></i></a>
										<a href="{{url('admin/view-property?id='.$row->id)}}" class="btn btn-info shadow btn-xs">View</a>

							@if ($row->status == 1)
                                <button onclick="changeStatus({{ $row->id }} , 0)" class="btn btn-sm btn-danger">Disable</button>
                            @else
                                <button onclick="changeStatus({{ $row->id }} , 1)" class="btn btn-sm btn-success">Enable</button>
                            @endif
										
									</td>
									</tr>
									 @php $sn++; @endphp
								@endforeach
							@endif

							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->


	  <!--**********************************
        Footer start
    ***********************************-->
        @include('admin.includes.footer')

    <!--**********************************
        Footer end
    ***********************************-->
    <script type="text/javascript">
    	// function makeFeatured(rowId){

    	// }

    	function makeFeatured(id) {
		    if(confirm('Are you soure want to update featured property?')){
			    $.ajax({
			        url: '{{url("admin/make-featured")}}',
			        data: { "_token": "{{ csrf_token() }}", "id": id},
			        type: 'POST',
			        dataType:'json',
			        beforeSend: function() {        
		            	
		          	},
			        success: function(result){
			        	msg = "Property Marked as featured successfully";
			        	if (result.status == 0) {
			        		msg = "Property Removed from featured successfully";
			        	};
			            Swal.fire(
		                  'Changed!',
		                  msg,
		                  'success'
		                )
			        },
			    });
		    }
		    return false;
		  }

function changeStatus (id , status) 
    {
    	//alert('hello');
        form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        
        form_data.append('id', id);
        form_data.append('status', status);
        $.ajax({
            url: "{{ url('admin/block_unblock') }}",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
               /* $.blockUI();*/
            },
            success: function (data) {
               /*$.unblockUI();*/
                Swal.fire(
                  'Changed!',
                  'Your Property Status has been Changed.',
                  'success'
                ).then(function() {
                    location.reload();
                })
                //alert('hello');
                
            }
            
          });
    }
  
 </script>