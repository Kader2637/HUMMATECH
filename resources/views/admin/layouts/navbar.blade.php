<ul class="nav-menus">
    <li>
        <div class="mode">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 15q1.25 0 2.125-.875T15 12q0-1.25-.875-2.125T12 9q-1.25 0-2.125.875T9 12q0 1.25.875 2.125T12 15m0 2q-2.075 0-3.537-1.463T7 12q0-2.075 1.463-3.537T12 7q2.075 0 3.538 1.463T17 12q0 2.075-1.463 3.538T12 17M2 13q-.425 0-.712-.288T1 12q0-.425.288-.712T2 11h2q.425 0 .713.288T5 12q0 .425-.288.713T4 13zm18 0q-.425 0-.712-.288T19 12q0-.425.288-.712T20 11h2q.425 0 .713.288T23 12q0 .425-.288.713T22 13zm-8-8q-.425 0-.712-.288T11 4V2q0-.425.288-.712T12 1q.425 0 .713.288T13 2v2q0 .425-.288.713T12 5m0 18q-.425 0-.712-.288T11 22v-2q0-.425.288-.712T12 19q.425 0 .713.288T13 20v2q0 .425-.288.713T12 23M5.65 7.05L4.575 6q-.3-.275-.288-.7t.288-.725q.3-.3.725-.3t.7.3L7.05 5.65q.275.3.275.7t-.275.7q-.275.3-.687.288T5.65 7.05M18 19.425l-1.05-1.075q-.275-.3-.275-.712t.275-.688q.275-.3.688-.287t.712.287L19.425 18q.3.275.288.7t-.288.725q-.3.3-.725.3t-.7-.3M16.95 7.05q-.3-.275-.288-.687t.288-.713L18 4.575q.275-.3.7-.288t.725.288q.3.3.3.725t-.3.7L18.35 7.05q-.3.275-.7.275t-.7-.275M4.575 19.425q-.3-.3-.3-.725t.3-.7l1.075-1.05q.3-.275.712-.275t.688.275q.3.275.288.688t-.288.712L6 19.425q-.275.3-.7.288t-.725-.288M12 12"/></svg>
        </div>
    </li>
    <li class="profile-nav onhover-dropdown p-0">
        <div class="d-flex align-items-center profile-media"><img class="b-r-10 img-40"
                src="{{ asset('assets/images/Logo_HUMMATECH_700px.png') }}" alt="">
            <div class="flex-grow-1"><span>{{ auth()->user()->name }}</span>
                <p class="mb-0">{{ auth()->user()->role }} <i class="middle fa-solid fa-chevron-down"></i></p>
            </div>
        </div>
        <ul class="profile-dropdown onhover-show-div">
            <form action="{{ route('logout') }}" method="post">
            @csrf
            <li><button type="submit" class="btn btn-transparant"><i data-feather="log-in"> </i><span>Log Out</span></button></li>
        </form>
        </ul>
    </li>
</ul>
