<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Google Tag Manager (noscript)-->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX4JH47" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript)-->
    <div class="sidebar sidebar-light sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <svg class="sidebar-brand-full ms-2" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#signet"></use>
            </svg>
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item"><a class="nav-link" href="index.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                    </svg> Dashboard<span class="badge bg-primary-gradient ms-auto">NEW</span></a></li>
            <li class="nav-title">Components</li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                    </svg> Base</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="base/accordion.html"><span class="nav-icon"></span>
                            Accordion</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/breadcrumb.html"><span class="nav-icon"></span>
                            Breadcrumb</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/cards.html"><span class="nav-icon"></span>
                            Cards</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/carousel.html"><span class="nav-icon"></span>
                            Carousel</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/collapse.html"><span class="nav-icon"></span>
                            Collapse</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/list-group.html"><span class="nav-icon"></span>
                            List group</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/navs-tabs.html"><span class="nav-icon"></span>
                            Navs &amp; Tabs</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/pagination.html"><span class="nav-icon"></span>
                            Pagination</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/placeholders.html"><span
                                class="nav-icon"></span> Placeholders</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/popovers.html"><span class="nav-icon"></span>
                            Popovers</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/progress.html"><span class="nav-icon"></span>
                            Progress</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/scrollspy.html"><span class="nav-icon"></span>
                            Scrollspy</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/spinners.html"><span class="nav-icon"></span>
                            Spinners</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/tables.html"><span class="nav-icon"></span>
                            Tables</a></li>
                    <li class="nav-item"><a class="nav-link" href="base/tooltips.html"><span
                                class="nav-icon"></span> Tooltips</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
                    </svg> Buttons</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="buttons/buttons.html"><span
                                class="nav-icon"></span> Buttons</a></li>
                    <li class="nav-item"><a class="nav-link" href="buttons/button-group.html"><span
                                class="nav-icon"></span> Buttons Group</a></li>
                    <li class="nav-item"><a class="nav-link" href="buttons/loading-buttons.html"> Loading
                            Buttons<span class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="buttons/dropdowns.html"><span
                                class="nav-icon"></span> Dropdowns</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
                    </svg> Forms</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="forms/form-control.html"> Form Control</a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/select.html"> Select</a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/multi-select.html"><span
                                class="nav-icon"></span> Multi Select<span
                                class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/checks-radios.html"> Checks and radios</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="forms/range.html"> Range</a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/input-group.html"> Input group</a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/floating-labels.html"> Floating labels</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="forms/date-picker.html"> Date Picker<span
                                class="badge bg-success ms-auto">LAB</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/date-range-picker.html"> Date Range
                            Picker<span class="badge bg-success ms-auto">LAB</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/time-picker.html"> Time Picker<span
                                class="badge bg-success ms-auto">LAB</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/layout.html"> Layout</a></li>
                    <li class="nav-item"><a class="nav-link" href="forms/validation.html"> Validation</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
                    </svg> Icons</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-free.html"> CoreUI Icons<span
                                class="badge bg-success ms-auto">Free</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-brand.html"> CoreUI Icons -
                            Brand</a></li>
                    <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-flag.html"> CoreUI Icons -
                            Flag</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg> Notifications</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="notifications/alerts.html"><span
                                class="nav-icon"></span> Alerts</a></li>
                    <li class="nav-item"><a class="nav-link" href="notifications/badge.html"><span
                                class="nav-icon"></span> Badge</a></li>
                    <li class="nav-item"><a class="nav-link" href="notifications/modals.html"><span
                                class="nav-icon"></span> Modals</a></li>
                    <li class="nav-item"><a class="nav-link" href="notifications/toasts.html"><span
                                class="nav-icon"></span> Toasts</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="widgets.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calculator"></use>
                    </svg> Widgets<span class="badge bg-primary-gradient ms-auto">NEW</span></a></li>
            <li class="nav-divider"></li>
            <li class="nav-title">Plugins</li>
            <li class="nav-item"><a class="nav-link" href="calendar.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                    </svg> Calendar<span class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
            <li class="nav-item"><a class="nav-link" href="charts.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                    </svg> Charts</a></li>
            <li class="nav-item"><a class="nav-link" href="datatables.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-spreadsheet"></use>
                    </svg> DataTables<span class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
            <li class="nav-item"><a class="nav-link" href="google-maps.html">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-map"></use>
                    </svg> Google Maps<span class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
            <li class="nav-title">Extras</li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-star"></use>
                    </svg> Pages</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="login.html" target="_top">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                            </svg> Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.html" target="_top">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                            </svg> Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="404.html" target="_top">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bug"></use>
                            </svg> Error 404</a></li>
                    <li class="nav-item"><a class="nav-link" href="500.html" target="_top">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bug"></use>
                            </svg> Error 500</a></li>
                </ul>
            </li>
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-layers"></use>
                    </svg> Apps</a>
                <ul class="nav-group-items">
                    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                            </svg> Invoicing</a>
                        <ul class="nav-group-items">
                            <li class="nav-item"><a class="nav-link" href="apps/invoicing/invoice.html"> Invoice<span
                                        class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                            <svg class="nav-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg> Email</a>
                        <ul class="nav-group-items">
                            <li class="nav-item"><a class="nav-link" href="apps/email/inbox.html"> Inbox<span
                                        class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="apps/email/message.html"> Message<span
                                        class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="apps/email/compose.html"> Compose<span
                                        class="badge bg-danger-gradient ms-auto">PRO</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item mt-auto"><a class="nav-link" href="https://coreui.io/docs/templates/installation/"
                    target="_blank">
                    <svg class="nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                    </svg> Docs</a></li>
            <li class="nav-title">System Utilization</li>
            <li class="nav-item px-3 d-narrow-none">
                <div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-primary-gradient" role="progressbar" style="width: 25%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis-inverse">348 Processes. 1/4 Cores.</small>
            </li>
            <li class="nav-item px-3 d-narrow-none">
                <div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 70%"
                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis-inverse">11444GB/16384MB</small>
            </li>
            <li class="nav-item px-3 mb-3 d-narrow-none">
                <div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 95%"
                        aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis-inverse">243GB/256GB</small>
            </li>
        </ul>
    </div>
    <div class="sidebar sidebar-light sidebar-lg sidebar-end sidebar-overlaid hide" id="aside">
        <div class="sidebar-header bg-transparent p-0">
            <ul class="nav nav-underline nav-underline-primary" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#timeline"
                        role="tab">
                        <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#messages" role="tab">
                        <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speech"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#settings" role="tab">
                        <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg></a></li>
            </ul>
            <button class="sidebar-close" type="button" data-coreui-close="sidebar">
                <svg class="icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-x"></use>
                </svg>
            </button>
        </div>
        <!-- Tab panes-->
        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="list-group list-group-flush">
                    <div
                        class="list-group-item border-start-4 border-start-secondary bg-light text-center fw-bold text-medium-emphasis text-uppercase small dark:bg-white dark:bg-opacity-10 dark:text-medium-emphasis">
                        Today</div>
                    <div class="list-group-item border-start-4 border-start-warning list-group-item-divider">
                        <div class="avatar avatar-lg float-end"><img class="avatar-img"
                                src="assets/img/avatars/7.jpg" alt="user@email.com"></div>
                        <div>Meeting with <strong>Lucas</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 1 - 3pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg> Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item border-start-4 border-start-info">
                        <div class="avatar avatar-lg float-end"><img class="avatar-img"
                                src="assets/img/avatars/4.jpg" alt="user@email.com"></div>
                        <div>Skype with <strong>Megan</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 4 - 5pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-skype"></use>
                            </svg> On-line</small>
                    </div>
                    <div
                        class="list-group-item border-start-4 border-start-secondary bg-light text-center fw-bold text-medium-emphasis text-uppercase small dark:bg-white dark:bg-opacity-10 dark:text-medium-emphasis">
                        Tomorrow</div>
                    <div class="list-group-item border-start-4 border-start-danger list-group-item-divider">
                        <div>New UI Project - <strong>deadline</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 10 - 11pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg> creativeLabs HQ</small>
                        <div class="avatars-stack mt-2">
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                    <div class="list-group-item border-start-4 border-start-success list-group-item-divider">
                        <div><strong>#10 Startups.Garden</strong> Meetup</div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 1 - 3pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg> Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item border-start-4 border-start-primary list-group-item-divider">
                        <div><strong>Team meeting</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 4 - 6pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg> creativeLabs HQ</small>
                        <div class="avatars-stack mt-2">
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="assets/img/avatars/8.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="aside-options">
                    <div class="clearfix mt-4">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox"
                                checked="">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                1</label>
                        </div>
                    </div>
                    <div><small class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                2</label>
                        </div>
                    </div>
                    <div><small class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                3</label>
                        </div>
                    </div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox"
                                checked="">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                4</label>
                        </div>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 2 Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">25GB/256GB</small>
            </div>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        <header class="header header-light bg-primary header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none text-white" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="assets/brand/coreui.svg#full"></use>
                    </svg></a>
                <form class="d-none d-md-flex" role="search">
                    <div class="input-group"><span class="input-group-text bg-light border-0 px-1" id="search-addon">
                            <svg class="icon icon-lg my-1 mx-2 text-disabled">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-search"></use>
                            </svg></span>
                        <input class="form-control bg-light border-0" type="text" placeholder="Search..."
                            aria-label="Search" aria-describedby="search-addon">
                    </div>
                </form>
                <ul class="header-nav d-none d-sm-flex ms-auto me-3">
                    <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false"><span
                                class="d-inline-block my-1 mx-2 position-relative">
                                <svg class="icon icon-lg">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                                </svg><span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle"><span
                                        class="visually-hidden">New alerts</span></span></span></a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                            <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have 5
                                    notifications</strong></div><a class="dropdown-item" href="#">
                                <svg class="icon me-2 text-success">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                                </svg> New user registered</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2 text-danger">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                                </svg> User deleted</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2 text-info">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                                </svg> Sales report is ready</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2 text-success">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                                </svg> New client</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2 text-warning">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                                </svg> Server overloaded</a>
                            <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10">
                                <strong>Server</strong></div><a class="dropdown-item d-block" href="#">
                                <div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </span><small class="text-medium-emphasis">348 Processes. 1/4 Cores.</small>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </span><small class="text-medium-emphasis">11444GB/16384MB</small>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%"
                                        aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                </span><small class="text-medium-emphasis">243GB/256GB</small>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false"><span
                                class="d-inline-block my-1 mx-2 position-relative">
                                <svg class="icon icon-lg">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                                </svg><span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle"><span
                                        class="visually-hidden">New alerts</span></span></span></a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg py-0">
                            <div class="dropdown-header bg-light fw-semibold dark:bg-white dark:bg-opacity-10">You have
                                5 pending tasks</div><a class="dropdown-item d-block" href="#">
                                <div class="small mb-1">Upgrade NPM &amp; Bower<span
                                        class="float-end"><strong>0%</strong></span></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="small mb-1">ReactJS Version<span
                                        class="float-end"><strong>25%</strong></span></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="small mb-1">VueJS Version<span
                                        class="float-end"><strong>50%</strong></span></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%"
                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="small mb-1">Add new layouts<span
                                        class="float-end"><strong>75%</strong></span></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 75%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a><a class="dropdown-item d-block" href="#">
                                <div class="small mb-1">Angular 8 Version<span
                                        class="float-end"><strong>100%</strong></span></div><span
                                    class="progress progress-thin">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </span>
                            </a>
                            <div class="p-2"><a class="btn btn-outline-primary w-100" href="#">View all
                                    tasks</a></div>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false"><span
                                class="d-inline-block my-1 mx-2 position-relative">
                                <svg class="icon icon-lg">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                </svg><span
                                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger rounded-circle"><span
                                        class="visually-hidden">New alerts</span></span></span></a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                            <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have 4
                                    messages</strong></div><a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                                alt="user@email.com"><span class="avatar-status bg-success"></span>
                                        </div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">Just now</small></div>
                                    <div class="text-truncate font-weight-bold"><span class="text-danger">!</span>
                                        Important message</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a><a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/6.jpg"
                                                alt="user@email.com"><span class="avatar-status bg-warning"></span>
                                        </div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">5 minutes ago</small></div>
                                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a><a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/5.jpg"
                                                alt="user@email.com"><span class="avatar-status bg-danger"></span>
                                        </div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a><a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/4.jpg"
                                                alt="user@email.com"><span class="avatar-status bg-info"></span></div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">4:03 PM</small></div>
                                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a><a class="dropdown-item text-center border-top" href="#"><strong>View all
                                    messages</strong></a>
                        </div>
                    </li>
                </ul>
                <ul class="header-nav ms-auto ms-sm-0 me-sm-4">
                    <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0"
                            data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg"
                                    alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                                <div class="fw-semibold">Account</div>
                            </div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                                </svg> Updates<span class="badge badge-sm bg-info-gradient ms-2">42</span></a><a
                                class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                </svg> Messages<span class="badge badge-sm badge-sm bg-success ms-2">42</span></a><a
                                class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                                </svg> Tasks<span class="badge badge-sm bg-danger-gradient ms-2">42</span></a><a
                                class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                                </svg> Comments<span class="badge badge-sm bg-warning-gradient ms-2">42</span></a>
                            <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                                <div class="fw-semibold">Settings</div>
                            </div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                </svg> Settings</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                                </svg> Payments<span
                                    class="badge badge-sm bg-secondary-gradient text-dark ms-2">42</span></a><a
                                class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                                </svg> Projects<span class="badge badge-sm bg-primary-gradient ms-2">42</span></a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                </svg> Lock Account</a><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                </svg> Logout</a>
                        </div>
                    </li>
                </ul>
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#aside')).show()">
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
                    </svg>
                </button>
            </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <div class="fs-2 fw-semibold">Dashboard</div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Home</span>
                        </li>
                        <li class="breadcrumb-item active"><span>Dashboard</span></li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col">
                                                <div class="card-title fs-4 fw-semibold">Sale</div>
                                                <div class="card-subtitle text-disabled">January - July 2022</div>
                                            </div>
                                            <div class="col text-end text-primary fs-4 fw-semibold">$613.200</div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper mt-3" style="height:150px;">
                                        <canvas class="chart" id="card-chart-new1" height="75"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="card-title text-disabled">Customers</div>
                                            <div class="bg-primary bg-opacity-25 text-primary p-2 rounded">
                                                <svg class="icon icon-xl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people">
                                                    </use>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="fs-4 fw-semibold pb-3">44.725</div><small
                                            class="text-danger">(-12.4%
                                            <svg class="icon">
                                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                </use>
                                            </svg>)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="card-title text-disabled">Orders</div>
                                            <div class="bg-primary bg-opacity-25 text-primary p-2 rounded">
                                                <svg class="icon icon-xl">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cart">
                                                    </use>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="fs-4 fw-semibold pb-3">385</div><small class="text-success">(17.2%
                                            <svg class="icon">
                                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                                </use>
                                            </svg>)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="card-title fs-4 fw-semibold">Traffic</div>
                                <div class="card-subtitle text-disabled">January 01, 2021 - December 31, 2021</div>
                                <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                                    <canvas class="chart" id="main-bar-chart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-title fs-4 fw-semibold">Users</div>
                                        <div class="card-subtitle text-disabled mb-4">1.232.150 registered users</div>
                                    </div>
                                    <div class="col-auto ms-auto">
                                        <button class="btn btn-secondary">
                                            <svg class="icon me-2">
                                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-plus">
                                                </use>
                                            </svg>Add new user
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="fw-semibold text-disabled">
                                            <tr class="align-middle">
                                                <th class="text-center">
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people">
                                                        </use>
                                                    </svg>
                                                </th>
                                                <th>User</th>
                                                <th class="text-center">Country</th>
                                                <th>Usage</th>
                                                <th>Activity</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/1.jpg" alt="user@email.com"><span
                                                            class="avatar-status bg-success"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Yiorgos Avraamu</div>
                                                    <div class="small text-medium-emphasis text-nowrap">New |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-us">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">50%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success-gradient"
                                                            role="progressbar" style="width: 50%"
                                                            aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">10 sec ago</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/2.jpg"
                                                            alt="user@email.com"><span
                                                            class="avatar-status bg-danger-gradient"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Avram Tarasios</div>
                                                    <div class="small text-medium-emphasis text-nowrap">Recurring |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-br">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">10%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-info-gradient"
                                                            role="progressbar" style="width: 10%"
                                                            aria-valuenow="10" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">5 minutes ago</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/3.jpg"
                                                            alt="user@email.com"><span
                                                            class="avatar-status bg-warning-gradient"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Quintin Ed</div>
                                                    <div class="small text-medium-emphasis text-nowrap">New |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-in">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">74%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-warning-gradient"
                                                            role="progressbar" style="width: 74%"
                                                            aria-valuenow="74" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">1 hour ago</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/4.jpg"
                                                            alt="user@email.com"><span
                                                            class="avatar-status bg-secondary-gradient"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Enéas Kwadwo</div>
                                                    <div class="small text-medium-emphasis text-nowrap">New |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-fr">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">98%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-danger-gradient"
                                                            role="progressbar" style="width: 98%"
                                                            aria-valuenow="98" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">Last month</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/5.jpg"
                                                            alt="user@email.com"><span
                                                            class="avatar-status bg-success"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Agapetus Tadeáš</div>
                                                    <div class="small text-medium-emphasis text-nowrap">New |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-es">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">22%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-info-gradient"
                                                            role="progressbar" style="width: 22%"
                                                            aria-valuenow="22" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">Last week</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropup">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">
                                                    <div class="avatar avatar-md"><img class="avatar-img"
                                                            src="assets/img/avatars/6.jpg"
                                                            alt="user@email.com"><span
                                                            class="avatar-status bg-danger-gradient"></span></div>
                                                </td>
                                                <td>
                                                    <div class="text-nowrap">Friderik Dávid</div>
                                                    <div class="small text-medium-emphasis text-nowrap">New |
                                                        Registered: Jan 1, 2020</div>
                                                </td>
                                                <td class="text-center">
                                                    <svg class="icon icon-xl">
                                                        <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-pl">
                                                        </use>
                                                    </svg>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="float-start">
                                                            <div class="fw-semibold">43%</div>
                                                        </div>
                                                        <div class="float-end ms-1 text-nowrap"><small
                                                                class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                                                2020</small></div>
                                                    </div>
                                                    <div class="progress progress-thin">
                                                        <div class="progress-bar bg-success-gradient"
                                                            role="progressbar" style="width: 43%"
                                                            aria-valuenow="43" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small text-medium-emphasis">Last login</div>
                                                    <div class="fw-semibold text-nowrap">Yesterday</div>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropup">
                                                        <button
                                                            class="btn btn-transparent p-0 dark:text-high-emphasis"
                                                            type="button" data-coreui-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <svg class="icon">
                                                                <use
                                                                    xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                                </use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end"><a
                                                                class="dropdown-item" href="#">Info</a><a
                                                                class="dropdown-item" href="#">Edit</a><a
                                                                class="dropdown-item text-danger"
                                                                href="#">Delete</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="row">
                            <div class="col-md-4 col-xl-12">
                                <div class="card mb-4 text-white bg-primary-gradient">
                                    <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                        </use>
                                                    </svg>)</span></div>
                                            <div>Users</div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent text-white p-0" type="button"
                                                data-coreui-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg class="icon">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                    </use>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                    href="#">Action</a><a class="dropdown-item"
                                                    href="#">Another action</a><a class="dropdown-item"
                                                    href="#">Something else here</a></div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper mt-3 mx-3" style="height:80px;">
                                        <canvas class="chart" id="card-chart1" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-12">
                                <div class="card mb-4 text-white bg-warning-gradient">
                                    <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                                        </use>
                                                    </svg>)</span></div>
                                            <div>Conversion Rate</div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent text-white p-0" type="button"
                                                data-coreui-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg class="icon">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                    </use>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                    href="#">Action</a><a class="dropdown-item"
                                                    href="#">Another action</a><a class="dropdown-item"
                                                    href="#">Something else here</a></div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper mt-3" style="height:80px;">
                                        <canvas class="chart" id="card-chart3" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-12">
                                <div class="card mb-4 text-white bg-danger-gradient">
                                    <div class="card-body p-4 pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                                                    <svg class="icon">
                                                        <use
                                                            xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom">
                                                        </use>
                                                    </svg>)</span></div>
                                            <div>Sessions</div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent text-white p-0" type="button"
                                                data-coreui-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg class="icon">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options">
                                                    </use>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                                    href="#">Action</a><a class="dropdown-item"
                                                    href="#">Another action</a><a class="dropdown-item"
                                                    href="#">Something else here</a></div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper mt-3 mx-3" style="height:80px;">
                                        <canvas class="chart" id="card-chart4" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="card-title fs-4 fw-semibold">Traffic</div>
                                <div class="card-subtitle text-disabled border-bottom mb-3 pb-4">Last Week</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="border-start border-start-4 border-start-info px-3 mb-3">
                                                    <small class="text-medium-emphasis text-truncate">New
                                                        Clients</small>
                                                    <div class="fs-5 fw-semibold">9.123</div>
                                                </div>
                                            </div>
                                            <!-- /.col-->
                                            <div class="col-6">
                                                <div
                                                    class="border-start border-start-4 border-start-danger px-3 mb-3">
                                                    <small class="text-medium-emphasis text-truncate">Recuring
                                                        Clients</small>
                                                    <div class="fs-5 fw-semibold">22.643</div>
                                                </div>
                                            </div>
                                            <!-- /.col-->
                                        </div>
                                        <!-- /.row-->
                                        <div class="progress-group mb-4 pt-4 border-top">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Monday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 34%" aria-valuenow="34" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 78%" aria-valuenow="78" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Tuesday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 56%" aria-valuenow="56" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Wednesday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 12%" aria-valuenow="12" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 67%" aria-valuenow="67" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Thursday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 91%" aria-valuenow="91" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Friday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 22%" aria-valuenow="22" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 73%" aria-valuenow="73" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Saturday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 53%" aria-valuenow="53" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 82%" aria-valuenow="82" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend"><span
                                                    class="text-disabled small">Sunday</span></div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-info-gradient" role="progressbar"
                                                        style="width: 9%" aria-valuenow="9" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-danger-gradient" role="progressbar"
                                                        style="width: 69%" aria-valuenow="69" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div
                                                    class="border-start border-start-4 border-start-warning px-3 mb-3">
                                                    <small
                                                        class="text-medium-emphasis text-truncate">Pageviews</small>
                                                    <div class="fs-5 fw-semibold">78.623</div>
                                                </div>
                                            </div>
                                            <!-- /.col-->
                                            <div class="col-6">
                                                <div
                                                    class="border-start border-start-4 border-start-success px-3 mb-3">
                                                    <small class="text-medium-emphasis text-truncate">Organic</small>
                                                    <div class="fs-5 fw-semibold">49.123</div>
                                                </div>
                                            </div>
                                            <!-- /.col-->
                                        </div>
                                        <!-- /.row-->
                                        <div class="progress-group mb-4 pt-4 border-top">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user">
                                                    </use>
                                                </svg>
                                                <div>Male</div>
                                                <div class="ms-auto fw-semibold">43%</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-warning-gradient" role="progressbar"
                                                        style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-5">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-female">
                                                    </use>
                                                </svg>
                                                <div>Female</div>
                                                <div class="ms-auto fw-semibold">37%</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-warning-gradient" role="progressbar"
                                                        style="width: 43%" aria-valuenow="43" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-google">
                                                    </use>
                                                </svg>
                                                <div>Organic Search</div>
                                                <div class="ms-auto fw-semibold me-2">191.235</div>
                                                <div class="text-disabled small">(56%)</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success-gradient" role="progressbar"
                                                        style="width: 56%" aria-valuenow="56" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f">
                                                    </use>
                                                </svg>
                                                <div>Facebook</div>
                                                <div class="ms-auto fw-semibold me-2">51.223</div>
                                                <div class="text-disabled small">(15%)</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success-gradient" role="progressbar"
                                                        style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter">
                                                    </use>
                                                </svg>
                                                <div>Twitter</div>
                                                <div class="ms-auto fw-semibold me-2">37.564</div>
                                                <div class="text-disabled small">(11%)</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success-gradient" role="progressbar"
                                                        style="width: 11%" aria-valuenow="11" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-group">
                                            <div class="progress-group-header">
                                                <svg class="icon icon-lg me-2">
                                                    <use
                                                        xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin">
                                                    </use>
                                                </svg>
                                                <div>LinkedIn</div>
                                                <div class="ms-auto fw-semibold me-2">27.319</div>
                                                <div class="text-disabled small">(8%)</div>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success-gradient" role="progressbar"
                                                        style="width: 8%" aria-valuenow="8" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-->
                                </div>
                                <!-- /.row-->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>

        <x-footer>
            
        </x-footer>
    </div>
</body>

</html>
