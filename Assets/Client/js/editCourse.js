
    function addBenefitField() {
      const newInput = document.createElement("input");
      newInput.type = "text";
      newInput.name = "benefit[]";
      newInput.className =
        "border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white";
      newInput.placeholder = "Ví dụ: Mục tiêu học tập bổ sung";
      const form = document.querySelector("form");
      form.insertBefore(newInput, form.querySelector("button").parentNode);
      disabledButtonAdd();
    }
    // Disable add button if any input is empty
    document.addEventListener("input", disabledButtonAdd);
    function disabledButtonAdd() {
      let addButton = document.getElementById("addButtonBenefit");
      let inputFields = document.querySelectorAll('input[name="benefit[]"]');
      let allFilled = true;
      inputFields.forEach((field) => {
        if (field.value === "") {
          allFilled = false;
          return;
        }
      });
      addButton.disabled = !allFilled;
    }
    function addCustomerObjectField() {
      const newInput = document.createElement("input");
      newInput.type = "text";
      newInput.name = "customer_object[]";
      newInput.className =
        "border mt-3 border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white";
      newInput.placeholder = "Ví dụ: Đối tượng học viên bổ sung";
      const form = document.querySelector("form");
      form.insertBefore(
        newInput,
        form.querySelectorAll("button")[1].parentNode
      );
      disabledButtonAddCustomer();
    }
    document.addEventListener("input", disabledButtonAddCustomer);
    function disabledButtonAddCustomer() {
      let addButton = document.getElementById("addButtonCustomer");
      let inputFields = document.querySelectorAll(
        'input[name="customer_object[]"]'
      );
      let allFilled = true;
      inputFields.forEach((field) => {
        if (field.value === "") {
          allFilled = false;
          return;
        }
      });
      addButton.disabled = !allFilled;
    }
    const file = document.getElementById("avatar");
    const preview = document.getElementById("preview");
    const placeholder = document.getElementById("placeholder");

    file.addEventListener("change", (e) => {
      const img = e.target.files[0];
      if (!img) return;

      preview.src = URL.createObjectURL(img);
      preview.classList.remove("hidden");
      placeholder.classList.add("hidden");
    });
    function hiddenPrice() {
      const isFree = document.getElementById("free").checked;
      const boxPrice = document.getElementById("boxPrice");
      const regular = document.getElementById("regular_price");
      const discount = document.getElementById("discounted_price");

      if (isFree) {
        boxPrice.style.display = "none";

        regular.value = "";
        discount.value = "";
      } else {
        boxPrice.style.display = "grid";
        regular.disabled = false;
        discount.disabled = false;
      }
    }
    function hiddenFormSection() {
      const button = document.getElementById("buttonHiddenForm");
      const formSection = document.getElementById("formSection");
      if (formSection.style.display === "none") {
        formSection.style.display = "block";
        button.innerText = "Ẩn thêm chương mới";
      } else {
        formSection.style.display = "none";
        button.innerText = "Thêm chương mới";
      }
    }
    function showEditBox() {
      const editBox = document.getElementById("editBox");
      if (editBox.classList.contains("hidden")) {
        editBox.classList.remove("hidden");
      } else {
        editBox.classList.add("hidden");
      }
    }
    function toggleEditSection(id) {
      document.getElementById("section" + id).classList.toggle("hidden");
    }

    function toggleEditLesson(id) {
      document.getElementById("lesson" + id).classList.toggle("hidden");
    }

    function toggleAddLesson(id) {
      document.getElementById("newLessonForm" + id).classList.toggle("hidden");
      addLessonButton = document.getElementById("btnAddLesson" + id);
      if (addLessonButton.innerText === "Thêm bài học mới") {
        addLessonButton.innerText = "Ẩn thêm bài học mới";
      } else {
        addLessonButton.innerText = "Thêm bài học mới";
      }
    }
