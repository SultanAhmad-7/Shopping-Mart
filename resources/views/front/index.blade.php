@extends('layouts.front_layout')
@section('title','Shopping Mart online Shopping cart')
    
@section('content')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{ $productFeaturedCount }}+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured"  @if ($productFeaturedCount > 4) class="carousel slide" @endif>
                <div class="carousel-inner">
                    @foreach ($productFeaturedChunk as $key => $featuredItems)
                    <div class="item @if ($key==1) active @endif">
                        <ul class="thumbnails">
                        @foreach ($featuredItems as $item)
                            
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="{{ url('product', $item['id']) }}">
                                        @php
                                            $path = '/img/admin_img/admin_product/small/'.$item['main_image']
                                        @endphp
                                        <img src="{{ (empty($item['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $item['main_image']) }}">
                                    </a>
                                    <div class="caption">
                                        <h5>{{ $item['product_name'] }}</h5>
                                        <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Rs.{{ $item['product_price'] }}</span></h4>
                                    </div>
                                </div>
                            </li>
                        
                        @endforeach
                        </ul>
                       
                    </div>    
                    @endforeach
                    
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach ($productLatest as $latest)        
            <li class="span3">
                <div class="thumbnail">
                @php
                    $path = 'img/admin_img/admin_product/small/'.$latest['main_image']
                @endphp
                    <a  href="{{ url('product', $latest['id'])}}"><img style="width: 170px;" src="{{ (empty($latest['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $latest['main_image']) }}"></a>
                    <div class="caption">
                        <h5>{{ $latest['product_name'] }}</h5>
                        <p>
                            {{ $latest['product_code'] }} - {{ $latest['product_color']}}
                        </p>
                        
                        <h4 style="text-align:center"><a class="btn" href="{{ url('product', $latest['id'])}}"><i class="fas fa-search-plus"></i></a> <a class="btn" href="#">Add to <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{ $latest['product_price']}}</a></h4>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection