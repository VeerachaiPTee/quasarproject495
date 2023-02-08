<template>
  <q-page class="row">
    <div class="row full-width">
      <div class="col-md-8 offset-md-2 col-xs-12 q-pa-xs">
        <q-card flat class="bg-white text-black">
          <q-card-section class=""> </q-card-section>
          <div class="row full-width">
            <div class="col-md-12 col-xs-12 q-pa-xs">
              <!-- @submit.prevent="submitForm()"
                      @reset="resetForm()" -->
              <!-- <q-form
                      method="post"
                      class="q-gutter-md"
                    >
                    </q-form> -->
              <q-form autofocus @submit="submitForm">
                <q-card-section>
                  <div class="text-h6">Add your favorite friend</div>
                  <div class="text-subtitle1">
                    Fill out the following form to friend information.
                  </div>
                </q-card-section>
                <q-separator inset />
                <q-card-section class="column q-gutter-md">
                  <q-input label="Name *" v-model="formState.name"></q-input>
                  <q-input label="Nickname *" v-model="formState.nickname">
                  </q-input>
                  <q-input label="Age *" type="number" v-model="formState.age">
                  </q-input>
                  <q-input
                    label="Email *"
                    v-model="formState.email"
                    :rules="[
                      (val) => validateEmail(val) || 'Must be a valid email.',
                    ]"
                  ></q-input>
                  <q-input
                    label="Phone *"
                    v-model="formState.phone"
                    :rules="[
                      (val) =>
                        val.length == 10 || 'Must be a valid phone number.',
                    ]"
                  ></q-input>
                </q-card-section>
                <q-card-actions align="right">
                  <q-btn flat @click="reset()">Cancel</q-btn>
                  <q-btn color="primary" type="submit">Add</q-btn>
                </q-card-actions>
              </q-form>
            </div>
          </div>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      title: "Add friend information in form",
      api: "http://localhost/account_sansai/api-account-sansai.php",
      formState: {
        name: "",
        nickname: "",
        age: "",
        email: "",
        phone: "",
      },
    };
  },
  methods: {
    validateEmail(email) {
      return /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/.test(email);
    },
    submitForm() {
      console.log("name: ", this.formState.name);
      console.log("nickname: ", this.formState.nickname);
      console.log("age: ", this.formState.age);
      console.log("email: ", this.formState.email);
      console.log("phone: ", this.formState.phone);
      axios
        .post(this.api, {
          action: "addfriend",
          name: this.formState.name,
          nickname: this.formState.nickname,
          age: this.formState.age,
          email: this.formState.email,
          phone: this.formState.phone,
        })
        .then((res) => {
          console.log("addfriend", res.data);
          alert("Add data successfully");
          this.formState.name = "";
          this.formState.nickname = "";
          this.formState.age = "";
          this.formState.email = "";
          this.formState.phone = "";
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    reset() {
      this.formState.name = "";
      this.formState.nickname = "";
      this.formState.age = "";
      this.formState.email = "";
      this.formState.phone = "";
    },
  },
};
</script>
