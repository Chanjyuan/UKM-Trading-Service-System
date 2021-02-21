<div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
        <tr class="cart_menu">
            @if (count($userCartItems) > 0)
            <td class="image">Image</td>        
            <td class="description">Item</td>
            <td class="price">Price</td>
            <td class="type">Deal Method</td>
            <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($userCartItems as $item)
            <tr>
                <td><img width="100" src="{{ asset( 'storage/post_images/'.$item['product']['cover_image']) }}"></td>
                <td><a href="{{url('posts',$item['product']['id'])}}">{{ $item['product']['title'] }}</a></td>
                <td>RM {{ number_format($item['product']['price'], 2) }}</td>
                <td>{{ $item['product']['type'] }}</td>
                <td>
                    <div class="input-append">
                            <button class="genric-btn danger radius btnItemDelete" type="button" data-cartid="{{ $item['id'] }}"><i class="icon-remove icon-white">Remove</i></button>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
                <p>Find your favourites and start creating your own wishlist !</p><a href="/catalog" class="primary-btn">Go now</a>
            @endif
        </tbody>
    </table>
</div>


