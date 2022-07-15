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
			<h2 class="mb-3 me-auto">{{$title}}</h2>
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
			<div class="customer-search mb-sm-0 mb-3">
				
			</div>
			<div class="d-flex align-items-center flex-wrap">
				<a href="javascript::void(0)" class="btn btn-primary btn-rounded me-3 mb-2"  data-bs-toggle="modal" data-bs-target="#addAnimitiesModal"><i class="fas fa-user-friends me-2"></i>+ Add Aminities</a>
				
			</div>
		</div>
		<div class="row">
			@if( Session::has('success')) 
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
			<div class="col-xl-12">
				<div class="table-responsive">
					<table id="example3" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>Sn.</th>
								<th>Amenities</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(!blank($animities))
								@php $sn = 1; @endphp
								@foreach($animities as $row)

									<tr>
										<td class="tbl-bx">{{$sn}}</td>
										<td>{{$row->name}}</td>
										
										<td>
                                            <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updateAnimityModal{{$row->id}}"><i class="fas fa-pencil-alt"></i></a>
                                             <a href="javascript:void(0)" onclick="deleAnimities({{$row->id}})" id="delBtn{{$row->id}}" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>

                                             @if(!$is_parent)
                                               <a href="{{url('admin/view-child-aminities/'.$row->id)}}" class="btn btn-danger btn-sm">view child</i></a>
                                             @endif

                                        </td>
									</tr>


<div class="modal fade" id="updateAnimityModal{{$row->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv{{$row->id}}"></div>
            <form method="post" onsubmit="return updateAnimity(event, '{{$row->id}}')" id="updateAnimity{{$row->id}}" enctype="multipart/form-data">
            	@csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="modal-body">

                    <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text"  name="name" placeholder="Animity name.." class="form-control" value="{{$row->name}}" required>
                            </div>
                             <p id="contact_type_field_err{{$row->id}}"></p>
                        </div>
                        
                        <button class="btn btn-primary" id="upbtn{{$row->id}}" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
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



<div class="modal fade" id="addAnimitiesModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Amenities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="post" onsubmit="return addAnimities(event)" id="addAnimities" enctype="multipart/form-data">
            	@csrf
                <div class="modal-body">
                    

                	  <div class="row" id="parent">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Parent</label>
                                <select name="aminities" class="form-control aminities" required>
                                	<option value="">-----Select------</option>
                                @foreach($animities as $row)
                                	<option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Is Parent</label>
                                <input type="checkbox"  name="is_parent" id="is_parent" value="1">
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Amenities Name</label>&emsp;
                                <input type="text"  name="name" placeholder="Amenities name.." class="form-control" value="" required>
                            </div>
                             
                        </div>
                        
                        <button class="btn btn-primary" id="upbtn" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
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
    	function updateAnimity(event,  fid) {
		    event.preventDefault();
		    $('.alert-danger').remove();
		    var data = new FormData($('#updateAnimity'+fid)[0]);
		    $.ajax({
		        url: '{{url("admin/update-animities")}}',
		        data: data,
		        processData: false,
		        contentType: false,
		        type: 'POST',
		        dataType:'json',
		        beforeSend: function() {        
		            $('#upbtn'+fid).prop('disabled' , true);
		            $('#upbtn'+fid).text('Processing..');
		          },
		        success: function(result){
		            $('#upbtn'+fid).prop('disabled' , false);
		            $('#upbtn'+fid).text('Update');
		              window.location.reload();
		        },
		        error: function(err){
			        var name = err.responseJSON.errors.name; 
			        if(typeof  name!=="undefined" && name!==null){
			            $('#contact_type_field_err'+fid).html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.name[0]+'</div>');
			        }
			        $('#upbtn'+fid).prop('disabled' , false);
			     }
		    });
		    return false;
		  }



		  function addAnimities(event) {
		    event.preventDefault();
		    $('.alert-danger').remove();
		    var data = new FormData($('#addAnimities')[0]);
		    $.ajax({
		        url: '{{url("admin/add-animities")}}',
		        data: data,
		        processData: false,
		        contentType: false,
		        type: 'POST',
		        dataType:'json',
		        beforeSend: function() {        
		            $('#upbtn').prop('disabled' , true);
		            $('#upbtn').text('Processing..');
		          },
		        success: function(result){
		            $('#upbtn').prop('disabled' , false);
		            $('#upbtn').text('Update');
		              window.location.reload();
		        },
		        error: function(err){
			        var name = err.responseJSON.errors.name; 
			        if(typeof  name!=="undefined" && name!==null){
			            $('#contact_type_field_err').html('<div class="alert alert-danger" role="alert">'+err.responseJSON.errors.name[0]+'</div>');
			        }
			        $('#upbtn').prop('disabled' , false);
			     }
		    });
		    return false;
		  }


		  function deleAnimities(id) {

		  	Swal.fire({
	          title: 'Are you sure?',
	          text: "The child amenities in this category have also been removed",
	          icon: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Yes, delete it!'
	        }).then((result) => {
          if (result.isConfirmed) {
            
                $.ajax({
			        url: '{{url("admin/del-animities")}}',
			        data: { "_token": "{{ csrf_token() }}", "id": id},
			        type: 'POST',
			        dataType:'json',
			        beforeSend: function() {        
		            	$('#delBtn'+id).prop('disabled' , true);
		          	},
			        success: function(result){
			            $('#delBtn'+id).prop('disabled' , false);
			            Swal.fire(
                          'Deleted!',
                          'Your Amenities has been deleted.',
                          'success'
                        )
			              window.location.reload();
			        },
			    });
                
            }
           
          
        })
		    
		    
		    return false;
		  }
    </script>
 <script type="text/javascript">
    $(function () {
        $("#is_parent").click(function () {
        	//alert('hello');
            if ($(this).is(":checked")) {
                $("#parent").hide();
                $('.aminities').prop('required', false);
               
            } else {
                $("#parent").show();
               
            }
        });
    });
</script>