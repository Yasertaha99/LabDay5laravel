<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Rules\MaxThreePosts;
use App\Rules\validPostTitle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class postsController extends Controller
{
    function __construct(){
        $this->middleware('auth:sanctum')->only(['update', 'store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::all();
        return postResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $std_validator  = Validator::make($request->all(), [
            "title" => ["required", new validPostTitle(), new MaxThreePosts()],
            "content" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
        ],[
            "name.required" => "You must select a creator.",
            "name.exists" => "The selected creator does not exist.",
            "title.required" => "A post must have a title.",
            "content.required" => "Content is required for the post.",
            "image.required" => "An image is required to create a post.",
            "image.image" => "The file must be an image.",
            "image.mimes" => "The image must be a file of type: jpeg, png, jpg.",
            "image.max" => "The image size must not exceed 2MB.",
        ]);

        if($std_validator->fails()){
            return response()->json([
                "message"=>"errors happened while storing post",
                "errors"=> $std_validator->errors()
            ], 400);
        }


        $my_path = '';
        $data = request()->all();

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('posts_images','posts_images');

        }

        $post = new Post();
        $post->creator_name =Auth::user()->name;
        $post->creator_id =Auth::id();
        $post->title = $data['title'];
        $post->create_date = Carbon::now()->toDateString();
        $post->content= $data['content'];
        $post->image= $my_path;
        $post->save();

        return new PostResource($post);



    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $std_validator  = Validator::make($request->all(), [

                 "title" => ["required", new validPostTitle()],
                 "content" => "required",
                 "image" => "nullable|image|mimes:jpeg,png,jpg|max:2048"

        ],[
            "title.required" => "A post must have a title.",
            "content.required" => "Content is required for the post.",
            "image.image" => "The file must be an image.",
            "image.mimes" => "The image must be a file of type: jpeg, png, jpg.",
            "image.max" => "The image size must not exceed 2MB.",
        ]);

        if($std_validator->fails()){
            return response()->json([
                "message"=>"errors happened while updating post",
                "errors"=> $std_validator->errors()
            ], 400);
        }

        $my_path = $post->image;
        $data = request()->all();

        if(request()->hasFile("image")){

            $image = request()->file("image");
            $my_path=$image->store('posts_images','posts_images');

        }


        $post->creator_name =Auth::user()->name;
        $post->creator_id =Auth::id();
        $post->title = $data['title'];
        $post->create_date = Carbon::now()->toDateString();
        $post->content= $data['content'];
        $post->image= $my_path;


        $post->save();

        return new PostResource($post);


    }


    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('deleted successfully ', 204);
    }
}
