<div>
    <main class="main_content_wrapper setting_content_wrapper">
        <button type="button" class="sidebar_open_btn" id="sidebarShowBtn">
            <img src="{{ asset('assets/app/icons/back-double-arrow.svg') }}" alt="double arrow" />
        </button>
        @if (user()->type != 'sub')
            <!-- Pricing Section  -->
            <section class="pricing_wrapper">
                <div class="container container-custom">
                    <div class="row">
                        <div class="col-12">
                            <div class="header_area text-center">
                                <h2 class="pricing_title">Bring Your Own Gateway</h2>
                                <h5>
                                    Already have a preferred SMS gateway? Easily integrate it with
                                    our platform and choose a plan that suits your needs.
                                </h5>
                            </div>
                            <div class="pricing_grid">
                                <div>
                                    <div class="pricing_item">
                                        <h3>Standard</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>7,000 credits</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Access to essential SMS marketing features</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Real-time delivery reports</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Message templates</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Contact management</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Basic customer support</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>5 sub-account</h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$49 <span>/month </span></h6>
                                        @if (getActiveSubscription()['name'] == 'standard')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ffffff"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('own-gateway', 'standard')" class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('own-gateway', 'standard')", 'Choose Your Plan') !!}</button>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="pricing_item premium_pricing_item">
                                        <h3>Premium</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>15,000 credits</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Everything in Standard and Additionally</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Advanced analytics and reporting</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Automated message scheduling</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Priority customer support</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>10 sub-accounts</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>
                                                    API access for seamless integration with your gateway
                                                </h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$99 <span>/month </span></h6>
                                        @if (getActiveSubscription()['name'] == 'premium')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ffffff"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('own-gateway', 'premium')" class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('own-gateway', 'premium')", 'Choose Your Plan') !!}</button>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="pricing_item">
                                        <h3>Enterprise</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>30,000 credits</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Everything in Premium and Additionally</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Unlimited contact segmentation</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Custom API integrations</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>24/7 dedicated support</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Unlimited sub-accounts</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Advanced security and compliance features</h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$149 <span>/month </span></h6>
                                        @if (getActiveSubscription()['name'] == 'enterprise')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5"
                                                    stroke="#ffffff" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('own-gateway', 'enterprise')"
                                                class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('own-gateway', 'enterprise')", 'Choose Your Plan') !!}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inclusive Pricing Section  -->
            <section class="pricing_wrapper inclusive_pricing_wrapper overflow-x-hidden">
                <div class="container container-custom">
                    <div class="row">
                        <div class="col-12">
                            <div class="header_area text-center">
                                <h2 class="pricing_title">All-Inclusive Platform</h2>
                                <h5>
                                    Don’t have a gateway? No problem. Use our complete solution
                                    and pay per message. Our all-inclusive platform offers
                                    everything you need to start your SMS campaigns without any
                                    additional setup."
                                </h5>
                            </div>
                            <div class="pricing_grid">
                                <div>
                                    <div class="pricing_item">
                                        <h3>Starter</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Access to essential SMS marketing features</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Real-time delivery reports</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Contact management</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Basic customer support</h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$625 <span>/25,000 messages </span></h6>
                                        {{-- @if (getActiveSubscription()['name'] == 'starter')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5"
                                                    stroke="#ffffff" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('text-torrent', 'starter')"
                                                class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('text-torrent', 'starter')", 'Choose Your Plan') !!}</button>
                                        @endif --}}

                                        <button class="choose_btn">Comming Soon</button>
                                    </div>
                                </div>
                                <div>
                                    <div class="pricing_item premium_pricing_item">
                                        <h3>Growth</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Everything in Starter and Additionally</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Advanced analytics and reporting</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Automated message scheduling</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Priority customer support</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check-white.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Customizable message templates</h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$1,250 <span>/50,000 messages </span></h6>
                                        {{-- @if (getActiveSubscription()['name'] == 'growth')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5"
                                                    stroke="#ffffff" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('text-torrent', 'growth')" class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('text-torrent', 'growth')", 'Choose Your Plan') !!}</button>
                                        @endif --}}

                                        <button class="choose_btn">Comming Soon</button>
                                    </div>
                                </div>
                                <div>
                                    <div class="pricing_item">
                                        <h3>Pro</h3>
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Everything in Growth and Additionally</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Unlimited contact segmentation</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Detailed campaign analytics</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>24/7 dedicated support</h4>
                                            </li>
                                            <li>
                                                <div class="icon">
                                                    <img src="{{ asset('assets/app/icons/entypo_check.svg') }}"
                                                        alt="check icon" />
                                                </div>
                                                <h4>Advanced security and compliance features</h4>
                                            </li>
                                        </ul>
                                        <h6 class="price">$2,550 <span>/100,000 messages</span></h6>
                                        {{-- @if (getActiveSubscription()['name'] == 'pro')
                                            <button class="choose_btn bg-success" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-checks" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2.5"
                                                    stroke="#ffffff" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 12l5 5l10 -10" />
                                                    <path d="M2 12l5 5m5 -5l5 -5" />
                                                </svg>
                                                Current Plan</button>
                                        @else
                                            <button wire:click="purchasePlan('text-torrent', 'pro')" class="choose_btn"
                                                wire:loading.attr='disabled'>{!! loadingStateWithText("purchasePlan('text-torrent', 'pro')", 'Choose Your Plan') !!}</button>
                                        @endif --}}

                                        <button class="choose_btn">Comming Soon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
</div>
