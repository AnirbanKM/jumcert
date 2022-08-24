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
        <h1>Your Sell Transactions</h1>
    </div>

    <div class="container">
        <div class="row">

            @foreach ($owner_videos as $item)
                <ul>
                    <li>Id: {{ $item->id }}</li>
                    <li>Title: {{ $item->title }}</li>
                    <li>Price: {{ $item->price }}</li>
                    <li>Video Id: {{ $item->video_id }}</li>
                </ul>
            @endforeach

            @php
                $x = 0;

                foreach ($owner_videos as $item) {
                    $x = $x + $item->price;
                }

                $admin_commission = ($x * 19) / 100;

                $after_split = $x - $admin_commission;

            @endphp

        </div>

        <h1>Total Earning : ${{ $x }}</h1>
        <h1>Total Admin Commission : ${{ $admin_commission }}</h1>
        <h1>After Split : ${{ $after_split }}</h1>


        {{-- {{ $owner_videos->count() }} --}}

        {{-- @foreach ($owner_videos->groupBy('video_id') as $item)
                <dd>{{ $item[0] }}</dd>
            @endforeach --}}

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

    <script></script>
</body>

</html>
