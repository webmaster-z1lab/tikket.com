@if($ticket->status === $status->valid)
    <span class="fas fa-circle text-success small"></span>
    <span class="text-dark text-capitalize">{{ __("status.ticket.$ticket->status") }}</span>
@elseif($ticket->status === $status->checked)
    <span class="fas fa-check-double text-info small"></span>
    <span class="text-dark text-capitalize">{{ __("status.ticket.$ticket->status") }}</span>
@else
    <span class="fas fa-times text-danger small"></span>
    <span class="text-dark text-capitalize">{{ __("status.ticket.$ticket->status") }}</span>
@endif
