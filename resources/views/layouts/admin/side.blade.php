<?php
$uri = Request::segment(2);
?>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('admin_assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Be-Bak</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin_assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name)}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- User links Defined Here --}}
          @php $userModuleArray = ['users', 'edit_user','add_user']; @endphp
          <li class="nav-item {{ in_array( $uri, $userModuleArray) ? "menu-open" : ""}}">
            <a href="#" class="nav-link {{ in_array( $uri, $userModuleArray) ? "active" : ""}}" >
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.list') }}" class="nav-link {{ in_array($uri, ["users", "edit_user"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.list') }}" class="nav-link {{$uri == "add_user" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Section  links Defined Here --}}
          @php 
          $sectionModuleArray = ['sections', 'section.index','section.add'];
          @endphp
          <li class="nav-item {{ in_array( $uri, $sectionModuleArray) ? "menu-open" : ""}}">
            <a href="#" class="nav-link {{ in_array( $uri, $sectionModuleArray) ? "active" : ""}}" >
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sections
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('section.index') }}" class="nav-link {{ in_array($uri, ["sections"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Sections</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('section.add') }}" class="nav-link {{$uri == "create" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Section</p>
                </a>
              </li>
            </ul>
          </li>

           {{-- Category  links Defined Here --}}
           @php 
           $categoryModuleArray = ['categories', 'category.lists'];
           @endphp
           <li class="nav-item {{ in_array( $uri, $categoryModuleArray) ? "menu-open" : ""}}">
             <a href="#" class="nav-link {{ in_array( $uri, $categoryModuleArray) ? "active" : ""}}" >
               <i class="nav-icon fas fa-copy"></i>
               <p>
                 Categories
                 <i class="fas fa-angle-left right"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{ route('category.lists') }}" class="nav-link {{ in_array($uri, ["categories"]) ? "active" : ""}}">
                   <i class="far fa-circle nav-icon"></i>
                   <p>All Categories</p>
                 </a>
               </li>
               <li class="nav-item">
                <a href="{{ route('category.add') }}" class="nav-link {{$uri == "create" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
             </ul>
           </li>
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
