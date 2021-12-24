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
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($sections as $section)
                    <tr>
                        <td>{{ $section->id}}</td>
                        <td>{{ $section->name }}</td>
                        @if ($section->status == 1)
                        <td> <a href="javascript:void(0)" id="section-{{$section->id}}" section_id="{{$section->id}}" class="updateSectionStatus"><span  class="badge rounded-pill bg-info text-dark text-sm">Active</span></a></td>
                        @else
                        <td> <a href="javascript:void(0)" id="section-{{$section->id}}" section_id="{{$section->id}}" class="updateSectionStatus"><span  class="badge rounded-pill bg-danger text-dark text-sm">Inactive</span></a></td>
                        @endif

                        <td> <a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                      </tr>
                    @empty
                    <p class="alert alert-warning">No Record Found</p>
                    @endforelse

                </tbody>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Section Name</th>
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
