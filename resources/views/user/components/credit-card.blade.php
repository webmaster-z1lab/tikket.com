@if($card->brand === 'visa')
    <i class="fab fa-cc-visa mr-1"></i>
@elseif(starts_with($card->brand, 'master'))
    <i class="fab fa-cc-mastercard mr-1"></i>
@else
    <i class="far fa-credit-card mr-1"></i>
@endif
