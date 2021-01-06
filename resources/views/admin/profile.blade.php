@extends('layouts.app')
@section('title')
    {{$user->name}}
@endsection
@section('style')
<style>
body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>
@endsection
@section('content')
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="{{url('public/profileImg/'.$user->profile_pic)}}" class="img-radius" alt="User-Profile-Image" style="height:100px "> </div>
                                <h6 class="f-w-600">{{$user->name}}</h6>
                                <p>Web Dev</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">{{$user->email}}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400">{{$user->phone_no}}</h6>
                                    </div>
                                </div>
                                {{-- <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6> --}}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <h6 class="text-muted f-w-400">{{$user->address}}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Role</p>
                                        <h6 class="text-muted f-w-400">{{$user->role}}</h6>
                                    </div>
                                </div>
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="{{url('public/profileImg/'.$user->profile_pic)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}'s Profile</h2>
            <form enctype="multipart/form-data" action="{{ url('profile.update'.'/'.$user->id) }}" method="POST">
                <label>Update Profile Image</label>
                <input type="file" name="avatar">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary" value="Upload">
            </form>
        </div>
        <h1>Email:- {{$user->email}}</h1>
        <br/>
        <h1>Phone No:- {{$user->phone_no}}</h1><br>
        <h1>Address:- {{$user->address}}</h1><br>
    </div>
</div>
<div>
    <ul class="list-group">
      <li class="list-group-item">
         Joined on {{$user->created_at->format('M d,Y  h:i a')}}
      </li>
      <li class="list-group-item panel-body">
        <table class="table-padding">
          <style>
            .table-padding td{
              padding: 3px 8px;
            }
          </style>
          <tr>
              <td>Total Posts:-</td>
              <td>{{$posts_count}}</td>
              @if ($author && $posts_count)
              <td><a href="{{url('/my-all-posts'.'/'.$user->id)}}">Show All</a></td>
              @endif

          </tr>
          <tr>
            <td>Published Posts:-</td>
            <td>{{$posts_active_count}}</td>
            @if ($author && $posts_active_count)
            <td><a href="{{url('/user'.$user->id.'/posts')}}">Show All</a></td>
            @endif

        </tr>
        <tr>
            <td>Posts in Draft :-</td>
            <td>{{$posts_draft_count}}</td>
            @if ($author && $posts_draft_count)
            <td><a href="{{url('/my-drafts'.'/'.$user->id)}}">Show All</a></td>
            @endif

        </tr>
        </table>
      </li>
      <li class="list-group-item">
        Total Comments {{$comments_count}}
     </li>
    </ul>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Latest Posts</h3></div>
    <div class="panel-body">
        @if (!empty($latest_posts[0]))
        @foreach ($latest_posts as $latest_post)
        <p>
            <strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
            <span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
        </p>
        @endforeach
         @else
         <p>You have not written any post till now.</p>
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h3>Latest Comments</h3></div>
    <div class="list-group">
        @if (!empty($latest_comments[0]))
            @foreach ($latest_comments as $latest_comment)
            <div class="list-group-item">
                <p>{{ $latest_comment->body }}</p>
                <p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
                <p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
              </div>
            @endforeach
            @else
            <div class="list-group-item">
                <p>You have not commented till now. Your latest 5 comments will be displayed here</p>
              </div>
        @endif
    </div>
</div>


@endsection
