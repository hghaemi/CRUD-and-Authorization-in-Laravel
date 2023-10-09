@extends('Layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-md-6">
                <h4>All Posts</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                <a href="{{route('posts.index')}}" class="btn btn-dark mx-1">Back</a>
                </div>
                </div>
            </div>
    
            <div class="card-body">
                <table class="table table-striped table-bordered border-dark">
                    <thead style="background: #f2f2f2">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">Image</th>
                            <th scope="col" style="width: 20%">Title</th>
                            <th scope="col" style="width: 30%">Description</th>
                            <th scope="col" style="width: 10%">Category</th>
                            <th scope="col" style="width: 10%">Publish Date</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($posts as $post)  
                    
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>
                                <img src="{{asset($post->image)}}" alt="" width="80">
                            </td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{date('d-m-Y' , strtotime($post->created_at))}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="{{route('posts.restore' , $post->id)}}" class="btn-sm btn-success btn">Restore</a>
                                <form action="{{route('posts.fdelete' , $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger btn">Delete</button>
                                </form>
                                </div>
                            </td>


                        </tr>
                    @endforeach    
                    </tbody>
                    

                </table>
            </div>
        </div>
    
    </div>

@endsection