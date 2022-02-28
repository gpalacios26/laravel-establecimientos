<template>
    <div class="container">
        <div class="row justify-content-center">
            <vue-page-transition name="fade-in-right">
                <router-view></router-view>
            </vue-page-transition>
        </div>
    </div>
</template>

<script>
import store from "../store";

export default {
    name: "pagina-inicio",
    store,
};
</script>
