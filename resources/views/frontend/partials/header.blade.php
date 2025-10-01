@php
    $lang = selectedLang();
    $about_slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::ABOUT_SECTION);
    try {
        $about = App\Models\Admin\SiteSections::getData($about_slug)->first();
    } catch (\Throwable $e) {
        $about = null;
    }
    $system_default = get_default_language_code();

    // Wild Resilience Network Data
    $wildResilience = [
        'dove_dome' => [
            'vegetables' => 0,
            'fish' => 0,
            'bee_hives' => 0,
            'solar' => '0%'
        ],
        'peace_gardens' => [
            'owls' => 0,
            'doves' => 0,
            'next_event' => null,
            'status' => null,
            'current_visitors' => 0,
            'capacity' => 0
        ],
        'therapy' => [
            'trees_planted' => 0,
            'doves_fed' => 0,
            'sessions_completed' => 0,
            'stats' => [
                'success_rate' => null,
                'satisfaction' => null
            ],
            'book_link' => '#'
        ],
        'guardian_network' => [
            'node_health' => 'Unknown',
            'food_yield' => 0,
            'active_nodes' => 0,
            'total_nodes' => 0,
            'network_status' => [
                'uptime' => null,
                'latency' => null
            ],
            'resources' => [
                'cpu_usage' => null,
                'memory_usage' => null
            ],
            'dashboard_link' => '#'
        ],
        'dove_dome_symbol' => [
            'live_feed' => 'Network Status: Active',
            'learn_link' => '#'
        ]
    ];

    // Impact Wallet Data
    $impactWallet = [
        'currency' => 'ETH',
        'balance' => 2.5
    ];

    // Education Bundles
    $educationBundles = [
        ['name' => 'Basic Education Bundle', 'type' => 'Free'],
        ['name' => 'Advanced Skills Bundle', 'type' => 'Premium'],
        ['name' => 'Professional Bundle', 'type' => 'Pro']
    ];

    // Disaster Mode Status
    $disasterMode = [
        'active' => true,
        'emergency_data' => [
            'amount' => '500MB',
            'used' => '100MB'
        ],
        'emergency_sms' => [
            'amount' => 100,
            'used' => 20
        ],
        'emergency_calls' => [
            'minutes' => 60,
            'used' => 15
        ],
        'mesh_network' => [
            'connected_nodes' => 8,
            'signal_strength' => 'Good'
        ]
    ];

    // Ensure Impact Wallet has safe defaults
    $impactWallet = $impactWallet ?? [];
    $impactWallet['currency'] = $impactWallet['currency'] ?? 'KSh';
    $impactWallet['balance'] = $impactWallet['balance'] ?? 0;
    $impactWallet['recent_aid'] = $impactWallet['recent_aid'] ?? [];

    // Defaults for Community Bonds & Green M-Pesa badges
    $communityBonds = $communityBonds ?? [
        'apy' => 0,
        'currency' => 'KSh',
        'user_investment' => 0,
        'impact_stats' => 'N/A',
    ];

    $greenMpesa = $greenMpesa ?? [
        'eco_tokens' => 0,
        'impact' => 'N/A',
    ];
@endphp
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<header class="header-section floating-header" id="floatingHeader">
        <!-- Disaster Mode Dropdown -->
        @if($disasterMode['active'])
        <div class="header-disaster-mode dropdown d-inline-block me-3">
            <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="disasterModeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-broadcast-tower"></i> Disaster Mode Active
                <span class="badge bg-warning text-dark">Emergency Services</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="disasterModeDropdown">
                <li><span class="dropdown-item-text text-warning fw-bold">Free Emergency Services</span></li>
                <li>
                    <div class="dropdown-item">
                        <i class="fas fa-wifi me-2"></i>Emergency Data: {{ $disasterMode['emergency_data']['amount'] }} Available
                        <div class="emergency-progress">
                            <div class="emergency-progress-bar" data-progress="20"></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-item">
                        <i class="fas fa-sms me-2"></i>Emergency SMS: {{ $disasterMode['emergency_sms']['amount'] }} Messages
                        <div class="emergency-progress">
                            <div class="emergency-progress-bar" data-progress="20"></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-item">
                        <i class="fas fa-phone me-2"></i>Emergency Calls: {{ $disasterMode['emergency_calls']['minutes'] }} Minutes
                        <div class="emergency-progress">
                            <div class="emergency-progress-bar" data-progress="25"></div>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><span class="dropdown-item-text fw-bold">Mesh Network Status</span></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-project-diagram me-2"></i>Connected to {{ $disasterMode['mesh_network']['connected_nodes'] }} Nearby Nodes</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-signal me-2"></i>Local Network Strength: {{ $disasterMode['mesh_network']['signal_strength'] }}</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-info" href="#"><i class="fas fa-info-circle me-2"></i>Learn More About Emergency Services</a></li>
            </ul>
        </div>
        @endif

        <style>
        .emergency-progress {
            height: 3px;
            background: #e9ecef;
            border-radius: 3px;
            margin-top: 4px;
        }
        .emergency-progress-bar {
            height: 100%;
            background: #198754;
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        .emergency-progress-bar[data-progress="20"] { width: 20%; }
        .emergency-progress-bar[data-progress="25"] { width: 25%; }
        </style>

        <!-- Wild Resilience Network Dropdown -->
        <div class="header-wild-resilience dropdown d-inline-block me-3">
            <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" id="wildResilienceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-dove"></i> Wild Resilience Network
            </button>
            <ul class="dropdown-menu" aria-labelledby="wildResilienceDropdown">
                <li><span class="dropdown-item-text fw-bold">Dove Dome Status</span></li>
                <li><span class="dropdown-item-text">Vegetables: {{ $wildResilience['dove_dome']['vegetables'] ?? '0' }}kg, Fish: {{ $wildResilience['dove_dome']['fish'] ?? '0' }}, Bee Hives: {{ $wildResilience['dove_dome']['bee_hives'] ?? '0' }}, Solar: {{ $wildResilience['dove_dome']['solar'] ?? '0%' }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><span class="dropdown-item-text fw-bold">Peace Gardens & Biodiversity Corridors</span></li>
                <li><span class="dropdown-item-text">Owls: {{ $wildResilience['peace_gardens']['owls'] ?? '0' }}, Doves: {{ $wildResilience['peace_gardens']['doves'] ?? '0' }}, Next event: {{ $wildResilience['peace_gardens']['next_event'] ?? 'No events scheduled' }}</span></li>
                @if(isset($wildResilience['peace_gardens']['status']) && $wildResilience['peace_gardens']['status'] === 'active')
                    <li><span class="dropdown-item-text text-success">Status: Active ({{ $wildResilience['peace_gardens']['current_visitors'] ?? '0' }}/{{ $wildResilience['peace_gardens']['capacity'] ?? '0' }} visitors)</span></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li><span class="dropdown-item-text fw-bold">Wildlife Therapy Progress</span></li>
                <li><span class="dropdown-item-text">Trees planted: {{ $wildResilience['therapy']['trees_planted'] ?? '0' }}, Doves fed: {{ $wildResilience['therapy']['doves_fed'] ?? '0' }}</span></li>
                <li><span class="dropdown-item-text">Sessions completed: {{ $wildResilience['therapy']['sessions_completed'] ?? '0' }}</span></li>
                <li><span class="dropdown-item-text">Success rate: {{ $wildResilience['therapy']['stats']['success_rate'] ?? 'N/A' }} | Satisfaction: {{ $wildResilience['therapy']['stats']['satisfaction'] ?? 'N/A' }}</span></li>
                <li><a class="dropdown-item text-success" href="{{ $wildResilience['therapy']['book_link'] ?? '#' }}">Book therapy session</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><span class="dropdown-item-text fw-bold">AI + DLT Guardian Network</span></li>
                <li><span class="dropdown-item-text">Node health: {{ $wildResilience['guardian_network']['node_health'] ?? 'Unknown' }}, Food yield: {{ $wildResilience['guardian_network']['food_yield'] ?? '0' }}kg</span></li>
                <li><span class="dropdown-item-text">Network: {{ $wildResilience['guardian_network']['active_nodes'] ?? '0' }}/{{ $wildResilience['guardian_network']['total_nodes'] ?? '0' }} nodes active</span></li>
                <li><span class="dropdown-item-text">Status: {{ $wildResilience['guardian_network']['network_status']['uptime'] ?? 'N/A' }} uptime, {{ $wildResilience['guardian_network']['network_status']['latency'] ?? 'N/A' }} latency</span></li>
                <li><span class="dropdown-item-text">Resources: CPU {{ $wildResilience['guardian_network']['resources']['cpu_usage'] ?? 'N/A' }}, Memory {{ $wildResilience['guardian_network']['resources']['memory_usage'] ?? 'N/A' }}</span></li>
                <li><a class="dropdown-item text-info" href="{{ $wildResilience['guardian_network']['dashboard_link'] ?? '#' }}">View Network Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><span class="dropdown-item-text fw-bold">Signature Symbol: Dove Dome</span></li>
                <li><span class="dropdown-item-text">{{ $wildResilience['dove_dome_symbol']['live_feed'] }}</span></li>
                <li><a class="dropdown-item text-primary" href="{{ $wildResilience['dove_dome_symbol']['learn_link'] }}">Learn more</a></li>
            </ul>
        </div>
    <div class="header">
        <!-- Impact Wallet Dropdown -->
        <div class="header-impact-wallet dropdown d-inline-block me-3">
            <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" id="impactWalletDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-hand-holding-heart"></i> Impact Wallet <span class="badge bg-success">{{ $impactWallet['currency'] ?? 'KSh' }} {{ number_format($impactWallet['balance'] ?? 0) }}</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="impactWalletDropdown">
                <li><span class="dropdown-item-text fw-bold">Recent Aid Received</span></li>
                @if(isset($impactWallet['recent_aid']) && is_array($impactWallet['recent_aid']) && count($impactWallet['recent_aid']))
                    @foreach($impactWallet['recent_aid'] as $aid)
                        <li><a class="dropdown-item" href="#">{{ $aid['type'] ?? 'Unknown Aid' }}: {{ $impactWallet['currency'] ?? 'KSh' }} {{ number_format($aid['amount'] ?? 0) }}</a></li>
                    @endforeach
                @else
                    <li><span class="dropdown-item-text text-muted">No recent aid received</span></li>
                @endif
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-success" href="#">Redeem Credits</a></li>
            </ul>
        </div>

        <!-- Community Bonds Button -->
        <div class="header-community-bonds d-inline-block me-3">
            <button class="btn btn-outline-primary btn-sm" type="button">
                <i class="fas fa-chart-line"></i> Invest in Community Bonds
                <span class="badge bg-primary">{{ $communityBonds['apy'] }}% APY</span>
            </button>
            <span class="ms-2 text-muted small">Invested: {{ $communityBonds['currency'] }} {{ number_format($communityBonds['user_investment']) }} | Impact: {{ $communityBonds['impact_stats'] }}</span>
        </div>

        <!-- Green M-Pesa Badge -->
        <div class="header-green-mpesa d-inline-block me-3">
            <span class="badge bg-success text-white p-2 rounded-pill">
                <i class="fas fa-leaf"></i> Green M-Pesa: {{ $greenMpesa['eco_tokens'] }} Eco-Tokens
            </span>
            <span class="ms-2 text-muted small">Impact: {{ $greenMpesa['impact'] }}</span>
        </div>

        <!-- Education Bundles Dropdown -->
        <div class="header-education-bundles dropdown d-inline-block">
            <button class="btn btn-outline-warning btn-sm dropdown-toggle" type="button" id="educationBundlesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-graduation-cap"></i> Education Bundles
            </button>
            <ul class="dropdown-menu" aria-labelledby="educationBundlesDropdown">
                <li><span class="dropdown-item-text fw-bold">Available Bundles</span></li>
                @foreach($educationBundles as $bundle)
                    <li><a class="dropdown-item" href="#">{{ $bundle['name'] }} ({{ $bundle['type'] }})</a></li>
                @endforeach
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-warning" href="#">Access Digital Curriculum</a></li>
            </ul>
        </div>
        <!-- Disaster Mode Banner (Humanitarian Connectivity Cloud) -->
        @if(session('disaster_mode_active'))
        <div class="disaster-mode-banner text-center py-2 px-3" style="background:linear-gradient(90deg,#ff9800 0%,#ff5722 100%);color:#fff;font-weight:600;">
            <i class="fas fa-broadcast-tower me-2"></i>
            {{ __("Disaster Mode Active: Free emergency data & SMS available. Mesh network enabled.") }}
        </div>
        @endif
        <!-- Real-Time Account Status & Notifications -->
        <div class="header-realtime-status d-flex align-items-center justify-content-end py-2 px-3" style="background:rgba(245,250,255,0.95); border-bottom:1px solid #e3eaf3;">
            <div id="accountBalance" class="me-4 fw-bold text-primary">
                <i class="fas fa-wallet"></i> <span>Balance:</span> <span class="account-balance-amount">$0.00</span>
            </div>
            <div id="realtimeNotifications" class="dropdown">
                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i> <span class="notif-count badge bg-danger">0</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                    <li><span class="dropdown-item-text text-muted">No new notifications</span></li>
                </ul>
            </div>
        </div>
        <div class="header-bottom-area">
            <div class="container custom-container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-xl p-0">
                        <a class="site-logo site-title" href="{{ setRoute('index') }}">
                            <img src="{{ get_logo($basic_settings) }}"  data-white_img="{{ get_logo($basic_settings,'white') }}"
                            data-dark_img="{{ get_logo($basic_settings,'dark') }}"
                                alt="site-logo">
                        </a>
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu me-auto">
                                @if(page_access('personal'))
                                    <li class="nav-item dropdown"><a href="javascript:void(0);" class="has-sub">{{ __("Personal") }}
                                            <i class="fas fa-angle-down"></i></a>
                                        <div class="sub-menu">
                                            <div class="sub-menu-title">
                                                <a href="{{ setRoute('user.login') }}" class="menu-name">
                                                    <h3 class="title">{{ __("User") }} <i
                                                            class="fas fa-long-arrow-alt-right ms-1"></i> </h3>
                                                </a>
                                            </div>
                                            <div class="sub-menu-wrapper">
                                                <div class="row mb-20">
                                                    @foreach ($personal ?? [] as  $item)
                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-10">
                                                            <a href="{{ setRoute('header.page',encrypt($item->id)) }}">
                                                                <div class="sub-menu-item">
                                                                    <div class="icon">
                                                                        <i class="{{ __($item->icon->language->$lang->icon ?? $item->icon->language->$system_default->icon) }}"></i>
                                                                    </div>
                                                                    <div class="menu-item-name">
                                                                        <h4 class="title">{{ __($item->title->language->$lang->title ?? $item->title->language->$system_default->title) }}</h4>
                                                                        <p>{{ __($item->sub_title->language->$lang->sub_title ?? $item->sub_title->language->$system_default->sub_title) }}</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(page_access('business'))
                                    <li class="nav-item dropdown"><a href="javascript:void(0);" class="has-sub">{{ __("Business") }}
                                            <i class="fas fa-angle-down"></i></a>
                                        <div class="sub-menu">
                                            @if(page_access('merchant'))
                                                <div class="sub-menu-title">
                                                    <a href="{{ setRoute('merchant') }}" class="menu-name">
                                                        <h3 class="title">{{ __("Merchant") }} <i class="fas fa-long-arrow-alt-right ms-1"></i> </h3>
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="sub-menu-wrapper">
                                                <div class="row mb-10-none">
                                                    @foreach ($business ?? [] as  $item)
                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-10">
                                                            <a href="{{ setRoute('header.page',encrypt($item->id)) }}">
                                                                <div class="sub-menu-item">
                                                                    <div class="icon">
                                                                        <i class="{{ __($item->icon->language->$lang->icon ?? $item->icon->language->$system_default->icon) }}"></i>
                                                                    </div>
                                                                    <div class="menu-item-name">
                                                                        <h4 class="title">{{ __($item->title->language->$lang->title ?? $item->title->language->$system_default->title) }}</h4>
                                                                        <p>{{ __($item->sub_title->language->$lang->sub_title ?? $item->sub_title->language->$system_default->sub_title) }}</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(page_access('enterprice'))
                                    <li class="nav-item dropdown"><a href="javascript:void(0);" class="has-sub">{{ __("Enterprise") }}
                                            <i class="fas fa-angle-down"></i></a>
                                        <div class="sub-menu">
                                            @if(page_access('agent'))
                                                <div class="sub-menu-title">
                                                    <a href="{{setRoute('agent') }}" class="menu-name">
                                                        <h3 class="title">{{ __("Agent") }} <i class="fas fa-long-arrow-alt-right ms-1"></i> </h3>
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="sub-menu-wrapper">
                                                <div class="row mb-10-none">
                                                    @foreach ($enter_price ?? [] as  $item)
                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-10">
                                                            <a href="{{ setRoute('header.page',encrypt($item->id)) }}">
                                                                <div class="sub-menu-item">
                                                                    <div class="icon">
                                                                        <i class="{{ __($item->icon->language->$lang->icon ?? $item->icon->language->$system_default->icon) }}"></i>
                                                                    </div>
                                                                    <div class="menu-item-name">
                                                                        <h4 class="title">{{ __($item->title->language->$lang->title ?? $item->title->language->$system_default->title) }}</h4>
                                                                        <p>{{ __($item->sub_title->language->$lang->sub_title ?? $item->sub_title->language->$system_default->sub_title) }}</p>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(page_access('company'))
                                    <li class="nav-item dropdown"><a href="javascript:void(0);" class="has-sub">{{ __("Company") }}
                                            <i class="fas fa-angle-down"></i></a>
                                        <div class="sub-menu">
                                            <div class="sub-menu-wrapper">
                                                <div class="row mb-10-none">
                                                    @foreach ($company ?? [] as  $item)
                                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-10">
                                                                <a href="{{ setRoute( $item->slug ?? '') }}">
                                                                    <div class="sub-menu-item">
                                                                        <div class="icon">
                                                                            <i class="{{ __($item->icon->language->$lang->icon ?? $item->icon->language->$system_default->icon) }}"></i>
                                                                        </div>
                                                                        <div class="menu-item-name">
                                                                            <h4 class="title">{{ __($item->title->language->$lang->title ?? $item->title->language->$system_default->title) }}</h4>
                                                                            <p>{{ __($item->sub_title->language->$lang->sub_title ?? $item->sub_title->language->$system_default->sub_title) }}</p>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                @if(page_access('developer'))
                                    <li class="nav-item dropdown">
                                        <a href="{{ setRoute("developer.index") }}" class="has-sub {{ menuActive('developer.index') }}">{{ __("Developer") }}</a>
                                    </li>
                                @endif

                            </ul>
                            <div class="navbar-right">
                                <ul>
                                    @if(page_access('contact'))
                                        <li class="nav-item">
                                            <a href="{{ setRoute('contact') }}" class="help-btn {{ menuActive('contact') }}">{{ __("Help") }}</a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="lang-select">
                                    @php
                                    $session_lan = session('local')??get_default_language_code();
                                    @endphp
                                    <select class="form--control langSel nice-select">
                                        @foreach($__languages as $item)
                                        <option value="{{$item->code}}" @if( $session_lan == $item->code) selected  @endif>{{ __($item->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="header-action">
                                    @if(auth('web')->check())
                                        <a href="{{ setRoute('user.dashboard') }}" class="btn--base btn-auth">{{ __("Dashboard") }}</a>
                                     @elseif(auth('agent')->check())
                                        <a href="{{ setRoute('agent.dashboard') }}" class="btn--base btn-auth">{{ __("Dashboard") }}</a>
                                    @elseif(auth('merchant')->check())
                                        <a href="{{ setRoute('merchant.dashboard') }}" class="btn--base btn-auth">{{ __("Dashboard") }}</a>
                                    @else
                                        <a href="{{ setRoute('user.login') }}" class="btn--base btn">{{ __("Log In") }}</a>
                                        <a href="{{ setRoute('user.register') }}" class="btn--base btn-auth">{{ __("sign Up") }}</a>
                                    @endif
                                </div>


                            </div>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
