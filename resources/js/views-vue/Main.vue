<template>
  <div class="content">
    <div class="services">
      <div v-for="service in services.data" :key="service.id" class="service">
        <v-card
          style="
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            width: 25em;
            justify-content: center;
            align-content: center;
          "
        >
          <v-card-title>
            {{ service.title }}
            <v-img
              src="https://makewebsite.ru/wp-content/uploads/2020/09/2.jpg"
            ></v-img>
          </v-card-title>
          <v-card-subtitle style="font-size: 1.1em; margin-top: 0.5em">
            {{ service.description }}
          </v-card-subtitle>
          <v-divider class="mx-4" />
          <v-card-text>
            <div>
              От {{ service.min_price }}₽ <br />
              До {{ service.max_price }}₽
            </div>
            <div>Средний срок исполнения {{ service.deadline }} дней</div>
          </v-card-text>
          <v-card-actions>
            <v-btn
              :color="$vuetify.theme.themes.light.primary"
              style="color: black"
              @click="openSettingExecuor(service.id)"
            >
              Написать исполнителю
            </v-btn>
            <v-btn
              class="mx-2"
              fab
              small
              style="background: pink; color: white"
            >
              <v-icon> mdi-heart </v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </div>
      <v-overlay :value="overlay">
        <v-card style="background: white; color: black">
          <v-card-title> Создание заказа </v-card-title>
          <v-stepper v-model="e1">
            <v-stepper-header>
              <v-stepper-step :complete="e1 > 1" step="1">
                Название и описание
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step :complete="e1 > 2" step="2">
                Дополнительная информация
              </v-stepper-step>
            </v-stepper-header>
            <v-stepper-content step="1">
              <v-card
                class="mb-12 cardStepper"
                color="grey lighten-1"
                height="200px"
              >
                <label> Название заказа </label>
                <v-text-field v-model="order.title" />
                <label> Описание заказа </label>
                <v-text-field v-model="order.description" />
              </v-card>

              <v-btn color="primary" @click="e1 = 2"> Далее </v-btn>
            </v-stepper-content>

            <v-stepper-content step="2">
              <v-card
                class="mb-12 cardStepper"
                color="grey lighten-1"
                height="200px"
              >
                <label> Укажите бюджет </label>
                <v-text-field v-model="order.price" suffix="₽" />
                <label> Укажите дедлайн </label>
                <v-text-field
                  v-model="order.deadline"
                  type="number"
                  suffix="дней"
                />
              </v-card>

              <v-btn color="primary" @click="setExecutor()"> Отправить </v-btn>
            </v-stepper-content>
          </v-stepper>
        </v-card>
      </v-overlay>
    </div>
    <div>
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" @click="setPage(curPage - 1)">Previous</a>
          </li>
          <li v-for="page in services.pages" :key="page" class="page-item">
            <a class="page-link" @click="setPage(page)">{{ page }}</a>
          </li>
          <li class="page-item">
            <a class="page-link" @click="setPage(curPage + 1)">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import store from "../store";
import style from "../../style/css/main.css";
export default {
  data: () => ({
    services: [],
    overlay: false,
    idsend: 0,
    order: {
      title: null,
      description: null,
      deadline: null,
      price: null,
    },
    e1: 1,
    curPage: 1,
  }),
  methods: {
    getServices() {
      return axios
        .post("/api/all-services", {
          page: this.curPage,
        })
        .then((request) => {
          this.services = request.data;
        });
    },
    setPage(page = 1) {
      if (page != 7 && page != 0) {
        this.$router.push("/?page=" + page);
        this.curPage = Number(this.$route.query.page);
        this.getServices();
      }
    },
    openSettingExecuor(id) {
      this.overlay = true;
      this.idsend = id;
    },
    setExecutor() {
      console.log(this.order);
      return axios
        .post(
          "/api/set-executor-for-task",
          {
            id: this.idsend,
            order: this.order,
          },
          {
            headers: {
              Authorization: "Bearer " + store.state.token,
            },
          }
        )
        .then((r) => {
          if (r.status == 401) {
            $router.push("/login");
          } else {
            alert(
              "Мы передали ваши контакты исполнителю, скоро он Вам напишет"
            );
            this.overlay = false;
          }
        });
    },
  },
  mounted() {
    this.getServices();
    this.curPage = Number(this.$route.query.page);
  },
};
</script>
