 let totalSeconds = 5 * 60; // 5 menit
    let currentSeconds = totalSeconds;
    let interval = null;
    const timerElement = document.getElementById("timer");

    function updateDisplay() {
      const minutes = Math.floor(currentSeconds / 60);
      const seconds = currentSeconds % 60;
      timerElement.textContent =
        `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function startTimer() {
      if (interval) return; // Jangan duplikat interval
      interval = setInterval(() => {
        if (currentSeconds > 0) {
          currentSeconds--;
          updateDisplay();
        } else {
          clearInterval(interval);
          interval = null;
          alert("Waktu selesai");
        }
      }, 1000);
    }

    function pauseTimer() {
      clearInterval(interval);
      interval = null;
    }

    function resetTimer() {
      pauseTimer();
      currentSeconds = totalSeconds;
      updateDisplay();
    }

    // Inisialisasi tampilan awal
    updateDisplay();

    // Event listeners
    document.getElementById("startBtn").addEventListener("click", startTimer);
    document.getElementById("pauseBtn").addEventListener("click", pauseTimer);
    document.getElementById("resetBtn").addEventListener("click", resetTimer);