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
                            <a href="{{ route('admin.category.create') }}" class="btn btn-success float-end btn-sm mb-2">Add Category</a>
                            <hr/>
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td>SL</td>
                                    <td>Category Name</td>
                                    <td>Image</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                @php $i=1 @endphp
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <img src="{{ asset($category->image) }}" class="img-fluid" style="height: 50px; width: 50px">
                                        </td>
                                        <td>{{ $category->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.category.edit',$category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @if($category->status == 1)
                                                <a href="{{ route('admin.category.show',$category->id) }}" class="btn btn-success btn-sm">UnPublished</a>
                                            @else
                                                <a href="{{ route('admin.category.show',$category->id) }}" class="btn btn-warning btn-sm">Published</a>
                                            @endif
                                            <form action="{{ route('admin.category.destroy',$category->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

