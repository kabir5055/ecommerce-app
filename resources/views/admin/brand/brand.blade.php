@extends('admin.master')

@section('title')
    DashBoard-Brand
@endsection

@section('style')
    <style>
        /*body{*/
        /*    background-color: maroon;*/
        /*}*/
    </style>
@endsection

@section('script')
    <script>
        // new PerfectScrollbar(".best-product")
        // new PerfectScrollbar(".top-sellers-list")
    </script>
@endsection

@section('content')
    <main class="page-content">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase">Brand</h6>
                            <a href="{{ route('admin.brand.index') }}" class="btn btn-success float-end btn-sm mb-2">Brand List</a>
                            <hr/>
                            <form class="row g-3" action="{{ isset($brand) ? route('admin.brand.update',$brand->id) : route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                                @if(isset($brand))
                                    @method('put')
                                @endif
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Brand-Name</label>
                                    <input type="text" name="brand_name" class="form-control" value="{{ isset($brand) ? $brand->brand_name : ' ' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if(isset($brand))
                                        <img src="{{ asset($brand->image) }}" alt="" style="height: 70px; width: 70px" class="img-fluid">
                                    @endif
                                </div>
                                @if(isset($brand))
                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <input type="radio" name="status" value="1" {{ $brand->status == 1 ? 'checked' : ' ' }}>Published
                                        <input type="radio" name="status" value="0" {{ $brand->status == 0 ? 'checked' : ' ' }}>Unpublished
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


