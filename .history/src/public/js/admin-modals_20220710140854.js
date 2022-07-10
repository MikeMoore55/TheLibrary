// button variables

const addBtn = document.querySelector("#add-btn");
const updateBtn = document.querySelector("#update-btn");
const delBtn = document.querySelector("#del-btn");

// modal variables

const addModal = document.querySelector("#add-modal");
const updateModal = document.querySelector("#update-modal");
const delModal = document.querySelector("#del-modal");

//close variables
const closeAddBtn = document.querySelector("#add-close");
const closeUpdateBtn = document.querySelector("#update-close");
const closeDelBtn = document.querySelector("#del-close");


// code

//make modals display none by default


//open modals

function openAdd(){
    addModal.style.display = "block"; 
};

function openUpdate(){
    updateModal.style.display = block; 
}

function openDel(){
    delModal.style.display = block; 
}