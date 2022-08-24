@if (Auth::user()->userAccount == null)
    <div class="user-account-alert-modal show" data-signup-modal>
        <img src="https://jumcart.previewforclient.com/frontend/img/t-alert-con.svg" alt="" />
        <h5>
            <a href="{{ route('user_account') }}">
                You need to create your bank account.
            </a>
        </h5>
        <span class="close2" data-close></span>
    </div>

    <script>
        const signupModal = document.querySelector('[data-signup-modal]');
        const closeSignupModal = document.querySelector('[data-close]');
        closeSignupModal.addEventListener('click', function(e) {
            signupModal.classList.toggle('show');
        });

        setInterval(() => {
            const signupModal = document.querySelector('.user-account-alert-modal');
            signupModal.classList.add("show");
        }, 600000);
    </script>
@endif
