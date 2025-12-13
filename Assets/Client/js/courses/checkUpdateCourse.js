function checkError(event) {
    let courseName = document.querySelector("#course_name");
    let category = document.querySelector("#category");
    let description = document.querySelector("#description");
    let benefit = document.querySelectorAll(".benefit");
    let customerObject = document.querySelectorAll(".customer_object");
    let regularPrice = document.querySelector("#regular_price");
    let discountedPrice = document.querySelector("#discounted_price");
    let imagePreview = document.querySelector(".image-preview");

    let courseNameError = document.querySelector("#course_name_error");
    let categoryError = document.querySelector("#category_error");
    let descriptionError = document.querySelector("#description_error");
    let benefitError = document.querySelector(".benefit-error");
    let customerObjectError = document.querySelector(".customerObj-error");
    let regularError = document.querySelector("#regular_error");
    let discountedError = document.querySelector("#discounted_error");
    let imageError = document.querySelector("#image_error");

    let isError = false;

    courseNameError.innerHTML = "";
    categoryError.innerHTML = "";

    if (courseName.value.trim() === "") {
        isError = true;
        courseNameError.innerHTML = "Tên khóa học không được để trống";
    }

    if (category.value.trim() == "") {
        isError = true;
        categoryError.innerHTML = "Category không được để trống";
    }

    if (description.value.trim() == "") {
        isError = true;
        descriptionError.innerHTML = "Mô tả không được để trống";
    } else {
        descriptionError.innerHTML = "";
    }

    let filledBenefit = Array.from(benefit).filter(item => item.value.trim() !== "");

    if (filledBenefit.length < 4) {
        isError = true;
        benefitError.innerText = "Ít nhất phải có 4 mục tiêu";
    } else {
        benefitError.innerText = "";
    }

    if (customerObject.length <= 1) {
        isError = true;
        customerObjectError.innerText = "Ít nhất phải có 1 đối tượng";
    }

    if (imagePreview.src == "http://localhost:3000/index.php?page=teacher&action=viewEditCourse") {
        isError = true;
        imageError.innerText = "Vui lòng chọn hình ảnh";
    } else {
        imageError.innerText = "";
    }

    // Kiểm tra giá gốc
    if (regularPrice.value.trim() === "") {
        isError = true;
        regularError.innerText = "Giá không được để trống";
    } else if (regularPrice.value < 49000) {
        isError = true;
        regularError.innerText = "Giá gốc phải lớn hơn hoặc bằng 49.000đ";
    } else {
        regularError.innerText = "";

        if (discountedPrice.value.trim() == "") {
            console.log("Rỗng sale");
        } else {
            if (discountedPrice.value < 0) {
                isError = true;
                discountedError.innerText = "Giá khuyến mãi phải lớn hơn 0";
            } else if (discountedPrice.value >= regularPrice.value) {
                isError = true;
                discountedError.innerText = "Giá khuyến mãi phải nhỏ hơn giá gốc";
            } else {
                discountedError.innerText = "";
            }
        }
    }

    if (isError) {
        showAlert(true);
        event.preventDefault();
    }
}

document.querySelector("#form_infor_course").addEventListener("submit", checkError);

function showAlert(isError) {
    if (isError == false) {
        document.querySelector("#alert_success").classList.remove("hidden");
        setTimeout(() => {
            document.querySelector("#alert_success").classList.add("hidden");
        }, 3000)
    } else {
        document.querySelector("#alert_danger").classList.remove("hidden");
        setTimeout(() => {
            document.querySelector("#alert_danger").classList.add("hidden");
        }, 3000)
    }
}