(function AutosubmitCheckboxes() {
   let checkboxes = document.querySelectorAll('.auto-submit-cb')

   if (checkboxes) {
       checkboxes.forEach(cb => {
           cb.addEventListener('change', () => {
               cb.form.submit()
           })
       })
   }
})();