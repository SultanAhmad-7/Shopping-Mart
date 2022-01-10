@php
 
  $uri = Request::segment(2); 
 
@endphp


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
          <img src="{{ url('img/adm_img/admin_photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(Auth::guard('admin')->user()->name)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $uri == 'dashboard' ? "active" : ""}}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                 </a>
              </li>
          {{-- setting links --}}
          @php $settingModuleArray = ['settings', 'update-admin-detail','update-admin-password']; @endphp
          <li class="nav-item {{in_array($uri, $settingModuleArray) ? "menu-open" : ""}} menu-open">
            <a href="#" class="nav-link {{ in_array($uri, $settingModuleArray) ? "active" : ""}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/update-admin-detail') }}" class="nav-link {{ $uri == "update-admin-detail" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Admin Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/settings') }}" class="nav-link {{ $uri == "settings" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Admin Password</p>
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
                <a href="{{ route('user.list') }}" class="nav-link {{ in_array($uri, ["users", "add_user","edit_user"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('user.list') }}" class="nav-link {{$uri == "add_user" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li> --}}
            </ul>
          </li>

          {{-- Section  links Defined Here --}}
          @php 
          $sectionModuleArray = [
                                  'sections', 'section.index','create-section',
                                  'categories', 'category.lists','add-edit-category',
                                  'products', 'product.lists','add-edit-product','add-product-attributes','add-product-images',
                                  'brands'

                                ];
          @endphp
          <li class="nav-item {{ in_array( $uri, $sectionModuleArray) ? "menu-open" : ""}}">
            <a href="#" class="nav-link {{ in_array( $uri, $sectionModuleArray) ? "active" : ""}}" >
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Catalogues
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('brand.lists') }}" class="nav-link {{ in_array($uri, ["brands"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('section.index') }}" class="nav-link {{ in_array($uri, ["sections","create-section"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('category.lists') }}" class="nav-link {{ in_array($uri, ["categories","add-edit-category"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('product.lists')}}" class="nav-link {{ in_array($uri, ["products","add-edit-product","add-product-attributes","add-product-images"]) ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              
              {{-- <li class="nav-item">
                <a href="{{ route('section.add') }}" class="nav-link {{$uri == "create-section" ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Section</p>
                </a>
              </li> --}}
            </ul>
          </li>

           {{-- Category  links Defined Here --}}
           @php 
           $categoryModuleArray = ['categories', 'category.lists','add-edit-category'];
           @endphp
           {{-- <li class="nav-item {{ in_array( $uri, $categoryModuleArray) ? "menu-open" : ""}}">
             <a href="#" class="nav-link {{ in_array( $uri, $categoryModuleArray) ? "active" : ""}}" >
               <i class="nav-icon fas fa-copy"></i>
               <p>
                 Categories
                 <i class="fas fa-angle-left right"></i>
               </p>
             </a>
             <ul class="nav nav-treeview">
               <li class="nav-item">
                 <a href="{{ route('category.lists') }}" class="nav-link {{ in_array($uri, ["categories","add-edit-category"]) ? "active" : ""}}">
                   <i class="far fa-circle nav-icon"></i>
                   <p>Category List</p>
                 </a>
               </li>
               <li class="nav-item">
                <a href="{{ route('category.add') }}" class="nav-link {{ $uri == "add-edit-category"  ? "active" : ""}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
             </ul>
           </li> --}}
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
