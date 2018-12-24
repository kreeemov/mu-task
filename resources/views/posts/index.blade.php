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
                                        <a href="" class="btn btn-danger deletePost" >Delete</a>
                                    </div>
                                </div>
                            @endif
                            <hr>


                            <script>
                                $(".deletePost").click(function(){

                                    console.log("Clicked");
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax(
                                        {
                                            url: "posts/delete/{{$post->id}}",
                                            type: 'delete', // replaced from put
                                            dataType: "JSON",
                                            data: {
                                                "id": id // method and token not needed in data
                                            },
                                            success: function (response)
                                            {
                                                console.log(response); // see the reponse sent
                                            },
                                            error: function(xhr) {
                                                console.log(xhr.responseText); // this line will save you tons of hours while debugging
                                                // do something here because of error
                                            }
                                        });
                                });
                            </script>
                        @endforeach
                    </div>
                </div><br><br>



            </div>
        </div>
    </div>



@endsection
