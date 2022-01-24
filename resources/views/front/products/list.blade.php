@extends('layouts.front_layout')
@section('title','Shopping Mart online Shopping cart List')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ route('home.index') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">@php
            echo $categoryDetail['breadCrumb'];
        @endphp</li>
    </ul>
    <h3> {{ $categoryDetail['catDetails']['category_name'] }} <small class="pull-right"> <strong>[{{ count($categoryProducts) }}]</strong> products are available </small></h3>
    <hr class="soft"/>
    <p>
        {{ $categoryDetail['catDetails']['description'] }}
    </p>
    <hr class="soft"/>
    <form name="sortProducts" id="sortProducts" class="form-horizontal span6">
        <input type="hidden" name="url" id="url" value="{{ $url }}">
        <div class="control-group">
            <label class="control-label">Sort by:</label>
            <select name="sort" id="sort">
                <option value="">Featured</option>
                <option value="newest-arrivals" @if (isset($_GET['sort']) && $_GET['sort'] == 'newest-arrivals')
                    selected=''
                @endif>Newest Arrivals</option>
                <option value="product-a-z" @if (isset($_GET['sort']) && $_GET['sort'] == 'product-a-z')
                    selected=''
                @endif>Product: A - Z</option>
                <option value="product-z-a" @if (isset($_GET['sort']) && $_GET['sort'] == 'product-z-a')
                    selected=''
                @endif>Product: Z - A</option>
                <option value="price-low-to-high" @if (isset($_GET['sort']) && $_GET['sort'] == 'price-low-to-high')
                    selected=''
                @endif>Price: Low To High</option>
                <option value="price-hight-to-low" @if (isset($_GET['sort']) && $_GET['sort'] == 'price-hight-to-low')
                    selected=''
                @endif> Price: High To Low</option>
            </select>
        </div>
    </form>
    
    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="fas fa-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="fas fa-th-large"></i></span></a>
    </div>
    <br class="clr"/>
    <div class="tab-content filter_products">
    @include('front.products.ajax_product_filter')
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
    <div class="pagination">
        @if (isset($_GET['sort']) && !empty($_GET['sort']))
            {{ $categoryProducts->appends(['sort' => 'newest-arrivals'])->links() }}
        @else
        {{ $categoryProducts->links()}}
        @endif
    </div>
    <br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
@endsection