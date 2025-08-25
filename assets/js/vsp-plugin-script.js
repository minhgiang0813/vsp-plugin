document
  .querySelector(".vsp-search-form")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = new FormData(this);
    formData.append("action", "vsp_antoan_search"); // Add the action

    fetch(vsp_ajax_object.ajaxurl, {
      // ajaxurl is a global variable in WordPress
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("result").innerHTML = data;
      })
      .catch((error) => {
        console.error("Error:", error);
        document.getElementById("result").innerHTML =
          "An error occurred during the search.";
      });
  });
