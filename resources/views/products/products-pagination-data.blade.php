@foreach ($products as $product)
<tr>
    <td>{{ ++$loop->index }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->sku }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->description }}</td>
    <td class="text-center">
        <a class='btn btn-info btn-xs' href="{{ route('products.edit',$product->id) }}"> Edit </a>  
        <a class='btn btn-danger btn-xs delete-product' data-id="{{$product->id}}" href="javascript:"> Delete </a> 
    </td>
</tr>
@endforeach
<tr>
    <td colspan="6" align="center">
        {{ $products->links() }}
    </td>
</tr>