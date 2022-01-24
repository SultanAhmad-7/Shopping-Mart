@php
use \App\Section;
	$sections = Section::sections();
	$sections = json_decode(json_encode($sections),true);
@endphp

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{ asset('img/front_img/ico-cart.png') }}" alt="cart">3 Items in your cart</a></div>
    @foreach ($sections as $section)
        @if (count($section['categories']) > 0)
        <ul id="sideManu" class="nav nav-tabs nav-stacked">
            <li class="subMenu"><a>{{ $section['name'] }}</a>
                @foreach ($section['categories'] as $categories)
                    <ul>
                            <li><a href="{{ route('product-list.index',$categories['url']) }}"><i class="fas fa-caret-right f0da"></i><strong>{{ $categories['category_name'] }}</strong></a></li>
                        @foreach ($categories['sub_categories'] as $subCategory)
                            <li><a href="{{ route('product-list.index', $subCategory['url']) }}"><i class="fas fa-caret-right f0da"></i>{{ $subCategory['category_name'] }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </li>
        </ul>
        @endif
    @endforeach
    <br/>
@if (isset($page_name) && $page_name == "listing")

<div class="well well-small">
    <h5>Fabric</h5>
    @foreach ($fabricArray as $fabric)
        <input class="fabric" style="margin-top: -3px;" type="checkbox" name="fabric[]" id="" value="{{ $fabric }}">&nbsp;&nbsp;{{ $fabric }}<br>
    @endforeach
</div>

<div class="well well-small">
    <h5>Sleeve</h5>
    @foreach ($sleeveArray as $sleeve)
        <input class="sleeve" style="margin-top: -3px;" type="checkbox" name="sleeve[]" id="" value="{{ $sleeve }}">&nbsp;&nbsp;{{ $sleeve }}<br>
    @endforeach
</div>

<div class="well well-small">
    <h5>Pattern</h5>
    @foreach ($patternArray as $pattern)
        <input class="pattern" style="margin-top: -3px;" type="checkbox" name="pattern[]" id="" value="{{ $pattern }}">&nbsp;&nbsp;{{ $pattern }}<br>
    @endforeach
</div>

<div class="well well-small">
    <h5>Fit</h5>
    @foreach ($fitArray as $fit)
        <input class="fit" style="margin-top: -3px;" type="checkbox" name="fit[]" id="" value="{{ $fit }}">&nbsp;&nbsp;{{ $fit }}<br>
    @endforeach
</div>

<div class="well well-small">
    <h5>Ocasion</h5>
    @foreach ($occasionArray as $occasion)
        <input class="occasion" style="margin-top: -3px;" type="checkbox" name="occasion[]" id="" value="{{ $occasion }}">&nbsp;&nbsp;{{ $occasion }}<br>
    @endforeach
</div>
@endif
    
    <div class="thumbnail">
        <img src="{{ asset('img/front_img/payment_methods.png') }}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>