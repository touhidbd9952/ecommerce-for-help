@extends('layouts.admin-master')
@section('admin-content')
@section('products')
    active show-sub
@endsection
@section('manage-product')
    active
@endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Update Product Stock</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">Update product Quantity</h6>
              <form action="{{ route('stock.update',$product->id) }}" method="POST">
                @csrf
                <div class="row row-sm">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Name English: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="product_name_en" value="{{ $product->product_name_en }}" placeholder="Enter Product Name English">
                            @error('product_name_en')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="product_code" value="{{ $product->product_code }}" placeholder="Enter Product Code">
                            @error('product_code')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="product_qty" value="{{ $product->product_qty }}" placeholder="Enter Product Quantity">
                            @error('product_qty')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                      </div>
                </div>

                <div class="form-layout-footer mt-3" >
                    <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Stock</button>
                  </div><!-- form-layout-footer -->
                </form>

        </div>
    </div>




    @endsection

