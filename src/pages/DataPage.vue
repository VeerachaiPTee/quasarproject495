<template>
  <div class="q-pa-md text-center">
    <q-table :rows="rows" :columns="columns" row-key="name">
      <template v-slot:body-cell-actions="props">
        <q-btn color="negative" @click="deleteRow(props.row.name)"
          >Delete</q-btn
        >
      </template>
    </q-table>
  </div>
</template>

<script>
import axios from "axios";

const columns = [
  {
    name: "name",
    field: "name",
    label: "name",
    align: "center",
  },
  {
    name: "nickname",
    field: "nickname",
    label: "nickname",
    align: "center",
  },
  {
    name: "age",
    field: "age",
    label: "age",
    align: "center",
  },
  {
    name: "email",
    field: "email",
    label: "email",
    align: "center",
  },
  {
    name: "phone",
    field: "phone",
    label: "phone",
    align: "center",
  },
  {
    name: "actions",
    label: "Delete",
    align: "center",
    field: "actions",
  },
];
export default {
  data() {
    return {
      api: "http://localhost/account_sansai/api-account-sansai.php",
      columns,
      rows: [],
      i: 0,
    };
  },
  methods: {
    showData() {
      axios
        .post(this.api, {
          action: "selectfriend",
          f_id: this.i
        })
        .then((res) => {
          this.rows = res.data;
          console.log(res.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    deleteRow(name) {
      axios
        .post(this.api, {
          action: "delete",
        })
        .then((res) => {
          console.log(res);
          this.rows = this.rows.filter((row) => row.name !== name);
        });
    },
  },
  mounted() {
    this.showData();
  },
};
</script>

<style></style>
