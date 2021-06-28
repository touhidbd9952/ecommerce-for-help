<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // index page

    public function index(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        $proudcts = Product::where('status',1)->orderBy('id','DESC')->get();
        $featureds = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();
        $special_offers = Product::where('special_offer',1)->where('status',1)->orderBy('id','DESC')->get();
        $special_deals = Product::where('special_deals',1)->where('status',1)->orderBy('id','DESC')->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_category_1 = Category::skip(1)->first();
        $skip_category_2 = Category::skip(2)->first();
        $skip_brand_0 = Brand::skip(2)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBY('id','DESC')->get();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBY('id','DESC')->get();
        $skip_product_2 = Product::where('status',1)->where('category_id',$skip_category_2->id)->orderBY('id','DESC')->get();
        $skip_product_brand_0 = Product::where('status',1)->where('brand_Id',$skip_brand_0->id)->orderBY('id','DESC')->get();

        return view('fontend.index',compact('categories','sliders','proudcts','featureds','special_offers','special_deals','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_category_2','skip_product_2','skip_product_0','skip_product_brand_0','skip_brand_0'));
    }
    //product details
    public function singleProduct($product_id,$slug){
        $product = Product::findOrFail($product_id);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);

        $color_bn = $product->product_color_bn;
        $product_color_bn = explode(',',$color_bn);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);

        $size_bn = $product->product_size_bn;
        $product_size_bn = explode(',',$size_bn);

        $multiImgs = MultiImg::where('product_id',$product_id)->get();
        $cat_id = $product->category_id;
        $relatedProducts = Product::where('category_id',$cat_id)->where('id','!=',$product_id)->orderBy('id','DESC')->get();
        //prouct review
        $reviewProducts = ProductReview::with('user')->where('product_id',$product_id)->where('status','approve')->latest()->get();
        $rating = ProductReview::where('product_id',$product_id)->where('status','approve')->avg('rating');
        $avgRating = number_format($rating,1);
        return view('fontend.single-product',compact('product','multiImgs','product_color_en','product_color_bn','product_size_en','product_size_bn','relatedProducts','reviewProducts','avgRating'));
    }

    //tag wise product
    public function tagWiseProduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(1);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('fontend.tag-product',compact('products','categories'));
    }

    //subcategory wise product show
    public function subCatWiseProduct(Request $request,$subcat_id,$slug){

        $categories = Category::orderBy('category_name_en','ASC')->get();

        $sort = '';
        if ($request->sort != null) {
             $sort = $request->sort;
        }

        if ($subcat_id == null) {
            return view('errors.404');
        }else {
            if ($sort == 'priceLowtoHigh') {
                $products = Product::where(['status' => 1,'subcategory_id' => $subcat_id])->orderBy('selling_price','ASC')->paginate(12);
            }elseif ($sort == 'priceHightoLow') {
                $products = Product::where(['status' => 1,'subcategory_id' => $subcat_id])->orderBy('selling_price','DESC')->paginate(12);
            }elseif ($sort == 'nameAtoZ') {
                $products = Product::where(['status' => 1,'subcategory_id' => $subcat_id])->orderBy('product_name_en','ASC')->paginate(12);
            }elseif ($sort == 'nameZtoA') {
                $products = Product::where(['status' => 1,'subcategory_id' => $subcat_id])->orderBy('product_name_en','DESC')->paginate(12);
            }else {
                $products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
            }
        }
        $subCatId = $subcat_id;
        $subCatSlug = $slug;
        $route = 'subcategory/product';

        //loadmore product with ajax
        if ($request->ajax()) {
            $grid_view = view('fontend.inc.grid_view_product',compact('products'))->render();
            $list_view = view('fontend.inc.list_view_product',compact('products'))->render();
            return response()->json(['grid_view' => $grid_view,'list_view'=>$list_view]);
        }

        return view('fontend.sub-category-product',compact('products','categories','route','subCatId','subCatSlug','sort'));
    }

    //subsubcatgory wise product show
    public function subSubCatWiseProduct($subsubcat_id,$slug){
        $products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(1);
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('fontend.sub-sub-category-product',compact('products','categories'));
    }

    // =========================== Product view with ajax================
    public function productViewAjax($product_id){
            $product = Product::with('category','brand')->findOrFail($product_id);

            $color = $product->product_color_en;
            $product_color = explode(',',$color);
            $size = $product->product_size_en;
            $produt_size = explode(',',$size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $produt_size,
        ));

    }
}
