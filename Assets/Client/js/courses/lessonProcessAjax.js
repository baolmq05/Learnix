async function processCreateLesson(btnLesson) {
    let form = btnLesson.closest("form");
    let videoLength;

    let lessonName = form.querySelector(".input_lesson_name");
    let sectionId = form.querySelector(".input_section_id");
    let videoFile = form.querySelector(".input_lesson_file");

    // Checkerror
    let isError = false;
    let nameError = form.querySelector(".name_lesson_error");
    let videoError = form.querySelector(".video_lesson_error");
    const maxSize = 1.5 * 1024 * 1024 * 1024;

    if (lessonName.value == "") {
        isError = true;
        nameError.innerText = "Vui lòng điền tên bài học";
    } else {
        nameError.innerText = "";
    }

    if (videoFile.value == "") {
        isError = true;
        videoError.innerText = "Vui lòng chọn video bài học";
    } else {
        if (videoFile.files[0].type !== "video/mp4") {
            isError = true;
            videoError.innerText = "Vui lòng chọn file với đuôi là .mp4";
        } else if (videoFile.files[0].size >= maxSize) {
            videoError.innerText = "Quá dung lượng cho phép";
            videoFile.value = "";
        } else {
            let second = await getVideoDuration(videoFile);
            videoLength = formatVideoDuration(Number(second));
            videoError.innerText = "";
        }
    }

    if (isError) {
        return;
    }

    // UI
    let spinnerE = form.querySelector(".spinner");

    let progressMain = form.querySelector(".main-progress");
    let progressText = form.querySelector(".progressText");
    let progressBar = form.querySelector(".progressBar");
    let messageSuccess = form.querySelector(".message-success");

    // FORM
    var formData = new FormData();
    formData.append("lesson_name", lessonName.value);
    formData.append("section_id", sectionId.value);
    formData.append("videoFile", videoFile.files[0]);
    formData.append("videoLength", videoLength);
    formData.append("videoName", videoFile.files[0].name);

    // Turn On Spinner
    spinnerToggle(spinnerE, true);

    // Turn On Progress
    progressToggle(progressMain, true);
    setProgress(0, progressText, progressBar);

    // Turn Off Create Button
    btnLesson.disabled = true;
    btnLesson.classList.add("opacity-[0.5]");
    btnLesson.classList.add("cursor-not-allowed");

    // Readonly
    lessonName.disabled = true;
    videoFile.disabled = true;

    $.ajax({
        url: "/Controllers/Client/Ajax/AjaxLessonCreate.php",
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,

        success: function (response) {
            let lessonResult = response;
            let videoId = lessonResult["video_id"];
            let videoName = videoFile.files[0].name;

            getVideoInfo(progressMain, progressText, progressBar, videoId, messageSuccess, lessonName, videoFile, sectionId.value, lessonResult, videoName, btnLesson);
            spinnerToggle(spinnerE, false);
        },

        error: function (xhr, status, error) {
            console.error("AJAX ERROR", error);
            console.log("SERVER RESPONSE:", xhr.responseText);
        },
    });
}

async function processUpdateLesson(btnLessonUpdate) {
    let form = btnLessonUpdate.closest("form");
    const details = form.closest("details");
    let lessonNameTitle = details.querySelector(".lesson_name");

    let videoLength;
    let lessonName = form.querySelector(".lesson_name_update");
    let lessonId = form.querySelector(".lesson_id_update");
    let videoFile = form.querySelector(".lesson_video_update");
    let videoId = form.querySelector(".video_id_update");
    let videoIdInput = details.querySelector(".video_id_update");

    console.log(lessonName);
    console.log(lessonId);
    console.log(videoFile);

    // Checkerror
    let isError = false;
    let nameError = form.querySelector(".name_lesson_error");
    let videoError = form.querySelector(".video_lesson_error");
    const maxSize = 1.5 * 1024 * 1024 * 1024;

    if (lessonName.value == "") {
        isError = true;
        nameError.innerText = "Vui lòng điền tên bài học";
    } else {
        nameError.innerText = "";
    }

    if (videoFile.value != "") {
        if (videoFile.files[0].type !== "video/mp4") {
            isError = true;
            videoError.innerText = "Vui lòng chọn file với đuôi là .mp4";
        } else if (videoFile.files[0].size >= maxSize) {
            videoError.innerText = "Quá dung lượng cho phép";
            videoFile.value = "";
        } else {
            let second = await getVideoDuration(videoFile);
            videoLength = formatVideoDuration(Number(second));
            videoError.innerText = "";
        }
    } else {
        videoError.innerText = "";
    }

    if (isError) {
        return;
    }

    // UI
    let spinnerE = form.querySelector(".spinner");

    let progressMain = form.querySelector(".main-progress");
    let progressText = form.querySelector(".progressText");
    let progressBar = form.querySelector(".progressBar");
    let messageSuccess = form.querySelector(".message-success");

    if (videoFile.value != "") {
        // FORM
        var formData = new FormData();
        formData.append("lesson_name", lessonName.value);
        formData.append("lesson_id", lessonId.value);

        formData.append("videoId", videoId.value);
        formData.append("videoFile", videoFile.files[0]);
        formData.append("videoLength", videoLength);
        formData.append("videoName", videoFile.files[0].name);

        // Turn On Spinner
        console.log(spinnerE);
        spinnerToggle(spinnerE, true);

        // Turn On Progress
        progressToggle(progressMain, true);
        setProgress(0, progressText, progressBar);

        // Turn Off Update Button
        btnLessonUpdate.disabled = true;
        btnLessonUpdate.classList.add("opacity-[0.5]");
        btnLessonUpdate.classList.add("cursor-not-allowed");

        // Readonly
        lessonName.disabled = true;
        videoFile.disabled = true;

        $.ajax({
            url: "/Controllers/Client/Ajax/AjaxLessonUpdate.php",
            type: "POST",
            // dataType: "json",
            data: formData,
            contentType: false,
            processData: false,

            success: function (response) {
                let newVideoId = response;

                // let newVideoId = resultVideoId;
                let videoName = videoFile.files[0].name;
                let videoNameInput = details.querySelector(".video_name_class");
                let reviewBtn = details.querySelector(".review_btn");

                console.log(videoNameInput);
                console.log(lessonNameTitle);

                getVideoInfoUpdate(progressMain, progressText, progressBar, newVideoId, messageSuccess, lessonName, videoFile, videoName, btnLessonUpdate, lessonNameTitle, videoNameInput, reviewBtn, videoIdInput);
                spinnerToggle(spinnerE, false);
            },

            error: function (xhr, status, error) {
                console.error("Lỗi AJAX:", error);
            },
        });
    } else {
        $.ajax({
            url: "/Controllers/Client/Ajax/AjaxLessonUpdate.php",
            type: "POST",
            dataType: "json", // nếu PHP trả JSON
            data: {
                lessonName: lessonName.value,
                lessonId: lessonId.value
            },

            success: function (response) {
                if (response) {
                    lessonNameTitle.innerText = lessonName.value;
                }
            },

            error: function (xhr, status, error) {
                console.error("Lỗi AJAX:", error);
                console.log("Response từ server:", xhr.responseText);
            }
        });
    }
}

async function processDeleteLesson(btnLessonDelete) {
    let confirmResult = confirm("Chắc chắn xóa?");

    if (!confirmResult) return;

    let form = btnLessonDelete.closest("form");
    let details = form.closest("details");
    let videoIdInput = details.querySelector(".video_id_update");
    let lessonIdInput = details.querySelector(".lesson_id_update");

    $.ajax({
        url: "/Controllers/Client/Ajax/AjaxLessonDelete.php",
        type: "POST",
        // dataType: "json",
        data: {
            videoId: videoIdInput.value,
            lessonId: lessonIdInput.value
        },
        success: function (res) {
            if (res == true) {
                details.remove();
                alert("Xóa thành công!!!");
            }
        },
        error: function (xhr, status, error) {
            console.log("Lỗi:", error);
        },
    });
}

function getVideoDuration(inputFile) {
    return new Promise((resolve, reject) => {
        const file = inputFile.files[0];
        if (!file) return reject("Không có file");

        const url = URL.createObjectURL(file);
        const video = document.createElement("video");

        video.preload = "metadata";
        video.src = url;

        video.onloadedmetadata = () => {
            URL.revokeObjectURL(url);
            resolve(video.duration);
        };

        video.onerror = () => {
            reject("File không phải video hợp lệ");
        };
    });
}

function formatVideoDuration(duration) {
    const sec = Math.floor(duration);

    const hours = Math.floor(sec / 3600);
    const minutes = Math.floor((sec % 3600) / 60);
    const seconds = sec % 60;

    return (
        String(hours).padStart(2, "0") + ":" +
        String(minutes).padStart(2, "0") + ":" +
        String(seconds).padStart(2, "0")
    );
}

function getVideoInfoUpdate(progressMain, progressText, progressBar, videoId, messageSuccess, lessonName, videoFile, videoName, uploadButton, lessonNameTitle, videoNameInput, reviewBtn, videoIdInput) {
    const interval = setInterval(() => {
        $.ajax({
            url: "/Controllers/Client/Ajax/AjaxLessonProgress.php",
            type: "POST",
            dataType: "json",
            data: { videoId: videoId },
            success: function (res) {
                let encodeProgress = Number(res.encodeProgress);

                setProgress(encodeProgress, progressText, progressBar);

                if (encodeProgress >= 100) {
                    clearInterval(interval);
                    encodeProgress = 100;

                    // Update Lesson
                    lessonNameTitle.innerText = lessonName.value;
                    videoNameInput.innerText = videoName;

                    // Reset Button Review
                    reviewBtn.onclick = () => openVideoPopup(videoId);

                    // Reset input
                    videoIdInput.value = videoId;

                    console.log(videoIdInput.value);

                    videoFile.value = "";
                    lessonName.disabled = false;
                    videoFile.disabled = false;
                    uploadButton.disabled = false;
                    uploadButton.classList.remove("opacity-[0.5]");
                    uploadButton.classList.remove("cursor-not-allowed");

                    // Reset bar
                    setProgress(0, progressText, progressBar);
                    // Turn off bar
                    progressToggle(progressMain, false);
                    // Show Message
                    messageSuccess.style.display = "block";
                    setTimeout(() => {
                        messageSuccess.style.display = "none";
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                console.log("Lỗi:", error);
            },
        });
    }, 1000);
}

function getVideoInfo(
    progressMain, progressText, progressBar, videoId, messageSuccess,
    lessonName, videoFile, sectionId, lessonObj, videoName, uploadButton
) {

    let lastErrorTime = 0;   // Dùng để tránh spam lỗi liên tục trong console

    const interval = setInterval(() => {

        $.ajax({
            url: "/Controllers/Client/Ajax/AjaxLessonProgress.php",
            type: "POST",
            dataType: "json",
            data: { videoId: videoId },

            success: function (res) {

                let encodeProgress = Number(res.encodeProgress);
                setProgress(encodeProgress, progressText, progressBar);

                if (encodeProgress >= 100) {
                    clearInterval(interval);

                    // Render new lesson
                    renderNewLession(sectionId, lessonName.value, videoId, lessonObj, videoName);

                    // Reset input
                    lessonName.value = "";
                    videoFile.value = "";
                    lessonName.disabled = false;
                    videoFile.disabled = false;
                    uploadButton.disabled = false;
                    uploadButton.classList.remove("opacity-[0.5]");
                    uploadButton.classList.remove("cursor-not-allowed");

                    // Reset bar
                    setProgress(0, progressText, progressBar);

                    // Turn off bar
                    progressToggle(progressMain, false);

                    // Show success message
                    messageSuccess.style.display = "block";
                    setTimeout(() => {
                        messageSuccess.style.display = "none";
                    }, 3000);
                }
            },

            error: function (xhr, status, error) {

                // Chỉ log lỗi 1 lần mỗi 3 giây → đỡ spam console
                const now = Date.now();
                if (now - lastErrorTime > 3000) {
                    console.log("Lỗi API progress:", error);
                    lastErrorTime = now;
                }

                // Không dừng interval vì đây là realtime → server có thể trả lỗi tạm thời
            },

        });

    }, 1000);
}

function spinnerToggle(spinnerE, isOn) {
    if (isOn) spinnerE.style.display = "block";
    else spinnerE.style.display = "none";
}

function progressToggle(progressBarE, isOn) {
    if (isOn) progressBarE.style.display = "block";
    else progressBarE.style.display = "none";
}

function setProgress(currentValue, progressText, progressBar) {
    progressText.innerText = currentValue + "%";
    progressBar.style.setProperty("--value", currentValue);
}

function renderNewLession(sectionId, lessonName, videoId, lessonObj, videoName) {
    const container = document.getElementById(`lessonContainer${sectionId}`);
    if (!container) return;

    container.insertAdjacentHTML("beforeend", createLessonElement(lessonName, videoId, lessonObj, videoName));
}

function createLessonElement(lessonName, videoId, lessonObj, videoName) {
    return `
    <details class="p-3 border border-gray-200 rounded-lg bg-white">
      <summary class="font-medium flex justify-between items-center cursor-pointer">
        <p class="lesson_name">${lessonName}</p>
        <div class="flex gap-2">
          <button onclick="toggleEditLesson(${lessonObj.lesson_id})"
            type="button"
            class="ml-2 text-blue-600 hover:text-blue-800">
            <i class="bi bi-pencil-fill"></i>
          </button>
          
          <form action="">
            <input type="hidden" name="videoId" />
            <button type="button" name="deleteLesson" onclick="processDeleteLesson(this)" class="ml-2 text-red-600 hover:text-red-800">
              <i class="bi bi-trash3-fill"></i>
            </button>
          </form>
        </div>
      </summary>

      <div class="mt-3 space-y-2">
        <p class="video_name_class"><strong>Video:</strong> ${videoName ?? '—'}</p>

        <button type="button"
          onclick="openVideoPopup('${videoId}')"
          class="bg-purple-500 text-white p-2 rounded-sm hover:opacity-80 review_btn">
          Xem trước
        </button>
        <form id="lesson${lessonObj.lesson_id}" class="hidden mt-3 rounded-lg space-y-2"
            enctype="multipart/form-data">
            <div class="space-y-1">
                <label class="font-medium">Cập nhật tên bài học</label>
                <input
                type="text"
                name="lesson_name_update"
                class="p-2 border rounded-md w-full lesson_name_update"
                value="${lessonName}" />
                <small class="text-red-400 name_lesson_error w-full"></small>
            </div>

            <div class="space-y-1">
                <label class="font-medium">Cập nhật video</label>
                <input
                type="file"
                name="file"
                class="border p-2 rounded-md w-full lesson_video_update" />
                <small class="text-red-400 video_lesson_error w-full"></small>
                <input type="hidden" class="lesson_id_update" value="${lessonObj.lesson_id}">
                <input type="hidden" class="video_id_update" value="${videoId}">
            </div>

            <div style="display: none;" class="message-success text-green-400 font-medium">
                                                        <span>Hoàn thành</span>
                                                    </div>

                                                    <div style="display: none;" class="w-full relative main-progress">
                                                        <!-- Text phần trăm nằm trên cùng -->
                                                        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                                                            <span class="progressText text-sm font-semibold text-white">
                                                                60%
                                                            </span>
                                                        </div>

                                                        <!-- Progress bar -->
                                                        <div
                                                            class="progressBar relative h-5 bg-gray-200 rounded-full overflow-hidden"
                                                            style="--value: 60;">
                                                            <!-- Progress value -->
                                                            <div
                                                                class="h-full bg-green-400 rounded-full relative overflow-hidden transition-all duration-500 ease-out"
                                                                style="width: calc(var(--value) * 1%);">
                                                                <!-- Shimmer -->
                                                                <div
                                                                    class="absolute inset-0 animate-shimmer z-0"
                                                                    style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);"></div>
                                                            </div>
                                                        </div>
                                                    </div>

            <div class="flex justify-between items-center">
                <div>
                <button type="button"
                onclick="processUpdateLesson(this)"
                class="bg-blue-600 text-white px-3 py-2 rounded-md w-fit">
                    Lưu cập nhật
                </button>
                <button
                type="button"
                onclick="toggleEditLesson(${lessonObj.lesson_id})"
                class="bg-gray-200 text-black px-3 py-2 rounded-md w-fit">
                    Hủy
                </button>
            </div>
            <div style="display: none;" class="spinner w-6 h-6 border-4 border-gray-200 border-t-green-600 rounded-full animate-spin" role="status" aria-label="Loading">
                <span class="sr-only">Loading...</span>
            </div>
            </div>
        </form>
      </div>
    </details>
  `;
}