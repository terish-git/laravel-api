@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('products.import') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="productCSV" class="col-md-4 col-form-label text-md-end">Product CSV</label>

                            <div class="col-md-6">
                                <input id="productCSV" type="file" class="form-control @error('productCSV') is-invalid @enderror" name="productCSV">
                                <small>Browse products CSV file </small> <a href="{{ url('/') }}/sample/products.csv">Download Sample File</a>
                                @error('productCSV')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
