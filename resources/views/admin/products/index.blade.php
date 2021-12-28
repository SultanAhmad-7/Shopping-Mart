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
                  <td>{{ $product->category->category_name}}</td>
                   <td>{{ $product->section->name}}</td> 
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->product_discount }}</td>
                  @if($product->status == 1)
                  <td>
                     <a href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus">
                      <span class="badge rounded-pill bg-info text-dark text-sm">Active</span>
                    </a>
                  </td>
                @else
                  <td> 
                    <a href="javascript:void(0)" id="product-{{ $product->id }}" product_id="{{ $product->id }}" class="updateProductStatus">
                          <span class="badge rounded-pill bg-danger text-dark text-sm">Inactive</span>
                    </a>
                  </td>
                @endif
                  <td> 
                    <a href="{{ url('admin/add-edit-product',  $product->id ) }}" class="btn btn-info btn-sm">Edit</a> <a record="product" recordid="{{ $product->id }}" href="{{-- url('admin/delete-category', $category->id) --}}" class="btn btn-danger btn-sm confirmDelete">Delete</a></td>
                </tr>
              @empty
                 <td class="col col-lg-2"><span class="text-red text-center" style="padding-left: 50px">No Record Found</span></td>
              @endforelse

            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Product Name</th>
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