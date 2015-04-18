
function confirmDelete(e) {
    if(confirm("Are youe sure that you want to delete the record?")){
        return;
    }
    
    e.value = e.name = "junk";
}
