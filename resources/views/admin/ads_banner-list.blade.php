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
            <h2 class="mb-3 me-auto">Ads banner List</h2>
        </div>  
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div class="customer-search mb-sm-0 mb-3">
                
            </div>
            <div class="d-flex align-items-center flex-wrap">
                <a href="javascript::void(0)" class="btn btn-primary btn-rounded me-3 mb-2"  data-bs-toggle="modal" data-bs-target="#addAds_bannerModal"><i class="fas fa-user-friends me-2"></i>+ Add Ads banner</a>
                
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
                                <th>Banner Img</th>
                                <th>Banner Type</th>
                                <th>Pages</th>
                                <th>Banner Action</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!blank($Ads_banner))
                                @php $sn = 1; @endphp
                                @foreach($Ads_banner as $row)
                                 @php $pageArray = explode(',', $row->pages); @endphp
                                    <tr>
                                        <td class="tbl-bx">{{$sn}}</td>
                                        <td><img src="{{asset($row->banner_img)}}" class="img-fluid" width="100" height="200"></td>
                                        <td>{{ $row->banner_type }}</td>
                                        <td>{{ $row->pages }}</td>
                                        <td>{{ $row->banner_action }}</td>
                                        
                                        <td>
                                            <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updateAds_bannerModal{{$row->id}}"><i class="fas fa-pencil-alt"></i></a>
                                             <a href="javascript:void(0)" onclick="delAds_banner({{$row->id}})" id="delBtn{{$row->id}}" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>


<div class="modal fade" id="updateAds_bannerModal{{$row->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Ads_banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv{{$row->id}}" name="message"></div>
            <form method="post" onsubmit="return updateAds_banner(event, '{{$row->id}}' , this)" id="updateAds_banner{{$row->id}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$row->id}}">
                <div class="modal-body">
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner Image</label>
                                <input type="file"  name="banner_img" class="form-control" value="">
                                <br>
                                <img src="{{asset($row->banner_img)}}" class="img-fluid" width="300" height="200">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner type</label>
                               <select class="form-control" name="banner_type">
                                   <option {{($row->banner_type == 'horizontal') ? 'selected' : ''}} value="horizontal">horizontal</option>
                                   <option {{($row->banner_type == 'vertical') ? 'selected' : ''}} value="vertical">vertical</option>
                               </select>
                            </div>
                            
                            
                            <div class="mb-3 col-md-12">
                               <h4>Pages</h4>
                               <div name="pages"></div>
                               <div class="checkboxes">
                 
                                   <label><input type="checkbox" name="pages[]" {{(in_array('contact' , $pageArray)) ? 'checked' : ''}} value="contact">Contact</label>
                                   <label><input type="checkbox" name="pages[]" {{(in_array('terms-and-conditions' , $pageArray)) ? 'checked' : ''}} value="terms-and-conditions">Terms</label>
                                   <label><input type="checkbox" name="pages[]" {{(in_array('privacy-policy' , $pageArray)) ? 'checked' : ''}} value="privacy-policy">Privacy Policy</label>
                                   <label><input type="checkbox" name="pages[]" {{(in_array('about' , $pageArray)) ? 'checked' : ''}} value="about">About</label>
                               </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner Action Url</label>
                                <input type="url"  name="banner_action" class="form-control" value="{{ $row->banner_action }}">
                               
                            </div>
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



<div class="modal fade" id="addAds_bannerModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ads_banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div id="msgdiv" name="message"></div>
            <form method="post" onsubmit="return addAds_banner(event , this)" id="addAds_banner" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner Image</label>
                                <input type="file"  name="banner_img" class="form-control" value="">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner type</label>
                               <select class="form-control" name="banner_type">
                                   <option value="horizontal">horizontal</option>
                                   <option value="vertical">vertical</option>
                               </select>
                            </div>
                            <div class="mb-3 col-md-12">
                               <h4>Pages</h4>
                               <div name="pages"></div>
                               <div class="checkboxes">
                 
                                   <label class="p-3"><input type="checkbox" name="pages[]" value="contact">Contact</label>
                                   <label class="p-3"><input type="checkbox" name="pages[]" value="terms-and-conditions">Terms</label>
                                   <label class="p-3"><input type="checkbox" name="pages[]" value="privacy-policy">Privacy Policy</label>
                                   <label class="p-3"><input type="checkbox" name="pages[]" value="about">About</label>
                               </div>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Banner Action Url</label>
                                <input type="url"  name="banner_action" class="form-control" >
                               
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
        function updateAds_banner(event,  fid , e) {
            event.preventDefault();
            $('.alert-danger').remove();
            var data = new FormData($(e)[0]);
            $.ajax({
                url: '{{url("admin/update-ads_banner")}}',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                beforeSend: function() {        
                    $(e).find("button").html("Processing");
                    $(e).find("button").prop('disabled' , false);
                    
                  },
                success: function(result){
                    $(e).find("button").html("Update");
                     $(e).find("button").prop('disabled' , false);
                    if(result.status==1){
                        window.location.reload();
                    }
                },
                error: function(response){
                     $(e).find("button").html("Update");
                     $(e).find("button").prop('disabled' , false);
                      $(".alert").remove();
                      var erroJson = JSON.parse(response.responseText);
                      
                      for (var err in erroJson) {
                        
                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
                      }
                 }
            });
            return false;
          }



          function addAds_banner(event , e) {
            event.preventDefault();
            $('.alert-danger').remove();
            var data = new FormData($('#addAds_banner')[0]);
            $.ajax({
                url: '{{url("admin/add-ads_banner")}}',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                beforeSend: function() {        
                    $(e).find("[type='submit']").prop('disabled' , true);
                    $(e).find("[type='submit']").text('Processing..');
                  },
                success: function(result){
                    $(e).find("[type='submit']").prop('disabled' , false);
                    $(e).find("[type='submit']").text('Add');
                      window.location.reload();
                },
                error: function(response){
                     $(e).find("[type='submit']").html("Add");
                     $(e).find("[type='submit']").prop('disabled' , false);
                      $(".alert").remove();
                      var erroJson = JSON.parse(response.responseText);
                      
                      for (var err in erroJson) {
                        
                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
                      }
                 }
            })
            return false;
          }


          function delAds_banner(id) {
            if(confirm('Are you soure want to delete?')){
                $.ajax({
                    url: '{{url("admin/del-ads_banner")}}',
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