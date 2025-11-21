    let course_name = document.getElementById('course_name');
    let category = document.getElementById('category');
    let continueButton = document.getElementById('continueButton');
    function disabledButton(){
        if(course_name.value == '' || category.value == ''){
            continueButton.disabled = true;
        }else{
            continueButton.disabled = false;
        }
    }