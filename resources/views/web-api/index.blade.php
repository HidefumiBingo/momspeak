<h2 class="text-center mb-3">楽天市場【絵本】</h2>

    @foreach($items as $item)
        <div class="card mx-auto" style="width: 15rem;">
          <img src="{{ $item['mediumImageUrls'] }}" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title fs-6">{{ $item['itemName'] }}</p>
            <p class="card-text">{{ $item['itemPrice'] }}円</p>
            <a href="{{ $item['itemUrl'] }}" class="btn btn-primary">購入画面</a>
          </div>
        </div>
    @endforeach
