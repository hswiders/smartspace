@include('frontend.includes.header')

   <div class="signin-page-area pd-top-220 pd-bottom-120 body-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    
                    <form class="signin-inner" method="post" id="handleAjax" action="{{ route('reset.password.post') }}" name="postform">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h3>Change Password</h3>
                                <div name="0" id="errors-list"></div>
                            </div>
                            
                            
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="password" name="password" placeholder="New Password" value="{{old('password')}}"  />
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    @csrf
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                   <input type="password" name="confirm_password" placeholder="Confirm Password" value="{{old('confirm_password')}}"  />
                                   
                                </label>
                            </div>
                            
                            <div class="col-12 mb-1">
                                <button type="submit" class="btn btn-base w-100">Change Password</button>
                            </div>
                        
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    
@include('frontend.includes.footer')
 <script>
    $(function() {
    // handle submit event of form
      $(document).on("submit", "#handleAjax", function() {
        var e = this;
        // change login button text before ajax
        $(this).find("[type='submit']").html("Processing..");
         $('.alert-danger').remove();
        $.post($(this).attr('action'), $(this).serialize(), function(data) {

          $(e).find("[type='submit']").html("Forgot Password");
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
          $(e).find("[type='submit']").html("Forgot Password");
          $(".alert").remove();
          var erroJson = JSON.parse(response.responseText);
          
          for (var err in erroJson) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }
        });
        return false;
      });
    });
  </script>