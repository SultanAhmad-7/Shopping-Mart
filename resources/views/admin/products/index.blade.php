@extends('layouts.admin_layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('product.lists') }}">Home</a></li>
            <li class="breadcrumb-item active">Product List</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @if(Session::has('success_msg'))
        <div class="alert alert-success alert-dismissible mt-1">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-check"></i> Alert!</h5>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Product List</h3>
          <a href="{{ url('admin/add-edit-product')}}" title="Create New Product" class="btn btn-primary float-right">+ Product</a>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="productTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Main Image</th>
                 <th>Category</th>
                <th>Section</th>
                <th>Product Code</th>
                <th>Product Color</th>
                <th>Product Discount</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i=1;
              @endphp
              @forelse($products as $product)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td><img src="{{ (empty($product->main_image)) ? url('img/adm_img/admin_product/small/no-image.png') : url('img/adm_img/admin_product/small/', $product->main_image) }}" width="80%" height="100%" style="background-color:black;"></td>
                  <td>{{ $product->category->category_name}}</td>
                   <td>{{ $product->section->name}}</td> 
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->product_discount }}</td>
                  <td>
                  @if($product->status == 1)
                  
                     <a href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus">
                      <i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i>
                    </a>
               
                @else
                  
                    <a href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus">
                      <i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i>
                    </a>
                 
                @endif
              </td>
                  <td style="width: 120px;"> 
                    <a title="Add Product Attributes" href="{{ url('admin/add-product-attributes/'.$product->id ) }}"><i class="fas fa-plus fa-xs"></i></a> <a title="Add Product Multiple Images" href="{{ url('admin/add-product-images/'.$product->id ) }}"><i class="fas fa-plus-circle fa-xs"></i></a>
                    <a title="Edit Product" href="{{ url('admin/add-edit-product',  $product->id ) }}"><i class="fas fa-edit fa-xs"></i></a> <a title="Delete Product" record="product" recordid="{{ $product->id }}" href="{{-- url('admin/delete-category', $category->id) --}}" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>
                  </td>
                </tr>
              @empty
                 <td class="col col-lg-2"><span class="text-red text-center" style="padding-left: 50px">No Record Found</span></td>
              @endforelse

            </tbody>
            <tfoot>
              <tr>
               <th>#</th>
                <th>Product Name</th>
                <th>Main Image</th>
                 <th>Category</th>
                <th>Section</th>
                <th>Product Code</th>
                <th>Product Color</th>
                <th>Product Discount</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection