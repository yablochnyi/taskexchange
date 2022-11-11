<script setup>
import AdminMenu from '@/components/AdminMenu.vue'
import Navigation from "@/Layouts/Navigation.vue";
</script>
<template>
    <Navigation :user="$page.props.auth.user">
        <main>
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Редактирование публикации</h1>
                </div>
            </header>
            <main>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <AdminMenu/>
                    <form @submit.prevent="update">
                    <div class="bg-white rounded-md shadow-md py-5 px-7">
                        <div class="mb-6">
                            <label for="category"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Выберите
                                категорию</label>
<!--                            <select id="category" v-model="form.category"-->
<!--                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">-->
<!--                                <option v-for="categoryDb in $props.categories"  :value="categoryDb.id"-->
<!--                                        :selected="categoryDb.id === category">{{ categoryDb.title }}-->
<!--                                </option>-->
<!--                            </select>-->
                        </div>
                        <div class="mt-6 mb-6">
                            <label for="username"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Заголовок</label>
                            <input type="text" v-model="form.title" name="username"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Введите заголовок" required>
                        </div>
                        <div class="mt-6 mb-6">
                            <label for="username"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Краткий
                                текст</label>
                            <QuillEditor ref="shortEditor" theme="snow" contentType="html"
                                         placeholder="Введите краткий текст" v-model:content="form.short"
                                         toolbar="essential"/>
                        </div>
                        <div class="mt-6 mb-6">
                            <label for="username"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Текст</label>
                            <QuillEditor ref="textEditor" theme="snow" contentType="html" placeholder="Введите текст"
                                         v-model:content="form.text" toolbar="essential"/>
                        </div>
                        <div class="mt-6 mb-6">
                            <input @input="form.image = $event.target.files[0]"
                                   accept="image/png, image/jpg, image/jpeg"
                                   class="block w-full text-sm text-slate-900 bg-gray-100 rounded-lg border border-gray-100 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">только .png,
                                .jpeg, .jpg</p>
                        </div>
                        <div class="mt-6 mb-6">
                            <button type="submit"
                                    class="w-full bg-indigo-500 text-white font-semibold py-2 rounded-md">
                                Сохранить
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </main>
        </main>
    </Navigation>
</template>

<script>
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import {reactive} from "vue";

export default {
    props: {
        post: Object
    },
    components: {
        QuillEditor
    },
    setup (props) {
        const form = reactive({
            category: '',
            title: this.props.post.data.title,
            short: this.props.post.data.short,
            text: this.props.post.data.text,
            image: this.props.post.data.image,
        })

        function update() {
            Inertia.put(route('posts.update', post))
        }

        return { form, update }
    },
        //   onEditFormChange(e, field) {
        //     this[field] = e.target.value
        //   },
        //   changeImage(e) {
        //     this.image = e.target.files[0]
        //   },
        //   getCategories() {
        //     NProgress.start()
        //
        //     axios.get(import.meta.env.VITE_API_URL + 'posts/categories/', {
        //       headers: { Authorization: `Bearer ${this.token}` },
        //     }).then(res => {
        //       if(res.data.data) {
        //         this.categories = res.data.data
        //         this.category = this.categories[0].id
        //
        //         NProgress.done()
        //       }
        //     })
        //   },

    // },
}
</script>
