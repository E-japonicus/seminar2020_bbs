// Confirmation when form submit
function checkSubmit(){
	// Confirm nama
    if(document.bbs_post.name.value == "" || document.bbs_post.name.value.match(/^[ 　\r\n\t]*$/)) {
        alert("Please enter your name");
        return false;
    }
    // Confirm comment
    if(document.bbs_post.comment.value == "" || document.bbs_post.comment.value.match(/^[ 　\r\n\t]*$/)) {
        alert("Please enter your comment");
        return false;
    }
}

// Confirmation when deleting
function checkDelete(){
	if(window.confirm('Can I delete it?')){
		// When OK is pressed
		return true;
	} else{
		// When canceled
		window.alert('Delete canceled');
		return false;
	}

}
