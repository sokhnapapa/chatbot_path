<!DOCTYPE html>
<html lang="en">
<head>
    @stack('css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Elgibility Test | HIVST</title>
    <!-- CSS -->
    <!-- @push('css')
    <link rel="stylesheet" href="css/main.css">
    @endpush -->
    <link rel="stylesheet" href="{{ 'https://'.request()->getHost().'/css/main.css' }}">
    
    
    <!-- font -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    
    <!-- J query -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap CND -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
    <body>
        <script>
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/messenger.Extensions.js";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'Messenger'));

        </script>
        <div class="container d-flex align-items-center min-vh-100">
        <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-4 offset-lg-1 mx-0 px-0">
                <div id="title-container">
                    <h2>Get Free HIVST Kit</h2>
{{--                    <h3>Take Eligibility Test</h3>--}}
                    <br/>
                    <h5>Answer YES/NO to these questions to know if they qualify for a free HIVST kit or not. Click NEXT when you have choosen your answer. </h5>
                </div>
            </div>
            <!-- FORMS -->
            <div class="col-lg-7 mx-0 px-0">
                <div class="progress">
                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%"></div>
                </div>
                <div id="qbox-container">
                        <div id="steps-container">
                            @foreach($question_bank as $question)
                            <div class="step">
                                <form method="post">
                                    @csrf
                                    <h5>{{$question->question}}</h5>
                                    <div class="form-check ps-0 q-box">
                                        <div class="q-box__question">
                                            <input class="form-check-input question__input" id="q_{{$question->id}}_yes" name="{{$question->id}}" type="radio" value="1"> 
                                            <label class="form-check-label question__label" for="q_{{$question->id}}_yes">Yes</label>
                                        </div>
                                        <div class="q-box__question">
                                            <input checked class="form-check-input question__input" id="q_{{$question->id}}_no" name="{{$question->id}}" type="radio" value="0"> 
                                            <label class="form-check-label question__label" for="q_{{$question->id}}_no">No</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                            <div class="step">
                            <h4>Welcome to the End:</h4>
                            <p>Click on the submit button to know if you if you qualify for a free HIV self testing kit..</p>
                            </div>
                            <div class="step">
                            <div class="mt-1">
                                <div class="closing-text">
                                    <h4>That's about it!</h4>
                                    <p>Close the webview to get back to the Messenger to find out if you qualify for a free kit.</p>
                                    <!-- <p>Click on the submit button to continue.</p> -->
                                </div>
                            </div>
                            </div>
                            <div id="success">
                            <div class="mt-5">
                                <h4>That's about it!</h4>
                                <p>Close the webview to get back to the Messenger to find out if you qualify for a free kit.</p>
                                <!-- <a class="back-link" href="">Go back from the beginning ➜</a> -->
                            </div>
                            </div>
                        </div>
                        <div id="q-box__buttons">
                            <button id="prev-btn" type="button">Previous</button> 
                            <button id="next-btn" type="button">Next</button> 
                            <button id="submit-btn">Submit</button>
                        </div>
             </div>
             </div>
        </div>
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <!-- Javascript -->
        <script type="text/javascript" src="{{ 'https://'.request()->getHost().'/js/main.js' }}"></script>
    </body>
</html>
