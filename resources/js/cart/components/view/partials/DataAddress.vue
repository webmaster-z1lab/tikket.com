<template>
    <div>
        <h6 class="card-title mt-4 mb-0">Endereço de cobrança</h6>

        <p class="mb-2">
            <small>
                Insira seu CEP para pesquisarmos o endereço.
                <a class="text-primary" href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Não sei o meu CEP
                </a>
            </small>
        </p>

        <div class="row">
            <div class="col-md-4 mb-2" :class="errors.has('cep') ? 'u-has-error' : ''">
                <label class="form-label required">CEP</label>

                <the-mask class="form-control" type="text" name="cep" id="cep" placeholder="00000-000" data-vv-as="'CEP'" mask="#####-###"
                          v-model.lazy="cep" v-validate="'required|cep'"/>
                <div v-show="errors.has('cep')" class="invalid-feedback" style="display: block">
                    {{errors.first('cep') }}
                </div>
            </div>
        </div>

        <div class="row" v-if="completeAddress">
            <div class="col-md-9 mb-2" :class="errors.has('street') ? 'u-has-error' : ''">
                <label class="form-label required">Logradouro</label>

                <input class="form-control" type="text" name="street" id="street" placeholder="Nome da rua" v-model="data.street" data-vv-as="'Logradouro'" v-validate="'required'">

                <div v-show="errors.has('street')" class="invalid-feedback" style="display: block">
                    {{ errors.first('street') }}
                </div>
            </div>

            <div class="col-md-3 mb-2" :class="errors.has('number') ? 'u-has-error' : ''">
                <label class="form-label required">Número</label>

                <input class="form-control" type="number" name="number" placeholder="Ex: 55" v-model="data.number" data-vv-as="'Número'" v-validate="'required'">

                <div v-show="errors.has('number')" class="invalid-feedback" style="display: block">
                    {{ errors.first('number') }}
                </div>
            </div>

            <div class="col-md-6 mb-2" :class="errors.has('district') ? 'u-has-error' : ''">
                <label class="form-label required">Bairro</label>

                <input class="form-control" type="text" name="district" id="district" placeholder="Nome do Bairro" v-model="data.district" data-vv-as="'Bairro'" v-validate="'required'">

                <div v-show="errors.has('district')" class="invalid-feedback" style="display: block">
                    {{ errors.first('district') }}
                </div>
            </div>

            <div class="col-md-6 mb-2" :class="errors.has('complement') ? 'u-has-error' : ''">
                <label class="form-label">Complemento</label>

                <input class="form-control" type="text" name="complement" id="complement" placeholder="Ex: Casa, Loja 01..." v-model="data.complement">

                <div v-show="errors.has('complement')" class="invalid-feedback" style="display: block">
                    {{ errors.first('complement') }}
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label required" for="state">Estado</label>
                <input type="text" class="form-control disabled" id="state" readonly disabled name="state" v-model="data.state">
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label required" for="city">Cidade</label>
                <input type="text" class="form-control disabled" id="city" readonly disabled name="city" v-model="data.city">
            </div>
        </div>
    </div>
</template>

<script>
    import {getCEP} from "../../../../vendor/api";
    import {TheMask} from 'vue-the-mask'
    import {mapActions} from 'vuex'

    export default {
        name: "DataAddress",
        inject: ['$validator'],
        components: {
            TheMask
        },
        props: {
            data: {
                required: true,
                type: [Array, Object]
            }
        },
        data: () => ({
            cep: '',
            completeAddress: false
        }),
        methods: {
            ...mapActions(['changeLoading'])
        },
        watch: {
            async cep(value) {
                this.completeAddress = false

                if (value.length === 8) {
                    this.changeLoading(true)

                    await getCEP(value).then(response => {
                        if (_.isUndefined(response.data.erro)) {
                            let cep = response.data
                            this.completeAddress = true

                            this.data.postal_code = this.cep
                            this.data.state = cep.uf
                            this.data.district = cep.bairro
                            this.data.city = cep.localidade
                            this.data.street = cep.logradouro
                        }
                    }).catch(error => this.completeAddress = false).finally(() => {this.changeLoading(false)})
                }
            }
        }
    }
</script>
