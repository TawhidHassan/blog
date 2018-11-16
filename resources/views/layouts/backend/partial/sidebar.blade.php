<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{Storage::url(Auth::user()->image)}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{Auth::user()->role->id== 1? route('admin.setting.index') : route('author.setting.index')}}">
                                    <i class="material-icons">settings</i>settings
                                </a>
                                </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i>Sign Out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
<!-- ---------------------------admin-----------------------------------                    
                     -->@if(Request::is('admin*'))
                       <li class="{{Request::is('admin/dashbord') ? 'active':''}}">
                        <a href="{{route('admin.dashbord')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/tag*') ? 'active':''}}">
                        <a href="{{route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span>Tag</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/category*') ? 'active':''}}">
                        <a href="{{route('admin.category.index')}}">
                            <i class="material-icons">category</i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/post*') ? 'active':''}}">
                        <a href="{{route('admin.post.index')}}">
                            <i class="material-icons">books</i>
                            <span>post</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/pending/post') ? 'active':''}}">
                        <a href="{{route('admin.post.panding')}}">
                            <i class="material-icons">books</i>
                            <span>pending post</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/favorite') ? 'active':''}}">
                        <a href="{{route('admin.favorite.index')}}">
                            <i class="material-icons">books</i>
                            <span>favorite post</span>
                        </a>
                    </li>
                        <li class="{{Request::is('admin/subscriber*') ? 'active':''}}">
                            <a href="{{route('admin.subscriber.index')}}">
                                <i class="material-icons">category</i>
                                <span>subscriber</span>
                            </a>
                        </li>
                        
                         <li class="{{Request::is('admin/comments*') ? 'active':''}}">
                            <a href="{{route('admin.comment.index')}}">
                                <i class="material-icons">category</i>
                                <span>comments</span>
                            </a>
                        </li>
                        <li class="{{Request::is('admin/author*') ? 'active':''}}">
                            <a href="{{route('admin.author.index')}}">
                                <i class="material-icons">account_circle</i>
                                <span>Authors</span>
                            </a>
                        </li>


                    <li class="header">System</li>
                    <li class="{{Request::is('admin/setting*') ? 'active':''}}">
                            <a href="{{route('admin.setting.index')}}">
                                <i class="material-icons">settings</i>
                                <span>Settings</span>
                            </a>
                        </li>
                    <li>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i><span>Sign Out</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                               </form>
                            </li>
<!-- ---------------------------author-----------------------------------                    
                     -->
                    @elseif(Request::is('author*'))
                         <li class="{{Request::is('author/dashbord') ? 'active':''}}">
                        <a href="{{route('author.dashbord')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    <li class="{{Request::is('author/post*') ? 'active':''}}">
                        <a href="{{route('author.post.index')}}">
                            <i class="material-icons">books</i>
                            <span>post</span>
                        </a>
                    </li>
                     <li class="{{Request::is('author/favorite') ? 'active':''}}">
                        <a href="{{route('author.favorite.index')}}">
                            <i class="material-icons">books</i>
                            <span>favorite post</span>
                        </a>
                    </li>

                         <li class="{{Request::is('author/comments*') ? 'active':''}}">
                            <a href="{{route('author.comment.index')}}">
                                <i class="material-icons">category</i>
                                <span>comments</span>
                            </a>
                        </li>


                    <li class="header">System</li>
                     <li class="{{Request::is('author/setting*') ? 'active':''}}">
                            <a href="{{route('author.setting.index')}}">
                                <i class="material-icons">settings</i>
                                <span>Settings</span>
                            </a>
                        </li>
                    <li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">input</i><span>Sign Out</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                               </form>
                            </li>
                    @endif
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->