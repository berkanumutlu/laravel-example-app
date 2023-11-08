<div class="app-sidebar">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="logo-icon"><span class="logo-text">Laravel</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="//github.com/berkanumutlu" target="_blank">
                <img src="{{ asset('assets/admin/images/avatars/avatar.png') }}" alt="User Logo">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Berkan Ümütlü<br><span
                        class="user-state-info">On a development</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu pb-5">
        <ul class="accordion-menu">
            <li class="sidebar-title">Apps</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active-page' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="material-icons-two-tone">dashboard</i>Dashboard</a>
            </li>
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
        </ul>
    </div>
</div>
