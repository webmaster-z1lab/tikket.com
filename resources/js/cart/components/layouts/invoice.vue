<template>
    <div class="container space-1 space-sm-3" id="printable">
        <div class="card bg-img-hero" :style="`background-image: url(${'template/front/2.0.1/svg/components/bg-elements-6.svg' | aws_url});`">
            <slot />
        </div>

        <div class="text-right mt-5">
            <button type="button" class="btn btn-secondary btn-sm-wide transition-3d-hover" onclick="window.print();return false;">
                <span class="fas fa-print mr-2"></span>
                Imprimir
            </button>
            <a href="/" class="btn btn-primary btn-sm-wide transition-3d-hover">
                <span class="fas fa-home mr-2"></span>
                Ir para a Home
            </a>
        </div>
    </div>
</template>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable, #printable * {
            visibility: visible;
        }
        #printable {
            position: fixed;
            top: 6rem;
            left: 2rem;
        }
    }
</style>

<script>
    export default {
        name: 'LayoutInvoice'
    }
</script>
