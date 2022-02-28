import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
        establecimientos: [],
        establecimiento: {},
        categorias: [],
        categoria: ''
    },
    mutations: {
        AGREGAR_CAFES(state, cafes) {
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state, restaurantes) {
            state.restaurantes = restaurantes
        },
        AGREGAR_HOTELES(state, hoteles) {
            state.hoteles = hoteles
        },
        AGREGAR_ESTABLECIMIENTOS(state, establecimientos) {
            state.establecimientos = establecimientos
        },
        AGREGAR_ESTABLECIMIENTO(state, establecimiento) {
            state.establecimiento = establecimiento
        },
        AGREGAR_CATEGORIAS(state, categorias) {
            state.categorias = categorias
        },
        SELECCIONAR_CATEGORIA(state, categoria) {
            state.categoria = categoria
        }
    },
    getters: {
        obtenerEstablecimientos: state => {
            return state.establecimientos
        },
        obtenerEstablecimiento: state => {
            return state.establecimiento
        },
        obtenerImagenes: state => {
            return state.establecimiento.imagenes;
        },
        obtenerCategorias: state => {
            return state.categorias
        },
        obtenerCategoria: state => {
            return state.categoria
        }
    }
});
