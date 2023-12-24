import axios  from "axios";



window.axios = axios
axios.defaults.withCredentials = false
axios.defaults.baseURL = '//localhost:8000/api/'

const createBooks = async (name, description,publisher,isbn,pages,category,sub_category,file) => {
    let data = await axios.post('books', { 
      name, 
      description,
      publisher,
      isbn,
      pages,
      category,
      sub_category,
      file,
    });  
    let massageData = data //Some data massage
    return massageData
}

const registerUser = async (name, email,password) => {
    let data = await axios.post('users', { 
      name, 
      email,
      password, 
    });  
    let massageData = data //Some data massage
    return massageData
}
const borrowBook = async(bookid) => {
  let data = await axios.post('request/'+ bookid);
  let messagedata = data
  return messagedata.data
}
const getAllBookLoanRequestbyUser = async() => {
  let data = await axios.get('requests');
  let messagedata = data
  return messagedata.data
}
const getAllBookLoanRequest = async() => {
  let data = await axios.get('loans');
  let messagedata = data
  return messagedata.data
}
const getBook = async(id) => {
  let data = await axios.get('books/'+id);
  let messageData = data
  return messageData.data
}

const getAllBooks =async () => {
  let data = await axios.get('/books', { 
  });  
  let massageData = data //Some data massage
  return massageData.data
}

const updateBookLoan =async (id,status) => {
  let data = await axios.put('/loans/'+id, { 
    status,
  });  
  let massageData = data //Some data massage
  return massageData.data
}

const updateBookExtensionLoan =async (id,extended) => {
  let data = await axios.put('/loans/'+id, { 
    extended,
  });  
  let massageData = data //Some data massage
  return massageData.data
}
export {getAllBooks,createBooks,
  getBook,borrowBook,getAllBookLoanRequestbyUser,registerUser,getAllBookLoanRequest,updateBookLoan,updateBookExtensionLoan}
