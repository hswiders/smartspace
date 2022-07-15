


		
		
        <!--**********************************
            Header start
        ***********************************-->
        <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--********************************Header end ti-comment-alt********************************-->
<style type="text/css">
    .discript{width: 250px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
</style>
<!--**********************************
Sidebar start
***********************************-->
        <?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        	
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
                        <h4 class="card-title">Add Area</h4>
                    </div>
                    <div class="card-body">
    			        <form method="post" onsubmit="return addArea(event)" id="addArea" enctype="multipart/form-data">
    				       
    					
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Area Name</strong></label>
                                    <input type="text"  name="area_name" placeholder="area name.." class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Area Zipcode</strong></label>
                                    <input type="number" name="area_post_code" placeholder="area zipcode.." class="form-control" >
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Area Group</strong></label>
                                    <input type="text" name="area_group" class="form-control" required placeholder="area group..">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Background Image</strong></label>
                                    <input type="file" name="banner" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Slider Images</strong></label>
                                    <input type="file" multiple accept="image/png, image/gif, image/jpeg" name="image[]" class="form-control"  required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"><strong>Banner Heading</strong></label>
                                    <input type="text" name="location_heading" class="form-control" required placeholder="banner heading..">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label"><strong>Banner Description</strong></label>
                                    <textarea type="text" name="location_description" class="form-control textarea" placeholder="banner description.."></textarea>
                                </div>
                            </div>
                        
                            <button class="btn btn-primary" id="addbtn" type="submit">Add</button>
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
        <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

</script><?php /**PATH D:\xampp\htdocs\anilsir\smartSpaceFinder\resources\views/admin/add-property.blade.php ENDPATH**/ ?>