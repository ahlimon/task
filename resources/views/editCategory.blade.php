@extends('layouts/master')
@section('contents')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">

                      <form action="{{ route('crud.categories.update',$category->id)}}" method="post" class="pl-3 pr-3">
                        @csrf
                        @method('PUT')
                          <div class="form-group">
                              <label for="">Category Name</label>
                              <input class="form-control" name="name" type="text" value="{{$category->name}}" id="" required="" placeholder="Write Category name here" required>
                          </div><hr>
                          <div class="form-group"  id="subCategory-fields">
                              <label for="emailaddress1">SubCategories</label>
                              @forelse(json_decode($category->sub_categories) as $subCategory)
                              <div class="row" id="subCategory-field">
                                <input class="form-control col-10 mt-1" name="sub_categories[]" type="text" value="{{$subCategory}}" placeholder="Write SubCategory name here" required>
                                <div class="col-2"><button class="btn btn-danger removeSubCategory" type="button">x</button></div>
                              </div>
                              @empty
                              <p class="text-danger">No SubCategory is added yet under this Category.</p>
                              @endforelse
                          </div>
                          <button type="button" id="add-subCategory" class="btn btn-icon btn-info btn-sm"> <i class="mdi mdi-plus"></i> New SubCategory</button>

                          <div class="form-group text-center">
                          <button class="btn btn-rounded btn-primary btn-block mt-4" type="submit">Update Category</button>
                          </div>
                      </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('extra-scripts')
  <script>
    $('#add-subCategory').click(function(){
       $("#subCategory-field").clone(true).appendTo("#subCategory-fields").find('input').val('');
    });
    $('.removeSubCategory').click(function(){
      $(this).parent().parent().remove();
    });
  </script>
@endsection
