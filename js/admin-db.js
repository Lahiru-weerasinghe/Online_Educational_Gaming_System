function dbCounter(id, start, end, duration) {
  if (end != 0 && end > 5) {
    let obj = document.getElementById(id),
      count = start,
      range = end - start,
      increment = end > start ? 1 : -1,
      step = Math.abs(Math.floor(duration / range)),
      timer = setInterval(() => {
        count += increment;
        obj.textContent = count;
        if (count == end) {
          clearInterval(timer);
        }
      }, step);
  } else {
    obj = document.getElementById(id);
    obj.textContent = end;
  }
}

//Line Chart
let canvas = document.querySelector("canvas");
canvas.width = 700;
canvas.height = 390;

let xGrid = 10;
let yGrid = 10;
let cSize = 10;

let lgraph = canvas.getContext("2d");

function blocks(count) {
  return count * 9;
}

function drawAxis() {
  let yPlot = 40;
  let pop = 0;
  lgraph.beginPath();
  lgraph.strokeStyle = "black";
  lgraph.moveTo(blocks(5), blocks(2));
  lgraph.lineTo(blocks(5), blocks(40));
  lgraph.lineTo(blocks(75), blocks(40));

  lgraph.moveTo(blocks(5), blocks(40));

  for (let i = 1; i <= 8; i++) {
    lgraph.strokeText(pop, blocks(2), blocks(yPlot));
    yPlot -= 5;
    pop += 200;
  }

  lgraph.stroke();
}

function drawChart(entries) {
  lgraph.beginPath();
  lgraph.strokeStyle = "black";
  lgraph.moveTo(blocks(5), blocks(40));

  var xPlot = 10;
  for (const [month, income] of entries) {
    var incomeInBlocks = income / 40;
    lgraph.strokeText(month, blocks(xPlot), blocks(40 - incomeInBlocks - 1));
    lgraph.arc(
      blocks(xPlot),
      blocks(40 - incomeInBlocks),
      2,
      0,
      Math.PI * 2,
      true
    );
    lgraph.lineTo(blocks(xPlot), blocks(40 - incomeInBlocks));
    xPlot += 5;
  }
  lgraph.stroke();
}

drawAxis();
