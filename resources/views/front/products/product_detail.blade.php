@php
    use App\Product;
@endphp

@extends('layouts.front_layout')
@section('title','Shopping Mart online Shopping cart List')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li><a href="{{ url('/', $productDetail['category']['url']) }}">{{ $productDetail['category']['category_name']}}</a> <span class="divider">/</span></li>
        <li class="active">{{ $productDetail['product_name']}}</li>
    </ul>
    <div class="row mt-3">
        <div id="gallery" class="span3">
            <a href="{{ empty($productDetail['main_image']) ? url('img/adm_img/admin_product/large/no-image.png') : url('img/adm_img/admin_product/large/', $productDetail['main_image']) }}" title="{{ $productDetail['product_name']}}">
                <img src="{{ empty($productDetail['main_image']) ? url('img/adm_img/admin_product/large/no-image.png') : url('img/adm_img/admin_product/large/', $productDetail['main_image']) }}" style="width:100%"
                    alt="{{ $productDetail['product_name']}}" />
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach ($productDetail['images'] as $image)
                            <a href="{{ empty($image['image']) ? url('img/adm_img/admin_product/large/no-image.png') : url('img/adm_img/admin_product/large/', $image['image']) }}"> <img style="width:29%"
                                src="{{ empty($image['image']) ? url('img/adm_img/admin_product/large/no-image.png') : url('img/adm_img/admin_product/large/', $image['image']) }}" alt="" /></a>    
                        @endforeach
                    </div>
                    
                </div>
               
                    {{-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> --}}
        
            </div>

            <div class="btn-toolbar">
                <div class="btn-group">
                    <span class="btn"><i class="fas fa-envelope"></i></span>
                    <span class="btn"><i class="fas fa-print"></i></span>
                    <span class="btn"><i class="fas fa-search-plus"></i></span>
                    <span class="btn"><i class="fas fa-star"></i></span>
                    <span class="btn"><i class="fas fa-thumbs-up"></i></span>
                    <span class="btn"><i class="fas fa-thumbs-down"></i></span>
                </div>
            </div>
        </div>
        
        <div class="span6">
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible mt-1">
                
                {{ Session::get('error_message') }}
              </div>
          @endif

          @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible mt-1">
              
              {{ Session::get('success_message') }}
            </div>
        @endif
            <h3>{{ $productDetail['product_name']}} </h3>
            <small>- {{ $productDetail['brand']['name'] }}</small>
            <hr class="soft" />
            <small>{{ $productStocks }} items in stock</small>
            <form class="form-horizontal qtyFrm" method="POST" action="{{ url('add-to-cart') }}">
                @csrf
            <input type="text" style="display: none;" value="{{ $productDetail['id'] }}" name="product_id">
            @php
             $discountPrice = Product::getDiscountPrice($productDetail['id']);
            @endphp
                <div class="control-group">
                    <h4 class="getAttrPrice">
                        @if ($discountPrice > 0)
                          <small style="width: 05px">  Rs.<del> {{ $productDetail['product_price']}} </del> </small>
                            Rs. {{ $discountPrice }}
                        @else
                            Rs. {{ $productDetail['product_price'] }}
                        @endif    
                    </h4>
                    <select name="size" id="getPrice" class="span2 pull-left" product-id="{{ $productDetail['id']}}" required>
                        <option value="">Select</option>
                        @foreach ($productDetail['attributes'] as $productAttr)
                            <option value="{{ $productAttr['size']}} " >{{ $productAttr['size'] }}</option>  
                        @endforeach
                    </select>
                    <input type="number" name="quantity" class="span1" placeholder="Qty." onkeypress="return event.charCode >= 48" min="1" max="{{ $productStocks }}"/>
                    <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i>
                    </button>
                </div>
        </div>
        </form>

        <hr class="soft clr" />
        <p class="span6">
       {{ $productDetail['description'] }}

        </p>
        <a class="btn btn-small pull-right" href="#detail">More Details</a>
        <br class="clr" />
        <a href="#" name="detail"></a>
        <hr class="soft" />
    </div>

    <div class="span9">
        <ul id="productDetail" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
            <li><a href="#profile" data-toggle="tab">Related Products</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <h4>Product Information</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr class="techSpecRow">
                            <th colspan="2">Product Details</th>
                        </tr>
                        <tr class="techSpecRow">
                            <td class="techSpecTD1">Brand: </td>
                            <td class="techSpecTD2">{{ $productDetail['brand']['name'] }}</td>
                        </tr>
                        <tr class="techSpecRow">
                            <td class="techSpecTD1">Code:</td>
                            <td class="techSpecTD2">{{ $productDetail['product_code']}}</td>
                        </tr>
                        <tr class="techSpecRow">
                            <td class="techSpecTD1">Color:</td>
                            <td class="techSpecTD2">{{ $productDetail['product_color']}}</td>
                        </tr>
                        <tr class="techSpecRow">
                            <td class="techSpecTD1">Fabric:</td>
                            <td class="techSpecTD2">{{ $productDetail['fabric']}}</td>
                        </tr>
                        <tr class="techSpecRow">
                            <td class="techSpecTD1">Pattern:</td>
                            <td class="techSpecTD2">{{ $productDetail['pattern']}}</td>
                        </tr>
                    </tbody>
                </table>

                <h5>Washcare</h5>
                <p>{{ $productDetail['wash_care'] }}</p>
                <h5>Disclaimer</h5>
                <p>
                    There may be a slight color variation between the image shown and original product.
                </p>
            </div>
            <div class="tab-pane fade" id="profile">
                <div id="myTab" class="pull-right">
                    <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i
                                class="fas fa-list"></i></span></a>
                    <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i
                                class="fas fa-th-large"></i></span></a>
                </div>
                <br class="clr" />
                <hr class="soft" />
                <div class="tab-content">
                    <div class="tab-pane" id="listView">
                        @foreach ($productRelated as $relatedProducts)
                            <div class="row">
                                <div class="span2">
                                    <img style="width:50%" src="{{ (empty($relatedProducts['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $relatedProducts['main_image']) }}" alt="{{ $relatedProducts['product_name']}}">
                                </div>
                                <div class="span4">
                                    <h3>New | Available</h3>
                                    <hr class="soft" />
                                    <h5>{{ $relatedProducts['product_name'] }} </h5>
                                    <p>
                                        {{ substr($relatedProducts['description'], 0, 30) }}
                                    </p>
                                    <a class="btn btn-small pull-right" href="{{ url('product', $relatedProducts['id']) }}">View
                                        Details</a>
                                    <br class="clr" />
                                </div>
                               
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">
                                        <h3>Rs.{{ $relatedProducts['product_price'] }}</h3>
                                        <label class="checkbox">
                                            <input type="checkbox"> Adds product to compair
                                        </label><br />
                                        <div class="btn-group">
                                            <a href="product_details.html"
                                                class="btn btn-large btn-primary"> Add to <i
                                                    class="fas fa-shopping-cart"></i></a>
                                            <a href="{{ url('product', $relatedProducts['id']) }}" class="btn btn-large"><i
                                                    class="fas fa-search-plus"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft" />
                        @endforeach
                    </div>
                    <div class="tab-pane active" id="blockView">
                        <ul class="thumbnails">
                            @foreach ($productRelated as $relatedProducts)
                            @php
                            $discountPrice = Product::getDiscountPrice($productDetail['id']);
                           @endphp
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="{{ url('product', $relatedProducts['id']) }}">
                                            <img style="width:50%" src="{{ (empty($relatedProducts['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $relatedProducts['main_image']) }}" alt="{{ $relatedProducts['product_name']}}" >
                                        </a>
                                        <div class="caption">
                                            <h5>{{ $relatedProducts['product_name']}}</h5>
                                            <p>
                                                {{ substr($relatedProducts['description'],0,30) }}
                                            </p>
                                            <h4 style="text-align:center"><a class="btn"
                                                    href="{{ url('product', $relatedProducts['id']) }}"> <i
                                                        class="fas fa-search-plus"></i></a> <a class="btn"
                                                    href="#">Add to <i class="fas fa-shopping-cart"></i></a>
                                                    @if ($discountPrice > 0)
                                                  <small> <del>{{ $relatedProducts['product_price'] }}</del> </small>
                                                    <a class="btn btn-primary" href="#">
                                                       
                                                        Rs. {{ $discountPrice }}
                                                    </a>
                                                @else
                                                <a class="btn btn-primary" href="#">
                                                   Rs. {{ $relatedProducts['product_price'] }}
                                                </a>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <hr class="soft" />
                    </div>
                </div>
                <br class="clr">
            </div>
        </div>
    </div>
</div>
<!-- MainBody End ============================= -->
@endsection