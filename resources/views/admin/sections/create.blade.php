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
              <li class="breadcrumb-item active">Add New Sections</li>
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
              <h3 class="card-title">Add New Sections</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form action="{{ route('section.store') }}" method="post">
              <div class="form-group">
                <label for="sectionName">Name</label>
                <input type="text" name="name" id="" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
            <!-- /.card-body -->
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
