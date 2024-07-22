document.addEventListener("DOMContentLoaded", function() {
  var sections = document.querySelectorAll("main > div.item_header");
  var navigationLinks = document.querySelectorAll("#sticky-menu a");

  window.addEventListener("scroll", function() {
    var currentSection = "";

    sections.forEach(function(section) {
      var sectionTop = section.offsetTop;
      var sectionHeight = section.offsetHeight;

      if (pageYOffset >= sectionTop - sectionHeight / 2) {
        currentSection = section.getAttribute("id");
      }
    });

    navigationLinks.forEach(function(link) {
      link.classList.remove("active");
      if (link.getAttribute("href").slice(1) === currentSection) {
        link.classList.add("active");
      }
    });
  });
});
