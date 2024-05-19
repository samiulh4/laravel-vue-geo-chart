<template>
    <div class="app_wrapper">
        <div v-if="this.$route.meta.layout == 'AdminLayout'">
            <AdminNav></AdminNav>
            <AdminSidebar></AdminSidebar>
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                    <router-view></router-view>
                </div>
            </div>

        </div>
        <div v-else-if="this.$route.meta.layout == 'OtherLayout'">
            <router-view></router-view>
        </div>
        <div v-else>
            <WebNav></WebNav>
            <router-view></router-view>
            <WebFooter></WebFooter>
        </div>
    </div>
</template>
<script>
import WebNav from "../js/components/partials/WebNav.vue";
import WebFooter from "../js/components/partials/WebFooter.vue";
import AdminNav from "../js/components/partials/AdminNav.vue";
import AdminSidebar from "../js/components/partials/AdminSidebar.vue";
export default {
    components: {WebNav,WebFooter,AdminNav,AdminSidebar}
};
</script>
