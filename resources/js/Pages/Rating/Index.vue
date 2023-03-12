<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
defineProps({
  ratings: Array,
});
const showModal = ref(false);
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список оценок</h2>
    </template>

    <div class="py-12" v-if="ratings.length > 0">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
          <div
            class="xl:grid xl:grid-cols-3 lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:flex sm:justify-between font-bold"
          >
            <h1>Балл</h1>
            <h1>Фильм</h1>
            <h1>Пользователь</h1>
          </div>
          <div
            class="text-white p-5 border-1 border bg-slate-500 xl:grid xl:grid-cols-3 lg:grid lg:grid-cols-4 md:grid md:grid-cols-3 sm:flex sm:justify-between mb-5 mt-3 text-lg"
            v-for="rating in ratings"
            :key="rating.id"
          >
            <h1>{{ rating.ball }}</h1>
            <h1>{{ rating.film.name }}</h1>
            <h1>{{ rating.user.name }}</h1>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="mx-auto text-center mt-10 text-2xl font-sans shadow-2xl p-10">
      <p>В данный момент оценок в нашей базе данных нет!</p>
    </div>
  </AppLayout>
  <Modal :show="showModal"></Modal>
</template>

<style scoped>
.task-card {
  color: white;
  padding: 20px 0px;
  background-color: rgb(36, 36, 53);
  border-radius: 20px;
  margin-bottom: 40px;
  box-shadow: 24px 12px 18px 0px rgb(96, 96, 96);
  transition: 0.5s;
}
</style>
