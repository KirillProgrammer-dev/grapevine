<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Фриланс</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <div v-if="!auth">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" link href="/">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" link href="/login">Войти</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" link href="/register">Регистрация</a>
              </li>
            </div>
            <div v-else>
              <li class="nav-item">
                <a class="nav-link" link href="/logout">Выйти</a>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<style scoped>
</style>

<script>
import store from "../store"

export default {
  data: () => ({
    auth: false,
  }), 
  mounted(){
    store.dispatch("checkAuth") ? this.auth = true : this.auth = false;
  }
};
</script>
