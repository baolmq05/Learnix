function processCreateSection(btnSection) {
  let form = btnSection.closest("form");

  let sectionName = form.querySelector(".section_name");
  let courseId = form.querySelector(".course_id");

  var formData = new FormData();
  formData.append("section_name", sectionName.value);
  formData.append("course_id", courseId.value);

  $.ajax({
    url: "/Controllers/Client/Ajax/AjaxSectionCreate.php",
    type: "POST",
    dataType: "json",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      let sectionList = response;
      renderNewSection(sectionList);

      sectionName.value = "";
    },

    error: function (xhr, status, error) {
      console.error("Lỗi AJAX:", error);
    },
  });
}

function renderNewSection(sectionList) {
  const sectionContainer = document.querySelector("#section_container");
  let newSection = createSectionElement(sectionList);
  sectionContainer.appendChild(newSection);
}

function createSectionElement(section) {
  const wrapper = document.createElement("div");

  wrapper.innerHTML = `
    <details class="p-4 bg-white border border-gray-300 rounded-xl shadow-sm">
      <summary class="font-semibold text-lg flex justify-between items-center cursor-pointer">
        <h2 class="section_name_title">${section.section_name}</h2>
        <div class="flex">
          <button onclick="toggleEditSection(${section.id})"
            type="button"
            class="ml-2 text-blue-600 hover:text-blue-800 cursor-pointer">
            <i class="bi bi-pencil-fill"></i>
          </button>
          <form action="">
            <input type="hidden" name="sectionId" class="section_id" value="${section.id}" />
            <button type="button" onclick="openDeleteSectionModal(this)" name="deleteSection" value="${section.id}"
              class="ml-2 text-red-600 hover:text-red-800 cursor-pointer">
              <i class="bi bi-trash3-fill"></i>
            </button>
          </form>
        </div>
      </summary>

      <form action="" id="section${section.id}"
            class="hidden mt-3 rounded-lg space-y-2">
                <input type="hidden" value="${section.course_id}">
                <input required
                  type="text"
                  name="chapter_name"
                  class="p-2 border rounded-md w-full"
                  value="${section.section_name}" />
                <small class="text-red-400 block"></small>
                <input class="section_id" type="hidden" value="${section.id}">
                <button type="button" onclick="updateSection(this)" class="cursor-pointer bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                  Cập nhật
                </button>
        <button type="button" onclick="toggleEditSection(${section.id})"
          class="cursor-pointer bg-gray-200 text-black px-3 py-2 rounded-md w-fit">
          Hủy
        </button>
      </form>

      <div class="mt-3 space-y-4">

  <!-- CONTAINER CHỨA DANH SÁCH BÀI HỌC -->
  <div id="lessonContainer${section.id}" class="space-y-4"></div>

  <!-- BUTTON THÊM BÀI HỌC MỚI -->
  <button 
    onclick="toggleAddLesson('${section.id}')"
    type="button"
    id="btnAddLesson${section.id}"
    class="p-2 border border-gray-300 rounded-lg bg-purple-100 text-purple-700 font-medium hover:bg-purple-200">
      Thêm bài học mới
  </button>

  <!-- FORM TẠO BÀI HỌC MỚI -->
  <form 
    id="newLessonForm${section.id}" 
    class="hidden mt-3 rounded-lg space-y-3"
    enctype="multipart/form-data">

    <div class="space-y-1">
      <label class="font-medium">Tên bài học</label>
      <input 
        type="text" 
        class="p-2 border rounded-md w-full input_lesson_name"
        placeholder="Nhập tên bài học" />
      <small class="text-red-400 name_lesson_error w-full"></small>
      <input type="hidden" class="input_section_id" value="${section.id}">
    </div>

    <div class="space-y-1">
      <label class="font-medium">Video bài học</label>
      <input 
        type="file" 
        class="p-2 border rounded-md w-full input_lesson_file" />
      <small class="text-red-400 video_lesson_error w-full"></small>
    </div>

    <!-- Progress + Success -->
    <div style="display:none;" class="message-success text-green-400 font-medium">
      <span>Hoàn thành</span>
    </div>

    <div style="display:none;" class="w-full relative main-progress">
      <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
        <span class="progressText text-sm font-semibold text-white">0%</span>
      </div>
      <div class="progressBar relative h-5 bg-gray-200 rounded-full overflow-hidden" style="--value: 0;">
        <div class="h-full bg-green-400 rounded-full relative overflow-hidden transition-all duration-500 ease-out"
             style="width: calc(var(--value) * 1%);">
          <div class="absolute inset-0 animate-shimmer z-0"
               style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center">
      <button 
        type="button" 
        onclick="processCreateLesson(this)"
        class="bg-purple-700 text-white px-3 py-2 rounded-md w-fit">
        Thêm bài học
      </button>

      <div style="display:none;" 
        class="spinner w-6 h-6 border-4 border-gray-200 border-t-green-600 rounded-full animate-spin"
        aria-label="Loading">
      </div>
    </div>

  </form>

</div>
    </details>
  `;

  return wrapper.firstElementChild;
}

function updateSection(btnCurrent) {
  let sectionMainName = getSummaryElement(btnCurrent);

  let sectionIdInput = btnCurrent.previousElementSibling;
  let sectionNameInput = sectionIdInput.previousElementSibling.previousElementSibling;
  let errorSection = sectionIdInput.previousElementSibling;
  let courseIdInput = sectionNameInput.previousElementSibling;

  var formData = new FormData();
  formData.append("section_name", sectionNameInput.value);
  formData.append("section_id", sectionIdInput.value);
  formData.append("course_id", courseIdInput.value);

  if (sectionNameInput.value == "") {
    errorSection.innerHTML = "Không được để trống";
    return;
  } else {
    errorSection.innerHTML = "";
  }

  $.ajax({
    url: "/Controllers/Client/Ajax/AjaxSectionUpdate.php",
    type: "POST",
    // dataType: "json",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      if (response == true) {
        sectionMainName.innerText = sectionNameInput.value;
        sectionNameInput.blur();
        showUpdateSectionAlert();
      } else {
        alert("Cập nhật thất bại!!!");
      }
    },

    error: function (xhr, status, error) {
      console.error("Lỗi AJAX:", error);
    },
  });
}

function showUpdateSectionAlert() {
    const alertBox = document.getElementById("alert_update_section");

    alertBox.classList.remove("hidden");
    alertBox.classList.add("show");

    setTimeout(() => {
        alertBox.classList.remove("show");
        setTimeout(() => alertBox.classList.add("hidden"), 300);
    }, 3000);
}

function getSummaryElement(btn) {
  return btn.closest("details").querySelector(".section_name_title");
}

// ---------------------------------------------
// DELETE

let deleteSectionBtnTemp = null;

function openDeleteSectionModal(btn) {
  deleteSectionBtnTemp = btn;
  document.getElementById("deleteSectionModal").classList.remove("hidden");
  document.getElementById("deleteSectionModal").classList.add("flex");
}

function closeDeleteSectionModal() {
  deleteSectionBtnTemp = null;
  document.getElementById("deleteSectionModal").classList.add("hidden");
  document.getElementById("deleteSectionModal").classList.remove("flex");
}

function confirmDeleteSection() {
  if (!deleteSectionBtnTemp) return;

  processDeleteSection(deleteSectionBtnTemp);
  closeDeleteSectionModal();
}

function processDeleteSection(btnDeleteSection) {
  let form = btnDeleteSection.closest("form");
  let details = form.closest("details");

  let sectionId = form.querySelector(".section_id");

  var formData = new FormData();
  formData.append("section_id", sectionId.value);

  showGlobalLoading();

  $.ajax({
    url: "/Controllers/Client/Ajax/AjaxSectionDelete.php",
    type: "POST",
    // dataType: "json",
    data: formData,
    contentType: false,
    processData: false,

    success: function (response) {
      if (response == true) {
        details.remove();
        hideGlobalLoading();
        showDeleteSectionAlert();
      } else {
        alert("Xóa thất bại");
      }
    },

    error: function (xhr, status, error) {
      console.error("Lỗi AJAX:", error);
    },
  });
}

function showDeleteSectionAlert() {
    const alertBox = document.getElementById("alert_delete_section");

    alertBox.classList.remove("hidden");
    alertBox.classList.add("show");

    setTimeout(() => {
        alertBox.classList.remove("show");
        setTimeout(() => alertBox.classList.add("hidden"), 300);
    }, 3000);
}

function showGlobalLoading() {
    const loading = document.getElementById("globalLoading");
    loading.classList.remove("hidden");
    loading.classList.add("flex");
}

function hideGlobalLoading() {
    const loading = document.getElementById("globalLoading");
    loading.classList.add("hidden");
    loading.classList.remove("flex");
}