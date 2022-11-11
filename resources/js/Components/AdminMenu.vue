<template>
  <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 mb-7 gap-2 mx-3 md:mx-0">
    <div class="flex text-center">
      <Link :href="route('ap')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap'}">
        Статистика
      </Link>
    </div>
    <div class="flex text-center">
      <Link :href="route('users.index')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap/users', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap/users'}">
        Пользователи
        <p class="text-xs text-blue-500 -mt-1">управление</p>
      </Link>
    </div>
    <div class="flex text-center">
      <Link :href="route('options.index')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap/options', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap/options'}">
        Категории и опции
        <p class="text-xs text-blue-500 -mt-1">управление</p>
      </Link>
    </div>
    <div class="flex text-center">
      <Link :href="route('tasks.index')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap/tasks', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap/tasks'}">
        Задачи
        <p class="text-xs text-blue-500 -mt-1">управление</p>
      </Link>
    </div>
    <div class="flex text-center">
      <Link :href="route('orders.index')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap/orders', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap/orders'}">
        Заказы
        <p class="text-xs text-blue-500 -mt-1">управление</p>
      </Link>
    </div>
    <div class="flex text-center">
      <Link :href="route('posts.index')" class="w-full font-medium py-3 px-2 rounded-lg" :class="{'text-slate-700 bg-slate-200': $page.url === '/ap/posts', 'shadow bg-blue-200 text-blue-700 hover:bg-blue-300 hover:shadow-lg transition duration-300': $page.url !== '/ap/posts'}">
        Публикации
        <p class="text-xs text-blue-500 -mt-1">управление</p>
      </Link>
    </div>
  </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    }
}
</script>
