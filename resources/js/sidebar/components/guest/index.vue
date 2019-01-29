<template>
    <div class="js-scrollbar u-sidebar__body">
        <div class="u-sidebar__content u-header-sidebar__content">
            <component v-bind:is="currentComponent" @exchange="exchangeComponent"></component>
        </div>
    </div>
</template>

<script>
    import LoginForm from './login-form'
    import PasswordRecoveryForm from './password-recovery-form'
    import RegisterForm from './register-form'

    export default {
        name: "GuestPanel",
        data: () => ({
            currentComponent: 'login-form'
        }),
        components: {
            LoginForm,
            PasswordRecoveryForm,
            RegisterForm
        },
        methods: {
            exchangeComponent(comp) {
                this.currentComponent = comp
            }
        }
    }
</script>
