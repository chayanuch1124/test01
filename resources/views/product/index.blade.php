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

    <table class="table my-4">
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Content</th>
            <th>Price</th>
            <th>Stock</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <img src="{{ $item->photo }}" height="100" />
                </td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                    <div class="d-flex justify-content-around px-4">
                        <a class="btn btn-info" href="{{ route('product.show', $item->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('product.edit', $item->id) }}">Edit</a>

                        <form action="{{ route('product.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Confirm delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="mt-4">{{ $products->appends(['search' => request('search')])->links() }}</div>
</x-bootstrap>