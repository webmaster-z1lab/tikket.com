<template>
    <div class="card-body p-5 p-md-7 p-lg-11">
        <div class="row justify-content-lg-between align-items-sm-center mb-11">
            <div class="col-sm-6 col-lg-6 order-sm-2 text-sm-right mb-5 mb-sm-0 text-right">
                <h2 class="h2 font-weight-medium mb-0">
                    Pedido
                    <small class="d-block text-uppercase">REF: {{order.attributes.code}}</small>
                </h2>
            </div>

            <div class="col-sm-6 col-lg-6 order-sm-1">
                <h1 class="text-primary"><strong>{{order.attributes.event.name}}</strong></h1>
            </div>
        </div>

        <div v-if="this.order.attributes.type === 'boleto'">
            <div v-if="loading_boleto">
                <div class="row align-content-center ">
                    <div class="text-center">
                        <h4>Aguarde enquanto geramos o seu boleto</h4>

                        <p><strong>Mantenha essa página aberta</strong> enquanto o seu pedido é processado. Ela será atualizada automaticamente quando o seu <strong>BOLETO</strong>
                            estiver pronto para impressão.</p>

                        <p>
                            <i class="fas fa-circle-notch fa-spin fa-7x text-primary"></i>
                        </p>
                    </div>
                </div>
            </div>

            <div v-else>
                <div class="row justify-content-md-between mb-4">
                    <h4>Obrigado por comprar seu ingresso no Tikket!</h4>

                    <p>
                        Os nossos boletos são gerados pelo <strong>PagSeguro</strong> e por isso você verá o no campo "Beneficiário" do documento gerado a informação <strong>PAGSEGURO
                        INTERNET S.A.</strong>.
                        Os dados referentes a sua compra estão disponíveis no campo "Instruções" localizado no final do documento, próximo ao código de barras.
                    </p>

                    <p>
                        Para realizar o pagamento você pode utilizar a linha digitável "<strong>{{ boleto.barcode }}</strong>" ou se preferir, <strong><a
                        class="text-primary" :href="boleto.url" target="_blank"><i class="fas fa-print"></i> imprima o seu boleto</a>.</strong> Lembre-se de conferir os dados presentes na guia de pagamento.
                    </p>

                    <p>
                        A confirmação do pedido ocorre em até 3 dias úteis após o pagamento do boleto que deve ser efetuado até o vencimento que ocorre no dia <strong>{{
                        boleto.due_at }}.</strong>, após isso o seu pedido será automaticamente cancelado e os ingressos serão disponibilizados para novas compras.
                    </p>

                    <p>Novas informações e atualizações referentes ao seu pedido serão enviadas por e-mail e também estão disponíveis no link <a :href="formattedRoute('orders')"
                                                                                                                                                 class="link-muted text-uppercase text-primary">Meus
                        pedidos</a>.</p>

                    <p class="lead text-dark">
                        Caso tenha alguma dúvida ou precise de suporte é só entrar em contato com a gente utilizando um de nossos
                        <a :href="formattedRoute('contact')" class="link-muted text-uppercase text-primary">canais de atendimento</a>.
                    </p>
                </div>

                <div class="row justify-content-md-between mb-7">
                    <div class="col-md-6 col-lg-4">
                        <h3 class="h5">Comprador:</h3>
                        <span class="d-block">{{order.attributes.customer.name}}</span>
                        <span class="text-secondary mb-0">{{order.attributes.customer.document}}</span>
                        <span class="text-secondary text-truncate mb-0">{{order.attributes.customer.email}}</span>
                        <span class="text-secondary mb-0">{{order.attributes.customer.phone.formatted}}</span>
                    </div>

                    <div class="col-md-6 col-lg-4 mt-4 mt-sm-0">
                        <h3 class="h5">Forma de pagamento:</h3>

                        <span class="d-block text-uppercase">Boleto</span>
                        <span class="text-secondary mb-0 d-block">Vencimento: {{ boleto.due_at }}</span>
                        <span class="text-secondary mb-0 d-block">Linha digitável: {{ boleto.barcode }}</span>
                    </div>
                </div>

                <div class="text-center mb-4">
                    <a :href="boleto.url" class="btn btn-primary btn-wide btn-lg">Imprimir boleto</a>
                </div>
            </div>
        </div>

        <div v-else>
            <div class="row justify-content-md-between mb-4">
                <h4>Obrigado por comprar seu ingresso no Tikket!</h4>

                <p class="lead text-dark">
                    O seu pedido está sendo processado pela operadora de cartão e em breve você receberá e-mails com as informações de acompanhamento e atualizações da sua compra.
                </p>

                <p class="lead text-dark">
                    Você também pode acompanhar suas compras acessando o link
                    <a :href="formattedRoute('orders')" class="link-muted text-uppercase text-primary">Meus pedidos</a>.
                </p>

                <p class="lead text-dark">
                    Caso tenha alguma dúvida ou precise de suporte é só entrar em contato com a gente utilizando um de nossos
                    <a :href="formattedRoute('contact')" class="link-muted text-uppercase text-primary">canais de atendimento</a>.
                </p>
            </div>

            <div class="row justify-content-md-between mb-7" v-if="this.order.attributes.type === 'credit_card'">
                <div class="col-md-5 col-lg-4">
                    <h3 class="h5">Comprador:</h3>
                    <span class="d-block">{{order.attributes.customer.name}}</span>
                    <span class="text-secondary mb-0">{{order.attributes.customer.document}}</span>
                    <span class="text-secondary text-truncate mb-0">{{order.attributes.customer.email}}</span>
                    <span class="text-secondary mb-0">{{order.attributes.customer.phone.formatted}}</span>
                </div>

                <div class="col-md-5 col-lg-4 mt-4 mt-sm-0">
                    <h3 class="h5">Forma de pagamento:</h3>

                    <span class="d-block text-uppercase">CC {{ order.attributes.card.brand }}</span>
                    <span class="d-block text-uppercase">**** **** **** {{ order.attributes.card.number }}</span>
                    <span class="text-secondary mb-0 d-block">{{ order.attributes.card.holder.name }}</span>
                    <span class="text-secondary mb-0 d-block">{{ order.attributes.card.installments }}x de {{(order.attributes.card.parcel / 100) | currency }}</span>
                </div>
            </div>

            <div class="text-center mb-4">
                <a :href="formattedRoute('orders.show', order.id)" class="btn btn-primary btn-wide btn-lg">Acompanhar Pedido</a>
            </div>
        </div>


        <div class="row justify-content-lg-between">
            <div class="col-md-12">
                <span class="d-block">
                    <small class="font-weight-medium">Email:</small>
                    <small class="text-muted">contato@tikket.com.br</small>
                </span>

                <small class="font-weight-medium">Telefone e WhatsApp:</small>
                <small class="text-muted">(31) 99715-0447</small>
            </div>

            <div class="col-md-12">
                <p class="small text-muted mb-0">© tikket.com.br. Z1lab {{year}}</p>
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
            order: {
                id: '1',
                types: '',
                attributes: {
                    event: {},
                    customer: {
                        phone: {}
                    },
                    tickets: {},
                    boleto: {},
                    card: {}
                },
                relationships: []
            },
            loading_boleto: true,
            boleto: {}
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
            formattedRoute(name, value = null) {
                if (value) {
                    return route(name, value)
                } else {
                    return route(name)
                }
            }
        },
        mounted() {
            this.changeLoading(false)

            new LocalStorage('cart__').setItem('user', new LocalStorage('cart__').getItem('user'))

            this.order = new LocalStorage('order__').getItem('user')

            if (this.order.attributes.type === 'boleto') {
                let boleto = new LocalStorage('order__').getItem('boleto')

                if (boleto) {
                    this.boleto = boleto
                    this.loading_boleto = false
                }
            }

            Echo.private(`orders.${this.order.id}`)
                .listen('.Modules\\Order\\Events\\ReadyBoleto', (boleto) => {
                    new LocalStorage('order__').setItem('boleto', boleto)

                    this.boleto = boleto
                    this.loading_boleto = false
                });
        }
    }
</script>
