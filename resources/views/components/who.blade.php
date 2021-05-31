@if (Auth::guard('admin')->check())
    <p class="color-green">
    {{ __('You are Admin logged in!') }}
    </p>
@else
    <p class="color-red">
        {{ __('You are LoggedOut a Admin   !') }}

    </p>
@endif

<br>
@if (Auth::guard('web')->check())
<p class="color-green">
    {{ __('You are Logged in  a User !') }}

</p>
@else
<p class="color-red">
    {{ __('You are LoggedOut a User !') }}

</p>
@endif
