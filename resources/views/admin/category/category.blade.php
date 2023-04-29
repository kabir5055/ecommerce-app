@extends('admin.master')

@section('title')
    DashBoard-Category
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
                            <h6 class="mb-0 text-uppercase">Category</h6>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-success float-end btn-sm mb-2">Category List</a>
                            <hr/>
                            <form class="row g-3" action="{{ isset($category) ? route('admin.category.update',$category->id) : route( 'admin.category.store') }}" method="post" enctype="multipart/form-data">
                                @if(isset($category))
                                    @method('put')
                                @endif
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="category_name" value="{{ isset($category) ? $category->category_name : ' ' }}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if(isset($category))
                                        <img src="{{ asset($category->image) }}" style="height: 70px;width: 70px" class="img-fluid" alt="">
                                    @endif
                                </div>
                                @if(isset($category))
                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <input type="radio" name="status" value="1" {{ $category->status == 1 ? 'checked' : '' }}>Published
                                        <input type="radio" name="status" value="0" {{ $category->status == 0 ? 'checked' : '' }}>Unpublished
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

