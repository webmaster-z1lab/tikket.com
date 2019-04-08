@if($order->status === $status->waiting)
    <span class="fas fa-circle text-warning small"></span>
    <span class="text-dark text-capitalize">{{ __("status.order.$order->status") }}</span>
@elseif($order->status === $status->paid)
    <span class="fas fa-circle text-success small"></span>
    <span class="text-dark text-capitalize">{{ __("status.order.$order->status") }}</span>
@else
    <span class="fas fa-circle text-danger small"></span>
    <span class="text-dark text-capitalize">{{ __("status.order.$order->status") }}</span>
@endif
