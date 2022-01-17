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
            <li class="breadcrumb-item"><a href="{{ route('banner.list') }}">Home</a></li>
            <li class="breadcrumb-item active">Banner List</li>
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
          <h5><i class="icon fas fa-check"></i>Alert!</h5>
          {{ Session::get('success_msg') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Banne List</h3>
          <a href="{{ url('admin/add-edit-banner')}}" title="Create New Category" class="btn btn-primary float-right">+ Banner</a>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <table id="categoryTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>URL</th>
                <th>Title</th>
                <th>ALT</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i=1;
              @endphp
              @forelse($banners as $banner)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td> <img src="{{ asset('img/adm_img/carousel/'. $banner->image) }}" style="width: 140px" height="100px" alt=""></td>
                  <td> {{ $banner->link }}</td>
                  <td>{{ $banner->title }}</td>
                  <td>{{ $banner->alt }}</td>
                  <td> 
                    <a title="Edit Banner" href="{{ url('admin/add-edit-banner',  $banner->id ) }}" class=""><i class="fas fa-edit fa-xs"></i></a> 
                    <a title="Delete Banner" record="banner" recordid="{{ $banner->id }}" href="#" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>
                  @if($banner->status == 1)
                    <a href="javascript:void(0)" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}" class="updateBannerStatus">
                      <i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i>
                    </a>
                  @else
                    <a href="javascript:void(0)" id="banner-{{ $banner->id }}" banner_id="{{ $banner->id }}" class="updateBannerStatus">
                      <i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i>
                    </a>
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
                <th>Image</th>
                <th>URL</th>
                <th>Title</th>
                <th>ALT</th>
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