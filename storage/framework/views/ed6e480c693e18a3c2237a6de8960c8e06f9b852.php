<?php echo $__env->make('frontend.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="breadcrumb-area bg-overlay-2" style="background-image:url('<?php echo e(asset('')); ?>assets/frontend/images/breadcrumb-2.jpg')">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="section-title text-center">
                <h2 class="page-title">Privacy Policy</h2>
                <ul class="page-list">
                    <li><a href="index.php">Home</a></li>
                    <li> Privacy Policy</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="property-page-area pd-top-120 pd-bottom-90 body-bg">
    <div class="container">
        <?php if(empty($ads_banners)) {  ?>
        <h4>1. Accuracy and validity of information</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>2. Availability</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>3. Third party websites</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>4. Copyright and intellectual property</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>5. Termination of contract</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
    <?php } elseif(!empty($ads_banners)) { ?>
        <?php if($ads_banners->banner_type == 'vertical') { ?>

        <div class="container">
            <div class="row">
            <div class="col-md-10 mb-5 mb-lg-0">
        <h4>1. Accuracy and validity of information</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>2. Availability</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>3. Third party websites</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>4. Copyright and intellectual property</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>5. Termination of contract</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        </div>
    
        
        
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
            </div>
                
        </div>
        <?php } ?>
            <?php } ?>
        <?php if($ads_banners->banner_type == 'horizontal') { ?>
        <div class="container">
        <h4>1. Accuracy and validity of information</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>2. Availability</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>3. Third party websites</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>4. Copyright and intellectual property</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        
        <h4>5. Termination of contract</h4>
        <p class="mb-4">Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Quisque velit nisi, pretium ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada. Donec rutrum congue leo eget malesuada. Pellentesque in ipsum id orci porta dapibus. Curabitur aliquet quam id ut lacinia in elementum id enim. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi leo eget malesuada.</p>
        

                <div class="col-xl-6 col-lg-3 mb-5 mb-lg-0"></div>
                <div class="col-xl-6 offset-lg-3 col-lg-6 mb-5 mb-lg-0">              
                    
                                    <!-- <h5>India Office</h5> -->
                    <a href="<?=$ads_banners->banner_action?>" target="_blank"><img style="height:100%; width:100%" src='<?=url('public/'.$ads_banners->banner_img)?>' alt="img"></a>
                                        
                </div>
                <div class="col-xl-6 col-lg-3 mb-5 mb-lg-0"></div>
                <?php } ?>
    </div>
</div>
    
<?php echo $__env->make('frontend.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH /homepages/36/d911497826/htdocs/resources/views/frontend/privacy.blade.php ENDPATH**/ ?>