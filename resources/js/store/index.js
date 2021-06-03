import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
   state: {
       cafes: [],
       restaurantes: [],
       establecimiento: {}
   },
    mutations: {
        AGREGAR_CAFES(state, cafes){
           state.cafes = cafes;
        },
        AGREGAR_RESTAURANTES(state, restaurantes){
            state.restaurantes = restaurantes;
        },
        AGREGAR_ESTABLECIMIENTO(state,establecimiento){
            state.establecimiento = establecimiento;
        }
    },
    getters: {
       obtenerEstablecimiento: state => {
           return state.establecimiento;
       }
    }
});
