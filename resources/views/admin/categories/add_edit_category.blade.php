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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form id="categoryForm" name="categoryForm" action="{{ url('admin/add-edit-category') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="categoryName">Category Name</label>
                  <input type="text" name="category_name" id="" value="{{ old('category_name') }}" class="form-control" placeholder="Enter The Category Name">
                </div>
                <div id="appendCategoryLevel">
                  @include('admin.categories.append_category_level')
                </div>
                <!-- /.form-group -->
               {{-- category discount --}}
               <div class="form-group">
                <label for="categoryDiscount">Category Discount</label>
                <input type="number" name="category_discount" id="" class="form-control" placeholder="Category Discount">
              </div>
              {{-- Category Description --}}
              <div class="form-group">
                <label for="description">Category Description</label>
                <textarea name="description" id="" cols="10" rows="03" class="form-control"></textarea>
              </div>

              {{-- Meta Description --}}
              <div class="form-group">
                <label for="metaDescription">Meta Description</label>
                <textarea name="meta_description" id="" cols="10" rows="03" class="form-control"></textarea>
              </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Section</label>
                  <select name="section_id" id="getSection_id" class="form-control select2" style="width: 100%;">
                    <option value="">Section</option>
                    @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>    
                    @endforeach
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label for="categoryImage">Category Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="category_image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                
                <!-- /.form-group -->
                  {{-- category url --}}
              <div class="form-group">
                <label for="categoryUrl">Category URL</label>
                <input type="text" name="url" id="" class="form-control" placeholder="Category URL">
              </div>
              {{-- meta title --}}
              <div class="form-group">
                <label for="metaTitle">Meta Title</label>
                <textarea name="meta_title" id="" cols="10" rows="03" class="form-control"></textarea>
              </div>
              {{-- meta keywords --}}
              <div class="form-group">
                <label for="metaKeywords">Meta Keywords</label>
                <textarea name="meta_keywords" id="" cols="10" rows="03" class="form-control"></textarea>
              </div>

              </div>
              <!-- /.col -->
            

            </div>
            <!-- /.row -->

                {{-- submit button --}}
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
          </div>
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->
    <!-- /.content -->
  </div>
@endsection
