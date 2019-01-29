<template>
    <div>
        <breadcrumb-section v-if="!isLoading"></breadcrumb-section>

        <loading-component :isLoading="isLoading"></loading-component>

        <div class="bg-light">
            <router-view v-if="!isLoading"></router-view>
        </div>
    </div>
</template>

<script>
    import LoadingComponent from '../components/loadingComponent'
    import BreadcrumbSection from './components/breadcrumb-section'

    import {mapActions} from 'vuex'

    export default {
        name: 'VueMain',
        components: {
            LoadingComponent,
            BreadcrumbSection
        },
        data: () => ({
            isLoading: true
        }),
        methods: {
            ...mapActions(['setDataBasic'])
        },
        async mounted() {
            await this.setDataBasic()

            this.isLoading = false
        }
    }
</script>
