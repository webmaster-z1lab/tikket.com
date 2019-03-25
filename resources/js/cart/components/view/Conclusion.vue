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
                <h1 class="text-primary"><strong>Tikket</strong></h1>
                <address>
                    Minas Gerais, Brasil
                </address>
                <small class="d-block text-muted">Tel: (31) 99715-0447</small>
            </div>
        </div>

        <div class="row justify-content-md-between mb-4">
            <h4>Obrigado!</h4>
            <p class="lead text-dark">
                O seu pedido está sendo processado pela operadora de cartão e em breve você receberá e-mails com as informações de acompanhamento e atualizações da sua compra.
            </p>

            <p class="lead text-dark">
                Você também pode acompanhar suas compras acessando o link <a href="#" class="link-muted text-uppercase text-primary">Meus pedidos</a>.
            </p>

            <p class="lead text-dark">
                Caso tenha alguma dúvida ou precise de suporte é só entrar em contato com a gente utilizando um de nossos <a href="/contato"
                                                                                                                             class="link-muted text-uppercase text-primary">canais
                de atendimento</a>.
            </p>
        </div>

        <div class="row justify-content-md-between mb-7">
            <div class="col-md-5 col-lg-4">
                <h3 class="h5">Dados do comprador:</h3>
                <span class="d-block">{{order.attributes.costumer.name}}</span>
                <span class="text-secondary mb-0">
                    {{order.attributes.costumer.document}}
                </span>
                <span class="text-secondary mb-0">
                    {{order.attributes.costumer.email}}
                </span>
            </div>

            <div class="col-md-5 col-lg-6 mt-6 text-right">
                <dl class="row mb-0">
                    <dt class="col-5 col-md-6 font-weight-normal text-secondary">Data da pedido:</dt>
                    <dd class="col-7 col-md-6 font-weight-medium">{{now}}</dd>
                </dl>
            </div>
        </div>

        <table class="table table-heighlighted font-size-1 mb-9">
            <thead>
            <tr class="text-uppercase text-secondary">
                <th scope="col" class="font-weight-medium">Ingresso</th>
                <th scope="col" class="font-weight-medium text-right">Valor</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="ticket in order.attributes.tickets">
                <th scope="row" class="font-weight-normal">{{ticket.entrance}}</th>
                <td class="text-right">{{(ticket.price / 100) | currency}}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr class="h6">
                <td scope="row">Valor Total</td>
                <td colspan="3" class="text-right">{{(order.attributes.card.parcel * order.attributes.card.installments / 100) | currency}}</td>
            </tr>
            </tfoot>
        </table>

        <div class="row justify-content-lg-between">
            <div class="col-md-12">
                <span class="d-block">
                    <small class="font-weight-medium">Email:</small>
                    <small class="text-muted">contato@z1lab.com.br</small>
                </span>

                <small class="font-weight-medium">Telefone e WhatsApp:</small>
                <small class="text-muted">(31) 99715-0447</small>
            </div>

            <div class="col-md-12">
                <p class="small text-muted mb-0">© tikket.com. Z1lab {{year}}</p>
            </div>
        </div>
    </div>
</template>

<style>
    @media print {
        body * {
            visibility : hidden;
        }

        #printable, #printable * {
            visibility : visible;
        }

        #printable {
            position : fixed;
            top      : 6rem;
            left     : 2rem;
        }
    }
</style>

<script>
    import LocalStorage from "../../../vendor/storage"
    import moment from 'moment'
    import {mapActions} from 'vuex'

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

                for (let additional in this.conclusion.relationships.additional) {
                    amount += this.conclusion.relationships.additional[additional].attributes.value
                }

                return amount / 100
            }
        },
        methods: {
            ...mapActions(['changeLoading']),
        },
        mounted() {
            this.changeLoading(false)

            this.order = new LocalStorage('order__').getItem('user')
        }
    }
</script>
