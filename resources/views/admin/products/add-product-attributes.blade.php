@extends('layouts.admin_layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('product.lists') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Product Attributes</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('success_msg'))
            <div class="alert alert-success alert-dismissible mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                {{ Session::get('success_msg') }}
            </div>
            @endif

            @if (session('sku_exists_msg'))
            <div class="alert alert-danger alert-dismissible mt-1">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                {{ session('sku_exists_msg') }}
            </div>
            @endif
            <form id="productAttributeForm" name="productAttributeForm" action="{{ url('admin/add-product-attributes/'.$productData['id'])}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productData['id'] }}">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                            

                                    {{-- Product name --}}
                                    <div class="form-group">
                                        <label for="productName">Product Name:</label> &nbsp;
                                        {{ $productData['product_name'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">product Code:</label> &nbsp;
                                        {{ $productData['product_code'] }}
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">product Color:</label> &nbsp;
                                        {{ $productData['product_color'] }}
                                    </div>
                            </div>
                            <div class="col-md-4">
                                @if (! empty($productData['main_image']))
                                <img src="{{ asset('img/adm_img/admin_product/small/'. $productData['main_image']) }}"
                                    width="60%" height="80%">
                                @else
                                <img src="{{ asset('img/adm_img/admin_product/small/no-image.png') }}" width="60%"
                                    height="80%">
                                @endif

                            </div>
                        </div>
                        
                        <div class="col-md-8">

                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input id="size" name="size[]" type="text" style="width: 120px;" value="" placeholder="Size" required=""/>
                                        <input id="sku" name="sku[]" type="text" name="sku[]" style="width: 120px;" value="" placeholder="SKU" required=""/>
                                        <input id="stock" name="stock[]" type="number" name="stock[]" style="width: 120px;" value="" placeholder="Stock" required=""/>
                                        <input id="price" name="price[]" type="number" name="price[]" style="width: 120px;" value="" placeholder="Price" required=""/>
                                        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus-circle fa-x1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                {{-- submit button --}}
                <div class="card-footer">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Displaying the Product Attributes --}}
      <form action="{{ url('admin/edit-product-attributes/'. $productData['id']) }}" method="post">
        @csrf
        
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Attributes</h3>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="productTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Size</th>
                    <th>SKU</th>
                     <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                  @endphp
                  @forelse($productData['attributes'] as $attributes)
                  <input style="display: none;" type="text" name="attrId[]" value="{{ $attributes['id']}}">
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $attributes['size'] }}</td>
                      <td>{{ $attributes['sku'] }}</td>
                      <td>
                        <input type="number" name="stock[]" id="stock" value="{{ $attributes['stock'] }}" required="">
                      </td>
                      <td>
                        <input type="number" name="price[]" id="price" value="{{ $attributes['price'] }}" required="">
                      </td>
                      <td>
                      @if($attributes['status'] == 1)
                    
                         <a href="javascript:void(0)" id="attributes-{{ $attributes['id'] }}" attributes_id="{{ $attributes['id'] }}" class="updateAttributesStatus">
                          <span >Active</span>
                        </a>
                   
                    @else
                      
                        <a href="javascript:void(0)" id="attributes-{{ $attributes['id'] }}" attributes_id="{{ $attributes['id'] }}" class="updateAttributesStatus">
                              <span >Inactive</span>
                        </a>
                     
                    @endif
                    <a record="attribute" recordid="{{ $attributes['id'] }}" href="{{-- url('admin/delete-category', $category->id) --}}" class="confirmDelete"><i class="fas fa-trash fa-xs"></i></a>
                  </td>
                      <td> 
                        
                    </td>
                    </tr>
                  @empty
                     <td class="col col-lg-2"><span class="text-red text-center" style="padding-left: 50px">No Record Found</span></td>
                  @endforelse
    
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Size</th>
                    <th>SKU</th>
                     <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Update Attributes</button>
              </div>
            </div>
        </div>
      </form>
        <!-- /.card-body -->

</div>
<!-- /.card -->
<!-- /.content -->
</div>
@endsection
