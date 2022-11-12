<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="things"
      item-key="name"
      class="elevation-1"
      :search="search"
      :custom-filter="filterOnlyCapsText"
    >
      <!-- <template v-slot:top>
        <v-text-field
          v-model="search"
          label="Искать"
          class="mx-4"
        ></v-text-field>
      </template> -->
      <template v-slot:item="row">
        <tr>
          <td>{{ row.item.id }}</td>
          <td>{{ row.item.name }}</td>
          <td>{{ row.item.amount }}</td>
          <td></td>
          <td>
            <v-list>
              <v-list-group :value="false">
                <!-- prepend-icon="mdi-account-circle" -->
                <template v-slot:activator>
                  <v-list-item-title>Кто взял</v-list-item-title>
                </template>

                <v-list-item-content v-for="i in row.item.owner" :key="i">
                  <v-list-item-title>{{ i.name }}, {{ i.date }}, {{ i.amount }}</v-list-item-title>
                </v-list-item-content>
                
              </v-list-group>
            </v-list>
          </td>
          <td>
            <v-row justify="center">
              <v-dialog
                v-model="dialogAdd"
                fullscreen
                hide-overlay
                transition="dialog-bottom-transition"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    :color="$vuetify.theme.themes.light.primary"
                    dark
                    v-bind="attrs"
                    v-on="on"
                    @click="plusClicked(row.item.id)"
                  >
                    <v-icon dark>mdi-plus</v-icon>
                  </v-btn>
                  
                </template>
                <v-card>
                  <v-toolbar
                    dark
                    :color="$vuetify.theme.themes.light.secondary"
                  >
                    <v-btn icon dark @click="dialogAdd = false">
                      <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Добавить человека</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                      <v-btn dark text @click="addHuman()">
                        <v-icon>mdi-table-large-plus</v-icon>Добавить
                      </v-btn>
                    </v-toolbar-items>
                  </v-toolbar>

                  <v-list three-line subheader>
                    <v-subheader
                      >Введите информацию о том, когда человек взял товар,
                      сколько и на сколько</v-subheader
                    >
                    <div style="width: 40%">
                      <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Кто взял</v-list-item-title>
                          <v-list-item-subtitle
                            >Введите полное имя человека взявшего
                            вещь</v-list-item-subtitle
                          >
                        </v-list-item-content>
                        <v-list-item-action>
                          <v-text-field
                            type="text"
                            v-model="personName"
                            label="Имя"
                          ></v-text-field>
                        </v-list-item-action>
                      </v-list-item>
                    </div>
                    <div style="width: 40%">
                      <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Когда взял</v-list-item-title>
                          <v-list-item-subtitle
                            >Введите полную точную дату когда человек взял
                            вещь</v-list-item-subtitle
                          >
                        </v-list-item-content>
                        <v-list-item-action>
                          <v-text-field
                            type="date"
                            v-model="date"
                            label="Дата"
                          ></v-text-field>
                        </v-list-item-action>
                      </v-list-item>
                    </div>
                    <div style="width: 40%">
                      <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Сколько взял</v-list-item-title>
                          <v-list-item-subtitle
                            >Введите точное колличество сколько взял человек</v-list-item-subtitle
                          >
                        </v-list-item-content>
                        <v-list-item-action>
                          <v-text-field
                            type="number"
                            v-model="number"
                            label="Число"
                          ></v-text-field>
                        </v-list-item-action>
                      </v-list-item>
                    </div>
                  </v-list>
                </v-card>
              </v-dialog>
            </v-row>
          </td>
        </tr>
      </template>
    </v-data-table>
    <v-row justify="center">
      <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            :color="$vuetify.theme.themes.light.secondary"
            dark
            v-bind="attrs"
            v-on="on"
            block
            x-large
            @click="openOverlay"
          >
            Добавить вещь
          </v-btn>
        </template>
        <v-card>
          <v-toolbar dark :color="$vuetify.theme.themes.light.secondary">
            <v-btn icon dark @click="dialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Добавить вещь</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark text @click="addElement">
                <v-icon>mdi-table-large-plus</v-icon>Добавить
              </v-btn>
            </v-toolbar-items>
          </v-toolbar>
          <!-- <v-list three-line subheader>
            <v-subheader>Введите требуемую информацию</v-subheader>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Content filtering</v-list-item-title>
                <v-list-item-subtitle
                  >Set the content filtering level to restrict apps that can be
                  downloaded</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Password</v-list-item-title>
                <v-list-item-subtitle
                  >Require password for purchase or use password to restrict
                  purchase</v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
          </v-list> -->
          <!-- <v-divider></v-divider> -->
          <v-list three-line subheader>
            <v-subheader>Основная информация</v-subheader>
            <div style="width: 40%">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Название вещи</v-list-item-title>
                  <v-list-item-subtitle
                    >Введите полное название вещи, желательно
                    уникальное</v-list-item-subtitle
                  >
                </v-list-item-content>
                <v-list-item-action>
                  <v-text-field v-model="name" label="Название"></v-text-field>
                </v-list-item-action>
              </v-list-item>
            </div>
            <div style="width: 40%">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Колличество</v-list-item-title>
                  <v-list-item-subtitle
                    >Введите колличество вещей в сумме у всех на руках и в
                    Погорелках</v-list-item-subtitle
                  >
                </v-list-item-content>
                <v-list-item-action>
                  <v-text-field
                    type="number"
                    v-model="amount"
                    label="Колличество"
                  ></v-text-field>
                </v-list-item-action>
              </v-list-item>
            </div>
            
            <!-- <div style="width: 40%">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Когда взял</v-list-item-title>
                  <v-list-item-subtitle
                    >Введите полную точную дату когда человек взял
                    вещь</v-list-item-subtitle
                  >
                </v-list-item-content>
                <v-list-item-action>
                  <v-text-field
                    type="date"
                    v-model="date"
                    label="Дата"
                  ></v-text-field>
                </v-list-item-action>
              </v-list-item>
            </div> -->
          </v-list>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>

<script>
import store from "../store";
import style from "../../style/css/main.css";
export default {
  data() {
    return {
      search: "",
      amount: "",
      things: [],
      dialog: false,
      dialogAdd: false,
      name: "",
      amount: 0,
      date: "",
      personName: "",
      activeId: 0,
      number: 0, 
    };
  },
  computed: {
    headers() {
      return [
        {
          text: "id",
          align: "start",
          filter: (value) => {
            if (!this.id) return true;

            return value < parseInt(this.id);
          },
          value: "id",
          width: "1%",
        },
        {
          text: "Название вещи",
          sortable: false,
          value: "name",
          width: "1%",
        },
        {
          text: "Колличество всего",
          value: "amount",
          filter: (value) => {
            if (!this.amount) return true;

            return value < parseInt(this.amount);
          },
          width: "1%",
        },
        {
          text: "В погорелках",
          sortable: false,
          value: "inPogorelki",
          width: "1%",
        },
        {
          text: "У кого",
          sortable: false,
          value: "whoHas",
          width: "1%",
        },
        {
          text: "Добавить временного владельца",
          sortable: false,
          value: "addButton",
          width: "1%",
        },
      ];
    },
  },
  methods: {
    filterOnlyCapsText(value, search, item) {
      return (
        value != null &&
        search != null &&
        typeof value === "string" &&
        value.toString().toLocaleUpperCase().indexOf(search) !== -1
      );
    },
    addHuman() {
      //console.log(id);
      this.dialogAdd = false;
      axios
        .post("api/add-thing-owner", {
          id: this.activeId,
          name: this.personName,
          date_from: this.date,
          amount: this.number,
        })
        .then(function (response) {
          console.log(response);
        });
      window.location.reload();
    },
    addElement() {
      this.dialog = false;
      axios
        .post("api/add-new-thing", {
          name: this.name,
          amount: this.amount,
        })
        .then(function (response) {
          console.log(response);
        });
      window.location.reload();
    },
    loadThings() {
      axios.post("api/get-all-things").then((response) => {
        this.things = response.data;
        console.log(this.things);
      });
      this.response.forEach((element) => {
        element["button"];
      });

    },
    plusClicked(id){
      this.dialogAdd = true;
      this.activeId = id;
    }
  },
  beforeMount() {
    this.loadThings();
  },
};
</script>
