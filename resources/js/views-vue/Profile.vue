<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="worker">
            <div class="avatar">
              <img
                class="img"
                src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                alt="AVATAR"
              />
            </div>

            <div class="info">
              <h1 class="name">{{ user.name }}</h1>
              <div class="rating">
                <h3 class="class">{{ user.class }}</h3>
                <ul class="list_stars">
                  <li class="list_star" v-for="i in 5" :key="i">
                    <img
                      src="https://w7.pngwing.com/pngs/229/173/png-transparent-star-star-angle-white-triangle.png"
                      alt="STAR"
                      class="img"
                    />
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="discription">
            <h2 class="title">Описание Фрилансера</h2>
            <p class="text">{{ user.describtion }}</p>
          </div>
          <div class="skills" v-if="user.class == 'Исполнитель'">
            <h2 class="title">Навыки</h2>
            <ul class="list">
              <li
                v-for="skill in user.skills"
                :key="skill.id"
                class="item"
              >
                {{ skill }}
              </li>
            </ul>
          </div>
          <div class="worker_works" v-if="user.class == 'Исполнитель'">
            <h2 class="worker_works__title">Работы</h2>
            <ul class="worker_skills__list">
              <li
                v-for="work in user.works"
                :key="work.id"
                class="worker_skills__list__item"
              >
                {{ work }}
              </li>
            </ul>
          </div>
          <div class="contacts">
            <v-btn
              v-if="user.class == 'Исполнитель'"
              :color="$vuetify.theme.themes.light.primary"
              style="margin-right: 1em;"
              @click="add_service_overlay()"
            >
              Добавить услугу
            </v-btn>
            <v-btn
              :color="$vuetify.theme.themes.light.primary"
              @click="goToEdit()"
            >
              Редактировать профиль
            </v-btn>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div>
      <v-overlay :value="overlay">
        <v-card style="background: white; color: black">
          <v-card-title> Создание услуги </v-card-title>
          <v-stepper v-model="e1">
            <v-stepper-header>
              <v-stepper-step :complete="e1 > 1" step="1">
                Название и описание
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step :complete="e1 > 2" step="2">
                Дополнительная информация
              </v-stepper-step>

              <!-- <v-divider></v-divider>

              <v-stepper-step step="3"> 
                Выбор картинки
              </v-stepper-step> -->
            </v-stepper-header>
            <v-stepper-content step="1">
              <v-card
                class="mb-12 cardStepper"
                color="grey lighten-1"
                height="200px"
              >
                <label> Название услуги </label>
                <v-text-field v-model="task.title" />
                <label> Описание услуги </label>
                <v-text-field v-model="task.description" />
              </v-card>

              <v-btn color="primary" @click="e1 = 2"> Далее </v-btn>
            </v-stepper-content>

            <v-stepper-content step="2">
              <v-card
                class="mb-12 cardStepper"
                color="grey lighten-1"
                height="200px"
              >
                <label> Интервал цен </label>
                <v-row
                  class="d-flex flex-row flex-nowrap justify-center"
                  style="width: 50%"
                >
                  <v-text-field v-model="task.min_price" suffix="₽" />
                  <v-text-field v-model="task.max_price" suffix="₽" />
                </v-row>
                <label> Укажите средний срок исполнения </label>
                <v-text-field
                  v-model="task.deadline"
                  type="number"
                  suffix="дней"
                />
              </v-card>

              <v-btn color="primary" @click="add_service()"> Отправить </v-btn>
            </v-stepper-content>
          </v-stepper>
        </v-card>
      </v-overlay>
      <div v-if="user.class == 'Исполнитель'" class="services">
        <div v-for="service in services" :key="service.id" class="service">
          <v-card style="
          display: flex;
          flex-direction: column;
          flex-wrap: nowrap;
          width: 25em;
          justify-content: center;
          align-content: center;
          ">
            <v-card-title>
              {{ service.title }}
              <v-img src="https://makewebsite.ru/wp-content/uploads/2020/09/2.jpg"></v-img>
            </v-card-title>
            <v-card-subtitle style="font-size: 1.1em;margin-top:0.5em">
              {{ service.description }}
            </v-card-subtitle>
            <v-divider  class="mx-4"/>
            <v-card-text>
              <div>
                От {{ service.min_price }}₽ <br>
                До {{ service.max_price }}₽
              </div>
              <div>
                Средний срок исполнения {{ service.deadline }} дней
              </div>
            </v-card-text>
            <v-card-actions>
              <v-btn
              :color="$vuetify.theme.themes.light.primary"
              style="color: black;"
              >
                Написать исполнителю
              </v-btn>
               <v-btn
                class="mx-2"
                fab
                small
                style="background: pink; color: white;"
              >
                <v-icon>
                  mdi-heart
                </v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import style from "../../style/css/profile.css"
import store from "../store";

export default {
  data() {
    return {
      user: {
        name: null,
        email: null,
        describtion: null,
        img_url: null,
        class: null,
        skills: [],
        works: [],
      },
      services: [],
      overlay: false,
      e1: 1,
      task: {
        title: "",
        description: "",
        deadline: 1,
        min_price: 100,
        max_price: 1000,
      },
    };
  },
  methods: {
    getUser() {
      return axios
        .post(
          "/api/user",
          {
            token: store.state.token,
          },
          {
            headers: {
              Authorization: "Bearer " + store.state.token,
            },
          }
        )
        .then((response) => {
          if (response.status == 200) {
            this.user = response.data;
            this.user.skills = Object.assign({}, this.user.skills.split(","));
            this.user.works = Object.assign({}, this.user.works.split(","));
          } else {
            console.log("none");
          }
        });
    },
    add_service_overlay() {
      this.overlay = true;
    },
    add_service() {
      store
        .dispatch("add_service", {
          title: this.task.title,
          description: this.task.description,
          deadline: this.task.deadline,
          min_price: this.task.min_price,
          max_price: this.task.max_price,
        })
        .then((r) => {
          this.services = store.state.services;
          this.overlay = false;
        });
    },
    getServices() {
      return axios.post("/api/services-by-id", null, {
        headers: {
          Authorization: "Bearer " + store.state.token,
        },
      }).then(request => {
        this.services = request.data
      });
    },
    goToEdit(){
      window.location = '/edit';
    }
  },
  mounted() {
    this.getUser();
    this.getServices();
  },
};
</script>