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
            <li class="breadcrumb-item"><a href="{{ route('category.lists') }}">Home</a></li>
            <li class="breadcrumb-item active">Category List</li>
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
          <h3 class="card-title">Category List</h3>
          <a href="{{ url('admin/add-edit-category')}}" title="Create New Category" class="btn btn-primary float-right">+ Category</a>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="categoryTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Parent Category</th>
                <th>Section</th>
                <th>URL</th>
                <th>Category Discount</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i=1;
              @endphp
              @forelse($categories as $category)
                @if(!isset($category->parentCategory->category_name))
                  @php
                    $parent_category = "Root";
                  @endphp
                @else
                  @php
                    $parent_category = $category->parentCategory->category_name;

                  @endphp
                @endif
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $category->category_name }}</td>
                  <td> {{ $parent_category }}</td>
                  <td>{{ $category->sections->name }}</td>
                  <td>{{ $category->url }}</td>
                  <td>{{ $category->category_discount }}</td>
                  <td> 
                  @if($category->status == 1)
                   <a href="javascript:void(0)" id="category-{{ $category->id }}"
                        category_id="{{ $category->id }}" class="updateCategoryStatus">
                        <i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i>
                    </a>
                  @else
                    <a href="javascript:void(0)" id="category-{{ $category->id }}"
                        category_id="{{ $category->id }}" class="updateCategoryStatus">
                        <i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i>
                      </a>
                  @endif
                </td>
                  <td> 
                    <a title="Edit Category" href="{{ url('admin/add-edit-category',  $category->id ) }}" class=""><i class="fas fa-edit fa-xs"></i></a> 
                      <a title="Delete Category" record="category" recordid="{{ $category->id }}" href="#" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
              @empty
                <p class="alert alert-warning">No Record Found</p>
              @endforelse

            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Parent Category</th>
                <th>Section</th>
                <th>URL</th>
                <th>Category Discount</th>
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