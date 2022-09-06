@if (Auth::user()->connectedAccount == null)
    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: `<a href="{{ route('connected_account') }}">
                            You need to create your connected account.
                            Go to the my account page.
                    </a>`
        }).show();
    </script>
@endif

@if (Auth::user()->connectedAccountInfo == null)
    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: ` <a href="{{ route('connected_account') }}">
                            You need to update your connected account.
                            Go to the My account page & click
                            <b>update your connected account tab</b>.
                        </a>`
        }).show();
    </script>
@endif
