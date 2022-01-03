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
              <li class="breadcrumb-item"><a href="{{ route('product.lists') }}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
        <div class="card card-default">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form id="productForm" name="productForm"  action="{{ !empty($productData['id']) ? url('admin/add-edit-product', $productData['id']) : url('admin/add-edit-product') }}"
               method="post" enctype="multipart/form-data">
                @csrf
                  {{-- category dropDown --}}
                 <div class="form-group">
                  <label>Select Category</label>
                  <select name="category_id" id="getCategory_id" class="form-control" style="width: 100%;">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $section)
                        <optgroup label="{{ $section['name']}}"></optgroup>
                        @foreach ($section['categories'] as $category)
                            <option value="{{ $category['id'] }}" @if (!empty(@old('category_id')) && $category['id'] == @old('category_id'))
                                selected="" 
                                @elseif(!empty($productData['category_id']) && $productData['category_id'] == $category['id'])
                                selected=""
                            @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['category_name']}}</option>
                            @foreach ($category['sub_categories'] as $subCategory)
                                <option value="{{ $subCategory['id'] }}" @if (!empty(@old('category_id')) && $subCategory['id'] == @old('category_id'))
                                    selected=""
                                    @elseif(!empty($productData['category_id']) && $productData['category_id'] == $subCategory['id'])
                                    selected=""
                                @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subCategory['category_name']}}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                  </select>
                </div>
                {{-- Product name --}}
                <div class="form-group">
                  <label for="productName">Product Name</label>
                  <input type="text" name="product_name" id="" value="{{ !empty($productData['product_name']) ? $productData['product_name'] : old('product_name') }}" class="form-control" placeholder="Enter The product Name">
                </div>
                
                <div class="form-group">
                  <label for="product_price">Product Price</label>
                  <input type="text" name="product_price" id="" value="{{ !empty($productData['product_price']) ? $productData['product_price'] : old('product_price') }}" class="form-control" placeholder="Enter The product Price">
                </div>
                <!-- /.form-group -->
               {{-- product discount --}}
               <div class="form-group">
                <label for="productDiscount">Product Discount(%)</label>
                <input type="number" name="product_discount" id="" value="{{ !empty($productData['product_discount']) ? $productData['product_discount'] : old('product_discount')}}" class="form-control" placeholder="product Discount">
              </div>
              <div class="form-group">
                <label for="product_video">Product Video</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="product_video" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
                @if (!empty($productData['product_video']))
                  <div style="width: 100" class="mt-3">

                    <video width="320" height="240" controls>
                      <source src="{{ asset('videos/product_video/'. $productData['product_video']) }}" type="video/mp4">
                      <source src="{{ asset('videos/product_video/'. $productData['product_video']) }}" type="video/ogg">
                      Your browser does not support the video tag.
                    </video>
                    {{-- <a href="{{ url('videos/product_video/'. $productData['product_video']) }}" download="">Download</a>| --}}
                    {{-- <video src="{{ asset('videos/product_video/'. $productData['product_video']) }}" type="video/mp4" width="100%" height="100%" autoplay></video> --}}
                    {{-- <img src="{{ asset('videos/product_video/'. $productData['product_video']) }}" width="50" download> --}}
                    <a class="confirmDelete" record="product-video" recordid="{{$productData['id']}}" href="javascript:void(0)">Delete Video</a>
                  </div>
                      
                  @endif
              </div>
              
              {{-- product Description --}}
              <div class="form-group">
                <label for="description">Product Description</label>
                <textarea name="description" id="" cols="10" rows="03" class="form-control">{{ !empty($productData['description']) ? $productData['description']:old('description')}}</textarea>
              </div>
              <div class="col-12 col-sm-6">
                 {{-- fabric --}}
                 <div class="form-group">
                  <label>Select Fabric</label>
                  <select name="fabric" id="fabric" class="form-control" style="width: 100%;">
                    <option value="">-- Select Fabric --</option>
                    @foreach ($fabricArray as $fabric)
                        <option value="{{ $fabric }}" @if (!empty($productData['fabric']) && $productData['fabric'] == $fabric)
                            selected=""
                        @endif>{{ $fabric }}</option>
                    @endforeach
                  </select>
                </div>
                  {{-- sleeve --}}
                  <div class="form-group">
                    <label>Select Sleeve</label>
                    <select name="sleeve" id="sleeve" class="form-control" style="width: 100%;">
                      <option value="">-- Select Sleeve --</option>
                        @foreach ($sleeveArray as $sleeve)
                          <option value="{{ $sleeve }}" @if (!empty($productData['sleeve']) && $productData['sleeve'] == $sleeve)
                              selected=""
                          @endif>{{ $sleeve }}</option>
                        @endforeach
                    </select>
                  </div>
              </div>
              {{-- Meta Description --}}
              <div class="form-group">
                <label for="metaDescription">Meta Description</label>
                <textarea name="meta_description" id="" cols="10" rows="03" class="form-control">{{ !empty($productData['meta_description']) ? $productData['meta_description'] : old('meta_description') }}</textarea>
              </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                {{-- <div class="form-group">
                  <label>Select Section</label>
                  <select name="section_id" id="getSection_id" class="form-control select2" style="width: 100%;">
                    <option value="">Section</option>
                    @foreach ($sections as $section)
                    <option value="{{ $section->id }}" @if (!empty($editproduct['section_id']) && $editproduct['section_id'] == $section->id)
                        selected
                    @endif>{{ $section->name }}</option>    
                    @endforeach
                  </select>
                </div> --}}
                
                <div class="form-group">
                  <label for="product_color">product Color</label>
                  <input type="text" name="product_color" id="" class="form-control" value="{{ !empty($productData['product_color']) ? $productData['product_color'] : old('product_color')}}" placeholder="product Color">
                </div>

                <div class="form-group">
                  <label for="product_code">product Code</label>
                  <input type="text" name="product_code" id="" class="form-control" value="{{ !empty($productData['product_code']) ? $productData['product_code'] : old('product_code')}}" placeholder="product Code">
                </div>

                <div class="form-group">
                  <label for="product_weight">product Weight</label>
                  <input type="text" name="product_weight" id="" class="form-control" value="{{ !empty($productData['product_weight']) ? $productData['product_weight'] : old('product_weight')}}" placeholder="product Weight">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label for="mainImage">Product Main Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="main_image" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                  @if (!empty($productData['main_image']))
                  <div style="width: 100" class="mt-3">
                    <img src="{{ asset('img/adm_img/admin_product/small/'. $productData['main_image']) }}" width="50">
                    <a class="confirmDelete" record="product-image" recordid="{{$productData['id']}}" href="javascript:void(0){{-- url('admin/delete-category-image', $editCategory['id']) --}}">Delete Image</a>
                  </div>
                      
                  @endif
                </div>
                <!-- /.form-group -->
                  {{-- Wash Care --}}
                  <div class="form-group">
                    <label for="wash_care">Wash Care</label>
                    <textarea name="wash_care" id="" cols="10" rows="03" class="form-control">{{ !empty($productData['wash_care']) ? $productData['wash_care'] : old('wash_care')}}</textarea>
                  </div>
                  <div class="col-12 col-sm-6">
                    {{-- pattern --}}
                    <div class="form-group">
                      <label>Select Pattern</label>
                      <select name="pattern" id="pattern_id" class="form-control" style="width: 100%;">
                        <option value="">-- Select Pattern --</option>
                          @foreach ($patternArray as $pattern)
                            
                              <option value="{{ $pattern }}" @if (!empty($productData['pattern']) && $productData['pattern'] == $pattern)
                                selected=""
                              @endif>{{ $pattern }}</option>
                          @endforeach
                      </select>
                    </div>
                    {{-- fit --}}
                    <div class="form-group">
                      <label>Select Fit</label>
                      <select name="fit" id="fit_id" class="form-control" style="width: 100%;">
                        <option value="">-- Select Fit --</option>
                          @foreach ($fitArray as $fit)
                            <option value="{{ $fit }}" @if (!empty($productData['fit']) && $productData['fit'] == $fit)
                                selected=""
                            @endif>{{ $fit }}</option>
                          @endforeach
                      </select>
                    </div>
                    {{-- occassion --}}
                    <div class="form-group">
                      <label>Select Occasion</label>
                      <select name="occasion" id="occasion_id" class="form-control" style="width: 100%;">
                        <option value="">-- Select Occasion --</option>
                          @foreach ($occasionArray as $occasion)
                              <option value="{{ $occasion }}" @if (!empty($productData['occasion']) && $productData['occasion'] == $occasion)
                              selected=""
                          @endif>{{ $occasion }}</option>
                          @endforeach
                      </select>
                    </div>
                  
                </div>
              {{-- meta title --}}
              <div class="form-group">
                <label for="metaTitle">Meta Title</label>
                <textarea name="meta_title" id="" cols="10" rows="03" class="form-control">{{ !empty($productData['meta_title']) ? $productData['meta_title'] : old('meta_title')}}</textarea>
              </div>
              {{-- meta keywords --}}
              <div class="form-group">
                <label for="metaKeywords">Meta Keywords</label>
                <textarea name="meta_keywords" id="" cols="10" rows="03" class="form-control">{{ !empty($productData['meta_keywords']) ? $productData['meta_keywords'] : old('meta_keywords')}}</textarea>
              </div>

              </div>
              <!-- /.col -->
            

            </div>
            <!-- /.row -->
              <div class="form-group">
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" class="form-control" value="Yes" @if (!empty($productData['is_featured']) && $productData['is_featured'] == 'Yes')
                    checked=""
                @endif>
                <label class="form-check-label" for="is_featured">Either Product has features or not.</label>
                </div>
              </div>
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
