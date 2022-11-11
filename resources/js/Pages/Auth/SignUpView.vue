<template>
    <Navigation :user="$page.props.auth.user">
        <main>
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Регистрация</h1>
                </div>
            </header>
            <main>
                <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                    <div class="w-full max-w-lg space-y-8">
                        <div>
                            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Зарегистрируйте
                                аккаунт</h2>
                            <p class="mt-2 text-center text-sm text-gray-600">
                                Или
                                <Link :href="route('login')" class="font-medium text-blue-600 hover:text-blue-500">
                                    войдите, если он уже есть
                                </Link>
                            </p>
                        </div>
                        <form class="mt-8 space-y-6" @submit.prevent="submit">
                            <input type="hidden" name="remember" value="true">
                            <div class="-space-y-px rounded-md shadow-sm">
                                <div>
                                    <label for="email" class="sr-only">Email address</label>
                                    <input id="email" v-model="form.email" name="email" type="email" required
                                           class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Адрес электронной почты (example@gmail.com)">
                                </div>
                                <div v-if="$page.props.errors.email">{{ $page.props.errors.email }}</div>
                                <div>
                                    <label for="username" class="sr-only">Email address</label>
                                    <input id="username" name="username" v-model="form.username" type="text" required
                                           class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Никнейм (ilyavasiliev22)">
                                </div>
                                <div v-if="$page.props.errors.username">{{ $page.props.errors.username }}</div>
                                <div>
                                    <label for="firstName" class="sr-only">First Name</label>
                                    <input id="firstName" name="username" v-model="form.firstName" type="text" required
                                           class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Имя (Илья)">
                                </div>
                                <div v-if="$page.props.errors.firstName">{{ $page.props.errors.firstName }}</div>
                                <div>
                                    <label for="lastName" class="sr-only">Last Name</label>
                                    <input id="lastName" name="lastName" v-model="form.lastName" type="text" required
                                           class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Фамилия (Васильев)">
                                </div>
                                <div v-if="$page.props.errors.lastName">{{ $page.props.errors.lastName }}</div>
                                <div>
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" name="password" v-model="form.password" type="password"
                                           required
                                           class="relative block w-full appearance-none rounded-none border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Пароль (qwerty)">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="sr-only">Password</label>
                                    <input id="password_confirmation" name="password_confirmation"
                                           v-model="form.password_confirmation" type="password" required
                                           class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                                           placeholder="Повторите пароль (qwerty)">
                                </div>
                                <div v-if="$page.props.errors.password_confirmation">{{ $page.props.errors.password_confirmation }}</div>
                            </div>

                            <div class="flex">
                                <div class="flex items-center mr-4">
                                    <input checked id="inline-checked-radio" type="radio" v-model="form.accountType"
                                           value="1" name="accountType"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2  dark:border-gray-300">
                                    <label for="inline-checked-radio"
                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-900">Я
                                        исполнитель</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="inline-2-radio" type="radio" v-model="form.accountType" value="2"
                                           name="accountType"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-300">
                                    <label for="inline-2-radio"
                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-900">Я
                                        заказчик</label>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="rules" v-model="form.isRulesChecked" name="rules" type="checkbox"
                                           class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label for="rules" class="ml-2 block text-sm font-medium text-gray-900">
                                        Согласен(-а) на обработку персональных данных и правилами сайта
                                    </label>
                                </div>
                            </div>

                            <div>
                                <button :disabled="!form.isRulesChecked" type="submit"
                                        class="group relative flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white"
                                        :class="{'opacity-50': !form.isRulesChecked, 'hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2': form.isRulesChecked}">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <svg class="h-5 w-5 text-blue-500" :class="{'group-hover:text-blue-400': form.isRulesChecked}"
                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                          clip-rule="evenodd"/>
                  </svg>
                </span>
                                    Зарегистрироваться
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </main>
    </Navigation>
</template>

<script setup>
import NProgress from "nprogress";
import {useForm} from "@inertiajs/inertia-vue3";
import Navigation from "@/Layouts/Navigation.vue";
import {Link} from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    username: '',
    firstName: '',
    lastName: '',
    password: '',
    password_confirmation: '',
    accountType: 1,
    isRulesChecked: false,

});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}
NProgress.done()

</script>
