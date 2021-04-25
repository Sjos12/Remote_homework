@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card card--list">
                <div class="container px-5 d-flex justify-content-center flex-column">
                    <h1 class="mx-auto">Your Account</h1>
                    <form method="POST" action="{{ route('account.edit') }}">
                        @csrf
                        @method('PUT')
                        <!-- Equivalent to... -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="d-flex justify-content-between">
                            <div class="w-100 pr-5">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                               
                                <label for="name">Your username</label>
                                <input class="form-control" type="text" name="name" value="{{ $account->name }}">

                                <label for="email">Your E-mail</label>
                                <input class="form-control" type="text" name="email" value="{{ $account->email }}">

                                <label for="description">Your description</label>
                                <textarea class="form-control contentarea" type="text" name="description">{{ $account->name }}</textarea>   

                                
                                <button type="submit" class="btn btn-primary btn-lg my-4 mx-0 float-right">Save changes</button>
                            </div>
                            <div class="">
                                <div class="profilepicture-container shadow mx-auto mb-4">
                                    <img src="/images/homeworkgirl.svg" class="h-100" alt="">
                                   
                                </div>
                                <label for="image">Change profile picture</label>
                                <input type="file" src="" name="image">
                            </div>
                        </div>
                    </form>   
                </div>   
            </div>
        </div>
    </div>
@endsection