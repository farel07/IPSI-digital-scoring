console.log("listenEventsSeni.js loaded");

/**
 * Fungsi utama untuk memulai listener Pusher.
 */
function initializeListener(appKey, appCluster, pertandinganId) {
    if (!appKey || !appCluster || !pertandinganId) {
        console.error("Pusher Key, Cluster, atau ID Pertandingan tidak valid.");
        return;
    }

    Pusher.logToConsole = true;
    const pusher = new Pusher(appKey, {
        cluster: appCluster
    });

    const channelName = `kirim-poin-seni-channel-${pertandinganId}`;
    const eventName = `terima-poin-seni-${pertandinganId}`;

    const channel = pusher.subscribe(channelName);

    channel.bind('pusher:subscription_succeeded', () => {
        console.log(`✅ Berhasil subscribe ke channel "${channelName}"! Menunggu event...`);
    });

    channel.bind(eventName, (data) => {
        console.log("🎉 Event diterima!", data);
        updateScoreboard(data);
    });
}

/**
 * Fungsi pusat untuk menangani data event yang masuk.
 */
function updateScoreboard(data) {
    const { type, filter, poin, role } = data;

    if (filter === 'penilaian_tunggal_regu' && role.startsWith('juri-')) {
        const juriId = role.split('-')[1];

        if (type === 'wrong_move') {
            const cell = document.querySelector(`td[data-juri-id="${juriId}"][data-kategori="correctness_score"]`);
            if (cell) {
                const currentValue = parseFloat(cell.textContent) || 9.90;
                cell.textContent = (currentValue + poin).toFixed(2);
                cell.classList.add('bg-red-100', 'transition-colors', 'duration-500');
                setTimeout(() => cell.classList.remove('bg-red-100'), 1000);
            }
        } else if (type === 'flow_stamina') {
            const cell = document.querySelector(`td[data-juri-id="${juriId}"][data-kategori="flow_stamina"]`);
            if (cell) {
                cell.textContent = parseFloat(poin).toFixed(2);
                cell.classList.add('bg-yellow-100', 'transition-colors', 'duration-500');
                setTimeout(() => cell.classList.remove('bg-yellow-100'), 1000);
            }
        }
    }

    if (filter === 'penilaian_tunggal_regu' && role === 'dewan') {
        let penaltyType = type;
        if (type.startsWith('clear_')) {
            penaltyType = type.replace('clear_', '');
        }

        const cell = document.getElementById(`penalty-${penaltyType}`);
        if (cell) {
            const currentValue = parseFloat(cell.textContent) || 0;
            let newValue = currentValue + poin;
            if (newValue > 0) newValue = 0;

            cell.textContent = newValue.toFixed(2);
            if (newValue < 0) {
                cell.classList.add('text-red-600', 'font-bold');
            } else {
                cell.classList.remove('text-red-600', 'font-bold');
            }
        }
    }

    recalculateAll();
}

/**
 * Memanggil semua fungsi kalkulasi secara berurutan.
 */
function recalculateAll() {
    const judgeTotalScores = calculateAllJudgeTotals();
    const totalPenalty = calculateTotalPenalty();
    calculateAndDisplayFinalResults(judgeTotalScores, totalPenalty);
}

/**
 * Menghitung total skor untuk setiap juri.
 */
function calculateAllJudgeTotals() {
    const headers = document.querySelectorAll('th[id^="header-juri-"]');
    const totals = [];

    headers.forEach(header => {
        const juriId = header.id.split('-')[2];
        const correctnessCell = document.querySelector(`td[data-juri-id="${juriId}"][data-kategori="correctness_score"]`);
        const flowCell = document.querySelector(`td[data-juri-id="${juriId}"][data-kategori="flow_stamina"]`);
        const correctnessScore = parseFloat(correctnessCell.textContent) || 0;
        const flowScore = parseFloat(flowCell.textContent) || 0;
        const sum = correctnessScore + flowScore;
        const totalCell = document.getElementById(`total-juri-${juriId}`);
        if (totalCell) {
            totalCell.textContent = sum.toFixed(2);
        }
        totals.push(sum);
    });
    return totals;
}

/**
 * Menghitung total nilai penalti.
 */
function calculateTotalPenalty() {
    let total = 0;
    const penaltyCells = document.querySelectorAll('td[id^="penalty-"]');
    penaltyCells.forEach(cell => {
        total += parseFloat(cell.textContent) || 0;
    });
    const totalPenaltyCell = document.getElementById('total-penalty-value');
    if (totalPenaltyCell) {
        totalPenaltyCell.textContent = total.toFixed(2);
    }
    return total;
}

/**
 * Menghitung dan menampilkan semua hasil akhir dengan logika median yang baru.
 * @param {number[]} judgeTotals - Array skor total dari semua juri.
 * @param {number} totalPenalty - Nilai total penalti.
 */
function calculateAndDisplayFinalResults(judgeTotals, totalPenalty) {
    if (judgeTotals.length === 0) return;

    const sortedScores = [...judgeTotals].sort((a, b) => a - b);
    
    // --- LOGIKA MEDIAN YANG DIPERBARUI ---
    const midIndex = Math.floor(sortedScores.length / 2);
    let medianDisplay = '0.00';
    let medianAverage = 0;

    if (sortedScores.length % 2 === 0 && sortedScores.length > 1) {
        // Genap: tampilkan 2 nilai tengah dan hitung rata-ratanya
        const middle1 = sortedScores[midIndex - 1];
        const middle2 = sortedScores[midIndex];
        medianDisplay = `${middle1.toFixed(2)}, ${middle2.toFixed(2)}`;
        medianAverage = (middle1 + middle2) / 2;
    } else if (sortedScores.length > 0) {
        // Ganjil: nilai tengah adalah median dan rata-ratanya
        const middle = sortedScores[midIndex];
        medianDisplay = middle.toFixed(2);
        medianAverage = middle;
    }
    // --- AKHIR LOGIKA MEDIAN BARU ---

    // STANDARD DEVIATION (tetap sama)
    const mean = judgeTotals.reduce((acc, val) => acc + val, 0) / judgeTotals.length;
    const stdDev = Math.sqrt(judgeTotals.map(x => Math.pow(x - mean, 2)).reduce((a, b) => a + b, 0) / judgeTotals.length);
    
    // SKOR AKHIR (berdasarkan Rata-rata Median)
    const finalScore = medianAverage + totalPenalty;

    // UPDATE UI DENGAN NILAI BARU
    document.getElementById('median-value').textContent = medianDisplay;
    document.getElementById('median-average-value').textContent = medianAverage.toFixed(2);
    document.getElementById('judge-final-score').textContent = medianAverage.toFixed(2); // Final score judge adalah rata-rata median
    document.getElementById('std-dev-value').textContent = stdDev.toFixed(6);
    document.getElementById('final-result-score').textContent = finalScore.toFixed(2);
    document.getElementById('final-result-calculation').textContent = `Final Score (${medianAverage.toFixed(2)}) - Total Penalti (${Math.abs(totalPenalty).toFixed(2)})`;
}

// Inisialisasi perhitungan saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', () => {
    recalculateAll();
});