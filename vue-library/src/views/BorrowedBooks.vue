<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />
  <BookBorrowTable :loans="approvedLoans" @extend-borrow="ExtendBorrow" />
</template>
<script>
import { getAllBookLoanRequestbyUser, updateBookExtensionLoan } from '../client'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'
import BookBorrowTable from '@/components/BorrowedTable.vue'

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
  computed: {
    approvedLoans() {
      return this.loans.filter((loan) => loan.status === 'borrowed')
    },
  },
  methods: {
    getallbookrequest() {
      getAllBookLoanRequestbyUser()
        .then((response) => {
          const loansArray = Object.values(response.message)
          if (Array.isArray(loansArray)) {
            this.loans = loansArray
          } else {
            console.error('Unexpected response format:', response)
          }
        })
        .catch((err) => {
          console.log(err)
        })
    },
    ExtendBorrow(id) {
      updateBookExtensionLoan(id, 'requested')
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
