<script setup>
import {moment} from "@/moment";
</script>
<template>
    <Navigation :user="$page.props.auth.user">
  <main>
    <section v-if="userResource" v-for="user in userResource.data" class="mx-10 md:w-1/3 my-10 md:mx-auto bg-[#20354b] rounded-2xl px-8 py-6 shadow-lg">
      <div class="flex items-center justify-between">
          <div v-if="user.online === true" class="flex items-center text-gray-300">
              <span class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></span>
              Онлайн
          </div>
        <span v-else class="text-gray-300 text-sm font-semibold flex items-center" >был(-а) онлайн {{user.last_online}}</span>
        <span class="text-gray-300 text-sm font-semibold">
          @{{user.username }}
        </span>
      </div>
      <div class="mt-6 w-fit mx-auto">
        <img src="@/assets/img/user.png" class="rounded-full w-28 " alt="profile picture" srcset="">
      </div>

      <div class="mt-8 ">
        <h2 class="text-white font-bold text-2xl tracking-wide">
          {{ user.first_name }} <br/>
          {{ user.last_name }}
        </h2>
      </div>
      <p v-if="user.role_id === 1" class="text-emerald-400 font-semibold mt-2.5" >
        Исполнитель
      </p>
      <p v-if="user.role_id === 2" class="text-emerald-400 font-semibold mt-2.5" >
        Заказчик
      </p>
      <p v-if="user.role_id === 3" class="text-emerald-400 font-semibold mt-2.5" >
        Администратор
      </p>
      <div class="mt-3 text-white text-sm">
        <span class="text-gray-400 font-semibold">Зарегистрирован</span>
        <span class="ml-1">{{ user.created_at}}</span>
      </div>
      <Link v-if="user.id !== $page.props.auth.user.id"  class="mt-3 text-white bg-green-500 font-semibold shadow rounded-md py-2 text-base text-sm grid place-items-center">
        Написать
      </Link>
    </section>
    <section v-else class="w-1/3 my-10 mx-auto bg-[#20354b] text-white text-center font-semibold rounded-2xl px-8 py-6 shadow-lg">
      Пользователь не найден.
    </section>
  </main>
    </Navigation>
</template>

<script>
import NProgress from "nprogress";
import {Link} from '@inertiajs/inertia-vue3';
import Navigation from "@/Layouts/Navigation.vue";

export default {
    components: {
        Link,
        Navigation
    },
    props: {
        userResource: Object
    },
  data() {
    return {
      userProfile: null,
    }
  },
  computed: {
    // ...mapState(useUserStore, ['user']),
  },
  mounted() {
    document.title = 'Профиль'

    // this.getUser(this.$route.params.username)
  },
  methods: {
    // getUser(username) {
    //   axios.get(import.meta.env.VITE_API_URL + 'users/username/' + username, {
    //     headers: { Authorization: `Bearer ${this.token}` },
    //   }).then(res => {
    //     if(res.data.data) {
    //       this.userProfile = res.data.data
    //
    //       NProgress.done()
    //     }
    //   }).catch(err => {
    //     this.user = null
    //     NProgress.done()
    //   })
    // },
    // getOnline(onlineDate) {
    //   let onlineDateObj = moment(onlineDate).utcOffset(+6, true)
    //   let currentDateObj = moment()
    //
    //   if (onlineDateObj.diff(currentDateObj, 'minutes') > -15) {
    //     return '<div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div> онлайн'
    //   }
    //
    //   return 'был(-а) онлайн ' + onlineDateObj.utcOffset(+6, true).fromNow()
    // },
  }
}
</script>
