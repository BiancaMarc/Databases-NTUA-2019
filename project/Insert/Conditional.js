//This script executes conditional logic
//It must be placed in the same directory as the html file

//initial values
document.getElementById("author-group").style.visibility='hidden';
document.getElementById("publisher-group").style.visibility='hidden';

function  myfunction1(val) {
  if(val=="Add New"){
	document.getElementById("author-group").style.visibility='visible';
  }
  else {
	document.getElementById("author-group").style.visibility='hidden';
  }
};
function myfunction2(val){
  if(val=="Add New"){
	document.getElementById("publisher-group").style.visibility='visible';
  } 
  else {
	document.getElementById("publisher-group").style.visibility='hidden';
  }
};