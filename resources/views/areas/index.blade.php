<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Areas</title>
</head>
<body>
    <h1>{{$one}}</h1>
    <h2>{{$two}}</h2>
    <ul>
        @foreach ($areas as $area)
        <li>{{$area->name}} - {{$area->created_at}}

            <a href="/areas/{{$area->id}}">View this area</a>
            <a href="/areas/{{$area->id}}/edit">Edit this file area</a>

            <form action="/areas/{{$area->id}}" method="post">
                @csrf
                <input type="hidden" name="method" value="delete">
                <input type="submit" value="Delete">
            </form>
        </li>
        @endforeach
    </ul>
</body>
</html>
