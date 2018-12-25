@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <br>
                <br>
                <div class="card">
                    <h1 class="card-header">{{$post->title}}</h1>
                    <div class="card-body">
                        {!! $post->body !!}
                        <br>
                        <hr>
                        @if($post->user_id == Auth::user()->id)
                            <div class="actions-body">
                                <h5>Actions:</h5>
                                <div class="float-left">
                                    <a href="{{route('posts.edit', ['id' => $post->id])}}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="float-left">
                                    <form action="{{route('posts.destroy', ['id' => $post->id])}}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                <div class="float-left"></div>
                            </div>
                        @endif
                    </div>
                </div>


                    <div class="card">
                        <div class="card-header">Comments</div>
                        <div class="card-body">
                            <form action="{{route('comments.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <div class="form-group row">
                                    <textarea class="form-control" name="comment" placeholder="Add you Comment Here" required></textarea>
                                </div>
                                <button class="btn btn-primary">Add</button>
                            </form>
                            <hr>
                            @foreach($comments as $comment)
                                <div class="comment">
                                    <div class="col-3 float-left comment-user">{{$comment->user->name}}</div>
                                    <div class="col-9 float-left comment-body">{{$comment->comment}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div><br><br>



            </div>
        </div>
    </div>
@endsection
