<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />
  <BookBorrowTable :loans="loans" @update-loan="updateBookLoanStatus" />
</template>
<script>
import { getAllBookLoanRequest, updateBookLoan } from '../client'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'
import BookBorrowTable from '@/components/UpdateLoanTableStatus.vue'

export default {
  components: {
    ErrorToast,
    SuccessToast,
    BookBorrowTable,
  },
  data() {
    return {
      loans: [],
      error: null,
      success: null,
    }
  },
  mounted() {
    this.getallbookrequest()
  },
  methods: {
    getallbookrequest() {
      getAllBookLoanRequest()
        .then((response) => {
          const loansArray = Object.values(response.message)
          this.loans = loansArray
        })
        .catch((err) => {
          console.log(err)
        })
    },
    updateBookLoanStatus({ id, status }) {
      updateBookLoan(id, status)
        .then((response) => {
          this.success = response.message
          this.getallbookrequest()
        })
        .catch((err) => {
          this.error = err.response.data.error
        })
    },
    closeError() {
      this.error = null
    },
    closeSuccess() {
      this.success = null
    },
  },
}
</script>
