<div class="col-md-4">
    <div class="card">
        <div class="card-head">
            <h5>Starter <div></div>
            </h5>
            <h5>Free <span>Free Sign-Up </span></h5>

        </div>
        <h6>Plan Includes</h6>
        <ul>
            <li>Access to Jumcert</li>
            <li>Access to Event Library</li>
            <li>Pay-Per-View</li>
            <li>Chat/Message Feature</li>

        </ul>
        <a href="javascript:void(0)">View All Details</a>
        @if (auth()->user()->user_role == 0)
            <a class="card-btn" href="javascript:void(0)" style="background-color: #060447">
                Current Plan
            </a>
        @else
            <a class="card-btn" href="{{ route('payments') }}">
                Choose Package
            </a>
        @endif

    </div>
</div>

<div class="col-md-4">
    <div class="card middle-card">
        <div class="card-head">
            <h5>Pro <div></div>
            </h5>
            <h5>$19.00/Mon <span style="color: #fff !important;">7- Day Free Trial</span></h5>

        </div>
        <h6>Plan Includes</h6>
        <ul>
            <li>Starter plan plus</li>
            <li>Broadcast 1 to 1 Hosting</li>
            <li>Moderate Chat/Message Feature</li>
            <li>Create Profile Channel </li>

        </ul>
        <a href='javascript:void(0)'>View All Details</a>
        @if (auth()->user()->user_role == 1)
            <a class="card-btn" href="javascript:void(0)">
                Current Plan
            </a>
        @else
            <a class="card-btn" href="{{ route('payments', 1) }}">
                Choose Package
            </a>
        @endif

    </div>
</div>

<div class="col-md-4">
    <div class="card">
        <div class="card-head">
            <h5>Business<div></div>
            </h5>
            <h5>$44.99/Mon<span>7- Day Free Trial</span></h5>

        </div>
        <h6>Plan Includes</h6>
        <ul>
            <li>A Pro plan plus</li>
            <li>Create Profile Channel </li>
            <li>Create Profile Channel </li>
            <li>Create Profile Channel </li>

        </ul>
        <a href="#">View All Details</a>
        @if (auth()->user()->user_role == 2)
            <a class="card-btn" href="javascript:void(0)" style="background-color: #060447">
                Current Plan
            </a>
        @else
            <a class="card-btn" href="{{ route('payments') }}">
                Choose Package
            </a>
        @endif
    </div>
</div>
