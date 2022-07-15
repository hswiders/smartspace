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
    <div class="container-fluid">
		
       
		
		<div class="row page-titles" id="msgdivcont" style="display:none">
			
        </div>
        <!-- row -->
       
        <div class="row">
            @if( Session::has('success')) 
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif

            @if( Session::has('error')) 
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
            @endif 

            @error('old_password')
                <div class="alert alert-danger" role="alert">
                {{ $message }}
                </div>
            @enderror
            @error('password')
                <div class="alert alert-danger" role="alert">
                {{ $message }}
                </div>
            @enderror
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <div class="tab-content">
                                    <div id="my-posts" class="tab-pane fade active show">
                                        <div class="settings-form">
                                                <h4 class="text-primary">Update RV Rental</h4>
                                                <form method="post" onsubmit="return update_rv_rental(event)" id="update_rv_rental">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12" >
                                                            <label class="form-label">Name</label>
                                                            <input type="text" name="name" placeholder="Type name" value="{{$rv_rental->title}}" class="form-control" required readonly>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                            <label class="form-label">Link</label>
                                                            <input type="url" name="menu_link" placeholder="Enter Link" class="form-control" required value="{{$rv_rental->menu_link}}">
                                                        </div>
                                                    </div>
                                                    <button id="sub_btn" class="btn btn-primary" type="submit">Update</button>
                                                </form>
                                            </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                    </div>
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

 function update_rv_rental(event) {
    event.preventDefault();
    $('.alert-danger').remove();
    $.ajax({
      url: '{{url("admin/update-rv-rental")}}',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#update_rv_rental')[0]),
      dataType: 'json',
      beforeSend: function() {
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
          window.location.reload();
      }
    });
}

</script>