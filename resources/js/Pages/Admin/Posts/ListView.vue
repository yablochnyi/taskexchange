<script setup>
import AdminMenu from '@/components/AdminMenu.vue'
import Navigation from "@/Layouts/Navigation.vue";
</script>
<template>
    <Navigation :user="$page.props.auth.user">
  <main>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Управление публикациями</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <AdminMenu />
        <div class="flex">
          <Link :href="route('posts.create')" class="bg-green-200 mb-3 text-green-700 w-full font-medium py-3 px-2 rounded-lg shadow hover:bg-green-300 transition duration-300 grid place-content-center">
            Добавить
          </Link>
        </div>
        <div class="flex">
          <Link :href="route('categories.index')" class="bg-blue-200 mb-3 text-blue-700 w-full font-medium py-2 px-2 rounded-lg shadow hover:bg-blue-300 transition duration-300 grid place-content-center">
            Управление категориями
          </Link>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="py-3 px-6">
                ID
              </th>
              <th scope="col" class="py-3 px-6">
                Автор
              </th>
              <th scope="col" class="py-3 px-6 text-center">
                Изображение
              </th>
              <th scope="col" class="py-3 px-6">
                Заголовок
              </th>
              <th scope="col" class="py-3 px-6">
                Категории
              </th>
              <th scope="col" class="py-3 px-6">
                Действия
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in $props.postsResource.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="py-4 px-6">
                {{ post.id }}
              </td>
              <td class="py-4 px-6">
                {{ post.author.first_name }} {{ post.author.last_name }}
              </td>
              <td class="py-4 px-6">
                <a :href="post.image" target="_blank">
                  <img :src="post.image" class="h-14 w-14 mx-auto rounded shadow-lg">
                </a>
              </td>
              <td v-if="!post.deleted_at" class="py-4 px-6 font-medium">
                {{ post.title }}
              </td>
              <td v-else class="py-4 px-6 font-medium text-slate-400">
                {{ post.title }}<br>(архив)
              </td>
              <td class="py-4 px-6 font-medium">
                <span class="ml-1" v-for="category in post.category">
                  {{ category.title }}<br>
                </span>
              </td>
              <td class="py-4 px-6">
                <Link :href="route('posts.edit', post.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Редактировать</Link><br>
                <button @click="destroy(post.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Удалить</button>
<!--                <button v-else @click="deletePost(post.id)" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Восстановить</button>-->
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </main>
    </Navigation>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
    props: {
        postsResource: Object
    },
  mounted() {
    document.title = 'Управление публикациями'
  },
  methods: {
      destroy(id) {
          this.$inertia.delete(this.route('posts.destroy', id))
      },

  }
}
</script>
