<template>
    <div class="app_wrapper">
        <div id="AdminLayout" v-if="this.$route.meta.layout == 'AdminLayout'">
            <router-view></router-view>
        </div>
        <div id="OtherLayout" v-else-if="this.$route.meta.layout == 'OtherLayout'">
            <router-view></router-view>
        </div>
        <div id="WebLayout" v-else>
            <WebNav></WebNav>
            <router-view></router-view>
            <WebFooter></WebFooter>
        </div>
    </div>
</template>
<script>
import WebNav from "../js/components/partials/WebNav.vue";
import WebFooter from "../js/components/partials/WebFooter.vue";
export default {
    components: {WebNav,WebFooter}
};
</script>
