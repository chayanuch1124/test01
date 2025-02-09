<x-bootstrap title="Products">
    <div class="row g-4">
        <div class="col-lg-8">
            <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
        </div>
        <div class="col-lg-4">
            <form method="GET" action="{{ route('product.index') }}" class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            {{-- <i class="fa fa-search"></i> --}}
                            <i class="bi bi-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-2 my-4">
        @foreach ($products as $item)
            <div class="col">
                <div class="card h-100">
                    <img src="{{ $item->photo }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('product.show', $item->id) }}">
                                {{ mb_substr($item->title, 0, 20) }} ...
                            </a>
                        </h5>
                        <p class="card-text">
                            {{ mb_substr($item->content, 0, 130) }} ...
                        </p>
                        <p class="card-text fs-3">฿{{ number_format($item->price) }} บาท</p>
                        <p class="card-text">คงเหลือ : {{ $item->stock }}</p>

                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $products->appends(['search' => request('search')])->links() }}</div>
</x-bootstrap>