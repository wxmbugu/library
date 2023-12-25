<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />
  <BookLoan :loans="requestedBookLoans" @cancel-loan="updateBookLoanStatus" />
</template>
<script>
import { getAllBookLoanRequestbyUser, updateBookLoan } from '../client'
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
  computed: {
    requestedBookLoans() {
      return this.loans.filter((loan) => loan.status === 'requested')
    },
  },
  mounted() {
    this.getallbookrequest()
  },
  methods: {
    getallbookrequest() {
      getAllBookLoanRequestbyUser()
        .then((response) => {
          const loansArray = Object.values(response.message)
          this.loans = loansArray
        })
        .catch((err) => {
          console.log(err)
        })
    },
    updateBookLoanStatus({ id }) {
      updateBookLoan(id, 'canceled')
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
