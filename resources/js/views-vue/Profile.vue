<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="worker">
            <div class="avatar">
              <img
                class="avatar_img"
                src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                alt="AVATAR"
              />
            </div>

            <div class="worker_info">
              <h1 class="worker__name">{{ user.name }}</h1>
              <div class="worker__rating">
                <h3 class="worker_class">{{ user.class }}</h3>
                <ul class="list_stars">
                  <li class="list_star" v-for="i in 5" :key="i">
                    <img
                      src="https://cdn.icon-icons.com/icons2/38/PNG/512/star_favorite_5754.png"
                      alt="STAR"
                      class="list_star__img"
                    />
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="worker_discription">
            <h2 class="worker_description__title">Описание Фрилансера</h2>
            <p class="worker_description__text">{{ user.describtion }}</p>
          </div>
          <div class="worker_skills">
            <h2 class="worker_skills__title">Навыки</h2>
            <ul class="worker_skills__list">
              <li
                v-for="skill in user.skills"
                :key="skill.id"
                class="worker_skills__list__item"
              >
                {{ skill }}
              </li>
            </ul>
          </div>
          <div class="worker_works">
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
          <div class="worker_contacts_form">
            <button
              v-if="user.class == 'Заказчик'"
              class="btn btn-primary btn-lg btn-block text-white"
              style="margin-right: 1em"
              @click="add_service_overlay()"
            >
              Добавить услугу
            </button>
            <button
              type="button"
              class="btn btn-primary btn-lg btn-block text-white"
            >
              Редактировать профиль
            </button>
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
                <v-text-field v-model="task.describtion" />
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
                  <v-text-field
                    v-model="task.min_price"
                    suffix="₽"/>
                  <v-text-field 
                    v-model="task.max_price"
                    suffix="₽"/>
                </v-row>
                <label> Укажите средний срок исполнения </label>
                <v-text-field 
                v-model="task.deadline"
                type="number"
                suffix="дней"/>
              </v-card>

              <v-btn color="primary" @click="add_service()"> Отправить </v-btn>
            </v-stepper-content>
          </v-stepper>
        </v-card>
      </v-overlay>
    </div>
  </div>
</template>
<style scoped>
.cardStepper {
  margin: 1em;
  padding: 1em;
}
.container {
  width: 1100px;
  padding-top: 30px;
}

.avatar {
  display: flex;
  justify-content: center;
}

.avatar_img {
  width: 300px;
  height: 300px;
}

.worker__name {
  text-align: center;
}

.worker__rating {
  display: flex;
  justify-content: center;
  align-items: center;
}

.list_star {
  display: inline;
}

.list_star__img {
  width: 50px;
  height: 50px;
}

.worker_description__text {
  font-size: 18px;
}

.worker_skills__list__item {
  font-size: 18px;
}

.worker_contacts_form {
  display: flex;
}

.worker_contacts_form__message__btn {
  width: 180px;
  height: 50px;
  background-color: #1cb883;
  color: white;
  text-decoration: none;
  border-radius: 10px;
  text-align: center;
  font-size: 30px;
  padding-bottom: 10px;
  margin-right: 20px;
  margin-top: 20px;
}

.worker_contacts_form__message__btn :hover {
  background-color: #35c897;
}
</style>
<script>
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
        describtion: "",
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
      store.dispatch("add_service", {
        title: this.user.title,
        describtion: this.user.describtion,
        deadline: this.user.deadline,
        min_price: this.user.min_price,
        max_price: this.user.max_price,
      }).then((r) => {
        this.services = store.state.services;
        this.overlay = false;
      });
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>