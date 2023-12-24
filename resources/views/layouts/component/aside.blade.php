@if (isset($childs) && !empty($childs))  
    <li class="menu-item {{ request()->is($parent['route']) ? 'menu-item-active' : null }}" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                    fill="#000000" />
                <path
                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                    fill="#000000" opacity="0.3" />
                </g>
            </svg>
            </span>
            <span class="menu-text">{{__($parent['name'])}}</span>
            <i class=" menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class=" menu-arrow"></i>
            <ul class="menu-subnav">
                @foreach ($childs as $key => $name)  
                    
                    <li class="menu-item " aria-haspopup="true">
                        <a href="{{route($parent['route'].'.'.$key)}}" class="menu-link">
                            <i class=" menu-bullet menu-bullet-line">
                            <span></span>
                            </i>
                            <span class="menu-text">{{__($name)}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </li>
@else
    <li class="menu-item  {{ request()->is($parent['active']) ? 'menu-item-active' : null }}" aria-haspopup="true" data-menu-toggle="hover">
        <a href="{{route($parent['route'])}}" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24" />
                <path
                d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                fill="#000000" />
                <path
                d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                fill="#000000" opacity="0.3" />
            </g>
            </svg>
        </span>
        <span class="menu-text">{{__($parent['name'])}}</span>
        </a>
    </li>
@endif