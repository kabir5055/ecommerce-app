@extends('admin.master')
@section('title')
    All Product
@endsection
@section('style')
    <style>

    </style>
@endsection
@section('script')
    <script>

    </script>
@endsection
@section('content')
    <main class="page-content">
        <section class="add-category">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-0 text-uppercase">Product Form</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('admin.product.create') }}" class="btn btn-success float-end">Add Product</a>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div>
                                        <table id="example2" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>sl</th>
                                                <th>product name</th>
                                                <th>product code</th>
                                                <th>product price</th>
                                                <th>product dis_amount</th>
                                                <th>product dis_price</th>
                                                <th>product image</th>
                                                <th>supplier_id</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=1 @endphp
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{  $product->product_name }}</td>
                                                    <td>{{  $product->product_code }}</td>
                                                    <td>{{  $product->price }}</td>
                                                    <td>{{  $product->dis_amount }}</td>
                                                    <td>{{  $product->dis_price }}</td>
                                                    <td>
                                                        <img src="{{ asset($product->main_image) }}" class="img-fluid" style="height: 70px;width: 70px" alt="">
                                                    </td>
                                                    <td>{{ $product->getSupplierName->supplier_name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-sm btn-primary"> Edit</a>
{{--                                                        <form action="{{ route('admin.product.destroy') }}" method="">--}}

{{--                                                        </form>--}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
