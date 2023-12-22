<template>
  <div>
    <a href="#" class="space-y-4">
      <div class="aspect-w-16 aspect-h-9">
        <img
          class="object-contain shadow-md hover:shadow-xl rounded-lg h-60 w-full"
          :src="book.image"
          alt=""
        />
      </div>
      <div class="px-4 py-2">
        <div class="text-lg leading-6 font-medium space-y-1">
          <h3 class="font-bold text-gray-800 text-1xl mb-2">
            {{ book.name }}
          </h3>
          <h2 class="py-2 uppercase tracking-widest text-xs">
            {{ book.category }}
          </h2>
        </div>
        <div class="text-md">
          <p class="">
            {{ book.description }}
          </p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    book: {
      type: Object,
      required: true,
    },
  },
}
</script>
