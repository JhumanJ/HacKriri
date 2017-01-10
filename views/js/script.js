/**
 * Created by Julien on 30/01/16.
 */

//functions

//-------Functions for forms-------

function isEmpty( el ){
    return !$.trim(el)
}

function checkLenght(givenString,a,z){
    if(givenString.length>=a && givenString.length<=z ) {
        return true;
    }
    return false;
}