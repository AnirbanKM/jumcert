<table class="table display">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($owner_videos as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->title }}</td>
                <td>
                    <img src="{{ $item->thumbnail }}" alt="" style="width: 100px;" />
                </td>
                <td>
                    ${{ ($item->price * 81) / 100 }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{!! $owner_videos->links() !!}
