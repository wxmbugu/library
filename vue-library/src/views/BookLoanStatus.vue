<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />
  <BookLoan :loans="loans" />
</template>
<script>
import { getAllBookLoanRequestbyUser } from '../client'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'
import BookLoan from '@/components/LoanTable.vue'

export default {
  components: {
    ErrorToast,
    SuccessToast,
    BookLoan,
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
      getAllBookLoanRequestbyUser()
        .then((response) => {
          this.loans = response.message
        })
        .catch((err) => {
          console.log(err)
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
