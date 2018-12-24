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
                <div class="card">
                    <div class="card-header">Create New Post</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('posts.update', ['id' => $post->id])}}" method="post">
                            @csrf
                            @method("put")

                            <div class="form-group row">
                                <label for="title" class="col-md-12 col-form-label text-md-left">Title</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" name="title" placeholder="Title of Post" value="{{$post->title}}" required >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-12 col-form-label text-md-left">Content</label>

                                <div class="col-md-12">
                                    <textarea id="body" type="text" class="form-control" name="body" placeholder="Content of Post" required>{{$post->body}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-12 col-form-label text-md-left"></label>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div><br><br>



            </div>
        </div>
    </div>
@endsection
