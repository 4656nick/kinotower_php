<script setup>
import Modal from "@/Components/Modal.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import DangerButton from "../../Components/DangerButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import InputError from "../../Components/InputError.vue";
defineProps({
  films: Array,
  countries: Array,
});
const showModalCreate = ref(false);
const showModalRemove = ref(false);

const editId = ref(0);

const form = useForm({
  name: null,
  country_id: null,
  duration: null,
  year_of_issue: null,
  age: null,
  link_img: null,
  link_kinopoisk: null,
  link_video: null,
});
function submit() {
  if (editId.value) {
    form.patch(route("film.update", editId.value), {
      onSuccess: () => {
        closeForm();
      },
    });
  } else {
    form.post(route("film.create"), {
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
  form.delete(route("film.delete", editId.value), {
    onSuccess: () => {
      showModalRemove.value = false;
      closeForm();
    },
  });
}

const editForm = (film) => {
  form.name = film.name;
  form.country_id = film.country_id;
  form.duration = film.duration;
  form.year_of_issue = film.year_of_issue;
  form.age = film.age;
  form.link_img = film.link_img;
  form.link_kinopoisk = film.link_kinopoisk;
  form.link_video = film.link_video;
  showModalCreate.value = true;
  editId.value = film.id;
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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список фильмов</h2>
        <PrimaryButton @click="showModalCreate = true">Создать фильм</PrimaryButton>
        <Modal :show="showModalCreate">
          <div class="w-full max-w-xs mx-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Название фильма
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
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Длительность (в мин.)
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Количество минут"
                  v-model="form.duration"
                />
                <InputError
                  v-if="form.errors.duration"
                  :message="form.errors.duration"
                ></InputError>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Год производства
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Год"
                  v-model="form.year_of_issue"
                />
                <InputError
                  v-if="form.errors.year_of_issue"
                  :message="form.errors.year_of_issue"
                ></InputError>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"> Страна </label>
                <select
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  v-model="form.country_id"
                >
                  <option
                    :value="country.id"
                    v-for="country in countries"
                    :key="country.id"
                  >
                    {{ country.name }}
                  </option>
                  <InputError
                    v-if="form.errors.country_id"
                    :message="form.errors.country_id"
                  ></InputError>
                </select>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Возрастное ограничение
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Число"
                  v-model="form.age"
                />
                <InputError
                  v-if="form.errors.age"
                  :message="form.errors.age"
                ></InputError>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Кинопоиск
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Ссылка"
                  v-model="form.link_kinopoisk"
                />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"> Постер </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Ссылка"
                  v-model="form.link_img"
                />
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                  Трейлер
                </label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                  placeholder="Ссылка"
                  v-model="form.link_video"
                />
              </div>
              <div class="flex items-center justify-between">
                <PrimaryButton type="button" @click="submit()"> Сохранить </PrimaryButton>
                <DangerButton @click="closeForm"> Отменить </DangerButton>
              </div>
            </form>
          </div>
        </Modal>
      </div>
    </template>
    <div v-if="films.length > 0">
      <div
        class="container bg-white shadow-lg mt-10 p-10 grid mx-auto grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3"
      >
        <div
          class="rounded mx-auto overflow-hidden shadow-2xl mb-10 bg-white"
          style="max-width: 350px"
          v-for="film in films"
          :key="film.id"
        >
          <img :src="film.link_img" alt="film" style="max-height: 450px; width: 100%" />
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-6 text-center">
              {{ film.name.trim() }}
            </div>
            <div class="grid grid-cols-2">
              <p class="text-gray-500 text-xs">Продолжительность</p>
              <p class="text-right">{{ film.duration }}</p>
              <p class="text-gray-500 text-xs">Год выхода</p>
              <p class="text-right">{{ film.year_of_issue }}</p>
              <p class="text-gray-500 text-xs">Страна</p>
              <p class="text-right">{{ film.country.name }}</p>
              <p class="text-gray-500 text-xs">Возраст</p>
              <p class="text-right">{{ film.age }}+</p>
              <a :href="film.link_video" class="text-lg">Трейлер</a>
              <a :href="film.link_kinopoisk" class="text-lg text-right">Кинопоиск</a>
            </div>
          </div>
          <!-- <div class="px-6 pt-4 pb-2">
            <span
              class="inline-block bg-black text-white rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2"
              >#Жанр</span
            >
          </div> -->
          <div class="mb-3 mx-10 flex justify-around">
            <PrimaryButton @click="editForm(film)">Изменить</PrimaryButton>
            <danger-button @click="showDeleteForm(film.id)">Удалить</danger-button>
            <Modal :show="showModalRemove">
              <div class="mx-auto p-20">
                <div class="shadow-lg p-10">
                  <h1 class="text-3xl text-center">
                    Вы действительно хотите удалить данный фильм?
                  </h1>
                  <div class="flex items-center justify-around mt-10 p-10">
                    <PrimaryButton @click="deleteCategory">Да</PrimaryButton>
                    <DangerButton @click="showModalRemove = false">Нет</DangerButton>
                  </div>
                </div>
              </div>
            </Modal>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
