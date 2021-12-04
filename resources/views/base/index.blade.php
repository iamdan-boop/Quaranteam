@extends('layouts.app')

@section('section')
    <div>
        <style>
            body {
                background-color: #48878a;
            }

            .indexTitle {
                color: white;
                margin-top: 5%;
                font-weight: bolder;
            }

            .logLabel {
                margin: 2%;
                color: white;

            }

            .indexBtn {
                color: #3c6566;
                background-color: white;
                font-weight: bolder;
                border-radius: 12px;
                font-size: 20px;

            }

        </style>
        <div class="container-fluid mt-5">
            <center>
                <h2 class="indexTitle">Online Registration System for Vaccinations in Lourdes Young, Nabua</h2>
            </center>
            <center><img src="{{ asset('img/logo1.png') }}" class="img-fluid logo"></center>
            <center>
                <h4 class="logLabel">LOG IN AS</h4>
            </center>
            <center><a href="{{ route('login') }}"
                    class="btn btn-success btn-wave col-md-3 mb-3 p-3 btn-lg indexBtn">Resident</a>
            </center>
            <center><a href="{{ route('login') }}"
                    class="btn btn-success btn-wave col-md-3  p-3 btn-lg indexBtn">Administrator</a></center>
        </div>
    </div>
@endsection
