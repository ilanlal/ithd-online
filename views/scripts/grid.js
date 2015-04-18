var selectedRecords = [];

function newRecord(url) {
	var win = window.open(url);
	
}

function deleteSelectedRecords(e) {
	for(i=0;i<selectedRecords.length;i++) {
		var id = selectedRecords[i];
		var recorde = document.getElementById(id);
		delete_url = recorde.children[0].children["delete_url"].value;
		$.get(delete_url,hideRecod(selectedRecords[i])); 
	}
}

function hideRecod(id) {
	var e = document.getElementById(id);
	if(e) {
		e.style.display = "none";
	}
}

function refresh() {
	alert(selectedRecords);
}

function selectRow(e,id) {
	if(e.checked) {
		selectedRecords.push(id);
	}
	else {
		selectedRecords.splice(selectedRecords.indexOf(id),1);
	}
}