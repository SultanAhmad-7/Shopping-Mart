
    <div class="tab-pane" id="listView">
        @foreach ($categoryProducts as $product)
     
        <div class="row">
            <div class="span2">
                <img style="width: 170px;" src="{{ (empty($product['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $product['main_image']) }}" alt="{{ $product['product_name'] }}">
            </div>
            <div class="span4">
                <h3>{{ $product['brand']['name']}}</h3>
                <hr class="soft"/>
                <h5>{{ $product['product_name'] }}</h5>
                <p>
                    {{ substr($product['description'],0,30) }}
                </p>
                <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                <br class="clr"/>
            </div>
            <div class="span3 alignR">
                <form class="form-horizontal qtyFrm">
                    <h3> ${{ $product['product_name']}}</h3>
                  
                    <label class="checkbox">
                        <input type="checkbox">  Adds product to compair
                    </label><br/>
                    
                    <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                    <a href="product_details.html" class="btn btn-large"><i class="fas fa-search-plus"></i></a>
                    
                </form>
            </div>
        </div>
        <hr class="soft"/> 
        @endforeach
    </div>
    <div class="tab-pane  active" id="blockView">
        <ul class="thumbnails">
            @foreach ($categoryProducts as $product)
            <li class="span3">
                <div class="thumbnail">
                    <a  href="product_details.html"><img style="width: 170px;" src="{{ (empty($product['main_image'])) ? asset('img/adm_img/admin_product/small/no-image.png') : asset('img/adm_img/admin_product/small/'. $product['main_image']) }}"></a>
                    <div class="caption">
                        <h5>{{ $product['product_name'] }}</h5>
                        <p>
                            {{ $product['brand']['name']}}
                        </p>
                        <h4 style="text-align:center"><a class="btn" href="product_details.html"><i class="fas fa-search-plus"></i></a> <a class="btn" href="#">Add to <i class="fas fa-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.{{ $product['product_price'] }}</a></h4>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <hr class="soft"/>
    </div>
