@php
    $segment =[];
@endphp
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            @if (count(__('sidebar')) > 0)
                @foreach (__('sidebar') as $val)
                <li class="menu-item @if (in_array($segment, $val['name'])) active @endif">
                        {{-- @dd(array_key_exists('route',$val)) --}}
                        <a href="{{ array_key_exists("route",$val) && Route::has($val['route']) ? route($val['route']) : 'javascript:void(0)' }}" class="menu-link {{ array_key_exists("subModule",$val) && Route::has($val['route']) ? 'menu-toggle' : null }}">
                            <i class="menu-icon {{ $val['icon'] ?? 'tf-icons ri-home-smile-line' }}"></i>
                            <div data-i18n="Dashboards">{{ $val['title'] }}</div>
                        </a>
                        @if (array_key_exists('subModule',$val) && !empty($val['subModule']))
                            <ul class="menu-sub">
                                @foreach ($val['subModule'] as $sub)
                                    <li class="menu-item">
                                        <a href="{{ Route::has($sub['route']) ? route($sub['route']) : null }}"
                                            class="menu-link">
                                            <i class="menu-icon tf-icons ri-shopping-cart-2-line"></i>
                                            <div data-i18n="eCommerce">{{ $sub['title'] }}</div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
            <!-- Layouts -->
            {{-- <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ri-layout-2-line"></i>
                    <div data-i18n="Layouts">Layouts</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                            <i class="menu-icon tf-icons ri-layout-4-line"></i>
                            <div data-i18n="Without menu">Without menu</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                            <i class="menu-icon tf-icons ri-layout-left-line"></i>
                            <div data-i18n="Vertical">Vertical</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-fluid.html" class="menu-link">
                            <i class="menu-icon tf-icons ri-layout-top-line"></i>
                            <div data-i18n="Fluid">Fluid</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-container.html" class="menu-link">
                            <i class="menu-icon tf-icons ri-layout-top-2-line"></i>
                            <div data-i18n="Container">Container</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="layouts-blank.html" class="menu-link">
                            <i class="menu-icon tf-icons ri-square-line"></i>
                            <div data-i18n="Blank">Blank</div>
                        </a>
                    </li>
                </ul>
            </li> --}}

        </ul>
    </div>
</aside>
