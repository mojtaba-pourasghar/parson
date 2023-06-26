$(document).ready(function () {
  var progress_circle = $(".my-progress-bar")
    .gmpc({
      line_width: 12,
      color: "#0ff",
      starting_position: 50,
      percent: 0,
      percentage: true
    })
    .gmpc("animate", 100, 3000);
});
