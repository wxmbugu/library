<template>
  <ErrorToast :error="error" @close-error="closeError" />
  <SuccessToast :success="success" @close-success="closeSuccess" />
  <BookBorrowTable
    :loans="requestedExtension"
    @update-extension="updateBookLoanExtenstionStatus"
  />
</template>
<script>
import { getAllBookLoanRequest, updateBookExtensionLoan } from '../client'
import ErrorToast from '@/components/ErrorToast.vue'
import SuccessToast from '@/components/SuccessToast.vue'
import BookBorrowTable from '@/components/ExtensionBookTableStatus.vue'

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
  computed: {
    requestedExtension() {
      return this.loans.filter((loan) => loan.extended !== null)
    },
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
    updateBookLoanExtenstionStatus({ id, status }) {
      updateBookExtensionLoan(id, status)
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
