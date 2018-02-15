@extends('layouts.app')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Newsline</h3>
                        </div>
                        <div class="panel-body">
                            <div class="panel-heading">
                                <div class="text-right">
                                    <a href="{{route('post.add')}}" class="btn btn-success">Add Post</a>
                                </div>
                            </div>
                            <div class="panel-heading">
                                <div class="text-right">
                                    <a href="{{route('post.popular')}}" class="btn btn-success">Show most popular
                                        posts</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @foreach($posts as $post)
                                    {{Form::open(['method'=> 'post', 'url' => route('home')])}}
                                    <div class="form-group">
                                        <div class="conversation-item item-left clearfix">
                                            <div class="conversation-body">
                                                <div class="name">
                                                    {{$post->user->name}}
                                                    <div class="pull-right">{{$post->created_at->format('Y-m-d H:i:s')}}</div>
                                                </div>
                                                <div class="text">
                                                    <div class="text-info">{{ $post->title }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-muted">{{ $post->description }}</span>
                                        <br>
                                        @if (isset($post->comments))
                                            @foreach($post->comments as $comment)
                                                {{$comment->text  }}
                                                <span class="date">{{$comment->created_at->format('Y-m-d')}}</span><br>
                                            @endforeach
                                            @if (count($post->comments) >= 2 )
                                            @else
                                                <div class="form-group">
                                                    {!!Form::textarea('text', '', ['size' => '15x1',  'class' => 'form-control']) !!}
                                                </div>
                                                {{ Form::hidden('user_id', Auth::user()->id) }}
                                                {{ Form::hidden('post_id', $post->id) }}
                                                <div class="form-group">
                                                    {{ Form::submit('Reply', ['class'=>'btn btn-primary'])}}
                                                </div>
                                                {{ csrf_field() }}
                                            @endif
                                            @if(isset($post->parentComments[0]))
                                                {{--{{dump($post->parentComments[0]->id)}}--}}
                                                {{ Form::hidden('parent_id', $post->parentComments[0]->id) }}
                                            @endif
                                        @endif
                                    </div>
                                    {{Form::close()}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
