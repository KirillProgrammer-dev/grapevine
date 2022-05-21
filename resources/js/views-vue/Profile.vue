<template>
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
                <li class="list_star">
                  <img
                    src="https://cdn.icon-icons.com/icons2/1077/PNG/512/star_77949.png"
                    alt="STAR"
                    class="list_star__img"
                  />
                </li>
                <li class="list_star">
                  <img
                    src="https://cdn.icon-icons.com/icons2/1077/PNG/512/star_77949.png"
                    alt="STAR"
                    class="list_star__img"
                  />
                </li>
                <li class="list_star">
                  <img
                    src="https://cdn.icon-icons.com/icons2/1077/PNG/512/star_77949.png"
                    alt="STAR"
                    class="list_star__img"
                  />
                </li>
                <li class="list_star">
                  <img
                    src="https://cdn.icon-icons.com/icons2/38/PNG/512/star_favorite_5754.png"
                    alt="STAR"
                    class="list_star__img"
                  />
                </li>
                <li class="list_star">
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
              <p class="worker_description__text">Добрый день, меня зовут Анон и я занимаюсь программированием на PascalABC</p>
          </div>
          <div class="worker_skills">
              <h2 class="worker_skills__title">Навыки</h2>
              <ul class="worker_skills__list">
                  <li class="worker_skills__list__item">PascalABC</li>
                  <li class="worker_skills__list__item">Алгебра</li>
                  <li class="worker_skills__list__item">Геометрия</li>
                  <li class="worker_skills__list__item">Ораторское искусство</li>
              </ul>
          </div>
          <div class="worker_contacts_form">
              <a href="#" class="btn worker_contacts_form__message__btn">Написать</a>
              <a href="#" class="btn worker_contacts_form__message__btn">Оставить отзыв</a>
          </div>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="worker_works__title">Работы</h1>
        </div>
    </div>
    <div class="row">
    </div>
  </div>
</template>
<style scoped>

.container {
  width: 1100px;
  padding-top: 30px;
}

.avatar{
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

.worker_description__text{
    font-size: 18px;
}

.worker_skills__list__item{
    font-size: 18px;
}

.worker_contacts_form{
    display: flex;
}

.worker_contacts_form__message__btn{
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

.worker_contacts_form__message__btn :hover{
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
        password: null,
        img_url: null,
        class: null,
        skills: null,
        works: null,
      },
    };
  },
  methods: {
    getUser() {
      //this.user = store.state.user;
      return axios
        .post("/api/user")
        .then((response) => {
            if (response.status == 201) {
                this.user = response.data;
            } else {
                console.log('none');
            }
        });
    },
  },
  mounted(){
      this.getUser();
  },
};
</script>