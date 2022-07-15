@include('frontend.includes.header')


    <div class="banner-area banner-area-2 banner-area-bg" style="background: url('{{asset('/assets/frontend/images/banner-main.jpg')}}'); background-attachment: fixed;">
        <!-- <div class="main-search-area" style="background:transparent;">
            <div class="container">
                
            </div>
        </div> -->
        <div class="container">
            <div class="banner-area-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="banner-inner text-center">
                            <h2>Find your place to stay now</h2>
                            <div class="line"></div>

                            <form class="main-search-inner pl-0 pr-0" action="{{ route('search-property') }}">
                                <div class="row no-gutters">
                                
                                    <div class="col-lg-10 col-md-10">
                                        <div class="single-input-inner">
                                            <input type="text" name="keyword" placeholder="Enter Keyword" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-base w-md-auto w-100" href="#">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <div class="product-area pd-top-118 pd-bottom-90">
        <div class="container">
            <div class="section-title text-center">
                <h6>We are offering the best real estate</h6>
                <h2>Best House For You</h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($popular_property as $element)
                @php
                    $element->image = App\Models\ProperyImages::where('property_id' , $element->id)->first();
                    $element->owner = App\Models\User::where('id' , $element->user_id)->first();
                    $element->property_category = App\Models\ProperyCategory::where('id' , $element->property_category)->first();
                    
                    $icon_class = 'far';
                    if (Auth::id())
                    {
                        $is_favourite =  App\Models\Favourites::where(['property_id' => $element->id , 'user_id' => Auth::id()])->first();
                        if ($is_favourite)
                        {
                            $icon_class = 'fas';
                        }
                        
                    }
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="single-product-wrap">
                        <div class="thumb">
                            <a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">
                                        <img src="{{ asset($element->image->image) }}" alt="img">
                             </a> 
                            <div class="btn-area">
                                @if ($element->property_type == 1)
                                    <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                @elseif($element->property_type == 2)
                                    <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                @else
                                    <a class="btn btn-blue btn-sm p_type" href="javascript:;">Lots</a>
                                @endif
                                
                                
                            </div>
                            <div class="product-wrap-details">
                                <div class="media">
                                    <div class="author">
                                        <img src="{{asset($element->owner->image)}}" alt="img" width="50px" height="50px">                                    
                                    </div>
                                    <div class="media-body">
                                        <h6><a href="#">{{ $element->owner->first_name }}</a></h6>
                                        <p><img src="{{asset('/assets/frontend/images/location.png')}}" alt="img"> {{$element->address}} </p>
                                    </div>
                                    <a class="fav-btn float-right" href="javascript:;" onclick="addToFav({{$element->id}})"><i class="{{$icon_class}} fa-heart property_heart_{{$element->id}}"></i></a>
                                </div>
                            </div>
                        </div>
                         <div class="product-details-inner">
                                    <h4><a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">{{$element->property_heading}}</a></h4>
                                    <ul class="meta-inner">
                                        <li><img src="{{ asset('') }}assets/frontend/images/location2.png" alt="img">{{$element->city.' , '.$element->state }}</li>
                                        
                                    </ul>
                                    <p>{{ mb_strimwidth($element->description, 0, 97, '...') }}</p>
                                </div>
                                <div class="product-meta-bottom">
                                    <span class="price">${{$element->monthly_rent }}</span>
                                    <span>{{$element->created_at->diffForHumans()}}</span>
                                </div> 
                        

                    </div>
                </div>
                @empty
                    <div class="alert alert-danger">No Popular Properties found!</div>
                @endforelse
                    
            </div>
        </div>
    </div>
    


    <div class="service-area bg-gray py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap style-2" style="background-position: top center; background-image: url({{ asset('') }}assets/images/no.png);">
                        <div class="thumb">
                            <img src="{{ asset('') }}assets/images/no-color.png" alt="icon">
                        </div>
                        <div class="single-service-details">
                            <h4><a href="#">No Contracts</a></h4>
                            <p>You don't have to make a long term commitment. You can just pay for the services you need and nothing more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap style-2" style="background-position: top center; background-image: url({{ asset('') }}assets/images/check-outline.png">
                        <div class="thumb">
                            <img src="{{ asset('') }}assets/images/check-color.png" alt="icon">
                        </div>
                        <div class="single-service-details">
                            <h4><a href="#">Verified Users</a></h4>
                            <p>You can be confident that all our members are current and active with our monthly membership.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap style-2 mb-0" style="background-position: top center; background-image: url({{ asset('') }}assets/images/ssl.png);">
                        <div class="thumb">
                            <img src="{{ asset('') }}assets/images/ssl-color.png" alt="icon">
                        </div>
                        <div class="single-service-details">
                            <h4><a href="#">SSL Protection</a></h4>
                            <p>To keep your information safe and to filter out spam, multiple layers of protection have been Integrated.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="propartes-area pd-top-118 pd-bottom-90">
        <div class="container">
            <div class="section-title text-center">
                <h6>Our Properties</h6>
                <h2>Our Properties </h2>
            </div>
            <div class="mgd-tab-inner text-center"> 
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="resedential-tab" data-toggle="tab" href="#resedential" role="tab" aria-controls="resedential" aria-selected="true">Resedential</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="office-tab" data-toggle="tab" href="#office" role="tab" aria-controls="office" aria-selected="false">Office</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="plots-tab" data-toggle="tab" href="#plots" role="tab" aria-controls="plots" aria-selected="false">Lots</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="resedential" role="tabpanel" aria-labelledby="resedential-tab">
                    <div class="row">
                        @forelse ($res_property as $element)
                        @php
                            $element->image = App\Models\ProperyImages::where('property_id' , $element->id)->first();
                            $element->owner = App\Models\User::where('id' , $element->user_id)->first();
                            $element->property_category = App\Models\ProperyCategory::where('id' , $element->property_category)->first();
                            $icon_class = 'far';
                    if (Auth::id())
                    {
                        $is_favourite =  App\Models\Favourites::where(['property_id' => $element->id , 'user_id' => Auth::id()])->first();
                        if ($is_favourite)
                        {
                            $icon_class = 'fas';
                        }
                        
                    }
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product-wrap">
                                <div class="thumb">
                                    <a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">
                                                <img src="{{ asset($element->image->image) }}" alt="img">
                                     </a> 
                                    <div class="btn-area">
                                        @if ($element->property_type == 1)
                                            <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                        @elseif($element->property_type == 2)
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                        @else
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Lots</a>
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="product-wrap-details">
                                        <div class="media">
                                            <div class="author">
                                                <img src="{{asset($element->owner->image)}}" alt="img" width="50px" height="50px">                                    
                                            </div>
                                            <div class="media-body">
                                                <h6><a href="#">{{ $element->owner->first_name }}</a></h6>
                                                <p><img src="{{asset('/assets/frontend/images/location.png')}}" alt="img"> {{$element->address}} </p>
                                            </div>
                                            <a class="fav-btn float-right" href="javascript:;" onclick="addToFav({{$element->id}})"><i class="{{$icon_class}} fa-heart property_heart_{{$element->id}}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-details-inner">
                                            <h4><a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">{{$element->property_heading}}</a></h4>
                                            <ul class="meta-inner">
                                                <li><img src="{{ asset('') }}assets/frontend/images/location2.png" alt="img">{{$element->city.' , '.$element->state }}</li>
                                                
                                            </ul>
                                            <p>{{ mb_strimwidth($element->description, 0, 97, '...') }}</p>
                                        </div>
                                        <div class="product-meta-bottom">
                                            <span class="price">${{$element->monthly_rent }}</span>
                                            <span>{{$element->created_at->diffForHumans()}}</span>
                                        </div> 
                                

                            </div>
                        </div>
                        @empty
                            <div class="alert alert-danger">No Resedential Properties found!</div>
                        @endforelse
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="office" role="tabpanel" aria-labelledby="office-tab">
                    <div class="row">
                        @forelse ($office_property as $element)
                        @php
                            $element->image = App\Models\ProperyImages::where('property_id' , $element->id)->first();
                            $element->owner = App\Models\User::where('id' , $element->user_id)->first();
                            $element->property_category = App\Models\ProperyCategory::where('id' , $element->property_category)->first();
                            $icon_class = 'far';
                    if (Auth::id())
                    {
                        $is_favourite =  App\Models\Favourites::where(['property_id' => $element->id , 'user_id' => Auth::id()])->first();
                        if ($is_favourite)
                        {
                            $icon_class = 'fas';
                        }
                        
                    }
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product-wrap">
                                <div class="thumb">
                                    <a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">
                                                <img src="{{ asset($element->image->image) }}" alt="img">
                                     </a> 
                                    <div class="btn-area">
                                        @if ($element->property_type == 1)
                                            <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                        @elseif($element->property_type == 2)
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                        @else
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Lots</a>
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="product-wrap-details">
                                        <div class="media">
                                            <div class="author">
                                                <img src="{{asset($element->owner->image)}}" alt="img" width="50px" height="50px">                                    
                                            </div>
                                            <div class="media-body">
                                                <h6><a href="#">{{ $element->owner->first_name }}</a></h6>
                                                <p><img src="{{asset('/assets/frontend/images/location.png')}}" alt="img"> {{$element->address}} </p>
                                            </div>
                                            <a class="fav-btn float-right" href="javascript:;" onclick="addToFav({{$element->id}})"><i class="{{$icon_class}} fa-heart property_heart_{{$element->id}}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-details-inner">
                                            <h4><a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">{{$element->property_heading}}</a></h4>
                                            <ul class="meta-inner">
                                                <li><img src="{{ asset('') }}assets/frontend/images/location2.png" alt="img">{{$element->city.' , '.$element->state }}</li>
                                                
                                            </ul>
                                            <p>{{ mb_strimwidth($element->description, 0, 97, '...') }}</p>
                                        </div>
                                        <div class="product-meta-bottom">
                                            <span class="price">${{$element->monthly_rent }}</span>
                                            <span>{{$element->created_at->diffForHumans()}}</span>
                                        </div> 
                                

                            </div>
                        </div>
                        @empty
                            <div class="alert alert-danger">No Office Properties found!</div>
                        @endforelse
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="plots" role="tabpanel" aria-labelledby="plots-tab">
                    <div class="row">
                        @forelse ($plots_property as $element)
                        @php
                            $element->image = App\Models\ProperyImages::where('property_id' , $element->id)->first();
                            $element->owner = App\Models\User::where('id' , $element->user_id)->first();
                            $element->property_category = App\Models\ProperyCategory::where('id' , $element->property_category)->first();
                            $icon_class = 'far';
                    if (Auth::id())
                    {
                        $is_favourite =  App\Models\Favourites::where(['property_id' => $element->id , 'user_id' => Auth::id()])->first();
                        if ($is_favourite)
                        {
                            $icon_class = 'fas';
                        }
                        
                    }
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product-wrap">
                                <div class="thumb">
                                    <a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">
                                                <img src="{{ asset($element->image->image) }}" alt="img">
                                     </a> 
                                    <div class="btn-area">
                                        @if ($element->property_type == 1)
                                            <a class="btn btn-base btn-sm p_type" href="javascript:;">Residential</a>
                                        @elseif($element->property_type == 2)
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Office</a>
                                        @else
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Lots</a>
                                        @endif
                                        
                                        
                                    </div>
                                    <div class="product-wrap-details">
                                        <div class="media">
                                            <div class="author">
                                                <img src="{{asset($element->owner->image)}}" alt="img" width="50px" height="50px">                                    
                                            </div>
                                            <div class="media-body">
                                                <h6><a href="#">{{ $element->owner->first_name }}</a></h6>
                                                <p><img src="{{asset('/assets/frontend/images/location.png')}}" alt="img"> {{$element->address}} </p>
                                            </div>
                                            <a class="fav-btn float-right" href="javascript:;" onclick="addToFav({{$element->id}})"><i class="{{$icon_class}} fa-heart property_heart_{{$element->id}}"></i></a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="product-details-inner">
                                            <h4><a href="{{ route('search.single' , ['slug' => Str::slug($element->property_heading) , 'id' => $element->id]) }}">{{$element->property_heading}}</a></h4>
                                            <ul class="meta-inner">
                                                <li><img src="{{ asset('') }}assets/frontend/images/location2.png" alt="img">{{$element->city.' , '.$element->state }}</li>
                                                
                                            </ul>
                                            <p>{{ mb_strimwidth($element->description, 0, 97, '...') }}</p>
                                        </div>
                                        <div class="product-meta-bottom">
                                            <span class="price">${{$element->monthly_rent }}</span>
                                            <span>{{$element->created_at->diffForHumans()}}</span>
                                        </div> 
                                

                            </div>
                        </div>
                        @empty
                            <div class="alert alert-danger">No Lotss Properties found!</div>
                        @endforelse
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
    


    <div class="testimonial-area pd-top-118 pd-bottom-120 bg-overlay" style="background: url('{{asset('/assets/frontend/images/testimonial-bg.png')}}');">
        <div class="bg-overlay-wrap">
            <div class="container">
                <div class="section-title style-white text-center">
                    <h6>Our Testimonial </h6>
                    <h2>What Client Say</h2>
                    <p>Lorem ipsum dolor  amet, consectetur adipisicing elit Lorem ipsum dolor sit amet, </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="testimonial-slider-1 owl-carousel">
                            <div class="item">
                                <div class="single-testimonial-inner pl-lg-5 pr-lg-5 text-center">
                                    <div class="thumb">
                                        <img src="{{asset('/assets/frontend/images/quote.png')}}" alt="img">
                                    </div>
                                    <div class="details">
                                        <p>“consecte Lorem ipsum dolor sit amet, Lorem ipsum dolor amet, consecte Lorem ipsum dolor sit adipisicing amet, consectetur sed do eiusmod tempor dolore magna consecrem adipisicing ipsum dolor sit amet, incididunt sed do eiusmod tempor incididunt consectetur elit,’’ </p>
                                        <h6 class="name">Sarif Jaya Miprut</h6>
                                        <span class="designation">Profile Manager</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-testimonial-inner pl-lg-5 pr-lg-5 text-center">
                                    <div class="thumb">
                                        <img src="{{asset('/assets/frontend/images/quote.png')}}" alt="img">
                                    </div>
                                    <div class="details">
                                        <p>“consecte Lorem ipsum dolor sit amet, Lorem ipsum dolor amet, consecte Lorem ipsum dolor sit adipisicing amet, consectetur sed do eiusmod tempor dolore magna consecrem adipisicing ipsum dolor sit amet, incididunt sed do eiusmod tempor incididunt consectetur elit,’’ </p>
                                        <h6 class="name">Sarif Jaya Miprut</h6>
                                        <span class="designation">Profile Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <div class="categores-area bg-gray pd-top-118 pd-bottom-90">
        <div class="container">
            <div class="section-title text-center">
                <h6>We are offering the best real estate</h6>
                <h2>Popular Categories</h2>
            </div>
            <div class="row">
                @if(!blank($properyCategory))
                    @foreach($properyCategory as $category)
                        @php
                            $category->property_count = App\Models\Property::where('property_category' , $category->id)->count();
                            
                        @endphp
                        <div class="col-lg-6 col-sm-6">
                            <div class="single-category-product-wrap style-two text-center">
                                <div class="thumb">
                                    <img src="{{asset($category->image)}}" alt="img">
                                </div>
                                <div class="single-category-product-details">
                                    <h4><a href="{{ route('search.category' , ['slug' => Str::slug($category->title) , 'id' => $category->id]) }}">{{$category->title}}</a></h4>
                                    <a class="btn btn-base" href="{{ route('search.category' , ['slug' => Str::slug($category->title) , 'id' => $category->id]) }}">{{$category->property_count}} Properties</a>
                                </div>
                            </div>
                        </div> 
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    
    
@include('frontend.includes.footer')
