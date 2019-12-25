function People()
{
   document.getElementById("Modal-head").innerHTML = "People";
   document.getElementById("summernoteDiv").style.display = "none"
   document.getElementById("prompt").style.display = "block"
   document.getElementById("prompt").innerHTML = "Testing / Click here to assign to yourself";
   document.getElementById("Modal-footer").innerHTML = `
     <div class="modal-footer">
         <input class="btn btn-primary" type="submit" value="Save" onclick=savePeople()>
     </div>
     `;
}

function loadPeople(ticketId)
{

}

function savePeople(ticketId, userId)
{
    
}