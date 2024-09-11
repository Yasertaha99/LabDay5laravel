<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests\createPostRequest;
use App\Http\Requests\updatePostRequest;

use Illuminate\Support\Facades\Auth;


class postsController extends Controller
{


    function __construct(){
        $this->middleware("auth")->only('create');
    }


    public function index()
    {
            return view("home");

    }

    public function main()
    {
        $posts = Post::all();
            return view("main", ["posts"=>$posts]);

    }


    public function showDetails()
    {
        $posts = Post::withTrashed()->paginate(1);
        return view('show', ['posts' => $posts]);
    }
    public function create()
    {

        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'You need to be logged in to create a post.');
        // }

        $users = User::all();
        return view('create_post', compact('users'));


    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);

        $post->restore();
        return to_route("posts.details")->with('success', 'Post restored successfully.');


    }


    public function store(Request $request)
    {
        // dd($request);

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
        return  to_route("posts.details");


    }


    public function show(Post $post)
    {


        return view("get_post", ["post"=>$post ]);

    }


    public function edit(Post $post)
    {
        $users = User::all();
        // return view("edit_post", ["post"=>$post , "users"=> $users]);

        if (Auth::id() == $post->creator_id){
            return view("edit_post", ["post"=>$post , "users"=> $users]);

        }else{
            return redirect()->route('posts.details')
            ->with('error', 'You are not authorized to edit this post it is not yours.');        }

    }




    public function update(Request $request, Post $post)
    {


       // here i how we can validate the authrixation of the user making this update
        #################### using the gate ###################################
        ## 1: here using allows which returns a true or false value
//        if (Gate::allows('update-post', $post))




    ## 2: here this method is used to It either allows the action to
        # proceed or throws a 403 Forbidden exception if the user is not authorized.
        # It doesn't return true or false like Gate::allows().
//        $this->authorize('update-post', $post);


###################### or we can ###########################################
    //        if (Gate::allows('update-post', $post)) {
//            if (Gate::denies('update-post', $post)) {
//                if (Gate::check(['update-post', 'delete-post'], $post)) {
//                    if (Gate::any(['update-post', 'delete-post'], $post)) {
//                        if (Gate::none(['update-post', 'delete-post'], $post)) {


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

        return  to_route("posts.details");


    }


    public function destroy(Post $post)
    {
        if (auth()->user()->can('delete', $post )){
            $post->delete();
            return  to_route("posts.details");
        }else{
            return redirect()->route('posts.details')->with('error', 'You are not authorized to delete this post.');
        }

    }
}
