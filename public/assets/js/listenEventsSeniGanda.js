console.log("listenEventsSeniGanda.js loaded");

// Konstanta dasar untuk perhitungan
const BASE_SCORE_GANDA = 9.10;

/**
 * Fungsi utama untuk memulai listener Pusher.
 */
function initializeListener(appKey, appCluster, pertandinganId) {
    if (!appKey || !appCluster || !pertandinganId) {
        console.error("Pusher Key, Cluster, atau ID Pertandingan tidak valid.");
        return;
    }

    Pusher.logToConsole = true;
    const pusher = new Pusher(appKey, { cluster: appCluster });

    const channelName = `kirim-poin-seni-channel-${pertandinganId}`;
    const eventName = `terima-poin-seni-${pertandinganId}`;

    const channel = pusher.subscribe(channelName);
    channel.bind('pusher:subscription_succeeded', () => console.log(`✅ Berhasil subscribe ke channel \"${channelName}\"!`));
    channel.bind(eventName, (data) => {
        console.log("🎉 Event diterima!", data);
        routeEvent(data);
    });
}

/**
 * Router untuk menentukan fungsi mana yang harus menangani event.
 */
function routeEvent(data) {
    switch (data.filter) {
        case 'penilaian_ganda':
            handleJudgeScoreGanda(data);
            break;
        case 'penilaian_hukuman_ganda':
            handlePenaltyScoreGanda(data);
            break;
        default:
            console.warn("Filter event tidak dikenali:", data.filter);
    }
}

// =====================================================================
// HANDLER DAN KALKULASI
// =====================================================================

function handleJudgeScoreGanda(data) {
    const juriId = data.role.split('-')[1];
    const kategori = data.type;
    const cell = document.querySelector(`td[data-juri-id=\"${juriId}\"][data-kategori=\"${kategori}\"]`);
    if (cell) {
        cell.textContent = parseFloat(data.poin).toFixed(2);
        cell.classList.add('bg-yellow-200');
        setTimeout(() => cell.classList.remove('bg-yellow-200'), 1000);
        recalculateAll();
    }
}

function handlePenaltyScoreGanda(data) {
    let penaltyType = data.type;
    const isClearAction = penaltyType.startsWith('clear_');
    if (isClearAction) {
        penaltyType = penaltyType.replace('clear_', '');
    }

    const cell = document.getElementById(`penalty-ganda-${penaltyType}`);
    if (cell) {
        const newValue = isClearAction ? 0 : data.poin;
        cell.textContent = newValue.toFixed(2);
        if (newValue < 0) {
            cell.classList.add('text-red-600', 'font-bold');
        } else {
            cell.classList.remove('text-red-600', 'font-bold');
        }
        recalculateAll();
    }
}

function recalculateAll() {
    const totalScores = calculateAllJudgeTotals();
    const totalPenalty = calculateTotalPenalty();
    updateSortedScoresUI(totalScores);
    calculateAndDisplayResults(totalScores, totalPenalty);
}

function calculateAllJudgeTotals() {
    const headers = document.querySelectorAll('th[id^=\"header-juri-\"]');
    const totals = [];

    headers.forEach(header => {
        const juriId = header.id.split('-')[2];
        const teknikCell = document.querySelector(`td[data-juri-id=\"${juriId}\"][data-kategori=\"teknik\"]`);
        const kekuatanCell = document.querySelector(`td[data-juri-id=\"${juriId}\"][data-kategori=\"kekuatan\"]`);
        const penampilanCell = document.querySelector(`td[data-juri-id=\"${juriId}\"][data-kategori=\"penampilan\"]`);
        
        const skorTeknik = parseFloat(teknikCell?.textContent) || 0;
        const skorKekuatan = parseFloat(kekuatanCell?.textContent) || 0;
        const skorPenampilan = parseFloat(penampilanCell?.textContent) || 0;

        const sum = skorTeknik + skorKekuatan + skorPenampilan;
        const total = BASE_SCORE_GANDA + sum;
        
        const totalCell = document.getElementById(`total-juri-${juriId}`);
        if (totalCell) totalCell.textContent = total.toFixed(2);
        totals.push(total);
    });
    return totals;
}

function calculateTotalPenalty() {
    let total = 0;
    const penaltyCells = document.querySelectorAll('td[id^=\"penalty-ganda-\"]');
    penaltyCells.forEach(cell => {
        total += parseFloat(cell.textContent) || 0;
    });
    const totalPenaltyCell = document.getElementById('total-penalty-ganda-value');
    if (totalPenaltyCell) totalPenaltyCell.textContent = total.toFixed(2);
    return total;
}

function updateSortedScoresUI(totalScores) {
    const container = document.getElementById('sorted-scores-container');
    if (!container) return;
    container.innerHTML = '';
    const sorted = [...totalScores].sort((a, b) => a - b);
    sorted.forEach(score => {
        const span = document.createElement('span');
        span.className = 'px-4 py-3 bg-white border border-gray-300 rounded-lg font-mono text-sm shadow-sm';
        span.textContent = score.toFixed(2);
        container.appendChild(span);
    });
}

function calculateAndDisplayResults(totalScores, totalPenalty) {
    if (totalScores.length === 0) {
        // Jika belum ada skor, set semua ke 0
        document.getElementById('median-score').textContent = '0.00';
        document.getElementById('final-score').textContent = '0.00';
        document.getElementById('std-dev-score').textContent = '0.00';
        return;
    }

    const sortedScores = [...totalScores].sort((a, b) => a - b);
    
    // --- LOGIKA MEDIAN BARU ---
    const midIndex = Math.floor(sortedScores.length / 2);
    let medianDisplay = '0.00';
    let medianAverage = 0;

    if (sortedScores.length % 2 === 0 && sortedScores.length > 1) {
        const middle1 = sortedScores[midIndex - 1];
        const middle2 = sortedScores[midIndex];
        medianAverage = (middle1 + middle2) / 2;
        medianDisplay = `${middle1.toFixed(2)}, ${middle2.toFixed(2)} (${medianAverage.toFixed(2)})`
    } else if (sortedScores.length > 0) {
        const middle = sortedScores[midIndex];
        medianDisplay = middle.toFixed(2);
        medianAverage = middle;
    }
    // --- AKHIR LOGIKA MEDIAN BARU ---

    const mean = totalScores.reduce((acc, val) => acc + val, 0) / totalScores.length;
    const stdDev = Math.sqrt(totalScores.map(x => Math.pow(x - mean, 2)).reduce((a, b) => a + b, 0) / totalScores.length);
    
    // SKOR AKHIR = Rata-rata Median + Total Penalti (karena penalti sudah negatif)
    const finalScore = medianAverage + totalPenalty;

    // UPDATE UI
    document.getElementById('median-score').textContent = medianDisplay;
    // Elemen rata-rata median tidak ada di view Anda, jadi kita langsung gunakan nilainya.
    // document.getElementById('median-average-value').textContent = medianAverage.toFixed(2);

    // Final Score sekarang adalah skor akhir yang sudah dihitung
    document.getElementById('final-score').textContent = finalScore.toFixed(3);
    document.getElementById('std-dev-score').textContent = stdDev.toFixed(5);
}

// Inisialisasi perhitungan saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', () => {
    recalculateAll();
});