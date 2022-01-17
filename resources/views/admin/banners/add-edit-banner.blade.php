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
              <li class="breadcrumb-item"><a href="{{ route('banner.list') }}">Home</a></li>
              <li class="breadcrumb-item active">Banner</li>
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
            <h5><i class="icon fas fa-check"></i>Alert!</h5>
            {{ Session::get('success_msg')}}
          </div>
        @endif
        {{-- <!-- SELECT2 EXAMPLE  --> action="{{ empty($banner['id']) ?  url('admin/add-edit-category') : url('admin/add-edit-category', $banner['id']) }}" --}}
      <form   id="bannerForm" name="bannerForm" action="{{ empty($banner['id']) ? url('admin/add-edit-banner') : url('admin/add-edit-banner/'.$banner['id']) }}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mainImage">Banner Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                      <p>Image must has width = 1170px and height = 480px</p>
                      @if (!empty($banner['image']))
                        <div style="width: 100" class="mt-3">
                          <img src="{{ asset('img/adm_img/carousel/'. $banner['image']) }}" width="100" height="100">
                        </div>
                          
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="title">Banner Image Title</label>
                      <input type="text" name="title" id="" class="form-control" value="{{ !empty($banner['title']) ? $banner['title']: old('title') }}"  placeholder="Banner Image Title">
                    </div>

                    <div class="form-group">
                      <label for="alt">Image Alt Name</label>
                      <input type="text" name="alt" id="" class="form-control" value="{{ !empty($banner['alt']) ? $banner['alt']: old('alt') }}" placeholder="Image Alt Name">
                    </div>
                    <div class="form-group">
                      <label for="link">Image URL</label>
                      <input type="text" name="link" id="" class="form-control" value="{{ !empty($banner['link']) ? $banner['link']: old('link') }}" placeholder="Image URL">
                    </div>

                      {{-- submit button --}}
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
               </div>
           </div> 
        </div>
      </form>
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->
    <!-- /.content -->
  </div>
@endsection
