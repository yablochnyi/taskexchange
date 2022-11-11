<script setup>
import ProfileInfo from "@/components/ProfileInfo.vue";
import {moment} from "@/moment";
</script>
<template>
    <main>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Добавление задачи</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <ProfileInfo :user="$page.props.auth.user"/>
                <div class="mt-10 mx-3 md:mx-0">
                    <transition name="slide-fade">
                        <div v-if="form.selectedType === 1 || form.selectedType === 0">
                            <h2 class="text-2xl font-medium">Что хотите заказать? - <span class="underline">для разовой задачи</span></h2>
                            <p class="text-gray-700 mt-3 text-sm">
                                Краткое описание для разовой задачи
                            </p>
                        </div>
                    </transition>
                    <div class="bg-white mt-7 py-4 px-5 grid grid-cols-1 gap-4 md:grid-cols-4 rounded-xl shadow hover:shadow-lg transition duration-300">
                        <div @click="selectType(1)" class="shadow hover:shadow-lg hover:ring ring-slate-100 rounded-lg py-1 px-1 cursor-pointer transition duration-300" :class="{'bg-blue-500 text-white ring-blue-300': form.selectedType === 1, 'bg-slate-100': form.selectedType !== 1}">
                            <div class="float-left ml-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-20 py-3 font-medium">
                                Разовая задача
                                <br>
                                <span v-if="form.selectedType === 1" class="text-white text-sm">Выбрано</span>
                                <span v-else class="text-gray-500 text-sm">Выбрать</span>
                            </div>
                        </div>
                    </div>
                    <transition name="slide-fade">
                        <div v-if="form.selectedType === 1 && !closeSubmitForm || form.selectedType === 2 && !closeSubmitForm">
                            <h2 class="text-2xl font-medium mt-10">Выберите сервис</h2>
                            <div class="bg-white mt-3 py-4 px-5 grid grid-cols-1 gap-4 md:grid-cols-4 rounded-xl shadow hover:shadow-lg transition duration-300">
                                <div v-for="parent in optionsParent" @mouseenter="showOptions = parent.id" @mouseleave="showOptions = 0" class="relative">
                                    <div @click="selectParent(parent)" class=" cursor-pointer shadow hover:shadow-lg hover:ring ring-slate-100 rounded-lg py-1 px-1 transition duration-300" :class="{'text-white bg-sky-800': form.selectedParent === parent.id, 'bg-slate-100': form.selectedParent !== parent.id, 'rounded-t-lg': form.showOptions === parent.id}">
                                        <div class="py-3 px-4 font-medium flex items-center flex-row gap-4">
                                            <div class="basis-1/5">
                                                <div class="uppercase h-16 w-16 flex justify-center items-center text-xl rounded-md font-semibold" :class="{
                          'bg-white text-sky-800': form.selectedParent === parent.id,
                          'bg-sky-800 text-white': form.selectedParent !== parent.id
                        }">
                                                    {{ parent.short }}
                                                </div>
                                            </div>
                                            <div class="basis-3/5 text-sm font-semibold">
                                                <p class="leading-none">{{ parent.title }}</p>
                                                <p class="text-xs mt-1" :class="{'text-white': form.selectedParent === parent.id, 'text-gray-500': form.selectedParent !== parent.id}">от {{parent.price }}</p>
                                            </div>
                                            <div class="basis-1/5 text-sm font-semibold">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5ZM12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14ZM12 21C10.8954 21 10 20.1046 10 19C10 17.8954 10.8954 17 12 17C13.1046 17 14 17.8954 14 19C14 20.1046 13.1046 21 12 21Z" fill="#2E363E"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <transition name="slide-fade">
                                        <div v-if="showOptions === parent.id" class="absolute w-full z-50 ring ring-slate-200 bg-slate-200 shadow-lg rounded-b-lg pb-4 pt-2 px-3 text-sm flex flex-col">
                                            <div v-if="parent.children === null" class="mt-2 text-center text-slate-500">
                                                Нет опций для данной категории
                                            </div>
                                            <div v-for="option in parent.children" @click="selectOption(option)" class="py-2 px-4 mt-2 cursor-pointer shadow hover:shadow-lg transition duration-300 rounded-full" :class="{'bg-blue-500 text-white shadow-lg': form.selectedOptions.indexOf(option.id) !== -1, 'bg-slate-100': form.selectedOptions.indexOf(option.id) === -1}">
                                                {{ option.title }} {{ option.price }}
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                            <h2 v-if="showSubmitForm" class="text-2xl font-medium mt-10">Укажите необходимую информацию</h2>
                            <div v-if="showSubmitForm" class="mt-7 bg-white rounded-lg py-3 px-7 shadow">
                                <form>
                                    <div class="mt-4">
                                        <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ссылка на задачу</label>
                                        <input type="text" v-model="form.link" id="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Например, ссылка на пост ВКонтакте" required>
                                    </div>
                                    <div class="mt-6">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Описание задачи</label>
                                        <textarea id="description" v-model="form.description" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Описание задачи нужно для того, чтобы исполнители поняли суть задачи" required></textarea>
                                    </div>
                                    <div class="mt-6">
                                        <label for="report" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Укажите информацию, которую необходимо предоставить в отчёте</label>
                                        <textarea id="report" v-model="form.report" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Например, ссылка на аккаунт, с которого было выполнено задание" required></textarea>
                                    </div>
                                    <div class="mt-6">
                                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Количество</label>
                                        <input type="number" min="1" v-model="form.amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Например, количество необходимых комментариев под пост ВКонтакте" required>
                                    </div>
                                    <div class="mt-6">
                                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Дата сдачи</label>
                                        <select id="countries" v-model="form.deliveryDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">другая (выберите или введите ниже)</option>
                                            <option v-for="date in deliveryDatesHelper" :value="date.variable" >{{ date.title }}</option>
                                        </select>
                                        <input type="date" :min="new Date().toLocaleDateString('en-ca')" v-model="form.deliveryDate" id="amount" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Например, количество необходимых комментариев под пост ВКонтакте" required>
                                    </div>
                                    <div class="mt-6">
                                        <transition name="slide-fade">
                                            <div v-if="$page.props.auth.user.balance < priceForCurrentTask" class="mb-3 text-center font-medium text-sm text-red-500">
                                                Недостаточно средств на балансе
                                            </div>
                                        </transition>
                                        <button type="button" @click="store(form)" :disabled="!showSubmitButton" class="text-white w-full bg-blue-600 transition duration-300 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" :class="{'hover:bg-blue-800': showSubmitButton,'opacity-50': !showSubmitButton }">
                                            <span v-if="editTaskIndex !== null">Сохранить задачу</span>
                                            <span v-else>Добавить</span>
                                            <br>
                                            <p class="text-xs -mt-1 text-blue-200">
<!--                                                Итоговая стоимость данной задачи: {{ $filters.currencyFormat(priceForCurrentTask) }}-->
                                            </p>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </main>
    </main>
</template>

<script>

import {Inertia} from "@inertiajs/inertia";

export default {
    props: {
        optionsParent: Object,
    },
    data() {
        return {
            form: {
                selectedType: 0,
                selectedParent: 0,
                selectedOptions: [],
                link: "",
                description: "",
                amount: 1,
                report: "",
                deliveryDate: '',
                userBalance: 0,
            },
            showOptions: 0,
            options: [],
            showSubmitForm: false,
            tasks: [],
            showTask: 0,
            editTaskIndex: null,
            closeSubmitForm: false,
            loading: false,
            excelFile: null,
            // e: emitter
        }
    },
    computed: {
        showSubmitButton() {
            if(this.form.selectedParent === 0) return false
            if (this.form.link === '') return false
            if (this.form.description === '') return false
            if (this.form.deliveryDate === '') return false
            if (this.form.report === '') return false
            if (parseInt(this.form.amount) <= 0) return false
            if (this.form.userBalance < this.priceForCurrentTask) return false
            if (this.form.loading) return false

            return true
        },
        // showSubmitAllTasksButton() {
        //     if (3 < this.calculateAllTasksPrice) return false
        //     if (this.loading) return false
        //
        //     return true
        // },
        deliveryDatesHelper() {
            return [
                {
                    title: 'В течении дня',
                    variable: this.addDaysToCurrentDate(0).toLocaleDateString('en-ca'),
                }, {
                    title: 'Завтра',
                    variable: this.addDaysToCurrentDate(1).toLocaleDateString('en-ca'),
                }, {
                    title: '2 дня',
                    variable: this.addDaysToCurrentDate(2).toLocaleDateString('en-ca'),
                }, {
                    title: '3 дня',
                    variable: this.addDaysToCurrentDate(3).toLocaleDateString('en-ca'),
                }, {
                    title: '4 дня',
                    variable: this.addDaysToCurrentDate(4).toLocaleDateString('en-ca'),
                }, {
                    title: '5 дней',
                    variable: this.addDaysToCurrentDate(5).toLocaleDateString('en-ca'),
                }, {
                    title: '6 дней',
                    variable: this.addDaysToCurrentDate(6).toLocaleDateString('en-ca'),
                }, {
                    title: '7 дней',
                    variable: this.addDaysToCurrentDate(7).toLocaleDateString('en-ca'),
                }, {
                    title: '2 недели',
                    variable: this.addDaysToCurrentDate(14).toLocaleDateString('en-ca'),
                }, {
                    title: 'месяц',
                    variable: this.addDaysToCurrentDate(31).toLocaleDateString('en-ca'),
                },
            ]
        },
        priceForCurrentTask() {
            let price = 0
            console.log(price)

            if (this.form.selectedParent !== 0){
                for (let i = 0; i < this.form.selectedOptions; i++) {
                    if (this.options[i] === this.form.selectedParent) {
                        price += this.options[i].price
                        break
                    }
                }

                for (let s = 0; s < this.form.selectedOptions; s++) {
                    for (let o = 0; o < this.options; o++) {
                        if (this.options[o].id === this.form.selectedOptions[s].price) {
                            price += this.options[o].price
                        }
                    }
                }
            }

            return price * parseInt(this.amount)
        },
        // optionsToShow() {
        //     let parents = []
        //
        //     for (let i = 0; i < this.options.length; i++) {
        //         if(!this.options[i].parent_id) {
        //             let parent = this.options[i]
        //             parents.push(parent)
        //         }
        //     }
        //
        //     return parents
        // },
        // calculateAllTasksPrice() {
        //     let price = 0
        //
        //     for (let i = 0; i < this.tasks.length; i++) {
        //         price += this.tasks[i].taskOptions.amountPrice
        //     }
        //
        //     return price
        // },
    //     // ...mapState(useUserStore, ['user', 'token']),
    },
    mounted() {
        document.title = 'Добавление задачи'

        // this.getOptions()

        // this.userBalance = this.user.balance
    },
    methods: {
        store(form) {
            Inertia.post(route('store.task'), form, {
                preserveState: false,
            })
        },
        addDaysToCurrentDate(days) {
            let current = new Date()
            current.setDate(current.getDate() + days)

            return current
        },
        selectOption(option) {
            if(this.form.selectedParent !== option.parent_id) {
                this.form.selectedParent = option.parent_id
                this.showSubmitForm = true
                this.form.selectedOptions = []
            }

            let optionIndex = this.form.selectedOptions.indexOf(option.id)
            if (optionIndex === -1){
                this.form.selectedOptions.push(option.id)
            } else {
                this.form.selectedOptions.splice(optionIndex, 1)
            }
        },
        selectType(type) {
            this.form.selectedType = type
            if (type === 1) {
                this.closeSubmitForm = false
            }
        },
        // onInputChange(e, field) {
        //     this[field] = e.target.value
        // },
        // changeExcelFile(e) {
        //     this.excelFile = e.target.files[0]
        // },
        // editTask(taskIndex) {
        //     this.editTaskIndex = taskIndex
        //     this.selectedParent = this.tasks[taskIndex].taskOptions.id
        //
        //     for (let i = 0; i < this.tasks[taskIndex].taskOptions.options.length; i++) {
        //         this.selectedOptions.push(this.tasks[taskIndex].taskOptions.options[i].id)
        //     }
        //     this.amount = parseInt(this.tasks[taskIndex].amount)
        //     this.link = this.tasks[taskIndex].link
        //     this.description = this.tasks[taskIndex].description
        //     this.report = this.tasks[taskIndex].report
        //     this.deliveryDate = this.tasks[taskIndex].delivery_date
        //
        //     this.closeSubmitForm = false
        //     this.showSubmitForm = true
        // },

        // taskOptionsToShow(taskOptions) {
        //     let parent = {}
        //     let options = []
        //     let amountPrice = 0
        //
        //     for (let t = 0; t < taskOptions.length; t++) {
        //         for (let o = 0; o < this.options.length; o++) {
        //             if(taskOptions[t] === this.options[o].id) {
        //                 if(!this.options[o].parent_id) {
        //                     parent = this.options[o]
        //                 } else options.push(this.options[o])
        //                 amountPrice += this.options[o].price
        //             }
        //         }
        //     }
        //
        //     parent.options = options
        //     parent.amountPrice = amountPrice * parseInt(this.amount)
        //
        //     return parent
        // },
        selectParent(parent) {
            if(this.form.selectedParent === 0 || this.form.selectedParent !== parent.id) {
                this.form.selectedParent = parent.id
                this.showSubmitForm = true
            }
            else {
                this.form.selectedParent = 0
                this.showSubmitForm = false
            }

            this.form.selectedOptions = []
        },

        // collectSelectedOptions() {
        //     let options = []
        //     for (let i = 0; i < this.selectedOptions.length; i++) {
        //         options.push(this.selectedOptions[i])
        //     }
        //     options.push(this.selectedParent)
        //
        //     return options
        // },
        // getOptions() {
        //     axios.get(import.meta.env.VITE_API_URL + 'options/').then(res => {
        //         if(res.data.data) {
        //             this.options = res.data.data
        //         }
        //     })
        // },
        // onFormAllTasksSubmit() {
        //     this.loading = true
        //     NProgress.start()
        //     let tasksForRequest = []
        //
        //     for (let i = 0; i < this.tasks.length; i++) {
        //         tasksForRequest.push({
        //             status: 1,
        //             amount: this.tasks[i].amount,
        //             delivery_date: this.tasks[i].delivery_date,
        //             link: this.tasks[i].link,
        //             description: this.tasks[i].description,
        //             report: this.tasks[i].report,
        //             options: this.tasks[i].options,
        //         })
        //     }
        //
        //     console.log(tasksForRequest)
        //
        //     axios.post(import.meta.env.VITE_API_URL + 'tasks/', {
        //         tasks: tasksForRequest
        //     }, {
        //         headers: { Authorization: `Bearer ${this.token}` }
        //     }).then(res => {
        //         if(res.data.status) {
        //             this.e.emit('alert', {
        //                 title: 'Успешно!',
        //                 message: 'Задачи созданы.',
        //                 alertType: 1
        //             })
        //             this.e.emit('updateUser', false)
        //
        //             this.$router.push({'name': 'tasks-my'})
        //         }
        //     }).catch(err => {
        //         if(err.response.data.message) this.e.emit('alert', {
        //             title: 'Ошибка.',
        //             message: err.response.data.message,
        //             alertType: 2
        //         })
        //         else this.e.emit('alert', {
        //             title: 'Ошибка.',
        //             message: 'Произошла внутренняя ошибка сервера.',
        //             alertType: 2
        //         })
        //
        //         NProgress.done()
        //     })
        // },
        // onFormSubmit(e) {
        //     e.preventDefault()
        //
        //     if(this.editTaskIndex !== null) {
        //         this.tasks[this.editTaskIndex] = {
        //             status: 1,
        //             amount: parseInt(this.amount),
        //             delivery_date: this.deliveryDate,
        //             link: this.link,
        //             description: this.description,
        //             report: this.report,
        //             options: this.collectSelectedOptions(),
        //             taskOptions: this.taskOptionsToShow(this.collectSelectedOptions())
        //         }
        //
        //         this.closeSubmitForm = true
        //         this.editTaskIndex = null
        //
        //         return
        //     }
        //
        //     if(this.selectedType === 1) {
        //         this.loading = true
        //         NProgress.start()
        //
        //         axios.post(import.meta.env.VITE_API_URL + 'tasks/', {
        //             tasks: [
        //                 {
        //                     status: 1,
        //                     amount: parseInt(this.amount),
        //                     delivery_date: this.deliveryDate,
        //                     link: this.link,
        //                     description: this.description,
        //                     report: this.report,
        //                     options: this.collectSelectedOptions(),
        //                 }
        //             ]
        //         }, {
        //             headers: { Authorization: `Bearer ${this.token}` }
        //         }).then(res => {
        //             if(res.data.status) {
        //                 this.e.emit('alert', {
        //                     title: 'Успешно!',
        //                     message: 'Задача создана.',
        //                     alertType: 1
        //                 })
        //                 this.e.emit('updateUser', false)
        //
        //                 this.$router.push({'name': 'tasks-my'})
        //             }
        //         }).catch(err => {
        //             if(err.response.data.message) this.e.emit('alert', {
        //                 title: 'Ошибка.',
        //                 message: err.response.data.message,
        //                 alertType: 2
        //             })
        //             else this.e.emit('alert', {
        //                 title: 'Ошибка.',
        //                 message: 'Произошла внутренняя ошибка сервера.',
        //                 alertType: 2
        //             })
        //
        //             NProgress.done()
        //         })
        //     } else if (this.selectedType === 2) {
        //         let task = {
        //             status: 1,
        //             amount: parseInt(this.amount),
        //             delivery_date: this.deliveryDate,
        //             link: this.link,
        //             description: this.description,
        //             report: this.report,
        //             options: this.collectSelectedOptions(),
        //             taskOptions: this.taskOptionsToShow(this.collectSelectedOptions())
        //         }
        //
        //         this.tasks.push(task)
        //         this.closeSubmitForm = true
        //
        //         this.clearForm()
        //     }
        // },
        // submitExcelFileForm() {
        //     if(!this.excelFile) return
        //     if(this.loading) return
        //
        //     let formData = new FormData();
        //     formData.append('file', this.excelFile);
        //
        //     axios.post(import.meta.env.VITE_API_URL + 'tasks/excel', formData, {
        //         headers: {
        //             Authorization: `Bearer ${this.token}`,
        //             'Content-Type': 'multipart/form-data'
        //         }
        //     }).then(res => {
        //         if(res.data.status) {
        //             this.e.emit('alert', {
        //                 title: 'Успешно!',
        //                 message: 'Задачи созданы.',
        //                 alertType: 1
        //             })
        //             this.e.emit('updateUser', false)
        //
        //             this.$router.push({'name': 'tasks-my'})
        //         }
        //     }).catch(err => {
        //         if(err.response.data.message) this.e.emit('alert', {
        //             title: 'Ошибка.',
        //             message: err.response.data.message,
        //             alertType: 2
        //         })
        //         else this.e.emit('alert', {
        //             title: 'Ошибка.',
        //             message: 'Произошла внутренняя ошибка сервера.',
        //             alertType: 2
        //         })
        //
        //         NProgress.done()
        //     })
        // },
        // clearForm() {
        //     this.amount = 1
        //     this.deliveryDate = ''
        //     this.link = ''
        //     this.description = ''
        //     this.report = ''
        //     this.selectedParent = 0
        //     this.selectedOptions = []
        // }
    }
}
</script>

<style>
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}
.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(50px);
    opacity: 0;
}
</style>
