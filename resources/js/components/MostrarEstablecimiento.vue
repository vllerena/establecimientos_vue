<template>
    <div class="container my-5">
        <h2>{{establecimiento.nombre}}</h2>
    </div>
</template>

<script>
export default {
    name: "MostrarEstablecimiento",
    mounted() {
        const { id } = this.$route.params;
        axios.get('/api/establecimiento/' + id)
            .then(response => {
                this.$store.commit('AGREGAR_ESTABLECIMIENTO', response.data)
            })
    },
    computed: {
        establecimiento() {
            return this.$store.getters.obtenerEstablecimiento;
        }
    }
}
</script>

<style scoped>

</style>
