<div class="app-sidebar">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="logo-icon"><span class="logo-text">Laravel Admin</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="//github.com/berkanumutlu" target="_blank">
                <img src="{{ $avatar }}" alt="User Logo">
                <span class="activity-indicator"></span>
                <span class="user-info-text">{{ auth()->guard('admin')->user()->name }}<br>
                    <span class="user-state-info">On a development</span></span>
            </a>
        </div>
        <div class="d-inline-block w-100 mt-2">
            <div class="navbar-nav navbar-light align-items-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="btnUserLogout nav-link"><i class="material-icons">logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="app-menu pb-5">
        <ul class="accordion-menu">
            <li class="sidebar-title">General</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active-page' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
            <li class="{{ Route::is('admin.settings.index') || Route::is('admin.social.media.index') ? 'open' : '' }}">
                <a href="javascript:;"><i class="material-icons-two-tone">settings</i>Settings
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.settings.index') }}"
                           class="{{ Route::is('admin.settings.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">list</i>Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.social.media.index') }}"
                           class="{{ Route::is('admin.social.media.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">share</i>Social Media</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Route::is('admin.log.index') ? 'active-page' : '' }}">
                <a href="{{ route('admin.log.index') }}" class="{{ Route::is('admin.log') ? 'active' : '' }}">
                    <i class="material-icons-two-tone">receipt_long</i>Logs</a>
            </li>
            <li class="sidebar-title">Records</li>
            <li class="{{ Route::is('admin.article.index') || Route::is('admin.article.add') ? 'open' : '' }}">
                <a href="javascript:;"><i class="material-icons-two-tone">article</i>Article
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.article.index') }}"
                           class="{{ Route::is('admin.article.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">list</i>List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.article.add') }}"
                           class="{{ Route::is('admin.article.add') ? 'active' : '' }} has-icon">
                            <i class="material-icons">add</i>Add</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Route::is('admin.category.index') || Route::is('admin.category.add') ? 'open' : '' }}">
                <a href="javascript:;"><i class="material-icons-two-tone">category</i>Category
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.category.index') }}"
                           class="{{ Route::is('admin.category.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">list</i>List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.add') }}"
                           class="{{ Route::is('admin.category.add') ? 'active' : '' }} has-icon">
                            <i class="material-icons">add</i>Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-title">Web</li>
            <li class="{{ Route::is('admin.article.comments.index') || Route::is('admin.article.comments.pending') ? 'open' : '' }}">
                <a href="javascript:;"><i class="material-icons-two-tone">comment</i>Article Comments
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.article.comments.index') }}"
                           class="{{ Route::is('admin.article.comments.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">list</i>List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.article.comments.pending') }}"
                           class="{{ Route::is('admin.article.comments.pending') ? 'active' : '' }} has-icon">
                            <i class="material-icons">pending</i>Pending</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-title">Users</li>
            <li class="{{ Route::is('admin.user.index') || Route::is('admin.user.add') ? 'open' : '' }}">
                <a href="javascript:;"><i class="material-icons-two-tone">person</i>User
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('admin.user.index') }}"
                           class="{{ Route::is('admin.user.index') ? 'active' : '' }} has-icon">
                            <i class="material-icons">list</i>List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.add') }}"
                           class="{{ Route::is('admin.user.add') ? 'active' : '' }} has-icon">
                            <i class="material-icons">add</i>Add</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
