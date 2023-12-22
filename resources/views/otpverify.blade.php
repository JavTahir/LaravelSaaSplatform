<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iKAYtrfW2xkSbL98/sV09Q7GGD/JdSM+n5dEJ4SL6PVCBvxKPF+PVIbp"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.6.4.min.js"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    ></script>

    <style>
      body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: #022f6c; /* fallback for old browsers */
        background: -webkit-linear-gradient(
          to right,
          #4575b6,
          #022f6c
        ); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(
          to right,
          #4575b6,
          #022f6c
        ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
      }

      .userInput {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
      }

      .feilds {
        margin: 10px;
        height: 35px;
        width: 35px;
        border: none;
        border-bottom: 2px solid #4d5c60;
        text-align: center;
        font-family: arimo;
        font-size: 1.2rem;
        background: transparent;
        color: #000000;
      }

      h1,
      h2 {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        color: rgb(3, 231, 3);
      }

      .verify {
        width: 250px;
        height: 40px;
        margin-top:30px;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        font-size: 1.1rem;
        border: none;
        border-radius: 5px;
        letter-spacing: 2px;
        cursor: pointer;
        background: #000000;
        color: #feffff;
      }

      button {
        width: 250px;
        height: 40px;
        margin: 10px auto;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        display:flex;
        font-size: 1.1rem;
        border: none;
        border-radius: 5px;
        letter-spacing: 2px;
        cursor: pointer;
        background: red;
        color: #feffff;
      }
    </style>
    <title>OTP Page</title>
  </head>
  <body>
    <div class="container">
      <h1>Enter OTP</h1>
      <p>
        We have sent an OTP to your registered mobile number. Please enter it
        below.
      </p>

      <p id="message_error" style="color:red;"></p>
      <p id="message_success" style="color:green;"></p>

      <div class="userInput">
      <form method="post" id="verificationForm">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input
          type="text"
          id="ist"
          maxlength="1"
          class="feilds"
          onkeyup="clickEvent(this,'sec')"
        />
        <input
          type="text"
          id="sec"
          class="feilds"
          maxlength="1"
          onkeyup="clickEvent(this,'third')"
        />
        <input
          type="text"
          id="third"
          class="feilds"
          maxlength="1"
          onkeyup="clickEvent(this,'fourth')"
        />
        <input
          type="text"
          id="fourth"
          class="feilds"
          maxlength="1"
          onkeyup="clickEvent(this,'fifth')"
        />
        <input
          type="text"
          id="fifth"
          class="feilds"
          maxlength="1"
          onkeyup="clickEvent(this,'sixth')"
        />
        <input type="text" id="sixth" class="feilds" maxlength="1" />
        <br>
        <input type="submit" class="verify"  value="Verify">
        </form>

      </div>    
      <p class="time"></p>
      <button id="resendOtpVerification">Resend OTP</button>
    </div>

    <!-- Bootstrap JS and Popper.js for Bootstrap components that require them -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-e3tEmzRH/AgSgE6ThsU6P6F6LZ1Y3ZcLOqFgL5Kk1q5meFpiC8RUnr93gQVZpF"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


  </body>
  <script>
    function clickEvent(first, last) {
      if (first.value.length) {
        document.getElementById(last).focus();
      }
    }

    $(document).ready(function(){
        $('#verificationForm').submit(function(e){
            e.preventDefault();
            var otp = $('#ist').val() +
                  $('#sec').val() +
                  $('#third').val() +
                  $('#fourth').val() +
                  $('#fifth').val() +
                  $('#sixth').val();

        
            var formData = $(this).serialize() + '&otp=' + otp;


            $.ajax({
                url:"{{ route('verifiedOtp') }}",
                type:"POST",
                data: formData,
                success:function(res){
                    if(res.success){
                        alert(res.msg);
                        window.open("/login","_self");
                    }
                    else{
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });

        });

        $('#resendOtpVerification').click(function(){
            $(this).text('Wait...');
            var userMail = @json($email);

            $.ajax({
                url:"{{ route('resendOtp') }}",
                type:"GET",
                data: {email:userMail },
                success:function(res){
                    $('#resendOtpVerification').text('Resend Verification OTP');
                    if(res.success){
                        timer();
                        $('#message_success').text(res.msg);
                        setTimeout(() => {
                            $('#message_success').text('');
                        }, 3000);
                    }
                    else{
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });

        });
    });

    function timer()
    {
        var seconds = 30;
        var minutes = 1;

        var timer = setInterval(() => {

            if(minutes < 0){
                $('.time').text('');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

                $('.time').text(tempMinutes+':'+tempSeconds);
            }

            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }

            seconds--;

        }, 1000);
    }

    timer();

      
  </script>
</html>
