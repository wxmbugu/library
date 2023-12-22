<template>
  <Menu as="div" class="relative flex-shrink-0">
    <MenuButton class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black rounded-full">
      <img class="w-10 h-10 inline rounded-full"
        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMkTSF9gVJIBjtmyoOttT_j4yWAkOKpbMEO9LOfx8rUrgsdUSt-pndS2gJGHIpQCGSjvA&usqp=CAU"
        alt="avatar" srcset="" />
    </MenuButton>
    <transition enter-active-class="transition transform duration-100 ease-out" enter-from-class="opacity-0 scale-90"
      enter-to-class="opacity-100 scale-100" leave-active-class="transition transform duration-100 ease-in"
      leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-90">
      <MenuItems class="origin-top-right mt-2 absolute right-0 bg-white rounded shadow-lg border w-40">
        <MenuItem v-slot="{ active }">
        <a href="#" :class="{ 'bg-gray-100': active }" class="hover:bg-gray-100 block px-4 py-2 text-sm text-gray-700">My
          Profile
        </a>
        </MenuItem>
        <MenuItem v-slot="{ active }">
        <a href="#" :class="{ 'bg-gray-100': active }"
          class="hover:bg-gray-100 block px-4 py-2 text-sm text-gray-700">Settings</a>
        </MenuItem>
        <MenuItem v-slot="{ active }">
        <a href="#" :class="{ 'bg-gray-100': active }"
          class="hover:bg-gray-100 block px-4 py-2 text-sm text-gray-700">Help</a>
        </MenuItem>
        <hr />
        <MenuItem v-slot="{ active }">
        <button :class="{ 'bg-gray-100': active }" class="hover:bg-gray-100 float-right py-2 px-4 text-gray-700"
          @click="logout">
          Logout
        </button>
        </MenuItem>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
export default {
  components: { Menu, MenuButton, MenuItems, MenuItem },
  methods: {
    logout() {
      this.$store.dispatch('logout')
      console.log('logout')
    },
  },
}
</script>
