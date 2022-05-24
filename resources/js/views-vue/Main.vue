<template>
  <div class="services">
    <div v-for="service in services" :key="service.id" class="service">
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
          >
            Написать исполнителю
          </v-btn>
          <v-btn class="mx-2" fab small style="background: pink; color: white">
            <v-icon> mdi-heart </v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </div>
  </div>
</template>

<script>
import style from "../../style/css/main.css"
export default {
  data: () => ({
    services: [],
  }),
  methods: {
    getServices() {
      return axios.post("/api/all-services").then((request) => {
        this.services = request.data;
      });
    },
  },
  mounted() {
    this.getServices();
  },
};
</script>
