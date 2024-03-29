@extends('include_client.main')
@section('titre')
    Cart
@endsection

@section('contenu')
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/shop')}}">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->
@if (Session::has('status'))
<div class="alert alert-success">
    {{Session::get('status')}}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">


                        <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (Session::has('cart'))
                            @foreach (Session::get('topCart') as $item)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('storage/products_img/'.$item["product_image"])}}" alt="" />
                                    </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                        {{$item["product_name"]}}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    <p>$ {{number_format($item["product_price"], 1)}}</p>
                                </td>
                                <td class="quantity-box"><form method="POST" action="{{url('cart/updateqty/'.$item['product_id'])}}">
                                    @method('PUT') @csrf
                                    <input type="number" name='qty' size="4" value="{{$item["qty"]}}" min="0" step="1" class="c-input-text qty text"><br><input type="submit" class="btn btn-dark" value="Update"></form></td>
                                <td class="total-pr">
                                    <p>$ {{$item["product_price"] * $item["qty"]}}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{url('cart/removeitem/'.$item['product_id'])}}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
                <div class="coupon-box">
                    <div class="input-group input-group-sm">
                        <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                        <div class="input-group-append">
                            <button class="btn btn-theme" type="button">Apply Coupon</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> $ {{number_format(Session::has('cart') ? Session::get('cart')->totalPrice : 0, 1)}} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Coupon Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto font-weight-bold"> $ 0 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold"> Free </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ {{number_format(Session::has('cart') ? Session::get('cart')->totalPrice : 0, 1)}} </div>
                    </div>
                    <hr> </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{url('/checkout')}}" class="ml-auto btn hvr-hover ">Checkout</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->
@endsection
