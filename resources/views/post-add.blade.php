@extends('layouts.app')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3> Add new Post</h3>
                        </div>
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" id="form1" action="{{route('post.add')}}">
                                <div class="col-md-12">
                                    <input class="form-control" placeholder="title" name="title" type="text">
                                    <br>
                                    <textarea class="form-control" placeholder="text" name="description"
                                              rows="1"></textarea>
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <br>
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <hr>
                                    <br>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
