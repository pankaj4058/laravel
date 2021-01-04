<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\posts;
use App\Models\comments;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Requests\PostFormRequest;
use File;

class PostController extends Controller
{
    //fetch 5 posts from database which are active or latest
    public function index(){
        //die('POstController');
        $data['posts'] = posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
        // $post = posts::where('active',1)->orderBy('created_at','desc');
        // $data['category'] = Category::where('id',$post->category_id);

        $data['title'] = 'Latest Posts';
        //return home.blade.php template from resources/views folder
        return view('home',$data);
    }

    public function create(Request $request){

        $categories = Category::with('children')->whereNull('parent_id')->get();

        if ($request->user()->can_post()) {
            return view('posts.create')->with(['categories' => $categories]);
        }else{
            return redirect('/')->withErrors('You have not sufficient permissions for writing post');
        }
    }

    public function store(PostFormRequest $request){
        // print_r($request->category_id);
        // die;
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
            'category_id' => 'required|numeric',
        ]);
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        $post = new posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->category_id = $request->category_id;

        $post->slug = Str::slug($post->title);
        $post->image = '/public/images'.'/'.$input['imagename'];

        $duplicate = posts::where('slug',$post->slug)->first();
        if ($duplicate) {
            return redirect('new-post')->withErrors('Title Already Used')->withInput();
        }

        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
            $post->active = 0;
            $message = 'POst saves succesfully';
        }else{
            $post->active = 1;
            $message = 'POst Publish succesfully';
        }
        // }echo"<pre>";
        // print_r($category);
        // die;
        // echo"<pre>";
        // print_r($post);
        // die;
        $post->save();
        return redirect('/home')->with('message',$message);
        // return redirect('edit/',$post->slug)->withMessage($message);

    }

    public function show($slug){

        $data['post'] = posts::where('slug',$slug)->first();

        if (!$data) {
            return redirect('/')->withErrors('Requested page not found');
        }
        $data['comments'] = $data['post']->comments;
        return view('posts.show',$data);
    }
    public function edit(Request $request,$slug)
    {
        $data['categories'] = Category::with('children')->whereNull('parent_id')->get();
        $data['post'] = posts::where('slug',$slug)->first();
        if ($data['post'] && ($request->user()->id == $data['post']->author_id || $request->user()->is_admin())) {
           return view('posts.edit',$data);
        }
        return redirect('/')->withErrors('you have not sucficient permission');
    }

    public function update(Request $request)
    {
        //die('fghjkl');
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            //  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
            'category_id' => 'required|numeric',
        ]);


            $post_id = $request->input('post_id');
            $post = posts::find($post_id);
            if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
               // die('if update');
               if ($request->file('image')) {
                $image = $request->file('image');
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $input['imagename']);
                $post->image = '/public/images'.'/'.$input['imagename'];
            }
                $title = $request->input('title');
                $slug = Str::slug($title);
                $duplicate = posts::where('slug',$slug)->first();
                if ($duplicate) {
                    if ($duplicate->id != $post_id) {
                        //die('vhjkld');
                        return redirect('edit/'.$post->slug)->withErrors('Title Already Exists')->withInput();
                    }else{
                        $post->slug = $slug;

                    }
                }
                $post->title = $title;
                $post->body = $request->input('body');

                $post->category_id = $request->category_id;
                if ($request->has('save')) {
                    $post->active = 0;
                    $message = 'Post save succesfully';
                    $landing = 'edit/'.$post->slug;
                }else{
                    $post->active = 1;
                    $message = 'Post Update succesfully';
                    $landing = $post->slug;
                }
                $post->save();
                return redirect($landing)->withMessage($message);
            }
            else{
                return redirect('/')->withErrors('you have not sufficient permissions');
            }
    }

    public function destroy(Request $request,$id)
    {
       $post = posts::find($id);
       if ($post && ($request->user()->id == $post->author_id || $request->user()->is_admin())) {
           $post->delete();
           $data['message'] = 'POst Deleted succesfully';
       }else{
           $data['errors'] = 'you have not suficient permission';
       }
       return redirect('/')->with($data);
    }

    public function imgdelete(Request $request,$id,$author_id)
    {
        $post = posts::find($id);

       if ($post && ($request->user()->id == $post->author_id || $request->user()->is_admin())) {

        $post->image='';
        $post->save();

           $data['message'] = 'image Deleted succesfully';
           $landing = 'edit/'.$post->slug;
       }else{
           $data['errors'] = 'you have not suficient permission';
           $landing = 'edit/'.$post->slug;
       }
       return redirect($landing)->with($data);
    }
}
