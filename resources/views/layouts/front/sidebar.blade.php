<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{ asset('img/front_img/ico-cart.png') }}" alt="cart">3 Items in your cart</a></div>
    @foreach ($sections as $section)
        @if (count($section['categories']) > 0)
        <ul id="sideManu" class="nav nav-tabs nav-stacked">
            <li class="subMenu"><a>{{ $section['name'] }}</a>
                @foreach ($section['categories'] as $categories)
                    <ul>
                            <li><a href="products.html"><i class="fas fa-caret-right f0da"></i><strong>{{ $categories['category_name'] }}</strong></a></li>
                        @foreach ($categories['sub_categories'] as $subCategory)
                            <li><a href="products.html"><i class="fas fa-caret-right f0da"></i>{{ $subCategory['category_name'] }}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </li>
        </ul>
        @endif
    @endforeach
    
   
    <br/>
    <div class="thumbnail">
        <img src="{{ asset('img/front_img/payment_methods.png') }}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>