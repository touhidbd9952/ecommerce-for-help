@foreach ($products as $product)
<div class="category-product-inner wow fadeInUp">
                <div class="products">
                    <div class="product-list product">
        <div class="row product-list-row">
            <div class="col col-sm-4 col-lg-4">
                <div class="product-image">
                    <div class="image">
                        @if (session()->get('language') == 'bangla')
                        <a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_bn) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                        @else
                        <a href="{{ url('single/product/'.$product->id.'/'.$product->product_slug_en) }}"><img  src="{{ asset($product->product_thambnail) }}" alt=""></a>
                        @endif
                    </div>
                </div><!-- /.product-image -->
            </div><!-- /.col -->
            <div class="col col-sm-8 col-lg-8">
                <div class="product-info">
                    <h3 class="name"> @if (session()->get('language') == 'bangla')
                        <a href="detail.html">{{ $product->product_name_bn }}</a>
                        @else
                        <a href="detail.html">{{ $product->product_name_en }}</a>
                        @endif</h3>
                    <div class="rating rateit-small"></div>
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
                    <div class="description m-t-10">{!! $product->short_descp_en !!}</div>
                                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal" id="{{ $product->id }}" onclick="productView(this.id)">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="button" >@if (session()->get('language') == 'bangla') ??????????????????????????????????????? ????????????@else Add to cart @endif></button>
                                </li>
                                    <button class="btn btn-primary icon" type="button" title="Add to WIshlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
                                        <i class="icon fa fa-heart"></i>
                                    </button>
                            </ul>
                        </div><!-- /.action -->
                    </div><!-- /.cart -->

                </div><!-- /.product-info -->
            </div><!-- /.col -->
        </div><!-- /.product-list-row -->
        @php
        $amount = $product->selling_price - $product->discount_price;
        $discount =  ( $amount/$product->selling_price) * 100;
        @endphp
      <div class="tag-new">
            @if ($product->discount_price == NULL)
            <span> @if (session()->get('language') == 'bangla') ???????????? @else new @endif</span>
            @else
            <span> @if (session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
            @endif
        </div>        </div><!-- /.product-list -->
                </div><!-- /.products -->
</div><!-- /.category-product-inner -->
@endforeach
