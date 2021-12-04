@extends('layouts.app')


@section('section')
    <style>
        body {
            background-color: #5bacaf;

        }

        .cont1 {
            margin-top: 25px;
            margin-right: 5px;
            margin-left: 5px;


        }

        .loginForm {
            background-color: #e8e8e8;
            align-content: center;
            border-color: #3c6566;



        }

        .logoLogin {
            background-color: #e8e8e8;
            align-content: center;
            border-radius: 5px;

        }

        .text-center {
            margin-top: 15%;

        }

    </style>

    <nav class="navbar navbar-light bg-light navbar-bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo1.png') }}" alt="" width="50" class="d-inline-block align-text-center">
                Online Registration System for Vaccinations
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row cont1">
            <div class="col-md-8 logoLogin">
                <img class="img-fluid" src="{{ asset('img/logo2.png') }}" alt="sign up image"></figure>
            </div>

            <div class="card col-md-4 loginForm">
                <div class="card-body">
                    <div class="text-center">
                        <h3><b>Sign Up</b></h3>
                        <p class="mb-3">Sign up to continue.</p>
                    </div>
                    @if ($errors->any())
                        <div class="rounded bg-danger text-white w-50 p-3 mb-2">

                            @foreach ($errors->all() as $error)
                                <div>• <span>{{ $error }}</span></div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('register.save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="exampleInputFN" class="form-label">First Name</label>
                                <input type="text" name="firstname" class="form-control" aria-label="First name">
                            </div>

                            <div class="col mb-3">
                                <label for="exampleInputLN" class="form-label">Last Name</label>
                                <input type="text" name="lastname" class="form-control" aria-label="Last name">
                            </div>
                        </div>

                        <div class="mb-3 ">
                            <label for="exampleInputUsername1" class="form-label">Username</label>
                            <input type="username" name="username" class="form-control" id="exampleInputUsername1">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleInputEmail1" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>

                        <center><button type="submit" "btn-sm btn-block btn-wave col-md-4 btn-primary mb-5" style="background-color:
                                                                #284e50;">Sign Up</button></center>

                        <div class="mb-3">
                            <center><a href="{{ route('login') }}" class="link-primary">I am already a member</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
