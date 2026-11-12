<table class="products-table">
    <thead>
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>画像</th>
            <th>料金(¥)</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @if ($product->img_path)
                        <img
                            src="{{ asset('storage/' . $product->img_path) }}"
                            alt="{{ $product->product_name }}"
                            class="product-image"
                        >
                    @endif
                </td>
                <td>{{ number_format($product->price) }}</td>
                <td>
                    <a
                        href="{{ route('products.show', $product->id) }}"
                        class="detail-button"
                    >
                        詳細
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    商品が登録されていません。
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
