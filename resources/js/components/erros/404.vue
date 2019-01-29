<template>
    <div class="d-flex align-items-center bg-img-hero space-4 min-height-100vh--lg"
         style="background-image: url(https://s3.us-east-2.amazonaws.com/cdn-z1lab/template/front/2.0.1/svg/illustrations/error-404.svg);">
        <div class="container">
            <div class="w-lg-60 w-xl-50">

                <div class="mb-5">
                    <h1 class="text-primary font-weight-normal">Página não <span class="font-weight-bold">encontrada</span></h1>
                    <p class="mb-0">Oops! Você está em um link que não existe.</p>
                    <p>Se você acredita que isso é um bug, pro favor <a href="/contact">entre em contato com a gente</a>.</p>
                </div>

                <a class="btn btn-primary btn-wide transition-3d-hover" href="/">Voltar a Home</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Vue404"
    }
</script>
