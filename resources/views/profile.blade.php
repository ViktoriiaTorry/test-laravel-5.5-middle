@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="panel panel-profile">
            <div class="clearfix">
                <!-- LEFT COLUMN -->
                <div class="profile-left">
                    <!-- PROFILE HEADER -->
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="/assets/img/user-medium.png" class="img-circle" alt="Avatar">
                            <h3 class="name">{{$user->name}}</h3>
                        </div>
                        <div class="profile-stat">
                            <div class="row">
                                <div class="col-md-4 stat-item">
                                </div>
                                <div class="col-md-4 stat-item">
                                </div>
                                <div class="col-md-4 stat-item">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE HEADER -->
                    <!-- PROFILE DETAIL -->
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4 class="heading">Basic Info</h4>
                            <ul class="list-unstyled list-justify">
                                <li>Email <span>{{$user->email}}</span></li>
                                <li>followers_count <span>{{$user->followers_count}}</span></li>
                                <li>posts_count <span>{{$user->posts_count}}</span></li>
                                <li>comments_count <span>{{$user->comments_count}}</span></li>
                            </ul>
                        </div>
                        <div class="profile-info">
                            <ul class="list-inline social-icons">
                                @if(Auth::user()->id == $user->id)
                                @elseif(!in_array(Auth::user()->id, $followers))
                                    <a href="{{ route('user.follow', $user->id )}}" class="btn btn-success">Follow
                                        User</a>
                                @else
                                    <a href="{{ route('user.unfollow', $user->id) }}" class="btn btn-danger">Unfollow
                                        User</a>
                                    @endif
                                    </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END PROFILE DETAIL -->
                </div>
                <!-- END LEFT COLUMN -->
            </div>
        </div>
    </div>
@endsection
