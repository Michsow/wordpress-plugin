jQuery(document).ready(function ($) {
    $("#spin-btn").click(function () {
        let randomDegrees = Math.floor(Math.random() * 360) + 1800; // spin many times
        $("#wheel").css("transform", `rotate(${randomDegrees}deg)`);

        // Determine prize (6 segments → 60 degrees each)
        let finalDeg = randomDegrees % 360;
        let prizeIndex = Math.floor(finalDeg / 60);

        let prizes = [
            "Prize 1",
            "Prize 2",
            "Prize 3",
            "Prize 4",
            "Prize 5",
            "Prize 6"
        ];

        setTimeout(() => {
            $("#result").text("You won: " + prizes[prizeIndex]);
        }, 4000); // match CSS transition time
    });
});
