<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <p class="text-center">
                            <span id="location">@if(isset($user->city_id)){{ $user->city->name }}
                                @else - @endif</span>

            <span>&nbsp; | &nbsp;</span>
            <span id="occupation">@if(isset($user->occupation_id)){{ $user->occupation->name }}
                @else - @endif</span>
        </p>
    </div>
</div>