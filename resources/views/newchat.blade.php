<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Main css  --}}
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    {{-- Bootstrap files  --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">  
    {{-- Google fonts  --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Badal plus</title>
</head>
<body>
    <div class="row chat-content mt-5">

        <div class="col-md-6 chat-box">
            <div class="container">
                <div class="chat-title">

                    <div class="chat-name">
                        <a href="#">Diorbtc2022</a>
                        <h1>Seen 2 Hours ago</h1>
                    </div>

                    <div class="chat-status">
                        <div>
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-mobile"></i>
                            <span class="like">
                                <i class="fa-solid fa-thumbs-up"></i>
                                <p>35</p>
                            </span>
                            <span class="dislike">
                                <i class="fa-solid fa-thumbs-down"></i>
                                <p>0</p>
                            </span>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <a href="#">Partner details</a>
                        </div>
                    </div>

                </div>
                <div class="statue">
                    <h1>Moderator unavailable</h1>
                </div>
                <div class="chat">
                    <div class="message">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur soluta, hic laboriosam delectus alias unde earum corporis ex dicta nihil placeat rerum necessitatibus vitae praesentium eaque similique in distinctio beatae?</p>
                        <h3>March 4, 2023 at 1:03 AM</h3>
                    </div>

                    <form class="send">
                        <label for="input_file">
                            <span><i class="fa-solid fa-paperclip"></i></span>
                            <input type="file" id="input_file">
                        </label>
                        <input type="text" placeholder="Message . . .">
                        <button type="submit"><i class="fa-solid fa-paper-plane"></i><h3>Send</h3></button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6 confirm-content">
            <div class="confirm-title">
                
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>