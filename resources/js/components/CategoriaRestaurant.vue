<template>
    <div class="container my-5">
        <h2>Restaurantes</h2>
        <div class="row">
            <div class="col-md-4 mt-4" v-for="r in this.restaurantes" v-bind:key="r.id">
                <div class="card">
                    <img class="card-img-top" :src="`storage/${r.imagen_principal}`" alt="card">
                    <div class="card-body">
                        <h3 class="card-title text-primary font-weight-bold">{{r.nombre}}</h3>
                        <p class="card-text">{{r.direccion}}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario</span>
                            {{r.apertura}} - {{r.cierre}}
                        </p>
                        <router-link :to="{ name: 'establecimiento', params: {id: r.id}}">
                            <a class="btn btn-primary d-block">Ver Establecimiento</a>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        axios.get('/api/categorias/restaurant')
            .then(response => {
                this.$store.commit("AGREGAR_RESTAURANTES", response.data);
            })
    },
    computed: {
        restaurantes(){
            return this.$store.state.restaurantes;
        }
    }
}
</script>

<style scoped>

</style>
