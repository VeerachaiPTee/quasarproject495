<template>
  <q-layout view="hHh Lpr lFf">
    <q-page-container class="bg-grey-2">
      <div @keyup="nextItem">
        <q-page
          padding
          class="row items-center justify-center"
          style="background: linear-gradient(#9dddf2, #0cb9f2)"
        >
          <div class="row full-width">
            <div class="col-md-8 offset-md-2 col-xs-12 q-pa-xs">
              <q-card flat class="bg-white text-black">
                <q-card-section class="bg-blue-14">
                  <h4 class="text-h5 text-white q-my-xs text-center">
                    {{ title }}
                  </h4>
                </q-card-section>
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
                        <div class="text-h6">Create New Account</div>
                        <div class="text-subtitle1">
                          Fill out the following form to create your new
                          account.
                        </div>
                      </q-card-section>
                      <q-separator inset />
                      <q-card-section class="column q-gutter-md">
                        <q-input
                          label="Username *"
                          v-model="formState.username"
                          :rules="[
                            (val) =>
                              (val && val.length > 0) ||
                              'Username must be filled in.',
                          ]"
                        ></q-input>
                        <q-input
                          label="Password *"
                          type="password"
                          v-model="formState.password.value"
                          :rules="[
                            (val) =>
                              validatePassword(val) ||
                              'Password must meet all criteria.',
                          ]"
                        >
                        </q-input>
                        <q-input
                          label="Confirm Password *"
                          type="password"
                          v-model="formState.password.confirm"
                          :disable="!validatePassword(formState.password.value)"
                          :rules="[
                            (val) =>
                              (val && val === formState.password.value) ||
                              'Must match password.',
                          ]"
                        >
                        </q-input>
                        <q-input
                          label="Email *"
                          v-model="formState.email"
                          :rules="[
                            (val) =>
                              validateEmail(val) || 'Must be a valid email.',
                          ]"
                        ></q-input>
                      </q-card-section>
                      <q-card-actions align="right">
                        <q-btn flat>Cancel</q-btn>
                        <q-btn color="primary" type="submit"
                          >Create Account</q-btn
                        >
                      </q-card-actions>
                    </q-form>
                  </div>
                </div>
              </q-card>
            </div>
          </div>
        </q-page>
      </div>
    </q-page-container>
  </q-layout>
</template>
<script>
import axios from "axios";

export default {
  components: {},
  data() {
    return {
      title: "Sign up Sansai Wittayakhom member",
      url_api_account: "http://localhost/account_sansai/api-account-sansai.php",
      formState: {
        username: "",
        email: "",
        password: {
          value: "",
          confirm: "",
        },
      },
    };
  },
  methods: {
    validateEmail(email) {
      return /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/.test(email);
    },
    validatePassword(password) {
      // Test length
      var length = password.length >= 8;

      // Test capital
      var capital = /^(?=.*[A-Za-z]).*$/.test(password);

      // Test number
      var number = /^(?=.*[0-9]).*$/.test(password);

      // Test symbol
      var symbol = /^(?=.*[!@#$%^&*-_+=]).*$/.test(password);

      return length && capital && number && symbol;
    },
    submitForm() {
      console.log("username: ", this.formState.username);
      console.log("password.value: ", this.formState.password.value);
      console.log("password.confirm: ", this.formState.password.confirm);
      console.log("email: ", this.formState.email);
      axios
        .post(this.url_api_account, {
          action: "insert",
          username: this.formState.username,
          password: this.formState.password.value,
          email: this.formState.email,
        })
        .then((res) => {
          console.log("insert", res.data);
          this.$router.push('/');
          alert("Sign up success!!");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
  mounted() {},
};
</script>
