var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab


function showTab(n) {
  // This function will display the specified tab of the form ... this is list
  var x = document.getElementsByClassName("tab");
  console.log(x);

  if (0 === x.length) {
      return
  }

  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }

  console.log(currentTab);
  // Otherwise, display the correct tab:
  showTab(currentTab);
}


function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("circle");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" activestep", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " activestep";
}

function questionType(n) {
  let x = document.getElementsByClassName('type');
  let y = document.getElementsByClassName("typebtn");
  
  if (n == 1) {
      x[0].style.display = 'block';
      y[0].className += " activebtn";
      x[1].style.display = 'none';
      y[1].classList.remove("activebtn");
  }
  if (n == 2) {
    x[1].style.display = 'block';
    y[1].className += " activebtn";
    x[0].style.display = 'none';
    y[0].classList.remove("activebtn");
}
}
