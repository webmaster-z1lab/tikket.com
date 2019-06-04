<template>
    <div class="d-flex align-items-center bg-img-hero space-4 min-height-100vh--lg">
        <div class="container">
            <div class="w-lg-60 w-xl-50">
                <div class="mb-5">
                    <h1 :class="errorMessage.class_title" v-html="errorMessage.title"></h1>
                    <p class="mb-0">{{errorMessage.message}}</p>
                    <p>Se você acredita que isso é um erro, por favor <a :href="errorMessage.redirect" target="_blank">nos avise</a>.</p>
                </div>

                <a class="btn btn-primary btn-wide transition-3d-hover" href="/">Voltar a Home</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VueError",
        props: {
            code: {
                required: true
            },
            title: {
                type: String
            },
            message: {
                type: String
            }
        },
        computed: {
            errorMessage() {
                const code = {
                    401: {
                        title: '401 - Acesso não <span class="font-weight-semi-bold">permitido</span>',
                        class_title: 'font-weight-normal text-dark',
                        message: 'Oops! Você precisa estar autenticado para acessar esse recurso.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/images/undraw/purple/undraw_security.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    403: {
                        title: '403 - Acesso <span class="font-weight-semi-bold">negado</span>',
                        class_title: 'font-weight-normal text-dark"',
                        message: 'Oops! Você não possui as credenciais necessárias para acessar esse recurso.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/images/undraw/purple/undraw_security.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    404: {
                        title: 'Página não <span class="font-weight-bold">encontrada</span>',
                        class_title: 'text-primary font-weight-normal',
                        message: 'Oops! Você está em um link que não existe.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/images/undraw/undraw_page_not_found_su7k.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    405: {
                        title: '405 - Método não <span class="font-weight-semi-bold">permitido</span>',
                        class_title: 'text-primary font-weight-normal',
                        message: 'Oops! Essa recurso não pode ser acessado utilizando o método atual.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/undraw/purple/undraw_be_the_hero.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    422: {
                        title: 'Entidade <span class="font-weight-bold">improcessável</span>',
                        class_title: 'text-primary font-weight-normal',
                        message: 'Oops! Essa recurso não pode ser utilizando no momento atual.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/images/undraw/undraw_warning_cyit.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    500: {
                        title: '500 - Falha no <span class="font-weight-semi-bold">servidor</span>',
                        class_title: 'font-weight-normal text-danger',
                        message: 'Uma perturbação na força causou uma falha no nosso sistema.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/images/undraw/purple/undraw_may_the_force.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    503: {
                        title: '503 - Nós estamos realizando alguns <span class="font-weight-semi-bold">ajustes</span>',
                        class_title: 'font-weight-normal text-danger',
                        message: 'Pedimos desculpas pela inconveniência mas o <strong>Tikket</strong> está passando por uma manuntenção programada.',
                        background: `${process.env.MIX_AWS_CDN_ENDPOINT}/template/front/2.0.1/svg/illustrations/maintenance-mode.svg`,
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    }
                }

                return {
                    title: this.title || code[this.code].title,
                    message: this.message || code[this.code].message,
                    background: code[this.code].background,
                    redirect: code[this.code].redirect
                }
            }
        },
        created() {
            document.body.style.background = `url(${this.errorMessage.background}) no-repeat 0 0`
            document.body.style.backgroundSize = "100% auto"
            document.getElementById('list-footer').style.display = 'none'
        }
    }
</script>
