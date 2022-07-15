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
			<h2 class="mb-3 me-auto">fees List</h2>
			<!-- <div>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
					<li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
				</ol>
			</div> -->
		</div>	
		<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
			<!-- <div class="customer-search mb-sm-0 mb-3">
				<div class="input-group search-area">
					<input type="text" class="form-control" placeholder="Search here......">
					<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
				</div>
			</div>
			<div class="d-flex align-items-center flex-wrap">
				<a href="{{url('admin/add-property')}}" class="btn btn-primary btn-rounded me-3 mb-2"><i class="fas fa-user-friends me-2"></i>+ Add New Property</a>
				<a href="javascript:void(0);" class="btn bg-white btn-rounded me-2 mb-2 text-black shadow-sm"><i class="fas fa-calendar-times me-3 scale3 text-primary"></i>Filter<i class="fas fa-chevron-down ms-3 text-primary"></i></a>
				<a href="javascript:void(0);" class="btn btn-secondary btn-rounded mb-2"><i class="fas fa-sync"></i></a>
			</div> -->
			<div class="d-flex align-items-center flex-wrap">
				<a href="javascript::void(0)" class="btn btn-primary btn-rounded me-3 mb-2"  data-bs-toggle="modal" data-bs-target="#addFeesModal"><i class="fas fa-user-friends me-2"></i>+ Add Fees</a>
			</div>
		</div>
		<div class="row">
			@if( Session::has('error')) 
                <div class="alert alert-danger alert-dismissible">
                  <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Danger</strong> {{ Session::get('error') }}
                </div>
            
            @endif

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
								<th>Fees Name</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
							@if(!blank($fees))
							@php $sn = 1; @endphp
								@foreach($fees as $row)
									<tr>
										<td>{{$sn}}</td>
										<td>{{$row->name}}</td>
										
									<td>
										<a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updatefeesModal{{$row->id}}"><i class="fas fa-pencil-alt"></i></a>
										<a href="{{url('admin/delete-fees?id='.$row->id)}}" onclick="return confirm('are you sure?')" class="btn btn-danger shadow btn-xs"><i class="fas fa-trash"></i></a>
										<!-- <a href="{{url('admin/view-property?id='.$row->id)}}" class="btn btn-info shadow btn-xs">View</a> -->
										
									</td>
									</tr>

	<div class="modal fade" id="updatefeesModal{{$row->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Fees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv{{$row->id}}"></div>
            <form method="post" action="{{url('admin/fees-edit')}}" enctype="multipart/form-data">
            	@csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Fees Name</label>
                                <input type="text"  name="name" placeholder="Fees name.." class="form-control" value="{{$row->name}}" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="upbtn{{$row->id}}" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

<div class="modal fade" id="addFeesModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Fees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv{{$row->id}}"></div>
            <form method="post" action="{{url('admin/fees-add')}}" enctype="multipart/form-data">
            	@csrf
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Fees Name</label>
                                <input type="text"  name="name" placeholder="Fees name.." class="form-control" value="" required>
                             	<p id="title_err"></p>
                            </div>
                            
                        </div>
                        
                        <button class="btn btn-primary" id="upbtn" type="submit">Add</button>
                </div>
            </form>
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
		            	$('#delBtn'+id).prop('disabled' , true);
		          	},
			        success: function(result){

			            $('#delBtn'+id).prop('disabled' , false);
			              window.location.reload();
			        },
			    });
		    }
		    return false;
		  }
    </script>