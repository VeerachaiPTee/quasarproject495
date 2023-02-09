<template>
  <q-layout view="hHh lpr lFf">
    <q-header elevated >
      <q-toolbar class="glossy bg-blue-grey-10 text-black">
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
          color="blue-grey-1"
        />

        <q-toolbar-title class="text-h4 text-weight-medium text-blue-grey-1"> Memory in school </q-toolbar-title>

        <div class="q-pa-sm">
          <q-btn round color="primary">
            <q-avatar size="42px">
              <img src="https://cdn.quasar.dev/img/avatar2.jpg" />
            </q-avatar>
            <q-menu transition-show="flip-right" transition-hide="flip-left">
              <q-list style="min-width: 100px">
                <q-item clickable>
                  <q-item-section @click="logout()">Logout</q-item-section>
                </q-item>
                <q-separator />
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered class="bg-brown-2">
      <q-list>
        <q-item-label header class="text-h6 text-center"> Menu </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";
import EssentialLink from "components/EssentialLink.vue";

const linksList = [
  {
    title: "Add friend name",
    caption: "Friend name in the shcool",
    icon: "school",
    link: "/friendpage",
  },
  {
    title: "Show friend list",
    caption: "All infomation of friend",
    icon: "book",
    link: "/datapage",
  },
];

export default defineComponent({
  name: "MainLayout",

  components: {
    EssentialLink,
  },
  methods: {
    logout() {
      this.$router.replace('/')
    }
  },

  setup() {
    const leftDrawerOpen = ref(false);

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
});
</script>
