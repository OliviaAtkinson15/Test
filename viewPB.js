/**
 * Name: ILOANUGO ONYINYE
 * StudentId: 2009808
 * CourseCode: CMM004
 * Course: Software Engineering Project
 * 
 */


/**   DRAG AND DROP FOR SPRINT 3
 * * 
 * 
 * 
 * 
 */

//use javascript to put the PB according to priority
const dragArea = document.querySelector(".vertical-menu");

function dragStart(ev) {
    ev.dataTransfer.setData("text",ev.target.id);
}