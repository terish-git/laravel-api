@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products List</div>
                @include('partials.message')
                <div class="card-body">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @include("products.products-pagination-data")
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-scripts')
<script src="{{asset('js/custom/products/products.js')}}"></script>
@endpush