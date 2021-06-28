@extends('layouts.fontend-master')
@section('content')
@section('title') {{ $product->product_name_en }} @endsection
@section('meta')
<meta property="og:title" content="{{ $product->product_name_en }}" />
<meta property="og:url" content="{{Request::fullUrl()}}" />
<meta property="og:image" content="{{URL::to($product->product_thambnail)}}" />
<meta property="og:description" content="{{ $product->short_descp_en }}"/>
<meta property="og:site_name" content="Shopmama" />
@endsection
@php
 function bn_price($str){
    $en = array(1,2,3,4,5,6,7,8,9,0);
    $bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
    $str = str_replace($en,$bn,$str);
    return $str;
}
@endphp

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li><a href="#">Clothing</a></li>
				<li class='active'>Floral Print Buttoned</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
				<div class="home-banner outer-top-n">
<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div>



<!-- ================== HOT DEALS =========================== -->
        @include('fontend.inc.hot-deals')
<!-- ========================== HOT DEALS: END =========================== -->
<!-- ==============================================

<!-- ============================================== NEWSLETTER ============================================== -->
<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
	<h3 class="section-title">Newsletters</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<p>Sign Up for Our Newsletter!</p>
        <form role="form">
        	 <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
			  </div>
			<button class="btn btn-primary">Subscribe</button>
		</form>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== NEWSLETTER: END ============================================== -->

<!-- ============================================== Testimonials============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
        <div class="item">
            <div class="avatar"><img src="{{ asset('fontend') }}/assets/images/testimonials/member1.png" alt="Image"></div>
		<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
        </div><!-- /.item -->

         <div class="item">
         	<div class="avatar"><img src="{{ asset('fontend') }}/assets/images/testimonials/member3.png" alt="Image"></div>
		<div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>
        </div><!-- /.item -->

        <div class="item">
            <div class="avatar"><img src="{{ asset('fontend') }}/assets/images/testimonials/member2.png" alt="Image"></div>
		<div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
		<div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
        </div><!-- /.item -->

    </div><!-- /.owl-carousel -->
</div>

<!-- ================== Testimonials: END =========================== -->



				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
            <div class="detail-block">
				<div class="row  wow fadeInUp">

					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
        @foreach ($multiImgs as $img)
            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset($img->photo_name) }}">
                    <img class="img-responsive" alt="" src="{{ asset($img->photo_name) }}" data-echo="{{ asset($img->photo_name) }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->
            @endforeach

        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
             @foreach ($multiImgs as $img)
                <div class="item">
                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="{{ $img->id }}" href="#slide{{ $img->id }}">
                        <img class="img-responsive" width="85" alt="" src="{{ asset($img->photo_name) }}" data-echo="{{ asset($img->photo_name) }}" />
                    </a>
                </div>
                @endforeach
            </div><!-- /#owl-single-product-thumbnails -->

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name" id="pname">
                                @if (session()->get('language') == 'bangla')
                                {{ $product->product_name_bn }}
                                @else
                               {{  $product->product_name_en }}
                                @endif
                            </h1>

							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
                                        @for ($i =1 ; $i <= 5 ; $i++)
                                            <span style="color: red; font-size:15px;" class="glyphicon glyphicon-star{{ ($i <= $avgRating) ? '' : '-empty' }}"></span>
                                        @endfor
                                        <h3>5 / {{ $avgRating }}</h3>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">({{ count($reviewProducts) }} Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">In Stock</span>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
                             @if (session()->get('language') == 'bangla')
                             {!!  $product->short_descp_bn !!}
                             @else
                            {!!  $product->short_descp_en !!}
                            @endif
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">


									<div class="col-sm-6">
										<div class="price-box">
                                            @if ($product->discount_price == NULL)
                                            @if (session()->get('language') == 'bangla')
                                           <span class="price">${{ bn_price($product->selling_price) }}</span>
                                           @else
                                           <span class="price">${{ $product->selling_price }}</span>
                                           @endif
                                       @else
                                            @if (session()->get('language') == 'bangla')
                                            <span class="price">${{ bn_price($product->discount_price) }}</span>
                                            <span class="price-strike">${{ bn_price($product->selling_price) }}</span>
                                            @else
                                            <span class="price">${{ $product->discount_price }}</span>
                                            <span class="price-strike">${{ $product->selling_price }}</span>
                                            @endif
                                       @endif
										</div>
									</div>

									<div class="col-sm-6">
										<div class="favorite-button m-t-10">
                                            {{-- //product share  --}}
											<div class="sharethis-inline-share-buttons" data-href="{{ Request::url() }}"></div>
										</div>
									</div>

                                </div><!-- /.row -->
                                <div class="row mt-3">


									<div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="color">Select Color</label>
                                            <select class="form-control" id="color">
                                                @foreach ($product_color_en as $color)
                                                <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                              @endforeach

                                            </select>
                                          </div>
									</div>

									<div class="col-sm-6">
                                        @if ($product->product_size_en == null)
                                        @else
                                        <div class="form-group">
                                            <label for="size">Select Size</label>
                                            <select class="form-control" id="size">
                                                @foreach ($product_size_en as $size)
                                                <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          @endif
									</div>

								</div><!-- /.row -->
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">

									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>

									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" id="qty" value="1" min="1">
							              </div>
							            </div>
									</div>

                                    <input type="hidden" id="product_id" value="{{ $product->id }}">

									<div class="col-sm-7">
                                        <button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
									</div>


								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
                </div>

				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
								<li><a data-toggle="tab" href="#tags">Comments</a></li>

							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">

								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">
                                            @if (session()->get('language') == 'bangla')
                                            {!!  $product->long_descp_bn !!}
                                            @else
                                           {!!  $product->long_descp_en !!}
                                           @endif</p>
									</div>
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
                                    @foreach ($reviewProducts as $review)
										<div class="product-reviews">
											<h4 class="title">{{ $review->user->name }}</h4>
											<div class="reviews">
												<div class="review">
													<div class="review-title">
                                                        <span class="summary">
                                                        @for ($i =1 ; $i <= 5 ; $i++)
                                                        <span style="color: red" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty' }}"></span>
                                                        @endfor
                                                    </span>
                                                        <span class="date"><i class="fa fa-calendar"></i><span> {{ $review->created_at->diffForHumans() }}</span></span></div>
													<div class="text">"{{ $review->comment }}"
                                                    </div>
																										                                            </div>
											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->
                                    @endforeach
							        </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                                <div id="tags" class="tab-pane">
									<div class="product-tag">
                                        <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="10"></div>
									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Related Products</h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

        @foreach ($relatedProducts as $product)
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                        <div class="product-image">
                            <div class="image">
                                @if (session()->get('language') == 'bangla')
                                <a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                                @else
                                <a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                                @endif
                            </div><!-- /.image -->
                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount =  ( $amount/$product->selling_price) * 100;
                            @endphp
                            <div class="tag new">
                                @if ($product->discount_price == NULL)
                                <span> @if (session()->get('language') == 'bangla') নতুন @else new @endif</span>
                                @else
                                <span> @if (session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
                                @endif
                            </div>
                        </div><!-- /.product-image -->


                        <div class="product-info text-left">
                            <h3 class="name">
                                @if (session()->get('language') == 'bangla')
                                <a href="detail.html">{{ $product->product_name_bn }}</a>
                                @else
                                <a href="detail.html">{{ $product->product_name_en }}</a>
                                @endif
                            </h3>
                            <div class="rating rateit-small"></div>
                            <div class="description"></div>
                            <div class="product-price">
                            @if ($product->discount_price == NULL)
                                @if (session()->get('language') == 'bangla')
                                <span class="price">${{ bn_price($product->selling_price) }}</span>
                                @else
                                <span class="price">${{ $product->selling_price }}</span>
                                @endif
                            @else
                                @if (session()->get('language') == 'bangla')
                                <span class="price">${{ bn_price($product->discount_price) }}</span>
                                <span class="price-before-discount">${{ bn_price($product->selling_price) }}</span>
                                @else
                                <span class="price">${{ $product->discount_price }}</span>
                                <span class="price-before-discount">${{ $product->selling_price }}</span>
                                @endif

                            @endif

                            </div><!-- /.product-price -->
                        </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id="{{ $product->id }}" onclick="productView(this.id)">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button" >@if (session()->get('language') == 'bangla') কার্টেসংযুক্ত করুন@else Add to cart @endif></button>
                                            </li>
                                                <button class="btn btn-primary icon" type="button" title="Add to WIshlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
                                                    <i class="icon fa fa-heart"></i>
                                                </button>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->
                    </div><!-- /.product -->
                    </div><!-- /.products -->
        </div><!-- /.item -->
        @endforeach

	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=157782379562934&autoLogAppEvents=1" nonce="WhS30MCS"></script>

 {{-- // share products  --}}
 <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=609aecbaf811a40018fa1e32&product=inline-share-buttons" data-href="{{ Request::url() }}" async="async"></script>
@endsection
