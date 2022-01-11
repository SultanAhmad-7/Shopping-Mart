@extends('layouts.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('brand.lists') }}">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible mt-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ Session::get('success_msg')}}
          </div>
        @endif
        <!-- SELECT2 EXAMPLE -->
      <form id="brandForm" name="brandForm" action="{{ !empty($brand['id']) ? url('admin/add-edit-brand/'.$brand['id']) : url('admin/add-edit-brand/') }}" method="post" >
          @csrf
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
            {{-- div.row start --}}
            <div class="row">
              <div class="col-md-6">
              
                <div class="form-group">
                  <label for="brandName">Brand Name</label>
                  <input type="text" name="name" id="" value="{{ !empty($brand->name) ? $brand->name : old('name') }}" class="form-control" placeholder="Enter The Brand Name">
                </div>

              </div>
              <!-- /.col -->
            
              {{-- div.row end --}}
            </div>
            <!-- /.row -->

                {{-- submit button --}}
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">{{ $btn }}</button>
                </div>
        </form>
          </div>
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->
    <!-- /.content -->
  </div>
@endsection
