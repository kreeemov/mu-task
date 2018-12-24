@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                        <form action="{{route('posts.store')}}" method="post">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-12 col-form-label text-md-left">Title</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" name="title" placeholder="Title of Post" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-12 col-form-label text-md-left">Content</label>

                                <div class="col-md-12">
                                    <textarea id="body" type="text" class="form-control" name="body" placeholder="Content of Post" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-12 col-form-label text-md-left"></label>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div><br><br>



            </div>
        </div>
    </div>
@endsection
