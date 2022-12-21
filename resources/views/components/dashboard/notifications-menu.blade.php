<li class="nav-item dropdown">
    <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="icon-bell"></i>
    @if ($newCount)
    <span class="">{{ $newCount }}</span>
    @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
    <a class="dropdown-item py-3">
        <p class="mb-0 font-weight-medium float-left">You have {{ $newCount }} notificationss </p>
        <span class="badge badge-pill badge-primary float-right">View all</span>
    </a>
    <div class="dropdown-divider"></div>
    @foreach($notifications as $notification)
        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}" class="dropdown-item text-wrap @if ($notification->unread()) text-bold @endif">
            <div class="preview-thumbnail">
                <img src="{{ $notification->data['icon'] }}" alt="image" class="img-sm profile-pic">
            </div>
            <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">{{ $notification->created_at->longAbsoluteDiffForHumans() }} </p>
                <p class="fw-light small-text mb-0"> {{ $notification->data['body'] }} </p>
            </div>
        </a>
    @endforeach
    </div>
</li>
