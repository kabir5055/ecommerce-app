@extends('admin.master')

@section('title')
    All Sub-Category
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
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase">Category</h6>
                            <a href="{{ route('admin.sub-category.create') }}" class="btn btn-success float-end btn-sm mb-2">Add Sub-Category</a>
                            <hr/>
                            <table class="table table-bordered table-striped table-hover">
                                <tr>
                                    <td>SL</td>
                                    <td>Category Name</td>
                                    <td>Sub-Category Name</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                                @php $i=1 @endphp
                                @foreach($sub_categories as $subcategory)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $subcategory->category_name }}</td>
                                        <td>{{ $subcategory->sub_category }}</td>
                                        <td>{{ $subcategory->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.sub-category.edit',$subcategory->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            @if($subcategory->status == 1)
                                                <a href="{{ route('admin.sub-category.show',$subcategory->id) }}" class="btn btn-success btn-sm">UnPublished</a>
                                            @else
                                                <a href="{{ route('admin.sub-category.show',$subcategory->id) }}" class="btn btn-warning btn-sm">Published</a>
                                            @endif
                                            <form action="{{ route('admin.sub-category.destroy',$subcategory->id) }}" method="post">
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
