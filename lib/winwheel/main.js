var idSorteio = window.location.pathname.split('/')[4];
var theWheel = {};
var indexes = [];

$.ajax({
    url: base_url + '/sorteios/infoSorteio',
    type: 'post',
    data: {idSorteio: idSorteio},
    dataType: 'json',
    cache: false,
    beforeSend: function () {

    },
    success: function (data) {
        indexes = data.rolette;
        // Create new wheel object specifying the parameters at creation time.
        theWheel = new Winwheel({
            'numSegments': data.numSegments, // Specify number of segments.
            'outerRadius': 200, // Set outer radius so wheel fits inside the background.
            'textFontSize': 12, // Set font size as desired.
            'segments': // Define segments including colour and text.
                    data.rolette,
            'animation': // Specify the animation to use.
                    {
                        'type': 'spinToStop',
                        'duration': 10, // Duration in seconds.
                        'spins': 15, // Number of complete spins.
                        'callbackFinished': 'alertPrize()'
                    }
        });

        drawTriangle();

        data.rolette.forEach(function (user) {
            $('#' + user.userId).css('background', user.fillStyle);
        });
    }
});


// Create wheel objects.
var tp = new Winwheel({
    'canvasId': 'trianglePointer',
    'outerRadius': 110,
    'fillStyle': '#eae56f'
});

function startSpin(user) {
    var result = function (segment) {
        return segment.userId == user.id_usuario;
    };

    var segmentNumber = indexes.findIndex(result) + 1;

    if (segmentNumber) {
        // Get random angle inside specified segment of the wheel.
        var stopAt = theWheel.getRandomForSegment(segmentNumber);

        // Important thing is to set the stopAngle of the animation before stating the spin.
        theWheel.animation.stopAngle = stopAt;

        // Start the spin animation here.
        theWheel.startAnimation();
    }
}

function drawTriangle() {
    // Get the canvas context the wheel uses.
    var ctx = theWheel.ctx;

    ctx.strokeStyle = 'white';     // Set line colour.
    ctx.fillStyle = '#030696';     // Set fill colour.
    ctx.lineWidth = 1;
    ctx.beginPath();              // Begin path.
    ctx.moveTo(170, 5);           // Move to initial position.
    ctx.lineTo(230, 5);           // Draw lines to make the shape.
    ctx.lineTo(200, 40);
    ctx.lineTo(171, 5);
    ctx.stroke();                 // Complete the path by stroking (draw lines).
    ctx.fill();                   // Then fill.
}

// -------------------------------------------------------
// Function for reset button.
// -------------------------------------------------------
function resetWheel()
{
    theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
    theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
    theWheel.draw();                // Call draw to render changes to the wheel.
    wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
}

// -------------------------------------------------------
// Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters.
// -------------------------------------------------------
function alertPrize() {
    drawTriangle();
    // Get the segment indicated by the pointer on the wheel background which is at 0 degrees.
    var winningSegment = theWheel.getIndicatedSegment();

    var response = {class: 'success', msg: '<u>GANHADOR:</u><br><b class="font20">' + winningSegment.text + '</b>'};
    var modal = new Modal();
    response.redirect = base_url + '/sorteios/concluido/' + idSorteio;
    modal.response(response);
}