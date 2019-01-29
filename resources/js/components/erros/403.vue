<template>
    <div class="d-flex align-items-center bg-img-hero space-4 min-height-100vh--lg"
         style="background-image: url(https://s3.us-east-2.amazonaws.com/cdn-z1lab/images/undraw/undraw_security_o890.svg);">
        <div class="container">
            <div class="w-lg-60 w-xl-50">
                <div class="mb-5">
                    <h1 class="text-primary font-weight-normal">Não <span class="font-weight-bold">autorizado</span></h1>
                    <p class="mb-0">Oops! Você está tentando acessar uma página que não lhe pertence.</p>
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
