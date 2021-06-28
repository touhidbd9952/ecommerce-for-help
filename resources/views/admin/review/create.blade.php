@extends('layouts.admin-master')
@section('review')
    active
@endsection
@section('admin-content')
     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Customer Review</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Review List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Product Image</th>
                        <th class="wd-25p">Customer Name</th>
                        <th class="wd-25p">Comment</th>
                        <th class="wd-25p">Rating</th>
                        <th class="wd-25p">status</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($reviews as $review)
                      <tr>
                        <td>
                          <img src="{{ asset($review->product->product_thambnail) }}" alt="" style="width: 80px;">
                        </td>
                        <td>{{ $review->user->name }}</td>
                        <td>
                            <textarea name="" id="" cols="30" disabled rows="2">{{ $review->comment }}</textarea>
                        </td>
                        <td>{{ $review->rating }}

                            @for ($i =1 ; $i <= 5 ; $i++)
                            <span style="color: red; font-size:15px;" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty' }}"></span>
                        @endfor</td>
                        <td>
                            <span class="badg badge-pill badge-success">{{ $review->status }}</span>
                            @if ($review->status == 'pending')
                              <a href="{{ url('admin/review-approve/'.$review->id) }}" class="btn btn-sm btn-primary">Approve Now</a>
                            @endif
                        </td>
                        <td>
                          <a href="{{ url('admin/review-delete/'.$review->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div>
              </div><!-- card -->
            </div>
          </div>
        </div>


    </div>
@endsection
