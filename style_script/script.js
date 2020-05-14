console.log("JS online");



// For typing-text animation

function typeEffect(element, speed) {
	var text = element.innerHTML;
	element.innerHTML = "";
  
	var i = 0;
	var timer = setInterval(function() {
    if (i < text.length) {
      element.append(text.charAt(i));
      i++;
    } else {
      clearInterval(timer);
    }
  }, speed);
}

// application
var speed = 75;
var h1 = document.getElementById('headingh1');
var delay = h1.innerHTML.length * speed + speed;

// type affect to header
typeEffect(h1, speed);






   // for editing the notes
   console.log(22);
   let editBtns = document.getElementsByClassName("editBtn");
  //  console.log(editBtns);
   
   Array.from(editBtns).forEach(element => {
     console.log(element);
     
     element.addEventListener("click", () =>{
       console.log(1);
       console.log(element.parentNode.children[0]);
       console.log(element.parentNode.children[1]);
       console.log(element.parentNode.children[2].innerText);
       
       document.getElementById("editNoteTitle").value = element.parentNode.children[0].innerText;
       document.getElementById("editNoteBody").value = element.parentNode.children[1].innerText;
       document.getElementById("note_id").value = element.parentNode.children[2].innerText;
       
       
     })
   })

   let delBtns = document.getElementsByClassName("delBtn");
   
   Array.from(delBtns).forEach(element => {
      element.addEventListener("click", () =>{
      document.getElementById("delNoteId").value = element.parentNode.children[2].innerText;  
    })
  })

   














