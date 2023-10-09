@extends('Layouts.master')

@section('content')
    <div class="main-content mt-5">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-md-6">
                <h4>Create Post</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                <a href="{{route('posts.index')}}" class="btn btn-success mx-1">Back</a>
                </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('posts.store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" >Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label" >Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label" >Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option> 
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label" >Description</label>
                        <textarea  id="" cols="30" rows="10" class="form-control" name="description"></textarea>    
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    
    </div>

@endsection