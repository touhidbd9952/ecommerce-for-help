@extends('layouts.admin-master')
@section('admin-content')
     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMaMa</a>
          <span class="breadcrumb-item active">Profile</span>
        </nav>
  
        <div class="sl-pagebody">
          <div class="row row-sm">
                <div class="col-md-4 ">
                    @include('admin.profile.inc.sidebar')
                </div>
                <div class="col-md-8 mt-1">
                  <div class="card" >
                        <div class="card-body">
                            <form action="{{ route('update-data') }}" method="POST">
                                @csrf
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
    
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update Data</button>
                                </div>
                            </form>
                        </div>
                  </div>
                </div>
          </div><!-- row -->
        </div><!-- sl-pagebody -->
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
@endsection

