@extends('admin.master')

@section('title')
    DashBoard-Sub-Category
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
                            <h6 class="mb-0 text-uppercase">Sub-Category</h6>
                            <a href="{{ route('admin.sub-category.index') }}" class="btn btn-success float-end btn-sm mb-2">Sub Category List</a>
                            <hr/>
                            <form class="row g-3" action="{{ isset($sub_category) ? route('admin.sub-category.update',$sub_category->id) : route('admin.sub-category.store') }}" method="post" enctype="multipart/form-data">
                                @if(isset($sub_category))
                                    @method('put')
                                @endif
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Sub-Category Name</label>
                                    <input type="text" name="sub_category" class="form-control" value="{{ isset($sub_category) ? $sub_category->sub_category : ' ' }}">
                                </div>
                                @if(isset($sub_category))
                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <input type="radio" name="status" value="1"{{ $sub_category->status == 1 ? 'checked' : '' }}>Published
                                        <input type="radio" name="status" value="0"{{ $sub_category->status == 0 ? 'checked' : '' }}>Unpublished
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


