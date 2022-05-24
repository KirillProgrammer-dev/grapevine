<template>
  <div>
    <form>
      <div class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input
          v-model="form.name"
          type="text"
          class="form-control"
          id="name"
          aria-describedby="nameHelp"
          placeholder="Иванов Иван Иванович"
        />
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Электронная почта</label>
        <input
          v-model="form.email"
          type="email"
          class="form-control"
          id="email"
          aria-describedby="emailHelp"
          placeholder="test@test.com"
        />
        <div id="emailHelp" class="form-text">
          Мы никогда не поделимся вашей почтой с другими
        </div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input
          v-model="form.password"
          type="password"
          class="form-control"
          id="password"
        />
      </div>
      <div class="mb-3">
        <label for="describtion" class="form-label">Описание</label>
        <input
          v-model="form.describtion"
          type="text"
          class="form-control"
          id="describtion"
        />
      </div>
      <div class="mb-3">
        <label for="img_url" class="form-label">Картинка</label>
        <input
          v-model="form.img_url"
          type="text"
          class="form-control"
          id="img_url"
        />
      </div>
      <div class="mb-3">
        <label for="class" class="form-label">Выберите роль</label>
        <select v-model="form.class" class="form-select" aria-label="Вы хотите быть">
          <option value="Исполнитель" selected>Исполнитель</option>
          <option value="Заказчик">Заказчик</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="class" class="form-label">Выберите знания</label>
        <select v-model="form.skills" multiple class="form-select" aria-label="Выберите знания">
          <option value="PHP" selected>PHP</option>
          <option value="Python">Python</option>
          <option value="HTML">HTML</option>
          <option value="CSS">CSS</option>
          <option value="C++">C++</option>
          <option value="JS">JS</option>
          <option value="Golang">Golang</option>
          <option value="C#">C#</option>
          <option value="Java">Java</option>
        </select>
      </div>
      <input
        value="Редактировать"
        type="button"
        class="btn btn-primary text-white"
        @click="editProfile()"
      />
    </form>
  </div>
</template>

<style scoped>
form {
  padding: 20px;
  padding-top: 100px;
  padding-right: 40%;
  padding-left: 30%;
}

button {
  color: #fff;
}
</style>

<script>
import store from "../store";

export default {
  data() {
    return {
      form: {
        name: null,
        email: null,
        describtion: null,
        password: null,
        img_url: null,
        class: null,
        skills: [],
        works: [],
      },
      isCorrect: store.state.isCorrect,
    };
  },
  methods: {
    editProfile() {
      store.dispatch("edit_profile", {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        class: this.form.class,
        skills: this.form.skills.join(),
        describtion: this.form.describtion,
        works: this.form.works,
        img_url: this.form.img_url,
      });
    },
  },
};
</script>
