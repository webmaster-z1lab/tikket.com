@if($order->status === $status->waiting)
    <span class="fas fa-circle text-warning small"></span>
    <span class="text-dark text-capitalize">
        {{ __("status.order.$order->status") }}
        <i class="fas fa-info-circle" data-toggle="tooltip" title="Aguardando a confirmação da transação pela operadora de pagamentos."></i>
    </span>
@elseif($order->status === $status->paid)
    <span class="fas fa-circle text-success small"></span>
    <span class="text-dark text-capitalize">
        {{ __("status.order.$order->status") }}
        <i class="fas fa-info-circle" data-toggle="tooltip" title="Transação concluída com sucesso."></i>
    </span>
@elseif($order->status === $status->reversed)
    <span class="fas fa-circle text-danger small"></span>
    <span class="text-dark text-capitalize">
        {{ __("status.order.$order->status") }}
        <i class="fas fa-info-circle" data-toggle="tooltip" title="O pedido foi cancelado e o valor pago foi extornado para o titular do pagamento."></i>
    </span>
@else
    <span class="fas fa-circle text-danger small"></span>
    <span class="text-dark text-capitalize">
        {{ __("status.order.$order->status") }}
        <i class="fas fa-info-circle" data-toggle="tooltip" title="Pedido cancelado."></i>
    </span>
@endif
