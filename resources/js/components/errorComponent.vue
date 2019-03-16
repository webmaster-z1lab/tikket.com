<template>
    <div class="d-flex align-items-center bg-img-hero space-4 min-height-100vh--lg">
        <div class="container">
            <div class="w-lg-60 w-xl-50">
                <div class="mb-5">
                    <div v-html="errorMessage.title"></div>
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
            }
        },
        computed: {
            errorMessage() {
                const code = {
                    401: {
                        title: '<h1 class="font-weight-normal text-dark">401 - Acesso não <span class="font-weight-semi-bold">permitido</span></h1>',
                        message: 'Oops! Você precisa estar autenticado para acessar esse recurso.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/purple/undraw_security.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    403: {
                        title: '<h1 class="font-weight-normal text-dark">403 - Acesso <span class="font-weight-semi-bold">negado</span></h1>',
                        message: 'Oops! Você não possui as credenciais necessárias para acessar esse recurso.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/purple/undraw_security.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    404: {
                        title: '<h1 class="text-primary font-weight-normal">Página não <span class="font-weight-bold">encontrada</span></h1>',
                        message: 'Oops! Você está em um link que não existe.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/error-404.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    405: {
                        title: '<h1 class="text-primary font-weight-normal">405 - Método não <span class="font-weight-semi-bold">permitido</span></h1>',
                        message: 'Oops! Essa recurso não pode ser acessado utilizando o método atual.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/purple/undraw_be_the_hero.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    422: {
                        title: '<h1 class="text-primary font-weight-normal">Entidade <span class="font-weight-bold">improcessável</span></h1>',
                        message: '',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/error-404.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    500: {
                        title: '<h1 class="font-weight-normal text-danger">500 - Falha no <span class="font-weight-semi-bold">servidor</span></h1>',
                        message: 'Uma perturbação na força causou uma falha no nosso sistema.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/purple/undraw_may_the_force.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    503: {
                        title: '<h1 class="font-weight-normal text-danger">503 - Nós estamos realizando alguns <span class="font-weight-semi-bold">ajustes</span></h1>',
                        message: 'Pedimos desculpas pela inconveniência mas o <strong>Tikket</strong> está passando por uma manuntenção programada.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/maintenance-mode.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    }
                }

                return code[this.code]
            }
        },
        created() {
            document.body.style.background = `url(${this.errorMessage.background}) no-repeat 0 0`
            document.body.style.backgroundSize = "100% auto"
            document.getElementById('list-footer').style.display = 'none'
        }
    }
</script>
