export default function initAsset() {
    console.log("INIT ASSET", window.chartData);

    const canvas = document.getElementById("priceChart");
    if (!canvas || !window.chartData || window.chartData.length === 0) return;

    const parsed = window.chartData
                         .map(p => {
                             const iso = String(p.x).replace(" ", "T");
                             const d = new Date(iso);
                             return { d, y: Number(p.y) };
                         })
                         .filter(p => !Number.isNaN(p.d.getTime()));

    if (parsed.length === 0) {
        console.warn("PARSED DATA EMPTY");
        return;
    }

    const labels = parsed.map((p, i) => {
        if (i % 5 !== 0) return "";
        const day = String(p.d.getDate()).padStart(2, "0");
        const month = String(p.d.getMonth() + 1).padStart(2, "0");
        const hours = String(p.d.getHours()).padStart(2, "0");
        const minutes = String(p.d.getMinutes()).padStart(2, "0");
        return `${day}.${month} ${hours}:${minutes}`;
    });

    const prices = parsed.map(p => p.y);

    const ctx = canvas.getContext("2d");

    new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets: [{
                data: prices,
                borderColor: "#2563eb",
                backgroundColor: "transparent",
                tension: 0.4,
                pointRadius: 0,
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1200,
                easing: "easeOutCubic"
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `$${ctx.parsed.y.toFixed(2)}`
                    }
                }
            },
            scales: {

                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 6,
                        color: "#64748b",
                        font: {
                            size: 12
                        }
                    }
                },

                y: {
                    beginAtZero: false,
                    grid: {
                        color: "rgba(0,0,0,0.06)"
                    },
                    ticks: {
                        color: "#64748b",
                        font: {
                            size: 12
                        },
                        callback: value => `$${Number(value).toFixed(2)}`
                    }
                }
            }
        }
    });

}
