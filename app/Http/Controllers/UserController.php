<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\User;
use App\Models\comments;

class UserController extends Controller
{
    /*
   * Display active posts of a particular user
   *
   * @param int $id
   * @return view
   */
    public function user_posts($id)
    {
        $data['posts'] = posts::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
        $data['title'] = User::find($id)->name;
        return view('home',$data);
    }
    public function user_posts_all(Request $request,$id)
    {
        $user = $request->user();
        $data['posts'] = posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $data['title'] = $user->name;
        return view('home',$data);
    }

    public function user_posts_draft($id)
    {
        $data['posts'] = posts::where('author_id',$id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
        $data['title'] = User::find($id)->name;
        return view('home',$data);
    }

    public function profile(Request $request,$id)
    {
        $data['user'] = User::find($id);
        if (!$data['user']) {
            return redirect('/home');
        }
        if ($request->user() && $data['user']->id == $request->user()->id) {
            $data['author'] = true;
        }
        else{
            $data['author'] = false;
        }
        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count']    = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('active',1)->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user']->posts->where('active',1)->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);
        return view('admin.profile',$data);
    }

    public function profileImage(Request $request,$id)
    {
        $user = User::find($id);
        $profileImg = $request->file('avatar');
        $input['imagename'] = time().'.'.$profileImg->getClientOriginalExtension();
        $destinationPath = public_path('/profileImg');
        $profileImg->move($destinationPath,$input['imagename']);
        $user->profile_pic = $input['imagename'];
        $user->save();
       return back()->with('message','Profile IMage Uploaded Successfully');
    }
}
