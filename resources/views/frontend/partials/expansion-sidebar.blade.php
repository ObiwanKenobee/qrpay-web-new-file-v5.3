@php
    $current_route = Route::currentRouteName();
@endphp
<div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
    <div class="user-sidebar">
        <div class="user-widget">
            <div class="user-widget-header">
                <h5 class="title">@lang('Expansion Services')</h5>
            </div>
            <div class="user-widget-body">
                <ul class="user-menu-list">
                    <li>
                        <a href="{{ setRoute('user.expansion.personal') }}" class="{{ Route::is('user.expansion.personal') ? 'active' : '' }}">
                            <span class="icon"><i class="fas fa-user"></i></span>
                            <span>@lang('Personal')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ setRoute('user.expansion.business') }}" class="{{ Route::is('user.expansion.business') ? 'active' : '' }}">
                            <span class="icon"><i class="fas fa-briefcase"></i></span>
                            <span>@lang('Business')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ setRoute('user.expansion.enterprise') }}" class="{{ Route::is('user.expansion.enterprise') ? 'active' : '' }}">
                            <span class="icon"><i class="fas fa-building"></i></span>
                            <span>@lang('Enterprise')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ setRoute('user.expansion.company') }}" class="{{ Route::is('user.expansion.company') ? 'active' : '' }}">
                            <span class="icon"><i class="fas fa-industry"></i></span>
                            <span>@lang('Company')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ setRoute('user.expansion.developer') }}" class="{{ Route::is('user.expansion.developer') ? 'active' : '' }}">
                            <span class="icon"><i class="fas fa-code"></i></span>
                            <span>@lang('Developer')</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>