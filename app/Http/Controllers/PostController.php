<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        $posts = Post::orderBy('id' , 'desc')->paginate(4);
        return view('index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $this->authorize('create' , Post::class);
        $categories = Category::all();
        return view('create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   $post = new Post() ;


        $this->authorize('create' , $post);

        $request->validate([

            'image' => ['required' , 'max:2028' , 'image'],
            'title' => ['required' , 'max:255'],
            'category_id' => ['required' , 'integer'],
            'description' => ['required']

        ]);
        

        $fileName = time().'-'.$request->image->getClientOriginalName();
        $filePath = $request->image->storeAs('uploads' , $fileName);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->image = 'storage/'.$filePath;
        $post->save();
        
        return redirect()->route('posts.index');

    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   $post = Post::findOrFail($id);

        $this->authorize('update' , $post);
        
        $categories = Category::all();
        
        return view('edit' , compact('post' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   $post = Post::findOrFail($id);
        $this->authorize('update' , $post);

        $request->validate([
            'title' => ['required' , 'max:255'],
            'category_id' => ['required' , 'integer'],
            'description' => ['required']

        ]);
       
        if($request->hasFile('image')){
            $request->validate(['image' => ['required' , 'max:2028' , 'image']]);
            File::delete(public_path($post->image));
            $fileName = time().'-'.$request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads' , $fileName);
            $post->image = 'storage/'.'app/'.'public/'.$filePath;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        $post->save();
        
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   $post = Post::findOrFail($id);
        $this->authorize('delete' , $post);
        
        $post->delete();

        return redirect()->back();
        
    }

    public function trash(){
        
        $posts = Post::onlyTrashed()->get();

        return view('trashed' , compact('posts'));
    }

    public function restore($id){

        $post = Post::withTrashed()->findOrFail($id);

        $this->authorize('restore',$post);

        $post->restore();

        return redirect()->back();
    }

    public function fdelete($id){


        $post = Post::onlyTrashed()->findOrFail($id);

        $this->authorize('delete' , $post);

        File::delete(public_path($post->image));

        $post->forceDelete();
        
        return redirect()->back();
    }

    public function download($id){
        $img = Post::findOrFail($id);
        $picture = $img->image;

        return response()->download($picture);
    }
}
