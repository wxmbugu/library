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
const createLoans = async(coursetitle,Section) => {
  let data = await axios.post('/loans'+ coursetitle,{
    Section,
  });
  let messagedata = data
  return messagedata
}

const getBook = async(id) => {
  let data = await axios.get('/books/'+id);
  let messageData = data
  return messageData
}

const updateCourse = async (id, name, description) => {
  let data = await axios.post('/course/update/'+id, { 
    name, 
    description
  });  
  let messageData = data //Some data massage
  return messageData
}
 
const deleteCourse = async (id) => {
  let data = await axios.delete('/course/delete/'+id, { 
  });  
  let messageData = data //Some data massage
  return messageData
}
//////////////////////////////////////////////////////////////////////
const updateSection  = async (name, Description,sectionid) => {
  let data = await axios.post('/course/'+name+ '/updatesection/'+sectionid, { 
    Description
  });  
  let massageData = data //Some data massage
  return massageData
}

const deleteSection = async (coursename,sectionid) => {
  let data = await axios.delete('/course/'+coursename+ '/deletesection/'+sectionid, { 
  });  
  let massageData = data //Some data massage
  return massageData
}

const createSubsection = async (CourseName,sectionid, Content) => {
  let data = await axios.post('/course/'+CourseName + '/'+ sectionid , { 
    Content
  });  
  let massageData = data //Some data massage
  return massageData
}
///course/:name/update/:sectiontitle/:subsectionid
const updateSubsection = async (coursename,sectiontitle ,subsectionid,Subsection_Title) => {
  let data = await axios.post('/course/'+coursename+'/update/'+sectiontitle +'/'+subsectionid, { 
    Subsection_Title,
  });
  let massageData = data //Some data massage
  return massageData
}
const videoupload = async (coursename,sectiontitle ,subsectionid) => {
  let data = await axios.post('/upload/'+coursename+'/'+sectiontitle +'/'+subsectionid, { 
  
  });
  let massageData = data //Some data massage
  return massageData
}

const deleteSubsection =async (coursename,sectiontitle,subsectionid) => {
  let data = await axios.delete('/course/'+coursename +'/delete/'+ sectiontitle +'/' + subsectionid, { 
  });  
  let massageData = data //Some data massage
  return massageData
}
const getCourses =async (page_id,page_size) => {
  let data = await axios.get('/course?page_id='+ page_id+'&page_size='+ page_size, { 
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}
const gettotalnoCoursesbyUser =async (username) => {
  let data = await axios.get('/total/'+username, {
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}
///courses/:name/section/:subsectionid
const getContent =async (coursename,subsectionid) => {
  let data = await axios.get('/courses/'+ coursename +'/section/'+ subsectionid, { 
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}

const getAllCourses =async () => {
  let data = await axios.get('/courses', { 
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}


const getAllBooks =async () => {
  let data = await axios.get('/books', { 
  });  
  let massageData = data //Some data massage
  return massageData.data
}
const getAllCoursesEnrolled =async () => {
  let data = await axios.get('/course/enrolled', { 
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}

const enroll =async (title,username) => {
  let data = await axios.post('/enroll', { 
    title,
    username
  });  
  let massageData = data //Some data massage
  console.log(massageData)
  return massageData
}

//http://localhost:8000/courses?page_id=1&page_size=10
export {gettotalnoCoursesbyUser  ,updateCourse,enroll,getAllCoursesEnrolled,
  deleteCourse,updateSection,deleteSection,
  createSubsection,getContent,updateSubsection,
  deleteSubsection,getCourses,getAllBooks,
  getAllCourses,videoupload}
