<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Mail</title>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <p> <i>From</i> {{ $contact->name }} - <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
            <p class="text-right"></p>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $contact->object }}</h5>
          <p class="card-text text-justify">{{ $contact->message }}</p>
        </div>
    </div>
</body>
</html>