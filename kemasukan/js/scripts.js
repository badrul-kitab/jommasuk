/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector("#sidebarToggle");
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener("click", (event) => {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      localStorage.setItem(
        "sb|sidebar-toggle",
        document.body.classList.contains("sb-sidenav-toggled")
      );
    });
  }
});

// function RemoveForm() {
//   // Two places to customize:

//   // Specify the id of the form.
//   var IDofForm = "formpilihan";

//   // Specify the id of the div containing the form.
//   var IDofDivWithForm = "pilihanpelajar";

//   // This line submits the form. (If Ajax processed, call Ajax function, instead.)
//   document.getElementById(IDofForm).submit();

//   // This collapses the form.
//   document.getElementById(IDofDivWithForm).style.visibility = "hidden";
// }
