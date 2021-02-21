@extends('layouts.apps')

@section('title')
    Wishlist | UKM Trading & Service System
@endsection

@section('content')

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Wishlist</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area">
        @include('inc.messages')
        <div class="container">
            <div id="AppendCartItems">
                @include('posts.cart_items')
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btnItemDelete', function() {
                var cartid = $(this).data('cartid');
                //alert(cartid);return false;
                var result = confirm("Are you sure to remove this item?");
                if (result) {
                    $.ajax({
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "cartid":cartid
                        },
                        url: '/delete-cart-item',
                        type: 'post',
                        success:function(resp) {
                            $("#AppendCartItems").html(resp.view);
                        }, 
                        error:function() {
                            alert("Error");
                        }
                    });
                }
            });
        });
    </script>
@endsection
@section('scripts')
@endsection