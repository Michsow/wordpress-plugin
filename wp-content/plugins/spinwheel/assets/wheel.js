jQuery(document).ready(function ($) {

    const min = SpinWheelSettings.minPrizes;
    const max = SpinWheelSettings.maxPrizes;

    const apiUrl = SpinWheelSettings.apiUrl || "https://raw.githubusercontent.com/ByMykel/CSGO-API/main/public/api/en/crates.json";


    let prizes = [];
    let spinning = false;
    let prizesLoaded = false; // track if prizes are ready

    
    // Load prizes from API
    function loadPrizes() {
        $("#spin-btn").prop("disabled", true); // disable spin until ready
        $("#result").text("Loading prizes...");

        $.getJSON(apiUrl, function (data) {
            if (!Array.isArray(data)) {
                $("#result").text("API did not return an array.");
                return;
            }

            // Only take crate names as prizes
            let crateNames = data.map(crate => crate.name);

            // Validate minimum
            if (crateNames.length < min) {
                $("#result").text(
                    `API returned ${crateNames.length} crates, but minimum required is ${min}.`
                );
                return;
            }

            // Trim if too many
            if (crateNames.length > max) {
                prizes = crateNames.slice(0, max);
            } else {
                prizes = crateNames;
            }

            prizesLoaded = true;
            $("#result").text(`Loaded ${prizes.length} prizes! Click SPIN.`);
            $("#spin-btn").prop("disabled", false); // enable spin button

        }).fail(function () {
            $("#result").text("Failed to fetch crates from API.");
        });
    }

    loadPrizes();

    // Spin button
    $("#spin-btn").click(function () {
        if (!prizesLoaded) {
            $("#result").text("Prizes are not loaded yet.");
            return;
        }

        if (spinning) return;
        if (prizes.length === 0) {
            $("#result").text("No prizes available.");
            return;
        }

        spinning = true;

        // Animate spinning text
        let spinText = ["Spinning", "Spinning.", "Spinning..", "Spinning..."];
        let i = 0;
        const spinInterval = setInterval(() => {
            $("#result").text(spinText[i % spinText.length]);
            i++;
        }, 300); // changes text every 300ms

        // Pick random prize (crate name) after delay
        setTimeout(() => {
            clearInterval(spinInterval); // stop animation
            const prize = prizes[Math.floor(Math.random() * prizes.length)];
            $("#result").text("You won: " + prize);
            spinning = false;
        }, 2500); // 2.5 seconds spinning
    });
    function spinWheel(prizes) {
    if (spinning) return;
    spinning = true;

    const prizeIndex = Math.floor(Math.random() * prizes.length);
    const segments = prizes.length;
    const degreesPerSegment = 360 / segments;

    // Counter-clockwise spin (subtract rotation instead of adding)
    const rotation = 360 * 5 - (prizeIndex * degreesPerSegment) - Math.random() * degreesPerSegment;

    $("#wheel").css({
        "transition": "transform 3s cubic-bezier(0.33, 1, 0.68, 1)",
        "transform": `rotate(${rotation}deg)`
    });

    setTimeout(() => {
        $("#result").text("You won: " + prizes[prizeIndex]);
        spinning = false;
    }, 3000);
}


});
