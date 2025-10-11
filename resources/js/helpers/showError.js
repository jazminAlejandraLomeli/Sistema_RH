export const showErrors = (fields, errors)=>{
    // Clear previuos styles 
    Object.values(fields).forEach(field => {
    
        let span = field.nextElementSibling;
        
       if(span?.tagName !== 'SPAN') return;

       // Remove border error
       field.classList.remove('border-danger');       
       span.style.display = "none";

   });

   // If have errros show in the form
   Object.keys(errors).forEach(fieldName => {
       const field = fields[fieldName];       
       if (field) {           
           let span = field.nextElementSibling;

           if(span?.tagName !== 'SPAN') return;

           field.classList.add('border-danger');           
           span.textContent = errors[fieldName];
           span.style.display = "block";
       }
   });


  
}