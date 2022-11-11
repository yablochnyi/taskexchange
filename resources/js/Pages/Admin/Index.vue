<script setup>
import AdminMenu from '@/components/AdminMenu.vue'
import Navigation from "@/Layouts/Navigation.vue";
</script>
<template>
    <Navigation :user="$page.props.auth.user">
  <main>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Панель управления</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <AdminMenu />
        <div class="overflow-x-auto relative mx-3 md:mx-0">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <tbody>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Количество пользователей
                </th>
                <td class="py-4 px-6">
                  {{ $props.info.users }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Количество исполнителей
                </th>
                <td class="py-4 px-6">
                  {{ $props.info.performer }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Количество заказчиков
                </th>
                <td class="py-4 px-6">
                  {{ $props.info.customer }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Средств на балансе пользователей
                </th>
                <td class="py-4 px-6">
                  {{ $props.info.userAllBalance }} руб.
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                </th>
                <td class="py-4 px-6">

                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Активных задач на бирже
                </th>
                <td class="py-4 px-6">
                    {{ $props.info.tasks }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Активных заказов
                </th>
                <td class="py-4 px-6">
                    {{ $props.info.orders }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Выполненных заказов
                </th>
                <td class="py-4 px-6">
                    {{ $props.info.ordersWin }}
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                </th>
                <td class="py-4 px-6">

                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Выполнено заказов на сумму в общем
                </th>
                <td class="py-4 px-6">
<!--                  {{ $filters.currencyFormat(statistics.completed_orders_price) }}-->
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Выполнено заказов на сумму за сегодня
                </th>
                <td class="py-4 px-6">
<!--                  {{ $filters.currencyFormat(statistics.completed_orders_today_price) }}-->
                </td>
              </tr>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  Выполнено заказов на сумму за этот месяц
                </th>
                <td class="py-4 px-6">
<!--                  {{ $filters.currencyFormat(statistics.completed_orders_current_month_price) }}-->
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
export default {
  props: {
      info: Object
  },
  mounted() {
    document.title = 'Панель управления'
  },
}
</script>
