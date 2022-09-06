<style>
    a {
        color: #1c1c1c;
    }
</style>

@if (Auth::user()->connectedAccount == null)
    <div class="user-account-alert-modal show" data-signup-modal1>
        <img src="{{ asset('alert.svg') }}" alt="" />
        <h5>
            <a href="{{ route('connected_account') }}">
                You need to create your connected account.
                Go to the my account page.
            </a>
        </h5>
        <span class="close2" data-close></span>
    </div>
@endif

@if (Auth::user()->connectedAccountInfo == null)
    <div class="user-account-alert-modal show" data-signup-modal2>
        <img src="{{ asset('alert.svg') }}" alt="" />
        <h5>
            <a href="{{ route('connected_account') }}">
                You need to update your connected account.
                Go to the My account page & click
                <b>update your connected account tab</b>.
            </a>
        </h5>
        <span class="close2" data-close></span>
    </div>
@endif

<script>
    const signupModal1 = document.querySelector('[data-signup-modal1]');
    const signupModal2 = document.querySelector('[data-signup-modal2]');
    const closeSignupModal = document.querySelectorAll('[data-close]');

    for (let i = 0; i < closeSignupModal.length; i++) {
        closeSignupModal[i].addEventListener('click', function(e) {
            document.querySelector(`[data-signup-modal${i+1}]`).classList.toggle('show');
        });

    }

    setInterval(() => {
        const signupModal = document.querySelector('.user-account-alert-modal');
        signupModal.classList.add("show");
    }, 600000);
</script>
