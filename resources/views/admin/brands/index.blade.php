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
              <li class="breadcrumb-item"><a href="{{ route('brand.lists') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       @if(session('success_msg'))
        <div class="alert alert-success alert-dismissible mt-1">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-check"></i> Alert!</h5>
          {{ session('success_msg') }}
        </div>
      @endif
        <div class="card">
            <div class="card-header">
              
                <h3 class="card-title">{{ $title }}</h3>
                <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-primary btn-sm float-right mr-1"><i class="fas fa-plus"></i> Add Brand</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Brand Name</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                    <tr>
                      <td>{{ $brand->id}}</td>
                      <td>{{ $brand->name }}</td>
                      <td>
                        <a title="Edit Brand" href="{{ url('admin/add-edit-brand/'. $brand->id ) }}"><i class="fas fa-edit fa-xs"></i></a>&nbsp; <a title="Delete Brand" record="brand" recordid="{{ $brand->id }}" href="{{-- url('admin/delete-category', $category->id) --}}" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>&nbsp;
                        @if ($brand->status == 1)
                         <a href="javascript:void(0)" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" class="updateBrandStatus"><i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i></a>
                        @else
                           <a href="javascript:void(0)" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}" class="updateBrandStatus"><i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i></a>
                        @endif
                        
                      </td>
                    </tr>
                    @empty
                    <p class="alert alert-warning">No Record Found</p>
                    @endforelse

                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Brand Name</th>
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
