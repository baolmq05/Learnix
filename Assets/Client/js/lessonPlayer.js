    const guideSteps = [
      {
        element: "#lesson-one",
        title: "Bài học đầu tiên",
        desc: "Đây là bài học đầu tiên của bạn.",
      },
      {
        element: "#lesson-two",
        title: "Bài học thứ hai",
        desc: "Đây là bài học thứ hai của bạn.",
      },
      {
        element: "#video-player",
        title: "Video bài học",
        desc: "Tại đây bạn xem video bài giảng theo từng bài học.",
      },
      {
        element: "#tab-notes",
        title: "Ghi chú bài học",
        desc: "Tính năng giúp bạn ghi chép lại nội dung quan trọng.",
      },
      {
        element: "#tab-review",
        title: "Đánh giá khóa học",
        desc: "Bạn xem đánh giá từ học viên khác để hiểu thêm về chất lượng khóa học.",
      },
    ];

    let currentStep = 0;

    // When user clicks "Hướng dẫn" button, show intro modal first
    function tutorialPopup() {
      const backdrop = document.getElementById('intro-modal-backdrop');
      if (!backdrop) {
        // fallback: begin immediately if modal is missing
        currentStep = 0;
        showGuide();
        return;
      }
      backdrop.classList.remove('hidden');
      backdrop.classList.add('flex');
    }

    // Called when user confirms to actually start the guide
    function beginGuide() {
      const backdrop = document.getElementById('intro-modal-backdrop');
      if (backdrop) {
        backdrop.classList.add('hidden');
        backdrop.classList.remove('flex');
      }
      currentStep = 0;
      showGuide();
    }

    // Cancel intro modal — attach handlers now or on DOMContentLoaded
    (function attachIntroHandlers(){
      function attach(){
        const startBtn = document.getElementById('intro-start');
        const cancelBtn = document.getElementById('intro-cancel');
        if (startBtn) startBtn.addEventListener('click', beginGuide);
        if (cancelBtn) cancelBtn.addEventListener('click', () => {
          const backdrop = document.getElementById('intro-modal-backdrop');
          if (backdrop) {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
          }
        });
      }
      if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', attach);
      else attach();
    })();

    function showGuide() {
      const step = guideSteps[currentStep];
      const target = document.querySelector(step.element);

      if (!target) return endGuide();

      const overlay = document.getElementById("guide-overlay");
      const highlight = document.getElementById("guide-highlight");
      const tooltip = document.getElementById("guide-tooltip");

      overlay.classList.remove("hidden");
      highlight.classList.remove("hidden");
      tooltip.classList.remove("hidden");

      // Scroll tới vị trí của đối tượng
      target.scrollIntoView({ behavior: "smooth", block: "center" });

      setTimeout(() => {
        const rect = target.getBoundingClientRect();

        // Vị trí highlight
        highlight.style.top = rect.top - 10 + "px";
        highlight.style.left = rect.left - 10 + "px";
        highlight.style.width = rect.width + 20 + "px";
        highlight.style.height = rect.height + 20 + "px";

        // Vị trí tooltip
        tooltip.style.top = rect.bottom + 15 + "px";
        tooltip.style.left = rect.left + "px";

        document.getElementById("guide-title").innerText = step.title;
        document.getElementById("guide-desc").innerText = step.desc;
      }, 350);
    }

    document.getElementById("guide-next").onclick = () => {
      currentStep++;
      if (currentStep >= guideSteps.length) endGuide();
      else showGuide();
    };

    function endGuide() {
      document.getElementById("guide-overlay").classList.add("hidden");
      document.getElementById("guide-highlight").classList.add("hidden");
      document.getElementById("guide-tooltip").classList.add("hidden");
    }
