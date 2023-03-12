<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import DangerButton from "../../Components/DangerButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
defineProps({
  users: Array,
});
const showModal = ref(false);
const removeId = ref(0);

const form = useForm({});

function getDate(date) {
  date = new Date(date);
  return date.toLocaleString();
}

function deleteUser(id) {
  showModal.value = true;
  removeId.value = id;
}

function remove() {
  form.delete(route("user.delete", removeId.value), {
    onSuccess: () => {
      showModal.value = false;
    },
  });
}

function getAVG(arr) {
  let newArr = [];
  arr.forEach((element) => {
    newArr.push(element.ball);
  });
  let sum = newArr.reduce((sum, element) => sum + element, 0);
  let avg = sum / newArr.length || 0;
  return avg.toFixed(1);
}
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Список пользователей
        </h2>
      </div>
    </template>
    <div
      v-if="users.length > 0"
      class="container bg-white shadow-lg mt-10 p-10 grid mx-auto grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-3"
    >
      <div
        class="rounded mx-auto overflow-hidden shadow-2xl mb-10 bg-white text-black"
        style="max-width: 500px"
        v-for="user in users"
        :key="user.id"
      >
        <div class="px-6 py-4 mb-5">
          <h1 class="text-center mb-4">{{ user.name }}</h1>
          <div class="grid grid-cols-2 text-sm">
            <p>День рождения</p>
            <p>{{ user.birthday == null ? "Нет" : user.birthday }}</p>
            <p>Пол</p>
            <p>
              {{ user.gender == null ? "Нет" : user.gender.name }}
            </p>
            <p>Email</p>
            <p>{{ user.email }}</p>
          </div>
        </div>
        <div class="flex items-center justify-around mb-3">
          <danger-button @click="deleteUser(user.id)">Удалить</danger-button>
          <Modal :show="showModal">
            <div class="mx-auto p-20">
              <div class="shadow-2xl p-10">
                <h1 class="text-3xl text-center">
                  Вы действительно хотите удалить данного пользователя?
                </h1>
                <div class="flex items-center justify-around mt-10 p-10">
                  <PrimaryButton @click="remove">Да</PrimaryButton>
                  <DangerButton @click="showModal = false">Нет</DangerButton>
                </div>
              </div>
            </div>
          </Modal>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped></style>
