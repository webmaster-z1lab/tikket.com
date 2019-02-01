<template>
    <div class="d-flex align-items-center bg-img-hero space-4 min-height-100vh--lg"
         style="background-image: url(https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/undraw_security_o890.svg);">
        <div class="container">
            <div class="w-lg-60 w-xl-50">
                <div class="mb-5">
                    <h1 class="font-weight-normal text-dark">403 - Acesso <span class="font-weight-semi-bold">negado</span></h1>
                    <p class="mb-0 text-dark">Oops! Você não possui as credenciais necessárias para acessar esse recurso.</p>
                    <p class="text-dark">Se você acredita que isso é um erro, por favor <a class="text-dark" href="https://tawk.to/chat/5b789d4dafc2c34e96e7b2ec/default" target="_blank">nos avise</a>.</p>
                </div>
                <a class="btn btn-primary btn-wide transition-3d-hover" href="/">Voltar a Home</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Vue403"
    }
</script>
