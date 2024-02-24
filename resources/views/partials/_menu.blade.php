<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        <li>
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                <span class="nav-icon uil uil-create-dashboard"></span>
                <span class="menu-text">{{ trans('Home Page') }}</span>
            </a>
        </li>

        <li class="has-child">
            <a href="#" class="">
                <span class="nav-icon uil uil-folder"></span>
                <span class="menu-text">{{ trans('Layouts') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul style="display: none; top: 230.375px; left: 214px;">
                <li>
                    <a href="#" data-layout="light"
                        onclick="setLayoutToStorage('light')">{{ __('Light Mode') }}</a>
                </li>
                <li>
                    <a href="#" data-layout="dark" onclick="setLayoutToStorage('dark')">
                        {{ __('Dark Mode') }}
                    </a>

                </li>
                <li>
                    <a href="#" data-layout="top" onclick="setThemeToStorage('top')">{{ __('Top Menu') }}</a>
                </li>
                <li>
                    <a href="#" data-layout="side" onclick="setThemeToStorage('side')">{{ __('Side Menu') }}</a>
                </li>
            </ul>
        </li>













        <li
            class="has-child {{ Request::is('dashboard/divisions*') || Request::is('dashboard/projectStatuses*') || Request::is('dashboard/projects*') || Request::is('dashboard/tags*') || Request::is('dashboard/categories*') ? 'open' : '' }}">
            @canany(['project-read', 'project status-read', 'tag-read', 'category-read', 'division-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-folder"></span>
                    <span class="menu-text">{{ trans('Projects') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                @can('project-read')
                    <li>
                        <a href="{{ route('projects.index') }}"
                            class="{{ Request::is('dashboard/projects*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Projects') }}</span>
                        </a>
                    </li>
                @endcan
                @can('project status-read')
                    <li>
                        <a href="{{ route('projectStatuses.index') }}"
                            class="{{ Request::is('dashboard/projectStatuses*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('project Status') }}</span>
                        </a>
                    </li>
                @endcan
                @can('tag-read')
                    <li>
                        <a href="{{ route('tags.index') }}" class="{{ Request::is('dashboard/tags*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('tags') }}</span>
                        </a>
                    </li>
                @endcan
                @can('category-read')
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="{{ Request::is('dashboard/categories*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Categories') }}</span>
                        </a>
                    </li>
                @endcan
                @can('division-read')
                    <li>
                        <a href="{{ route('divisions.index') }}"
                            class="{{ Request::is('dashboard/divisions*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Divisions') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        <li class="has-child {{ Request::is('dashboard/forms*') || Request::is('dashboard/statuses*') ? 'open' : '' }}">
            @canany(['cart-read', 'transaction-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-clipboard-notes"></span>
                    <span class="menu-text">{{ trans('Statuses') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                @can('form builder-read')
                    <li>
                        <a href="{{ route('forms.index') }}" class="{{ Request::is('dashboard/forms*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Projects') }}</span>
                        </a>
                    </li>
                @endcan
                @can('form builder-read')
                    <li>
                        <a href="{{ route('statuses') }}" class="{{ Request::is('dashboard/statuses*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Statuses') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>


        {{-- @can('gift-read')
		<li>
			<a href="{{route('gifts.index')}}" class="{{ Request::is('dashboard/gift*')? 'active':'' }}">
				<span class="nav-icon uil uil-clipboard-notes"></span>
				<span class="menu-text">{{ trans('Gift') }}</span>
			</a>
		</li>
		@endcan --}}


        <li class="has-child {{ Request::is('dashboard/gifts*') ? 'open' : '' }}">
            @canany(['gift-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-clipboard-notes"></span>
                    <span class="menu-text">{{ trans('Gifts') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">

                @can('gift-read')
                    <li>
                        <a href="{{ route('gifts.index') }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Gift') }}</span>
                        </a>
                    </li>
                @endcan
                <li>
                    <a href="{{ route('gifts.templates.index') }}">
                        <span class="nav-icon uil uil-circle"></span>
                        <span class="menu-text">{{ trans('Templates') }}</span>
                    </a>
                </li>
            </ul>
        </li>



        @can('campaign-read')
            <li>
                <a href="{{ route('campaigns.index') }}" class="{{ Request::is('dashboard/campaigns*') ? 'active' : '' }}">
                    <span class="nav-icon uil uil-lightbulb-alt"></span>
                    <span class="menu-text">{{ trans('campaigns') }}</span>
                </a>
            </li>
        @endcan
        @can('contact us-read')
            <li>
                <a href="{{ route('contacts.index') }}" class="{{ Request::is('dashboard/contacts') ? 'active' : '' }}">
                    <span class="nav-icon uil uil-envelope"></span>
                    <span class="menu-text">{{ trans('Contact Us') }}</span>
                </a>
            </li>
        @endcan
        @can('donation-read')
            <li>
                <a href="{{ route('donations.index') }}" class="{{ Request::is('dashboard/donations*') ? 'active' : '' }}">
                    <span class="nav-icon uil uil-money-bill"></span>
                    <span class="menu-text">{{ trans('Donations') }}</span>
                </a>
            </li>
        @endcan

        <li class="has-child {{ Request::is('dashboard/reports*') ? 'open' : '' }}">
            <a href="#" class="">
                <span class="nav-icon uil uil-presentation-play"></span>
                <span class="menu-text">{{ trans('Reports') }}</span>
                <span class="toggle-icon"></span>
            </a>
            <ul style="display: none; top: 230.375px; left: 214px;">
                <li>
                    <a href="{{ route('reports.index') }}"
                        class="{{ Request::is('dashboard/reports') ? 'active' : '' }}">
                        <span class="nav-icon uil uil-circle"></span>
                        <span class="menu-text">{{ trans('Donations reports') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.social-media') }}"
                        class="{{ Request::is('dashboard/reports/social-media') ? 'active' : '' }}">
                        <span class="nav-icon uil uil-circle"></span>
                        <span class="menu-text">{{ trans('Social Media Reports') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.alias-links') }}"
                        class="{{ Request::is('dashboard/reports/alias-links') ? 'active' : '' }}">
                        <span class="nav-icon uil uil-circle"></span>
                        <span class="menu-text">{{ trans('Alias Links Reports') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li
            class="has-child {{ Request::is('dashboard/carts*') || Request::is('dashboard/transactions*') || Request::is('dashboard/news_tags*') ? 'open' : '' }}">
            @canany(['cart-read', 'transaction-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-money-bill"></span>
                    <span class="menu-text">{{ trans('Transactions') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                @can('cart-read')
                    <li>
                        <a href="{{ route('carts.index') }}" class="{{ Request::is('dashboard/carts*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Carts') }}</span>
                        </a>
                    </li>
                @endcan
                @can('transaction-read')
                    <li>
                        <a href="{{ route('transactions.index') }}"
                            class="{{ Request::is('dashboard/transactions*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Transactions') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        @can('slider-read')
            <li>
                <a href="{{ route('sliders.index') }}" class="{{ Request::is('dashboard/sliders*') ? 'active' : '' }}">
                    <span class="nav-icon uil uil-images"></span>
                    <span class="menu-text">{{ trans('Sliders') }}</span>
                </a>
            </li>
        @endcan
        @can('link-read')
            <li>
                <a href="{{ route('links.index') }}" class="{{ Request::is('dashboard/links*') ? 'active' : '' }}">
                    <span class="nav-icon uil uil-link"></span>
                    <span class="menu-text">{{ trans('Links') }}</span>
                </a>
            </li>
        @endcan


        <li
            class="has-child {{ Request::is('dashboard/albums*') || Request::is('dashboard/news*') || Request::is('dashboard/news_categories*') || Request::is('dashboard/news_tags*') ? 'open' : '' }}">
            @canany(['news-read', 'news category-read', 'news tag-read', 'album-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-newspaper"></span>
                    <span class="menu-text">{{ trans('Media') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                <li
                    class="has-child {{ Request::is('dashboard/news*') || Request::is('dashboard/news_categories*') || Request::is('dashboard/news_tags*') ? 'open' : '' }}">
                    @canany(['news-read', 'news category-read', 'news tag-read'])
                        <a href="#" class="">
                            <span class="nav-icon uil uil-newspaper"></span>
                            <span class="menu-text">{{ trans('news') }}</span>
                            <span class="toggle-icon"></span>
                        </a>
                    @endcanany
                    <ul style="display: none; top: 230.375px; left: 214px;">
                        @can('news-read')
                            <li>
                                <a href="{{ route('news.index') }}"
                                    class="{{ Request::is('dashboard/news') ? 'active' : '' }}">
                                    <span class="nav-icon uil uil-circle"></span>
                                    <span class="menu-text">{{ trans('news') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('news category-read')
                            <li>
                                <a href="{{ route('news_categories.index') }}"
                                    class="{{ Request::is('dashboard/news_categories*') ? 'active' : '' }}">
                                    <span class="nav-icon uil uil-circle"></span>
                                    <span class="menu-text">{{ trans('news_categories') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('news tag-read')
                            <li>
                                <a href="{{ route('news_tags.index') }}"
                                    class="{{ Request::is('dashboard/news_tags*') ? 'active' : '' }}">
                                    <span class="nav-icon uil uil-circle"></span>
                                    <span class="menu-text">{{ trans('news_tags') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('album-read')
                    <li>
                        <a href="{{ route('albums.index') }}"
                            class="{{ Request::is('dashboard/albums*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-images"></span>
                            <span class="menu-text">{{ trans('Albums') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>


        <li
            class="has-child {{ Request::is('dashboard/visits*') || Request::is('dashboard/menus*') || Request::is('dashboard/careers*') || Request::is('dashboard/help_types*') || Request::is('dashboard/helps*') || Request::is('dashboard/languages*') || Request::is('dashboard/countries*') || Request::is('dashboard/currencies*') ? 'open' : '' }}">
            @canany([
                'career-read',
                'menu-read',
                'visit-read',
                'help type-read',
                'help
                list-read',
                'language-read',
                'country-read',
                'currency-read',
                ])
                <a href="#" class="">
                    <span class="nav-icon uil uil-newspaper"></span>
                    <span class="menu-text">{{ trans('Basic data') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                {{-- @can('career-read')
				<li>
					<a href="{{route('careers.index')}}" class="{{ Request::is('dashboard/careers*')? 'active':'' }}">
						<span class="nav-icon uil uil-circle"></span>
						<span class="menu-text">{{ trans('Careers') }}</span>
					</a>
				</li>
				@endcan --}}

                @can('menu-read')
                    <li>
                        <a href="{{ route('menus.index') . '?menu_id=1' }}"
                            class="{{ Request::is('dashboard/menus*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Menus') }}</span>
                        </a>
                    </li>
                @endcan

                @can('visit-read')
                    <li>
                        <a href="{{ route('visits.index') }}"
                            class="{{ Request::is('dashboard/visits*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Visits') }}</span>
                        </a>
                    </li>
                @endcan
                {{-- @can('help type-read') --}}
                {{-- <li> --}}
                {{-- <a href="{{route('help_types.index')}}" --}} {{--
						class="{{ Request::is('dashboard/help_types')? 'active':'' }}"> --}}
                {{-- <span class="nav-icon uil uil-circle"></span> --}}
                {{-- <span class="menu-text">{{ trans('help type') }}</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- @endcan --}}
                {{-- @can('help list-read') --}}
                {{-- <li> --}}
                {{-- <a href="{{route('helps.index')}}" --}} {{--
						class="{{ Request::is('dashboard/helps')? 'active':'' }}"> --}}
                {{-- <span class="nav-icon uil uil-circle"></span> --}}
                {{-- <span class="menu-text">{{ trans('Help List') }}</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- @endcan --}}
                @can('language-read')
                    <li>
                        <a href="{{ route('languages.index') }}"
                            class="{{ Request::is('dashboard/languages*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Languages') }}</span>
                        </a>
                    </li>
                @endcan
                @can('country-read')
                    <li>
                        <a href="{{ route('countries.index') }}"
                            class="{{ Request::is('dashboard/countries*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Countries') }}</span>
                        </a>
                    </li>
                @endcan
                @can('currency-read')
                    <li>
                        <a href="{{ route('currencies.index') }}"
                            class="{{ Request::is('dashboard/currencies*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Currencies') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>

        <li
            class="has-child {{ Request::is('dashboard/audits*') || Request::is('dashboard/settings*') || Request::is('dashboard/users*') || Request::is('dashboard/roles*') || Request::is('dashboard/social-media*') ? 'open' : '' }}">
            @canany(['settings-update', 'site pages-read', 'user-read', 'role-read', 'audit-read'])
                <a href="#" class="">
                    <span class="nav-icon uil uil-setting"></span>
                    <span class="menu-text">{{ trans('Administration') }}</span>
                    <span class="toggle-icon"></span>
                </a>
            @endcanany
            <ul style="display: none; top: 230.375px; left: 214px;">
                @can('settings-update')
                    <li>
                        <a href="{{ route('social-media.index') }}"
                            class="{{ Request::is('dashboard/social-media') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Social media') }}</span>
                        </a>
                    </li>
                @endcan
                @can('settings-update')
                    <li>
                        <a href="{{ route('settings.index') }}"
                            class="{{ Request::is('dashboard/settings') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Settings') }}</span>
                        </a>
                    </li>
                @endcan
                @can('site pages-read')
                    <li>
                        <a href="{{ route('site-pages.index') }}"
                            class="{{ Request::is(app()->getLocale() . '/site_pages') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Site Pages') }}</span>
                        </a>
                    </li>
                @endcan
                @can('user-read')
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="{{ Request::is('dashboard/users') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Users') }}</span>
                        </a>
                    </li>
                @endcan
                @can('role-read')
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="{{ Request::is('dashboard/roles') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Roles') }}</span>
                        </a>
                    </li>
                @endcan
                @can('audit-read')
                    <li>
                        <a href="{{ route('audits.index') }}"
                            class="{{ Request::is('dashboard/audits*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Audit log') }}</span>
                        </a>
                    </li>
                @endcan
                @can('payment gateway-read')
                    <li>
                        <a href="{{ route('payment-gateways.index') }}"
                            class="{{ Request::is('dashboard/payment-gateways*') ? 'active' : '' }}">
                            <span class="nav-icon uil uil-circle"></span>
                            <span class="menu-text">{{ trans('Payment Gateways') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>



    </ul>
</div>
