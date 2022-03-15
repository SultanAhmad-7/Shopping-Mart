@php
use App\Product;

@endphp
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Description</th>
            <th>Quantity/Update</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalPrice = 0;
        @endphp
        @foreach ($carts as $cartItems)
        @php
        $attrPrice = Product::getAttrDiscountPrice($cartItems['product_id'],$cartItems['size']);
        @endphp
        <tr>
            <td> <img width="60"
                    src="{{ empty($cartItems['product']['main_image']) ? url('/front/adm_image/adm_product/small/no-image.png') : url('/img/adm_img/admin_product/small', $cartItems['product']['main_image']) }}"
                    alt="" /></td>
            <td>{{ $cartItems['product']['product_name']}} &nbsp; [{{ $cartItems['product']['product_code']}}]
                <br />Color : {{ $cartItems['product']['product_color']}}
                <br />Size : {{ $cartItems['size']}}
            </td>
            <td>
                <div class="input-append">
                    <input class="span1" style="max-width:34px" value="{{ $cartItems['quantity']}}"
                        id="appendedInputButtons" size="16" type="text">
                    <button class="btn btnItemUpdate qtyMinus" data-cartid="{{ $cartItems['id'] }}" type="button"><i
                            class="fas fa-minus"></i></button>
                    <button class="btn btnItemUpdate qtyPlus" data-cartid="{{ $cartItems['id'] }}" type="button"><i
                            class="fas fa-plus"></i></button>
                    <button class="btn btn-danger btnItemDelete" data-cartid="{{ $cartItems['id'] }}" type="button"><i
                            class="fas fa-times icon-white"></i></button> </div>
            </td>
            <td>Rs.{{ $attrPrice['product_price'] }}</td>
            <td>Rs.{{ $attrPrice['discount'] }}</td>

            <td>Rs.{{ $attrPrice['final_price'] * $cartItems['quantity'] }}</td>
        </tr>
        @php

        $totalPrice = $totalPrice + ($attrPrice['final_price'] * $cartItems['quantity']);
        @endphp
        @endforeach


        <tr>
            <td colspan="6" style="text-align:right">Sub Total Price: </td>
            <td> Rs. {{ $totalPrice }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">Voucher Discount: </td>
            <td> Rs.0.00</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right"><strong>Grand TOTAL (Rs.{{ $totalPrice }} - Rs.0) =</strong>
            </td>
            <td class="label label-important" style="display:block"> <strong> Rs.{{ $totalPrice }} </strong></td>
        </tr>
    </tbody>
</table>
