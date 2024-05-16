const detailsElements = document.querySelectorAll("details");

detailsElements.forEach(element => {
   element.addEventListener("click", () => {
      detailsElements.forEach(otherElement => {
         if (otherElement !== element) {
            otherElement.removeAttribute("open");
         }
      });
   });
});