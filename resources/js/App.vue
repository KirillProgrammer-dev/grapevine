<template>
  <v-app>
    <div>
      <Navbar></Navbar>
      <router-view></router-view>
    </div>
  </v-app>
</template>

<style scoped>
</style>

<script>
import Navbar from "./components/Navbar.vue";

export default {
  components: {
    Navbar: Navbar,
  },
  mounted() {
    this.$vuetify.theme.themes.light.primary = "#08D9D6";
    this.$vuetify.theme.themes.light.secondary = "#252A34";
    this.$vuetify.theme.themes.light.accent = "#FF2E63";
    this.$vuetify.theme.themes.light.error = "#f44336";
    this.$vuetify.theme.themes.light.warning = "#ffc107";
    this.$vuetify.theme.themes.light.info = "#3f51b5";
    this.$vuetify.theme.themes.light.success = "#4caf50";
  },
};
</script>
