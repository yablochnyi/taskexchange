<script setup>
// import NotificationsPopup from "@/Components/NotificationsPopup.vue";

</script>

<template>
    <div class="min-h-full">
        <div v-if="$page.props.flash.message" class="absolute top-8 right-10 z-10">
            <NotificationBox :message="$page.props.flash.message"/>
        </div>


        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                 alt="Tasks Exchange">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <Link v-for="elem in topMenu" :href="route(elem.to)"
                                      class="rounded-md text-sm font-semibold px-3 py-2 transition duration-300"
                                      :class="{'bg-gray-900 text-white': $page.url === elem.active, 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== elem.active}">
                                    {{ elem.title }}
                                </Link>
                                <Link v-if="$page.props.auth.user" :href="route('task')"
                                      class="rounded-md text-sm font-semibold px-3 py-2 transition duration-300"
                                      :class="{'bg-gray-900 text-white': $page.url === '/tasks', 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== '/tasks'}">
                                    Биржа
                                </Link>
                                <Link v-if="$page.props.auth.user" :href="route('messages')"
                                      class="rounded-md text-sm font-semibold px-3 py-2 transition duration-300"
                                      :class="{'bg-gray-900 text-white': $page.url === '/messages', 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== '/messages'}">
                                    Сообщения
                                    <span class="bg-slate-700 ml-1 rounded-full px-2 py-1 font-medium text-slate-200">
                    {{ unViewedMessagesCount }}
                  </span>
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <button v-if="$page.props.auth.user" @click="toggleNotifications" type="button"
                                    class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-notifications-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" id="user-notifications-svg"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                     aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                                </svg>
                                <div class="absolute ml-4 -mt-2 bg-slate-700 rounded-full px-1 text-sm text-slate-200">
                                    {{ events.length }}
                                </div>
                            </button>

<!--                            <NotificationsPopup-->
<!--                                v-if="$page.props.auth.user"-->
<!--                                :show-notifications="showNotifications"-->
<!--                                :events="events" is-mobile="false"-->
<!--                                @closePopup="showNotifications = false"-->
<!--                                @updateEvents="getNewEvents"/>-->

                            <div class="relative ml-3">
                                <div>
                                    <button @click="toggleProfileMenu" type="button"
                                            class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="@/assets/img/user.png" alt="User">
                                    </button>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <div v-if="showProfileMenu"
                                         class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                         role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                         tabindex="-1">
                                        <div v-if="$page.props.auth.user"
                                             class="text-sm text-gray-700 px-4 py-2 font-semibold border-b-2 border-gray-200">
                                            {{ user.first_name }} {{ user.last_name }}
                                            <br>
                                            <div v-if="user.type !== 3" class="text-gray-500">
                                                <div>{{ $page.props.auth.user.balance }}</div>
                                                <div class="flex">
                                                    <Link :to="{ name: 'payments' }" @click="showProfileMenu = false"
                                                          class="bg-indigo-600 text-white text-center rounded-lg mt-1 py-1 w-full shadow-lg">
                                                        Финансы
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                        <Link v-for="elem in profileMenu" :href="route(elem.to)"
                                              @click="showProfileMenu = false"
                                              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 font-semibold transition duration-300"
                                              role="menuitem" tabindex="-1" id="user-menu-item-0">{{ elem.title }}
                                        </Link>
                                        <Link href="/logout" method="post" v-if="$page.props.auth.user"
                                           class="block px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition duration-300"
                                           role="menuitem" tabindex="-1" id="user-menu-item-0">Выйти</Link>
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button" @click="showMobileMenu = !showMobileMenu"
                                class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" :class="{'hidden': showMobileMenu, 'block': !showMobileMenu}"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                            <svg class="h-6 w-6" :class="{'hidden': !showMobileMenu, 'block': showMobileMenu}"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <div v-if="showMobileMenu" class="md:hidden" id="mobile-menu">
                    <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                        <Link v-for="elem in topMenu" :href="route(elem.to)" @click="showMobileMenu = false"
                              class="block px-3 py-2 rounded-md text-base font-semibold"
                              :class="{'bg-gray-900 text-white': $page.url === elem.active, 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== elem.active}">
                            {{ elem.title }}
                        </Link>
                        <Link v-if="$page.props.auth.user" :href="route('task')" @click="showMobileMenu = false"
                              class="block px-3 py-2 rounded-md text-base font-semibold"
                              :class="{'bg-gray-900 text-white': $page.url === '/tasks', 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== '/tasks'}">
                            Биржа
                        </Link>
                        <Link v-if="$page.props.auth.user" :href="route('messages')" @click="showMobileMenu = false"
                              class="block px-3 py-2 rounded-md text-base font-semibold"
                              :class="{'bg-gray-900 text-white': $page.url === '/messages', 'text-gray-300 hover:bg-gray-700 hover:text-white': $page.url !== '/messages'}">
                            Сообщения
                            <span class="bg-slate-700 ml-1 rounded-full px-2 py-1 font-medium text-slate-200">
                {{ unViewedMessagesCount }}
              </span>
                        </Link>
                    </div>
                    <div class="border-t border-gray-700 pt-4 pb-3">
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="@/assets/img/user.png" alt="User">
                            </div>
                            <div v-if="$page.props.auth.user" class="ml-3">
                                <div class="text-base font-semibold leading-none text-white">{{ $page.props.auth.user.first_name }}
                                    {{ $page.props.auth.user.last_name }}
                                </div>
                                <div v-if="$page.props.auth.user.role_id !== 3"
                                     class="text-sm mt-1 font-semibold leading-none text-gray-400">
                                    {{ $page.props.auth.user.balance }}
                                    <div class="flex mt-1">
                                        <Link :to="{ name: 'payments' }" @click="showMobileMenu = false"
                                              class="bg-indigo-600 text-white text-center rounded-lg mt-1 py-1 w-full shadow-lg">
                                            Финансы
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            <button v-if="$page.props.auth.user" @click="toggleNotifications" type="button"
                                    class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                                </svg>
                            </button>
<!--                            <NotificationsPopup-->
<!--                                v-if="$page.props.auth.user"-->
<!--                                :show-notifications="showNotifications"-->
<!--                                :events="events"-->
<!--                                is-mobile="true"-->
<!--                                @closePopup="showNotifications = false"-->
<!--&lt;!&ndash;                                @updateEvents="getNewEvents"&ndash;&gt;-->
<!--                            />-->
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            <Link v-for="elem in profileMenu" :href="route(elem.to)" @click="showMobileMenu = false"
                                  class="block rounded-md px-3 py-2 text-base font-semibold text-gray-400 hover:bg-gray-700 hover:text-white">
                                {{ elem.title }}
                            </Link>
                            <a href="#" v-if="$page.props.auth.user" @click="logout"
                               class="block rounded-md px-3 py-2 text-base font-semibold text-gray-400 hover:bg-gray-700 hover:text-white">Выйти</a>
                        </div>
                    </div>
                </div>
            </transition>
        </nav>
        <slot/>
        <div class="mx-auto max-w-7xl text-center text-sm text-gray-500 border-t-2 py-7">
            &copy; 2022, Биржа работ. Все права защищены.
        </div>
    </div>
</template>

<script>
// import {emitter} from "@/emitter";
import {Link} from '@inertiajs/inertia-vue3';
import NotificationBox from "@/Components/NotificationBox.vue";

export default {
    name: "Navigation",
    props: {
        user: Object
    },
    components: {Link, NotificationBox},
    data() {
        return {
            topMenu: [
                {'to': 'home', 'active': '/', 'title': 'Главная'},
                {'to': 'posts', 'active': '/post','title': 'Новости'},
            ],
            alerts: [],
            alertTimers: [],
            showMobileMenu: false,
            showProfileMenu: false,
            showNotifications: false,
            // e: emitter,
            unViewedMessagesCount: 0,
            events: []
        }
    },
    computed: {
        profileMenu() {
            if (this.$props.user === null) {
                return [
                    {'to': 'login', 'title': 'Войти'},
                    {'to': 'register', 'title': 'Зарегистрироваться'},
                ]
            } else if (this.$props.user.role_id === 1) {
                return [
                    {'to': 'cabinet', 'title': 'Кабинет исполнителя'},
                    {'to': 'orders.performer', 'title': 'Мои задачи'},
                ]
            } else if (this.$props.user.role_id === 2) {
                return [
                    {'to': 'cabinet', 'title': 'Кабинет заказчика'},
                    {'to': 'create.task', 'title': 'Добавить задачу'},
                    {'to': 'my.task', 'title': 'Мои задачи'},
                    {'to': 'orders.customer', 'title': 'Мои заказы'},
                ]
            } else if (this.$props.user.role_id === 3) {
                return [
                    {'to': 'ap', 'title': 'Панель управления'},
                ]
            }
        },
        // ...mapState(useUserStore, ['token', 'user', 'eventsAfter']),
    },
    mounted() {
        // this.e.on('alert', (alert, e) => {
        //     this.addAlert(alert.title, alert.message, alert.alertType)
        // })
        //
        // this.e.on('updateUser', (redirect = false, e) => {
        //     this.updateUser(redirect)
        // })
        //
        // this.e.on('updateNewEvents', (e) => {
        //     this.getNewEvents()
        // })
        //
        // this.e.on('updateMessageCount', (e) => {
        //     this.getUnViewedMessagesCount()
        // })
        //
        // this.updateUser(false)
        //
        // if (this.token) {
        //     this.eventsPolling()
        //     this.messagesPolling()
        //     this.getUnViewedMessagesCount()
        // }
    },
    methods: {
        // ...mapActions(useUserStore, ['setToken', 'setUser', 'setEventsAfter']),
        toggleNotifications() {
            this.showNotifications = !this.showNotifications
            this.showProfileMenu = false
        },
        toggleProfileMenu() {
            this.showProfileMenu = !this.showProfileMenu
            this.showNotifications = false
        },
        addAlert(title, message, alertType) {
            let alertClasses = ''

            switch (alertType) {
                case 1:
                    alertClasses = 'text-green-700 bg-green-100 dark:bg-green-200 dark:text-green-800'
                    break;
                case 3:
                    alertClasses = 'text-blue-700 bg-blue-100 dark:bg-blue-200 dark:text-blue-800'
                    break;
                default:
                    alertClasses = 'text-red-700 bg-red-100 dark:bg-red-200 dark:text-red-800'
                    break;
            }

            let alert = {
                title: title,
                message: message,
                classes: alertClasses
            }

            this.alerts.splice(this.alerts.length - 1, 0, alert)

            this.alertTimers.push(setTimeout(() => {
                this.alerts.splice(this.alerts.length - 1, 1)
            }, 3000))
        },
    }
}
</script>

<style>
.slide-fade-enter-active {
    transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(50px);
    opacity: 0;
}
</style>
