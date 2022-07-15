
                    <div class="product-search-inner ">
                        <div class="row custom-gutters-20">
                            <div class="col-md-9 align-self-center">
                                <h5>{{$properties->total()}} Properties</h5>
                            </div>
                            <div class="col-md-3 mt-2 mt-md-0 align-self-center">
                                <div class="single-select-inner">
                                    <select class="form-control common_selector" id="sort_by">
                                        <option value="">Sort By</option>
                                        <option {{( $sort_by == 'is_featured' ) ? 'selected' : ''}} value="is_featured">Popular</option>
                                        <option {{( $sort_by == 'l_to_h' ) ? 'selected' : ''}} value="l_to_h">Low to High</option>
                                        <option {{( $sort_by == 'h_to_l' ) ? 'selected' : ''}} value="h_to_l">High to Low</option>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <div class="row">
                        @forelse ($properties as $element)
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
                        <div class="col-lg-6 col-md-6">
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
                                            <a class="btn btn-blue btn-sm p_type" href="javascript:;">Plot</a>
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
                            <div class="col-md-12">
                                <div class="alert alert-danger">No properties found</div>
                            </div>
                        @endforelse
                        
                      
                    </div>
                    <div class="pagination-area text-center mt-4">
                        {{-- <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="la la-angle-double-left"></i></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="la la-angle-double-right"></i></a></li>
                        </ul> --}}
                        <div id="pagination">
                          {{ $properties->links('pagination.ajax_pagination') }}
                        </div>
                    </div>
                