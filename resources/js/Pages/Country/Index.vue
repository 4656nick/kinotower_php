<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
defineProps({
  countries: Array,
});
const showModal = ref(false);
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список стран</h2>
    </template>

    <div class="py-12" v-if="countries.length > 0">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
          <ol
            class="text-white p-5 border-1 border bg-slate-500 mx-auto"
            v-for="country in countries"
            :key="country.id"
          >
            <li class="text-xl">
              {{ country.name }}
            </li>
          </ol>
        </div>
      </div>
    </div>
  </AppLayout>
  <Modal :show="showModal"></Modal>
</template>
