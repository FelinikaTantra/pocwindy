<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #3b82f6;
            margin: 0;
            font-size: 32px;
        }
        .product {
            width: 30%;
            display: inline-block;
            margin: 1%;
            box-sizing: border-box;
            border: 1px solid #eee;
            padding: 10px;
            vertical-align: top;
            text-align: center;
        }
        .product-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background-color: #f9f9f9;
        }
        .product-title {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-category {
            font-size: 12px;
            color: #777;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 18px;
            color: #d97706;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 20px;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Katalog Produk</h1>
        <p>E-Catalog Collection - {{ date('F Y') }}</p>
    </div>

    <div style="width: 100%;">
        @foreach($products as $product)
        <div class="product">
            @if($product->images->count() > 0)
                <?php $imagePath = storage_path('app/public/' . $product->images->first()->image_path); ?>
                @if(file_exists($imagePath))
                    <img src="{{ $imagePath }}" class="product-image">
                @else
                    <div class="product-image" style="line-height: 150px; color: #aaa;">Image Missing</div>
                @endif
            @else
                <div class="product-image" style="line-height: 150px; color: #aaa;">No Image</div>
            @endif
            
            <div class="product-title">{{ $product->name }}</div>
            <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    <div class="footer">
        Dicetak pada {{ date('d M Y H:i') }} - E-Catalog
    </div>
</body>
</html>
