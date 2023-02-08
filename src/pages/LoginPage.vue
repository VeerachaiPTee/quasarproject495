<template>
  <q-layout>
    <q-page-container>
      <q-page class="flex flex-center">
        <div class="row items-center">
          <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-center q-pa-sm">
            <a href="/">
              <img
                src="~assets\1a.png"
                alt=""
                style="width: 200px; height: 200px"
              />
            </a>
          </div>
          <div class="col-12 col-sm-12 col-md-8 col-lg-8 q-pa-sm">
            <div class="column items-center">
              <q-form autofocus style="width: 400px" class="">
                <q-card-section>
                  <div class="text-h4 text-center">Login</div>
                </q-card-section>
                <q-card-section class="column q-gutter-md">
                  <div class="">Username</div>
                  <q-input
                    class="full-width"
                    label="Username *"
                    rounded
                    outlined
                    v-model="formState.username"
                    :rules="[
                      (val) =>
                        (val && val.length > 0) ||
                        'username must be filled in.',
                    ]"
                  ></q-input>
                  <div class="">Password</div>
                  <q-input
                    class="full-width"
                    label="Password *"
                    type="password"
                    rounded
                    outlined
                    v-model="formState.password"
                    :rules="[
                      (val) => (val && val.length > 0) || 'Wrong password.',
                    ]"
                  >
                  </q-input>
                </q-card-section>
                <q-card-actions align="center">
                  <q-btn
                    unelevated
                    rounded
                    style="width: 200px"
                    color="primary"
                    type="submit"
                    @click="login()"
                    >Login</q-btn
                  >
                </q-card-actions>
                <q-card-actions align="center">
                  <div class="">
                    <q-btn
                      flat
                      rounded
                      color="primary"
                      label="Don't have an account yet ? Click here."
                      icon-right="send"
                      @click="register()"
                    />
                  </div>
                </q-card-actions>
              </q-form>
            </div>
          </div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      api_url: "http://localhost/account_sansai/api-account-sansai.php",
      formState: {
        username: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      axios
        .post(this.api_url, {
          action: "select",
          username: this.formState.username,
          password: this.formState.password,
        })
        .then((res) => {
          if (res.data.length > 0) {
            this.$router.replace('/mainlayout')
            alert("Successfully LoggedIn !")
          } else {
            alert("Wrong username or password")
          }
        });
    },
    register() {
      this.$router.push("/registerpage");
    },
  },
};
</script>

<style></style>
