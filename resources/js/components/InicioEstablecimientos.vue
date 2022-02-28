<template>
    <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
    </div>
</template>

<script>
import ListadoCategorias from "./ListadoCategorias";
import MapaEstablecimientos from "./MapaEstablecimientos";
import CategoriaCafe from "./CategoriaCafe";
import CategoriaRestaurant from "./CategoriaRestaurant";

export default {
    name: "inicio-establecimientos",
    components: {
        ListadoCategorias,
        MapaEstablecimientos,
        CategoriaCafe,
        CategoriaRestaurant,
    },
};
</script>
