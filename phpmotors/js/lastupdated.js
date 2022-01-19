//shows date last modified and current year
const dateTimeObject = new Date();
const fullYear = dateTimeObject.getFullYear();
const monthName = dateTimeObject.toLocaleString('default',{month:'long'}); 
const day = dateTimeObject.getDate();
document.getElementById("lastUpdated").textContent = day + ' ' + monthName + ', ' + fullYear;