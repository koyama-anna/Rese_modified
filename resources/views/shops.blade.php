<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>店舗一覧</title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/shops.css') }}">
</head>
<body>
    <div class="ttl">Rese</div>
    <div class="search">
        <div class="search-area"></div>
        <div class="search-genre"></div>
        <div class="search-search"></div>
    </div>

    @foreach ($shops as $shop)
    <div class="shop-card">
        <div class="shop-photo"><img src="{{$shop->photo}}" alt=""></div>
        <div class="shop-content">
            <div class="shop-name">{{$shop->name}}</div>
            <div class="tag">
                <div class="shop-area">#{{$shop->area}}</div>
                <div class="shop-genre">#{{$shop->genre}}</div>
            </div>
            <div class="btn">
                <div class="detail-btn">
                    <button type="submit" value="detail">詳しくみる</button>
                </div>
                <div class="favorite-btn">
                    ♡
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>