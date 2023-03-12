<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
defineProps({
  reviews: Array,
});
const showModal = ref(false);
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список рецензий</h2>
    </template>

    <div class="py-12" v-if="reviews.length > 0">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
          <div
            class="xl:grid xl:grid-cols-3 lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:flex sm:justify-between font-bold"
          >
            <h1>Текст</h1>
            <h1>Фильм</h1>
            <h1>Пользователь</h1>
          </div>
          <div
            class="text-white p-5 border-1 border bg-slate-500 xl:grid xl:grid-cols-3 lg:grid lg:grid-cols-3 md:grid md:grid-cols-3 sm:flex sm:justify-between mb-5 mt-3 text-lg"
            v-for="review in reviews"
            :key="review.id"
          >
            <h1>"{{ review.message }}"</h1>
            <h1>{{ review.film.name }}</h1>
            <h1>{{ review.user.name }}</h1>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
