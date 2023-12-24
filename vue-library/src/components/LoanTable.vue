<template>
  <div class="m-20">
    <div v-if="loans.length === 0" class="text-gray-500">
      No Requested books at the moment.
    </div>

    <div v-else class="overflow-x-auto shadow-md sm:rounded-lg">
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
      >
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3"></th>

            <th scope="col" class="px-6 py-3">Title</th>
            <th scope="col" class="px-6 py-3">Pages</th>
            <th scope="col" class="px-6 py-3">Publisher</th>
            <th scope="col" class="px-6 py-3">Category</th>
            <th scope="col" class="px-6 py-3">Status</th>

            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody v-for="loan in loans" :key="loan.id">
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th class="p-4" scope="row">
              <router-link :to="{ name: 'Book', params: { id: loan.book.id } }">
                <img
                  v-bind:src="loan.book.image"
                  class="w-16 md:w-32 max-w-full h-40"
                  alt="Book Cover"
                />
              </router-link>
            </th>
            <router-link :to="{ name: 'Book', params: { id: loan.book.id } }">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ loan.book.name }}
              </th>
            </router-link>
            <td class="px-6 py-4">{{ loan.book.pages }}</td>
            <td class="px-6 py-4">{{ loan.book.publisher }}</td>
            <td class="px-6 py-4">{{ loan.book.category }}</td>
            <td class="px-6 py-4">{{ loan.status }}</td>

            <td class="px-6 py-4">
              <a
                href="#"
                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                @click.prevent="cancelLoan(loan)"
              >
                Cancel
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    loans: {
      type: Array,
      required: true,
    },
  },
  methods: {
    cancelLoan(loan) {
      this.$emit('cancel-loan', { id: loan.id })
    },
  },
}
</script>
