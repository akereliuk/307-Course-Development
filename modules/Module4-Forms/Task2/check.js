/*
 * check.js
 *
 * checkFormData(form)
 *
 *  This will check the data in the form (object passed as a parameter to this function)
 *  and flag the input field with the CSS error class, display a pop-up alert window, 
 *  and return false if the data is not valid, or true of the data is OK
 */

function checkFormData(form) {

  var errors = [];
  if (form.elements['name'].value.length < 5) { 
      errors.push("What is your name (optional)?");
      document.getElementById('name').className += ' error';
    } else {
      document.getElementById('name').classList.remove('error');
  } 
  if (form.elements['major'].value.length == 0) { 
      errors.push("What is your major program of study?");
      document.getElementById('major').className += ' error';
    } else {
      document.getElementById('major').classList.remove('error');
  } 
  radios = document.getElementsByName('hours');  
  numChecked = 0;  
  for(index=0; index < radios.length; index++) { 
    if (radios[index].checked) numChecked++; 
  } 
  if (numChecked == 0) { 
      errors.push("How many hours a day do you spend on the computer?");
      document.getElementById('hours').className += ' error';
    } else {
      document.getElementById('hours').classList.remove('error');
  } 
  boxes = document.getElementsByName('media[]');  
  numChecked = 0;  
  for(index=0; index < boxes.length; index++) { 
    if (boxes[index].checked) numChecked++; 
  } 
  if (numChecked < 2) { 
      errors.push("What are your two favourite social media sites?");
      document.getElementById('media').className += ' error';
    } else {
      document.getElementById('media').classList.remove('error');
  } 
  if(errors.length != 0){
	alert(errors.join('\n'));
    return false;
  } else {
    return true;
  }
}