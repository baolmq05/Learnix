    <main>
      <div class="lg:w-[50%]  mx-auto mt-20 p-10">
        <p class="text-3xl font-bold text-center">Tạo khóa học mới</p>
        <p class="text-center mt-3">
          Hãy đặt tên và chọn chủ đề cho khóa học của bạn
        </p>
        <form action="">
          <div class="flex flex-col mt-5">
            <label for="course_name" class="text-[1.1rem]">Tên khóa học</label>
            <input
              type="text"
              name="course_name"
              id="course_name"
              class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
              placeholder="Nhập tên khóa học"
              oninput="disabledButton()"
            />
            <label for="category" class="text-[1.1rem] mt-2">Chọn chủ đề</label>
            <select
              name="category"
              id="category"
              class="border border-gray-300 focus:outline focus:outline-purple-500 p-2 rounded-md hover:bg-gray-100 focus:bg-white"
              onchange="disabledButton()"
            >
              <option value="" selected disabled>Vui lòng chọn ...</option>
              <option value="1">Lập trình web</option>
              <option value="2">Lập trình phần mềm</option>
              <option value="3">Lập trình mobile</option>
              <option value="4">Lập trình game</option>
            </select>
            <div class="flex justify-between">
              <button class="px-5 border border-purple-500 bg-white text-purple-700 hover:bg-purple-700 hover:text-white py-2 rounded-[5px] mt-8 hover:cursor-pointer">Quay lại</button>
              <button class="px-5 border border-gray-300 bg-purple-700 text-white hover:bg-purple-500 py-2 rounded-[5px] mt-8 hover:cursor-pointer disabled:bg-purple-300" id="continueButton" disabled>Tiếp tục</button>
            </div>
          </div>
        </form>
      </div>
    </main>