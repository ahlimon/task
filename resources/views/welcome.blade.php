@extends('layouts/master')
@section('contents')
            <h2>Categories
                <a href="javascript:void(0);" class="btn btn-info m-2 float-right" data-toggle="modal" data-target="#category-add"><i class="mdi mdi-plus-circle mr-2"></i> {{__('Add Category')}}</a>
            </h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Sub-Categories</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>
                            <ol>
                                @if($category->sub_categories!='[null]' && $category->sub_categories!='null') @forelse(json_decode($category->sub_categories) as $subCategory)
                                <li>{{$subCategory}}</li>
                                @empty
                                <li class="text-danger">No Sub-categories found</li>
                                @endforelse @else
                                <span class="text-danger">No Sub-categories found</span> @endif
                            </ol>
                        </td>
                        <td>{{\Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                        <td>{{$category->created_at!=''?date('d M, Y',strtotime($category->updated_at)):''}}</td>
                        <td>{{$category->deleted_at!=''?date('d M, Y',strtotime($category->deleted_at)):''}}</td>
                        <td>
                            <a href="{{ route('crud.categories.edit',$category->id) }}" class="btn btn-icon btn-sm btn-primary action-icon float-left m-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form class="action-icon" action="{{ route('crud.categories.destroy', $category->id) }}" method="POST">
                                @method('DELETE') @csrf
                                <button type="submit" onclick="return confirm('Are you sure to delete the Category and related subcategories?')" class="btn btn-icon m-1 btn-sm btn-danger action-icon">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-danger">No Categories Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
    <!-- category add modal -->
    <div id="category-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('crud.categories.store')}}" method="post" class="pl-3 pr-3">
                        @csrf
                        <div class="form-group">
                            <label class="text-dark" for="">{{__('Category Name')}}</label>
                            <input class="form-control" name="name" type="text" value="" id="" required="" placeholder="{{__('Write category name here')}}" required>
                        </div>
                        <hr>

                        <div class="form-group" id="subCategory-fields">
                            <label class="text-dark" for="">{{__('Subcategories')}}</label>
                            <input class="form-control mt-1" name="sub_categories[]" type="text" value="" id="subCategory-field" placeholder="{{__('Write SubCategory name here')}}">
                        </div>

                        <button type="button" id="add-subCategory" class="btn btn-icon btn-info btn-sm"> <i class="mdi mdi-plus"></i>{{__('New SubCategory')}}</button>

                        <div class="form-group text-center">
                            <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">{{__('Add Category')}}</button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('extra-scripts')
    <script>
        $('#add-subCategory').click(function() {
            $("#subCategory-field").clone().appendTo("#subCategory-fields").val('');
        });
    </script>
@endsection
