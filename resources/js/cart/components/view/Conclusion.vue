<template>
    <div class="card-body p-5 p-md-7 p-lg-11">
        <div class="row justify-content-lg-between align-items-sm-center mb-11">
            <div class="col-sm-6 col-lg-6 order-sm-2 text-sm-right mb-5 mb-sm-0 text-right">
                <h2 class="h2 font-weight-medium mb-0">
                    Pedido
                    <small class="d-block text-uppercase">{{order.id}}</small>
                </h2>
            </div>

            <div class="col-sm-6 col-lg-6 order-sm-1">
                <img class="mb-2" src="https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/quantofica/logo_full.svg" alt="Logo quantofica.com" width="250px">
                <address>
                    Viçosa - MG, Brasil
                </address>
                <small class="d-block text-muted">Tel: (31) 99715-0447</small>
            </div>
        </div>

        <!--<div class="row justify-content-md-between mb-7">-->
        <!--<div class="col-md-5 col-lg-4">-->
        <!--<h3 class="h5">Dados do comprador:</h3>-->
        <!--<span class="d-block">{{order.relationships.costumer.attributes.name}}</span>-->
        <!--<address class="text-secondary mb-0">-->
        <!--{{conclusion.relationships.costumer.relationships.address.attributes.formatted}}-->
        <!--</address>-->
        <!--</div>-->

        <!--<div class="col-md-5 col-lg-6 mt-6 text-right">-->
        <!--<dl class="row mb-0">-->
        <!--<dt class="col-5 col-md-6 font-weight-normal text-secondary">Data da pedido:</dt>-->
        <!--<dd class="col-7 col-md-6 font-weight-medium">{{now}}</dd>-->
        <!--</dl>-->
        <!--</div>-->
        <!--</div>-->

        <!--<table class="table table-heighlighted font-size-1 mb-9">-->
        <!--<thead>-->
        <!--<tr class="text-uppercase text-secondary">-->
        <!--<th scope="col" class="font-weight-medium">Descrição</th>-->
        <!--<th scope="col" class="font-weight-medium">Valor</th>-->
        <!--<th scope="col" class="font-weight-medium">Desconto</th>-->
        <!--<th scope="col" class="font-weight-medium text-right">Valor Final</th>-->
        <!--</tr>-->
        <!--</thead>-->
        <!--<tbody>-->
        <!--<tr>-->
        <!--<th scope="row" class="font-weight-normal">{{conclusion.relationships.plan.attributes.name}}</th>-->
        <!--<td>{{(conclusion.relationships.plan.attributes.values.standard / 100) | currency}}</td>-->
        <!--<td>{{(conclusion.relationships.plan.attributes.values.discount / 100) | currency}}</td>-->
        <!--<td class="text-right">{{(conclusion.relationships.plan.attributes.values.final / 100) | currency}}</td>-->
        <!--</tr>-->
        <!--<tr v-for="additional in conclusion.relationships.additional">-->
        <!--<th scope="row" class="font-weight-normal">Adicional - {{additional.attributes.name}}</th>-->
        <!--<td>{{(additional.attributes.value / 100) | currency}}</td>-->
        <!--<td>{{0 | currency}}</td>-->
        <!--<td class="text-right">{{(additional.attributes.value / 100) | currency}}</td>-->
        <!--</tr>-->
        <!--</tbody>-->
        <!--<tfoot>-->
        <!--<tr class="h6">-->
        <!--<td scope="row">Valor Total</td>-->
        <!--<td colspan="3" class="text-right">{{amount | currency}}</td>-->
        <!--</tr>-->
        <!--</tfoot>-->
        <!--</table>-->

        <!--<div class="row justify-content-lg-between">-->
        <!--<div class="col-md-8 col-lg-7 order-md-2 mb-5 mb-md-0">-->
        <!--<h4 class="h6">Obrigado!</h4>-->
        <!--<p class="font-size-1">Em breve entraremos em contato por email com mais informações sobre a a sua assinatura. Caso tenha alguma dúvida ou precise de suporte é só entrar em contato com a gente utilizando um de nossos <a href="/contato">canais de contato</a>.</p>-->

        <!--<span class="d-block">-->
        <!--<small class="font-weight-medium">Email:</small>-->
        <!--<small class="text-muted">contato@z1lab.com.br</small>-->
        <!--</span>-->

        <!--<small class="font-weight-medium">Telefone e WhatsApp:</small>-->
        <!--<small class="text-muted">(31) 99715-0447</small>-->
        <!--</div>-->

        <!--<div class="col-md-4 col-lg-3 order-md-1 align-self-end">-->
        <!--<p class="small text-muted mb-0">© quantofica.com. Z1lab {{year}}</p>-->
        <!--</div>-->
        <!--</div>-->
    </div>
</template>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable, #printable * {
            visibility: visible;
        }
        #printable {
            position: fixed;
            top: 6rem;
            left: 2rem;
        }
    }
</style>

<script>
    import LocalStorage from "../../../vendor/storage"
    import moment from 'moment'
    moment.locale('pt-br');

    export default {
        name: "Conclusion",
        data: () => ({
            order: {}
        }),
        computed: {
            now() {
                return moment().format('l');
            },
            year() {
                return moment().format('gggg');
            },
            amount() {
                let amount = this.conclusion.relationships.plan.attributes.values.final

                for (let additional in this.conclusion.relationships.additional){
                    amount += this.conclusion.relationships.additional[additional].attributes.value
                }

                return amount / 100
            }
        },
        mounted() {
            this.order = new LocalStorage('order__').getItem('user')
        }
    }
</script>
