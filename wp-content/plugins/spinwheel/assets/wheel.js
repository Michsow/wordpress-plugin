jQuery(document).ready(function ($) {
    const min = SpinWheelSettings.minPrizes;
    const max = SpinWheelSettings.maxPrizes;
    const apiUrl = SpinWheelSettings.apiUrl;

    let prizes = [];
    let spinning = false;

    /** LOAD PRIZES FROM API */
    function loadPrizes() {
        $("#spin-btn").prop("disabled", true);
        $("#result").text("Loading crates...");

        $.getJSON(apiUrl, function (data) {
            if (!Array.isArray(data)) {
                $("#result").text("Invalid API response.");
                return;
            }

            let crateNames = data.map(crate => crate.name);

            if (crateNames.length < min) {
                $("#result").text(`API returned too few crates.`);
                return;
            }

            prizes = crateNames.slice(0, max);
            $("#spin-btn").prop("disabled", false);
            $("#result").text(`Loaded ${prizes.length} crates!`);
        });
    }

    loadPrizes();


    /** CSGO-STYLE CASE OPENING */
    $("#spin-btn").click(function () {
        if (spinning) return;
        if (prizes.length === 0) return;

        spinning = true;
        $("#result").text("Opening...");

        const track = $("#case-track");
        track.empty();

        // generate many random items (CSGO opening style)
        let sequence = [];
        for (let i = 0; i < 40; i++) {
            let item = prizes[Math.floor(Math.random() * prizes.length)];
            sequence.push(item);
        }

        // append elements
        sequence.forEach(name => {
            track.append(`<div class="case-item">${name}</div>`);
        });

        // choose the WINNING item
        const winningIndex = 25; // center stop
        const winningItem = sequence[winningIndex];

        const itemWidth = 120;
        const stopPosition = -(winningIndex * itemWidth) + (600 / 2 - itemWidth / 2);

        // animate
        track.css("transform", `translateX(${stopPosition}px)`);

        // result after animation
        setTimeout(() => {
            $("#result").text("You won: " + winningItem);
            spinning = false;
        }, 3000);
    });
});
