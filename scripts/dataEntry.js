var itemCount = 0;

function addItem() {
    //Increase form by one row to accomodate new item requested

    var insertionPoint = document.getElementById("myForm");

    var original = document.getElementById("item");
    var clone = original.cloneNode(true);//Deep Clone
    //Increase item count
    itemCount++;
    clone.id = "item" + itemCount;
    insertionPoint.appendChild(clone);
}

function removeItem(toRemove) {
    //TODO Are you sure?
    var parentID = toRemove.parentNode.id;
    document.getElementById(parentID).remove();
}
