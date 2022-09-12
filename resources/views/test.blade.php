<!DOCTYPE html>
<html lang="en">

<head>
    <title>Test Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Your Test</h1>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-6">
                <form action="{{ route('channel_search') }}" method="POST">
                    @csrf
                    <input type="text" name="cname" placeholder="Search Channel">
                    <input type="submit" value="Search">
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <script></script>
</body>

</html>
