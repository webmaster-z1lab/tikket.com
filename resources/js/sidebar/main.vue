<template>
    <aside id="sidebarContent" class="u-sidebar" aria-labelledby="sidebarNavToggler">
        <div class="u-sidebar__scroller">
            <div class="u-sidebar__container">
                <div class="u-header-sidebar__footer-offset">

                    <div class="d-flex justify-content-between align-items-center pt-4 px-7">
                        <h3 class="h6 mb-0" v-if="dashboard">Minha Conta</h3>

                        <button type="button" class="close ml-auto"
                                aria-controls="sidebarContent"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-unfold-event="click"
                                data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarContent"
                                data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInRight"
                                data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <dashboard :user="user" v-if="dashboard"></dashboard>

                    <guest-panel v-else></guest-panel>
                </div>

                <footer class="u-sidebar__footer u-sidebar__footer--account bg-primary d-none d-lg-block">
                    <div class="position-absolute right-0 bottom-0 left-0">
                        <img :src="'template/front/2.0.1/svg/components/wave-bottom-with-dots.svg' | aws_url" alt="Sidebar footer">
                    </div>
                </footer>
            </div>
        </div>
    </aside>
</template>

<script>
    import Dashboard from './components/auth/index'
    import GuestPanel from './components/guest/index'
    import {toSeek} from "../vendor/common"

    export default {
        name: "Sidebar",
        components: {
            Dashboard,
            GuestPanel
        },
        data: () => ({
            user: {},
            dashboard: true
        }),
        watch: {
            user(value) {
                if (_.isEmpty(value)) this.dashboard = false
            }
        },
        mounted() {
            toSeek(route('openid.user')).then(
                data => {
                    _.isEmpty(data.data) ? this.user = data.data : this.user = data.data.attributes
                }
            );
        }
    }
</script>
