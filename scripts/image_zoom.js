// Get the featured-img-modal
var featured_img_modal = document.getElementById("myModal");

// Get the image and insert it inside the featured-img-modal - use its "alt" text as a caption
var img = document.getElementById("featured-img-mobile");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  featured_img_modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the featured-img-modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the featured-img-modal
span.onclick = function() { 
  featured_img_modal.style.display = "none";
}