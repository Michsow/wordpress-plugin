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

            // store full objects (name + image)
            prizes = data.slice(0, max);

            // check correct property
            if (prizes.length < min) {
                $("#result").text(`API returned too few crates.`);
                return;
            }

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

        // generate CSGO style sequence
        let sequence = [];
        for (let i = 0; i < 40; i++) {
            let item = prizes[Math.floor(Math.random() * prizes.length)];
            sequence.push({
                name: item.name,
                image: item.image ? item.image : null
            });
        }

        // append items
        sequence.forEach(item => {
            track.append(`
                <div class="case-item">
                    ${item.image ? `<img src="${item.image}" class="case-img"/>` : ""}
                    <div class="case-name">${item.name}</div>
                </div>
            `);
        });

        // picker
        const winningIndex = 25;
        const winningItem = sequence[winningIndex].name;

        const itemWidth = 120;
        const stopPosition = -(winningIndex * itemWidth) + (600 / 2 - itemWidth / 2);

        track.css("transform", `translateX(${stopPosition}px)`);

        setTimeout(() => {
            $("#result").text("You won: " + winningItem);
            spinning = false;
        }, 3000);
    });
});
