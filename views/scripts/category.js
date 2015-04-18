
function confirmDelete(e) {
    if(confirm("Are youe sure that you want to delete this record?")){
        return;
    }
    
    e.value = e.name = "junk";
}
