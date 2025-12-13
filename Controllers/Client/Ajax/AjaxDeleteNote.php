<?php
session_start();
require_once '../../../Models/Note.php';
$userId = $_SESSION['client']['id'] ?? null;
$noteId = $_POST['noteId'] ?? null;
$lessonId = $_POST['lessonId'] ?? null;
$noteModel = new Note();
if (!$userId) {
    echo json_encode([
        "status" => "error",
        "message" => "Vui lòng đăng nhập để xóa ghi chú!"
    ]);
    exit;
}
if (empty($userId) || !isset($noteId)) {
    echo json_encode([
        "status" => "error",
        "message" => "Dữ liệu không hợp lệ!"
    ]);
    exit;
}
$deleteNote = $noteModel->deleteNote($noteId);
if ($deleteNote) {
    $noteList = $noteModel->getNotesByUserAndLesson($userId, $lessonId);
}
?>
<details class="group mb-6 rounded-xl border border-gray-400 bg-white overflow-hidden" onclick="pauseVideo()">

    <!-- SUMMARY -->
    <summary class="flex items-center justify-between px-5 py-4 cursor-pointer select-none hover:bg-gray-50">

        <div class="flex items-center gap-3">
            <i
                class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform duration-300 group-open:rotate-180"></i>

            <h4 class="font-medium text-sm sm:text-base text-gray-800">
                Thêm ghi chú tại
                <span class="ml-2 inline-block px-3 py-1 rounded-full border text-xs text-gray-700"
                    id="videoSecond"></span>
            </h4>
        </div>

        <i class="bi bi-plus text-lg text-gray-500"></i>
    </summary>

    <!-- CONTENT -->
    <div class="p-5 space-y-4">

        <!-- TEXTAREA -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">
                Nội dung ghi chú
            </label>
            <textarea id="content" rows="4" placeholder="Nhập nội dung ghi chú..." class="w-full rounded-lg border border-gray-300 p-3 text-sm
                       focus:outline-none focus:ring-2 focus:ring-gray-400
                       resize-none"></textarea>
        </div>

        <!-- ACTION -->
        <div class="flex justify-end gap-2">
            <button type="reset"
                class="px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                Hủy
            </button>

            <button type="button" onclick="addNote()" class="px-4 py-2 text-sm rounded-lg border border-gray-900
                       bg-gray-900 text-white hover:bg-gray-800">
                Lưu ghi chú
            </button>
        </div>

    </div>
</details>
<?php
if (!empty($noteList)):
    foreach ($noteList as $noteValue):
        ?>
        <div class="group relative border border-gray-200 p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition">

            <!-- NÚT SỬA + XÓA -->
            <div class="absolute top-3 right-3 flex gap-2">
                <button onclick="toggleEdit(this)" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button onclick="confirmDelete(<?= $noteValue['id'] ?>)" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </div>

            <!-- THỜI GIAN -->
            <p class="text-sm font-medium mb-2">
                Ghi chú tại
                <span
                    class="inline-block px-3 py-1 ml-1 rounded-full bg-black text-white text-xs cursor-pointer hover:bg-gray-800"
                    onclick="goToTime('<?= $noteValue['video_time'] ?>')">
                    <?= $noteValue["video_time"] ?? "" ?>
                </span>
            </p>

            <!-- NỘI DUNG -->
            <div class="note-content">
                <p class="text-gray-700 text-justify">
                    <?= $noteValue["content"] ?? "" ?>
                </p>
            </div>

            <!-- FORM SỬA (ẨN) -->
            <div class="note-edit hidden mt-5">
                <textarea id="updateNoteContent<?= $noteValue['id'] ?>"
                    class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-black"><?= $noteValue["content"] ?? "" ?></textarea>

                <div class="flex justify-end gap-2 mt-2">
                    <button onclick="toggleEdit(this)" class="px-4 py-1 text-sm rounded-lg border">
                        Hủy
                    </button>
                    <button onclick="editNote(<?= $noteValue['id'] ?>)"
                        class="px-4 py-1 text-sm rounded-lg bg-black text-white hover:bg-gray-800">
                        Lưu
                    </button>
                </div>
            </div>

            <!-- NGÀY TẠO -->
            <p class="mt-3 text-xs text-gray-400">
                <?= $noteValue["created_at"] ?? "" ?>
            </p>
        </div>

        <?php
    endforeach;
else:
    ?>
    <p class="mt-5">Chưa có ghi chú nào. Hãy thêm ghi chú mới bên dưới!</p>
    <?php
endif;
?>
</div>
<div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl p-6 w-[320px] text-center animate-fadeIn">
        <h3 class="text-lg font-semibold mb-2">Xác nhận xóa</h3>
        <p class="text-sm text-gray-500 mb-4">
            Bạn có chắc muốn xóa ghi chú này không?
        </p>

        <div class="flex justify-center gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded-lg border">
                Hủy
            </button>
            <button id="deleteNoteButton" onclick="deleteNote()" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Xóa
            </button>
        </div>
    </div>
</div>