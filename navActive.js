var url = window.location.pathname;
var currentPage = document.getElementById('currentPgId').innerHTML;
function navActive() {
  if (currentPage.includes("Main")) {
    // off for now
  } else if (currentPage.includes("Gallery")) {
    document.getElementById('gallery_id').style.borderBottom = "3px solid rgb(65, 127, 184)";
    document.getElementById('gallery_id').style.fontWeight = "bolder";
  } else if (currentPage.includes("Contact")) {
    document.getElementById('contact_id').style.borderBottom = "3px solid rgb(65, 127, 184)";
    document.getElementById('contact_id').style.fontWeight = "bolder";
  } else if (currentPage.includes("About")) {
    document.getElementById('about_id').style.borderBottom = "3px solid rgb(65, 127, 184)";
    document.getElementById('about_id').style.fontWeight = "bolder";
  } else if (currentPage.includes("Login")) {
    document.getElementById('login_id').style.borderBottom = "3px solid rgb(65, 127, 184)";
    document.getElementById('login_id').style.fontWeight = "bolder";
  }
}
