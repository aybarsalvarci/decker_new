<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('back/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Deck-er</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link {{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-fire"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">COMMERCIAL & SALES</li>

                <li class="nav-item">
                    <a href="{{route('admin.category.index')}}"
                       class="nav-link {{request()->routeIs('admin.category.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.product.index')}}"
                       class="nav-link {{request()->routeIs('admin.product.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.offer.index')}}"
                       class="nav-link {{request()->routeIs('admin.offer.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Offers</p>
                    </a>
                </li>

                <li class="nav-item {{request()->routeIs('admin.free-sample.*') ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->routeIs('admin.free-sample.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            Free Samples
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.free-sample.index')}}"
                               class="nav-link {{request()->routeIs('admin.free-sample.index') ? 'active' : ''}}">
                                <i class="fas fa-inbox nav-icon"></i>
                                <p>Sample Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.free-sample.box.index')}}"
                               class="nav-link {{request()->routeIs('admin.free-sample.box.*') ? 'active' : ''}}">
                                <i class="fas fa-archive nav-icon"></i>
                                <p>Sample Boxes</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">CONTENT MANAGEMENT</li>

                <li class="nav-item">
                    <a href="{{route('admin.home-settings.index')}}"
                       class="nav-link {{request()->routeIs('admin.home-settings.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>Manage Homepage</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.about.index')}}"
                       class="nav-link {{request()->routeIs('admin.about.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>Manage About Page</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.report.index')}}"
                       class="nav-link {{request()->routeIs('admin.report.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Reports (News)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.product-color.index')}}"
                       class="nav-link {{request()->routeIs('admin.product-color.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-eye-dropper"></i>
                        <p>Product Colors</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.faqs.index')}}"
                       class="nav-link {{request()->routeIs('admin.faqs.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>FAQ</p>
                    </a>
                </li>

                <li class="nav-item {{request()->routeIs('admin.resources.*') || request()->routeIs('admin.technical.*') ? 'menu-open' : ''}}">
                    <a href="#"
                       class="nav-link {{request()->routeIs('admin.resources.*') || request()->routeIs('admin.technical.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Resource Center
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.resources.catalog')}}"
                               class="nav-link {{request()->routeIs('admin.resources.catalog') ? 'active' : ''}}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Online Catalog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.resources.installation-guides.index')}}"
                               class="nav-link {{request()->routeIs('admin.resources.installation-guides.*') ? 'active' : ''}}">
                                <i class="fas fa-stream nav-icon"></i>
                                <p>Installation Guides</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.resources.warranties')}}"
                               class="nav-link {{request()->routeIs('admin.resources.warranties') ? 'active' : ''}}">
                                <i class="fas fa-check-double nav-icon"></i>
                                <p>Warranties</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.resources.care-and-maintenance')}}"
                               class="nav-link {{request()->routeIs('admin.resources.care-and-maintenance') ? 'active' : ''}}">
                                <i class="fas fa-magic nav-icon"></i>
                                <p>Care & Maintenance</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.resources.gallery.index')}}"
                               class="nav-link {{request()->routeIs('admin.resources.gallery.*') ? 'active' : ''}}">
                                <i class="fas fa-camera-retro nav-icon"></i>
                                <p>Gallery</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.resources.technical-certificates.index')}}"
                               class="nav-link {{request()->routeIs('admin.resources.technical-certificates.*') ? 'active' : ''}}">
                                <i class="fas fa-stamp nav-icon"></i>
                                <p>Technical Certificates</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">SYSTEM SETTINGS</li>

                <li class="nav-item">
                    <a href="{{route('admin.setting.index')}}"
                       class="nav-link {{request()->routeIs('admin.setting.*') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>General Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
