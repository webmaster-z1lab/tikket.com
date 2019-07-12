<li class="nav-item u-header__nav-last-item">
    <a class="btn btn-sm btn-primary transition-3d-hover" href="javascript:;" role="button"
       aria-controls="sidebarContent"
       aria-haspopup="true"
       aria-expanded="false"
       data-unfold-event="click"
       data-unfold-hide-on-scroll="false"
       data-unfold-target="#sidebarContent"
       data-unfold-type="css-animation"
       data-unfold-animation-in="fadeInRight"
       data-unfold-animation-out="fadeOutRight"
       data-unfold-duration="500">
        <i class="fas fa-user-circle mr-1"></i>{{ explode(' ', Auth::user()->name)[0] }} <i class="fas fa-bars ml-1"></i>
    </a>
</li>
