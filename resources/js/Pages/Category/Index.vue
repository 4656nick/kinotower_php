<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import DangerButton from "../../Components/DangerButton.vue";
import InputError from "../../Components/InputError.vue";
import { useForm } from "@inertiajs/inertia-vue3";
defineProps({
  categories: Array,
});
const showModalCreate = ref(false);
const showModalRemove = ref(false);
const editId = ref(0);

const form = useForm({
  name: null,
  category_id: null,
});

function submit() {
  if (editId.value) {
    form.patch(route("category.update", editId.value), {
      onSuccess: () => {
        closeForm();
      },
    });
  } else {
    form.post(route("category.create"), {
      onSuccess: () => {
        closeForm();
      },
    });
  }
}

function showDeleteForm(id) {
  showModalRemove.value = true;
  editId.value = id;
}

function deleteCategory() {
  form.delete(route("category.delete", editId.value), {
    onSuccess: () => {
      showModalRemove.value = false;
      closeForm();
    },
  });
}

const editForm = (category) => {
  form.name = category.name;
  form.category_id = category.category_id;
  showModalCreate.value = true;
  editId.value = category.id;
};

let closeForm = () => {
  form.reset();
  editId.value = 0;
  showModalCreate.value = false;
  form.clearErrors();
};
</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Список категорий
        </h2>
        <PrimaryButton @click="showModalCreate = true">Создать категорию</PrimaryButton>
        <Modal :show="showModalCreate">
          <div class="w-full max-w-xs mx-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Название категории
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Название"
                  v-model="form.name"
                />
                <InputError
                  v-if="form.errors.name"
                  :message="form.errors.name"
                ></InputError>
              </div>
              <div class="inline-block relative w-64 mb-5">
                <label for="">Выбрать подкатегорию</label>
                <select
                  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                  v-model="form.category_id"
                >
                  <option value="null">Нет</option>
                  <option
                    :value="category.id"
                    v-for="category in categories"
                    :key="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <InputError
                  v-if="form.errors.category_id"
                  :message="form.errors.category_id"
                ></InputError>
              </div>
              <div class="flex items-center justify-between">
                <PrimaryButton type="button" @click="submit" :disabled="form.processing">
                  Создать
                </PrimaryButton>
                <DangerButton @click="closeForm"> Отменить </DangerButton>
              </div>
            </form>
          </div>
        </Modal>
      </div>
    </template>

    <div class="py-12" v-if="categories.length > 0">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10 text-center">
          <div
            class="text-center lg:grid lg:grid-cols-4 md:grid md:grid-cols-4 sm:flex sm:justify-between font-bold"
          >
            <h1>Название</h1>
            <h1>Поджанр</h1>
            <h1>Изменить</h1>
            <h1>Удалить</h1>
          </div>
          <div
            class="bg-slate-600 text-white text-center xl:grid xl:grid-cols-4 lg:grid lg:grid-cols-4 md:grid md:grid-cols-4 sm:flex sm:justify-between mb-5 mt-3 text-lg"
            v-for="category in categories"
            :key="category.id"
          >
            <h1>{{ category.name }}</h1>
            <h1>
              {{
                category.parent_category == null
                  ? "Нет поджанра"
                  : category.parent_category.name
              }}
            </h1>
            <PrimaryButton @click="editForm(category)">Изменить</PrimaryButton>
            <PrimaryButton
              class="hover:cursor-pointer"
              @click="showDeleteForm(category.id)"
            >
              Удалить
            </PrimaryButton>
            <Modal :show="showModalRemove">
              <div class="mx-auto p-20">
                <div class="shadow-lg p-10">
                  <h1 class="text-3xl">
                    Вы действительно хотите удалить данную категорию?
                  </h1>
                  <div class="flex items-center justify-around mt-10 p-10">
                    <PrimaryButton @click="deleteCategory()">Да</PrimaryButton>
                    <DangerButton @click="showModalRemove = false">Нет</DangerButton>
                  </div>
                </div>
              </div>
            </Modal>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="mx-auto text-center mt-10 text-2xl font-sans shadow-2xl">
      <p>В данный момент категорий в нашей базе данных нет!</p>
      <p>Создайте новую категорию, нажав на кнопку "СОЗДАТЬ КАТЕГОРИЮ"</p>
    </div>
  </AppLayout>
</template>
