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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Sections</li>
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
              <h3 class="card-title">All Sections</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Section Name</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($sections as $section)
                    <tr>
                      <td>{{ $section->id}}</td>
                      <td>{{ $section->name }}</td>
                      <td>
                       @if ($section->status == 1)
                        <a href="javascript:void(0)" id="section-{{$section->id}}" section_id="{{$section->id}}" class="updateSectionStatus"><i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i></a>
                       @else
                          <a href="javascript:void(0)" id="section-{{$section->id}}" section_id="{{$section->id}}" class="updateSectionStatus"><i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i></a>
                       @endif
                       <a title="Delete Section" record="section" recordid="{{ $section->id }}" href="{{-- url('admin/delete-category', $category->id) --}}" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>
                      </td>
                    </tr>
                    @empty
                    <p class="alert alert-warning">No Record Found</p>
                    @endforelse

                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Section Name</th>
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
