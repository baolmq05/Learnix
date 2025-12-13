   // Nếu nội dung ít hơn hoặc bằng 8 dòng, ẩn nút xem thêm
  const infoDiv = document.querySelector('.teacher-information');
  const lineHeight = parseFloat(getComputedStyle(infoDiv).lineHeight);
  const maxHeight = lineHeight * 8; // 8 dòng
  if (infoDiv.scrollHeight <= maxHeight) {
    document.getElementById('toggleInfo').style.display = 'none';
  }
  document.getElementById('toggleInfo').addEventListener('click', function() {
    const infoDiv = document.querySelector('.teacher-information');
    infoDiv.classList.toggle('expanded');
    if (infoDiv.classList.contains('expanded')) {
      this.textContent = 'Thu gọn';
    } else {
      this.textContent = 'Xem thêm';
    }
  });