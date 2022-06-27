<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Test Page</h1>
    </div>

    <div class="container">
        <div class="row">
            <ul>
                @foreach ($obj as $r)
                    <li>{{ $r->videoname }} <br><br>
                        {{ str_replace('public', 'storage', $r->videoname) }}
                        <h3>Image path: </h3>
                        <video controls width="250">
                            <source src={{ str_replace('public', 'storage', $r->videoname) }} type="video/webm">
                            <source src={{ str_replace('public', 'storage', $r->videoname) }} type="video/mp4">
                        </video>
                        <p>Category: {{ $r->category->name }}</p>
                        <p>Category: {{ $r->user_info->image }}</p>

                        {{-- <img src="{{ str_replace('public', 'storage', $r->user_info->image) }}" width="100px"> --}}
                    </li>
                @endforeach
            </ul>
            <hr />

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <script>


    </script>
</body>

</html>
