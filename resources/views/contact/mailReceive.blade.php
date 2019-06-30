@extends('layouts.app')
@section('stylesheet')
    <style>
    .jumbotron{
        background:green;
        color: white;
        font-weight:bolder
    }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron"><p>Ensemble des mails reçus</p></div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col" >Name</th>
                    <th class="col" >Email</th>
                    <th class="col" >Subject</th>
                    <th class="col" >Message</th>
                    <th class="col" >Date</th>
                </tr>
            </thead>
        @foreach($emails as $email)
            <tbody>
                <tr>
                    <td>{{ $email->name}} </td>
                    <td><a href='mailto:{{ $email->email}}' target='_blank'>{{ $email->email}}</a> </td>
                    <td>{{ $email->object}} </td>
                    <td>{{ $email->message}} </td>
                    <td>{{ $email->created_at}} </td>
                </tr>
            </tbody>
        @endforeach
        </table>
    </div>
@endsection