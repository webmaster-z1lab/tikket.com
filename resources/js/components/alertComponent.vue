<template>
    <div class="cbp-item rounded text-left">
        <div class="cbp-item-wrapper">
            <article class="rounded p-3" :class="classColor">
                <h4 class="h6 text-white mb-0">
                    {{textTitle}}
                </h4>
                <br>
                <small class="d-block text-light mb-1">
                    <strong>{{msg.detail}}</strong>
                </small>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlertVue",
        props: {
            title: {
                type: String
            },
            type: {
                type: String,
                default: 'danger'
            },
            msg: {
                type: Object,
                default: {}
            }
        },
        computed: {
            classColor() {
                const color = {
                    danger: 'bg-danger',
                    success: 'bg-success',
                    warning: 'bg-warning',
                    primary: 'bg-primary',
                    info: 'bg-info'
                }

                return color[this.type]
            },
            textTitle() {
                const text = {
                    danger: 'Ops, algo está errado!',
                    success: 'Eee, tudo Certo!',
                    warning: 'Atenção, algo deve ser verificado!',
                    primary: '',
                    info: ''
                }

                return this.title || text[this.type]
            }
        }
    }
</script>
