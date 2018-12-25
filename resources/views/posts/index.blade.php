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
                <a href="{{route("posts.create")}}" class="btn btn-primary">Create New Post</a>
                <br>
                <br>
                <div class="card">
                    <div class="card-header">Posts Timeline</div>
                    <div class="card-body">
                        @foreach($posts as $post)
                            <div id="post{{$post->id}}">
                            <h3><a href="{{route('posts.show', ['id' => $post->id])}}">{{$post->title}}</a></h3>
                            <h5>Author: {{$post->user->name}}</h5>
                            <span>{{ $post->created_at->format('Y-m-d') }}</span>
                            <p>
                                <?php $complate = "... <a href='/posts/". $post->id ."'>Read More</a>"; ?>
                                {!! str_limit($post->body, 250, $complate)  !!}
                            </p>

                            @if($post->user_id == Auth::user()->id)
                                <div class="actions-body">
                                    <h5>Actions:</h5>
                                    <div class="float-left">
                                        <a href="{{route('posts.edit', ['id' => $post->id])}}" class="btn btn-primary">Edit</a>
                                    </div>
                                    <div class="float-left">
                                        <a class="btn btn-danger deletePost" onclick="deletePost({{$post->id}})">Delete</a>
                                    </div>
                                </div>
                            @endif
                            <hr>


                            <script>
                                function  deletePost(id) {

                                    $.get("/posts/delete/{{$post->id}}", function(msg, status){
                                        //alert("MSG: " + msg + "\nStatus: " + status);

                                        if (status == 'success'){
                                            $("#post{{$post->id}}").css('display', 'none');
                                        }
                                    });

                                }
                            </script>
                            </div>
                        @endforeach
                    </div>
                </div><br><br>



            </div>
        </div>
    </div>



@endsection
