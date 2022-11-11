<script setup>
import {moment} from "@/moment";
</script>
<template>
    <Navigation :user="$page.props.auth.user">
  <main>
    <main>
      <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <section class="text-gray-600 body-font">
          <div class="container px-5 mx-auto max-w-7x1">
            <div class="flex flex-wrap w-full mb-4 p-4">
              <div class="w-full mb-6 lg:mb-0">
                <h1 class="sm:text-4xl text-5xl font-medium font-bold title-font mb-2 text-gray-900">Новости</h1>
                <div class="h-1 w-40 bg-indigo-500 rounded"></div>
              </div>
            </div>
            <div class="flex flex-wrap -m-4">
              <div v-for="post in $props.postResource.data" class="xl:w-1/3 md:w-1/2 p-4">
                <div class="bg-white p-6 rounded-lg">
                  <img class="lg:h-60 xl:h-56 md:h-64 sm:h-72 xs:h-72 h-72  rounded w-full object-cover object-center mb-6" :src="post.image" alt="Image Size 720x400">
                  <h3 v-for="category in post.category" class="tracking-widest text-indigo-500 text-xs font-medium title-font">{{category.title}}</h3>
                  <Link :href="route('post.show', post)" class="text-lg text-gray-900 font-medium title-font mb-4" v-html="post.title"></Link>
                  <p class="leading-relaxed text-base mt-2" v-html="post.short"></p>
                  <p class="text-sm text-gray-500 mt-3 text-right">{{post.date}}</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </main>
    </Navigation>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';
import Navigation from "@/Layouts/Navigation.vue";
import NProgress from "nprogress"

export default {
    props: {
        postResource: Object
    },
    components: {
        Navigation,
        Link
    },
}
</script>
