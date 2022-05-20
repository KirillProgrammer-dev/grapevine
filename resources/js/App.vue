<template>
    <div>
        <Navbar></Navbar>
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>

<script>
import Navbar from './components/Navbar.vue'

export default {
    components:{
        Navbar : Navbar,
    }
}
</script>
