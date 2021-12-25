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
                  <h3 class="card-title">Update Password</h3>
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
                <!-- /.card-header -->
                <!-- form start -->
                <form name="updateform" id="updateform" role="form" method="post" action="{{ url('admin/update-password') }}">
                  @csrf
                    <div class="card-body">
                    <div class="form-group">
                      <label for="adminEmail">Email address</label>
                      <input type="email" class="form-control" name="email" id="adminEmail" value="{{ $adminDetail->email }}" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="adminType">Admin Type</label>
                        <input type="text" class="form-control" name="type" id="adminType" value="{{ $adminDetail->type }}" readonly="">
                      </div>
                    <div class="form-group">
                      <label for="chkcurrpwd">Current Password</label>
                      <input type="password" class="form-control" name="chkcurrpwd" id="chkcurrpwd" placeholder="Password">
                      <div id="chkcurrentpwd"></div>
                    </div>

                    <div class="form-group">
                        <label for="newpwd">New Password</label>
                        <input type="password" name="newpwd" class="form-control" id="newpwd" placeholder="New Password">
                    </div>

                    <div class="form-group">
                        <label for="confirmpwd">Password</label>
                        <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password">
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