import axios  from "axios";



window.axios = axios
axios.defaults.withCredentials = false
axios.defaults.baseURL = '//localhost:8000/api/'

const createBooks = async (Name, Description) => {
    let data = await axios.post('/books', { 
      Name, 
      Description
    });  
    let massageData = data //Some data massage
    console.log(massageData.data.ID)
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


export {getAllBooks,createBooks,
  getBook,borrowBook,getAllBookLoanRequestbyUser}
