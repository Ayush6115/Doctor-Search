const hamburgerIcon = document.querySelector(".hamburger");
const dropdownMenu = document.querySelector(".dropdown-menu");

// Function to toggle the dropdown menu

function toggleMenu() {
  dropdownMenu.classList.toggle("show");
}

// Event listener for the hamburger icon click

hamburgerIcon.addEventListener("click", toggleMenu);

// Doctors functionality

function toggleList(list) {

  const allDoctorLists = document.querySelectorAll(".doctor-list");


  allDoctorLists.forEach(function (listElement) {
    if (list === "" || listElement.id === list + "-list") {
      listElement.style.display = "block";
    } else {
      listElement.style.display = "none";
    }
  });
}
