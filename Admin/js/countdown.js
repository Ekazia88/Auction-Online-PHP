function countdown(timer,id){
    var countDownDate = new Date(timer).getTime();


    var x = setInterval(function() {

    // Get today's date and time
    var now = Date.now();
    var distance = countDownDate - now;


    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    
    document.getElementById("demo-"+id).innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s";


    // If the count down is finished, write some text

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo-"+id).innerHTML = "Waktu Habis";
        document.getElementById("hide-"+id).style.display= 'block';
        document.getElementById("show-"+id).style.display= 'none';
    }
    }, 1000);
    }