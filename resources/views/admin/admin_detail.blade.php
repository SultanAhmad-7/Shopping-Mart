@extends('layouts.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="col-md-6">
        <div class="container-fluid">
        <div class="card card-primary">
    
                <div class="card-header">
                  <h3 class="card-title">Admin Detail Update</h3>
                </div>
                {{-- Success or Error Message --}}

                @if (Session::has('success_msg'))
                <div class="alert alert-success alert-dismissible mt-1">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    {{ Session::get('success_msg')}}
                  </div>
                @endif
                @if(Session::has('error_msg'))
                    <div class="alert alert-danger alert-dismissible mt-1">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Danger {{ Session::get('error_msg') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ url('/admin/update-admin-detail')}}" method="POST" role="form" id="updateadmindetail"
              name="updateadmindetail" enctype="multipart/form-data">
              @csrf
              <div class="card-body">


                  <div class="form-group">
                      <label for="exampleInputEmail1">Admin Email</label>
                      <input class="form-control" id="exampleInputEmail1"
                          value="{{ Auth::guard('admin')->user()->email}}" readonly="">
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Admin Type</label>
                      <input class="form-control" id="exampleInputEmail1"
                          value="{{ Auth::guard('admin')->user()->type}}" readonly="">
                  </div>


                  <div class="form-group">
                      <label for="exampleInputEmail1">Admin Name</label>
                      <input type="text" class="form-control" id="adm_name" name="adm_name"
                          value="{{ Auth::guard('admin')->user()->name}}" placeholder="Enter Your Name">
                  </div>
                  <div class="form-group">
                      <label for="adm_pwd">Admin Phone #</label>
                      <input type="text" name="adm_mobile" class="form-control" id="mobile"
                          value="{{ Auth::guard('admin')->user()->mobile}}">

                  </div>


                  <div class="form-group">
                      <label for="adm_img">Admin Profile Image</label>
                      <!-- hidden will help, if admin not updated image, then old one will be inserted -->
                      <input type="file" name="adm_img" class="form-control" id="adm_img">
                      @if(!empty(Auth::guard('admin')->user()->image))
                      {{-- <a href="{{ url('img/adm_img/admin_photos/'.Auth::guard('admin')->user()->image) }}">View
                          Image</a> --}}
                          <div class="mt-3">
                            <img src="{{ url('img/adm_img/admin_photos/'.Auth::guard('admin')->user()->image) }}" width="150px" height="100px">
                          </div>
                      
                      <input type="hidden" name="current_admin_image"
                          value="{{ Auth::guard('admin')->user()->image}}">
                      @endif
                  </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
            </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
@endsection