<template>
    <div class="col-12">
        <div class="mb-3">
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">Precisamos dos seus dados básicos</h5>
                <hr>
                <p class="alert-text">
                    São informações que irão completar seu perfil de usuário e são necessárias para completar o processo de compra.
                    Não será necessário fornecê-los em compras futuras!
                </p>
            </div>

            <div class="card card-frame card-frame-highlighted mb-4">
                <div class="card-body">
                    <h5 class="card-title">Dados básicos do comprador</h5>

                    <div class="row">
                        <div class="col-md-6 mb-2" :class="errors.has('customer_document') ? 'u-has-error' : ''">
                            <label class="form-label required">CPF</label>

                            <the-mask class="form-control" type="text" name="customer_document" id="customer_document" v-model="data.document"
                                      placeholder="000.000.000-00" v-validate="'required|cpf'" data-vv-as="'CPF'" mask="###.###.###-##" />

                            <div v-show="errors.has('customer_document')" class="invalid-feedback" style="display: block">
                                {{ errors.first('customer_document') }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-2" :class="errors.has('customer_phone') ? 'u-has-error' : ''">
                            <label class="form-label required">Telefone</label>

                            <the-mask class="form-control" type="text" name="customer_phone" id="customer_phone" placeholder="(00) 00000-0000 ou (00) 0000-0000"
                                      v-validate="'required|phone'" data-vv-as="'Telefone'" :mask="['(##) ####-####', '(##) #####-####']" v-model="data.phone" />

                            <div v-show="errors.has('customer_phone')" class="invalid-feedback" style="display: block">
                                {{ errors.first('customer_phone') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {TheMask} from 'vue-the-mask'

    export default {
        name: "UpdatingUserData",
        inject: ['$validator'],
        components: {
            TheMask
        },
        props: {
            data: {
                required: true,
                type: [Array, Object]
            }
        }
    }
</script>
