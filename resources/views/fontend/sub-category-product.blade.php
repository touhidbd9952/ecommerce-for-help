@extends('layouts.fontend-master')
@section('content')
@section('title') Subcat product @endsection
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
				<li class='active'>Handbags</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row'>
			<div class='col-md-3 sidebar'>
	            <!-- ================================== TOP NAVIGATION ================================== -->
                @include('fontend.inc.category')
<!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">

	            	<div class="sidebar-filter">
		            	<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp">
<h3 class="section-title">shop by</h3>
	<div class="widget-header">
		<h4 class="widget-title">Category</h4>
	</div>
	<div class="sidebar-widget-body">
		<div class="accordion">
            @foreach ($categories as $cat)
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapse{{ $cat->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                        @if (session()->get('language') == 'bangla')
                        {{ $cat->category_name_bn }}
                        @else
                      {{ $cat->category_name_en }}
                        @endif
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapse{{ $cat->id }}" style="height: 0px;">
	                <div class="accordion-inner">
                        @php
                        $sucategories = App\Models\Subcategory::where('category_id',$cat->id)->orderBy('subcategory_name_en','ASC')->get();
                        @endphp
	                    <ul>

                            @foreach ($sucategories as $subcat)
	                        <li>
                                @if (session()->get('language') == 'bangla')
                                <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}">
                                   {{ $subcat->subcategory_name_bn }}
                                </a>
                            @else
                                <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}">
                                   {{ $subcat->subcategory_name_en }}
                                </a>
                             @endif

                            </li>
                            @endforeach
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->
            @endforeach
	    </div><!-- /.accordion -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

		            	<!-- ============================================== PRICE SILDER============================================== -->



<!-- =================== PRODUCT TAGS ======================== -->
    @include('fontend.inc.product-tags')
<!-- =========== PRODUCT TAGS : END =================================== -->
    @include('fontend.inc.testimonial')
<!-- ============================================== Testimonials: END ============================================== -->

<div class="home-banner">
<img src="assets/images/banners/LHS-banner.jpg" alt="Image">
</div>

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">
			<div class="image">
				<img src="{{ asset('fontend') }}/assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">
					<div class="big-text">
						Big Sale
					</div>

					<div class="excerpt hidden-sm hidden-md">
						Save up to 49% off
					</div>
                    <div class="excerpt-normal hidden-sm hidden-md">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit
					</div>

				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

<!-- ========================================= SECTION – HERO : END ========================================= -->
<div class="clearfix filters-container m-t-10">
	<div class="row">
		<div class="col col-sm-6 col-md-2">
			<div class="filter-tabs">
				<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
					<li class="active">
						<a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
					</li>
					<li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
				</ul>
			</div><!-- /.filter-tabs -->
		</div><!-- /.col -->
		<div class="col col-sm-12 col-md-6">
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                              <select class="form-control" name="" id="sortBy">
                                <option>Sort By Products</option>
                                <option value="priceLowtoHigh" {{ ($sort == 'priceLowtoHigh') ? 'selected' :'' }}>Price:Lower to Higher</option>
                                <option value="priceHightoLow" {{ ($sort == 'priceHightoLow') ? 'selected' :'' }}>Price:Higher to Lower</option>
                                <option value="nameAtoZ" {{ ($sort == 'nameAtoZ') ? 'selected' :'' }}>Product Name:A to Z</option>
                                <option value="nameZtoA" {{ ($sort == 'nameZtoA') ? 'selected' :'' }}>Product Name:Z to A</option>
                              </select>

						</div>
					</div><!-- /.fld -->
				</div><!-- /.lbl-cnt -->
			</div><!-- /.col -->

	</div><!-- /.row -->
</div>
				<div class="search-result-container ">
					<div id="myTabContent" class="tab-content category-list">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product">
								<div class="row" id="grid_view_product">
                                    @include('fontend.inc.grid_view_product')
								</div><!-- /.row -->
							</div><!-- /.category-product -->

						</div><!-- /.tab-pane -->

						<div class="tab-pane "  id="list-container">
							<div class="category-product" id="list_view_product">
                                @include('fontend.inc.list_view_product')
							</div><!-- /.category-product -->
						</div><!-- /.tab-pane #list-container -->
					</div><!-- /.tab-content -->
				</div><!-- /.search-result-container -->
            </div><!-- /.col -->
            <div class="ajax-loadmore-product text-center" style="display: none">
                <img src="{{ asset('fontend/assets/images/ajaxloader.gif') }}" style="display: block; margin-left:auto; margin-right:auto; width:10%" alt="">
            </div>
		</div><!-- /.row -->
</div><!-- /.container -->

</div><!-- /.body-content -->

@endsection

@section('scripts')
    <script>
        $('#sortBy').change(function (e) {
            e.preventDefault();
            let sortBy = $('#sortBy').val();
           window.location = "{{ url(''.$route.'') }}/{{ $subCatId }}/{{ $subCatSlug }}?sort="+sortBy;

        });
    </script>

    <script>
        function loadmoreProduct(page){
            $.ajax({
                type: "get",
                url: "?page="+page,
                beforeSend: function (response) {
                    $('.ajax-loadmore-product').show();
                }
            })

            .done(function(data){
                if(data.grid_view == " " || data.list_view == " "){
                    $('.ajax-loadmore-product').html('No More Product Found');
                    return;
                }
                $('.ajax-loadmore-product').hide();

                $('#grid_view_product').append(data.grid_view);
                $('#list_view_product').append(data.list_view);
            })

            .fail(function(){
                alert('something went wrong')
            });

        }
        var page = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() +$(window).height() >= $(document).height()) {
                page ++;
                loadmoreProduct(page);
            }
        });
    </script>
@endsection
