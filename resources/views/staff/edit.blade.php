<x-bootstrap title="Edit Staff">
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="py-4">
                <a class="btn btn-primary" href="{{ route('staff.index') }}"> Back</a>
            </div>
        </div>
    </div> --}}

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row g-4">
            <div class="col-md-12">
                <strong>Title: <span class="text-danger">*</span> </strong>
                <input type="text" name="title" class="form-control" value="{{ $staff->title }}" required>
            </div>
            <div class="col-md-12">
                <strong>Salary: <span class="text-danger">*</span> </strong>
                <input type="number" name="salary" class="form-control" value="{{ $staff->salary }}" required>
            </div>
            <div class="col-md-12">
                <strong>Photo: </strong>
                <input type="file" name="photo" class="form-control" value="{{ $staff->photo }}" >
                <img src="{{ $staff->photo }}" height="150" />
            </div>
            <div class="col-md-12">
                <strong>Birthdate:</strong>
                <textarea class="form-control" style="height:150px" name="birthdate" > {{ $staff->birthdate }}</textarea>
            </div>
            <div class="col-md-12">
                <strong>Phone: </strong>
                <input type="number" name="phone" class="form-control" value="{{ $staff->phone }}">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>
</x-bootstrap>