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
                    422: {
                        title: 'Entidade improcessável',
                        message: '',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/error-404.svg',
                        icon: 'undraw_warning_cyit.svg',
                        redirect: 'https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default'
                    },
                    404: {
                        title: '<h1 class="text-primary font-weight-normal">Página não <span class="font-weight-bold">encontrada</span></h1>',
                        message: 'Oops! Você está em um link que não existe.',
                        background: 'https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/error-404.svg',
                        icon: 'undraw_page_not_found_su7k.svg',
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
