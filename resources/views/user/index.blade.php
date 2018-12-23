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


                @if(is_null(Auth::user()->gender))
                    <div class="card">
                        <div class="card-header">Update your Info</div>
                        <div class="card-body">
                            kindly choose th gender

                            <form action="{{route('update-gender')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <select name="gender" class="form-control">
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><br><br>
                @else

                @endif




                    <div class="card">
                        <div class="card-header">Your Info</div>
                        <div class="card-body">
                            id: {{Auth::user()->id}}
                            <br>
                            name: {{Auth::user()->name}}
                            <br>
                            National ID: {{Auth::user()->national_id}}
                            <br>
                        </div>
                    </div>



            </div>
        </div>
    </div>
@endsection
