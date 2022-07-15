@include('frontend.includes.header')

<div class="breadcrumb-area bg-overlay-2" style="background-image:url('{{ asset('') }}assets/frontend/images/breadcrumb-2.jpg')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title text-center">
                <h2 class="page-title">Get in Touch</h2>
                <ul class="page-list">
                    <li><a href="index.php">Home</a></li>
                    <li> Contact us</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="contact-page-area pd-top-120">
        <div class="container">
            <div class="row">
                @php
    
     $contact_info = DB::table('admin_contact_details')->where('id' , 1)->first();
    
@endphp
                
                
                    <?php if($ads_banners->banner_type != 'vertical') { ?>
                <div class="col-xl-6 col-lg-7 mb-5 mb-lg-0">
                <?php }  else { ?>
                    <div class="col-md-4 mb-5 mb-lg-0">
                    <?php } ?>
                    <div class="contact-details-inner mng-box-shadow">
                        <h4>CONTACT DETAILS</h4>
                        <p>Please find below contact details and contact us today!</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-single-list">
                                    <!-- <h5>India Office</h5> -->
                                    <ul>
                                        <li style="text-indent: -10px;"><a href="javascript:;"><i style="padding-right: 5px;color: #7cb833;" class="fa-solid fa-map-marker-alt"></i> {{ $contact_info->address }}</a></li>
                                        <li><a href="tel:{{ $contact_info->phone }}"><i class="fa-solid fa-phone"></i>  {{ $contact_info->phone }}</a></li>
                                        <li><a href="mailto:{{ $contact_info->phone }}"><i class="fa-solid fa-at"></i>  {{ $contact_info->email }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <?php if($ads_banners->banner_type != 'vertical') { ?>
                <div class="col-xl-6 col-lg-5">
                    <?php  } else { ?>
                    <div class="col-md-6 col-lg-6">
                    <?php } ?>
                    <form class="signin-inner" method="post" id="handleContactAjax" action="{{route('do-contact-us')}}" name="postform">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="single-select-inner style-bg-border">
                                    <select class="form-control" name="contact_type_id">
                                        <option value="">-- choose contact type --</option>
                                        @foreach($contact_type as $value)

                                        <option value="{{ $value->id }}">{{ $value->contact_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" placeholder="Subject" name="subject">
                                    @csrf
                                </label>
                            </div>
                            <div class="col-xl-12 col-lg-6">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" placeholder="Name" name="name">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="single-input-inner style-bg-border">
                                    <input type="text" placeholder="Email" name="email">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="single-input-inner style-bg-border">
                                    <input type="number" placeholder="Phone" name="phone">
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border">
                                    <textarea placeholder="Message" name="message"></textarea>
                                </label>
                            </div>
                            <div class="col-12">
                                <label class="single-input-inner style-bg-border" >
                                    <div class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                                </label>
                            </div>
                            <div class="col-12 mb-4">
                                <button type="submit" class="btn btn-base">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if($ads_banners->banner_type == 'vertical') { ?>
                <div class="col-md-2 mb-5 mb-lg-0">
                    
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-single-list">
                                    <!-- <h5>India Office</h5> -->
                                    <a href="<?=$ads_banners->banner_action?>" target="_blank"><img style="height:100%; width:100%" src='<?=url('public/'.$ads_banners->banner_img)?>' alt="img"></a>
                                        
                                </div>
                            </div>
                        </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if($ads_banners->banner_type == 'horizontal') { ?>
           
                <div class="col-xl-6 col-lg-3 mb-5 mb-lg-0"></div>
                <div class="col-xl-6 offset-lg-3 col-lg-6 mb-5 mb-lg-0">              
                    
                                    <!-- <h5>India Office</h5> -->
                    <a href="<?=$ads_banners->banner_action?>" target="_blank"><img style="height:100%; width:100%" src='<?=url('public/'.$ads_banners->banner_img)?>' alt="img"></a>
                                        
                </div>
                <div class="col-xl-6 col-lg-3 mb-5 mb-lg-0"></div>
                
                <?php } ?>
        {{-- <div class="contact-page-map mg-top-100">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193526.3099246293!2d-74.07959667726288!3d40.72134945797748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1652188203396!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> --}}
    </div>

    
@include('frontend.includes.footer')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">

    $(document).on("submit","#handleContactAjax",function(){
            var e = this;

            UserData = $(this).serialize()
            $(this).find("[type='submit']").html("Processing..");
            $('.alert-danger').remove();
            $.post($(this).attr('action'),UserData,function(data){
              
              $(e).find("[type='submit']").html("Submit Now");
              if(data.status){
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
             
              $(e).find("[type='submit']").html("Submit Now");
              $(".alert").remove();
              var erroJson = JSON.parse(response.responseText);
               for (var err in erroJson) {
            
                $("[name='" + err + "']").after("<div  class='label alert-danger'>" + erroJson[err] + "</div>");
          }

            });
        return false;
      });
</script>