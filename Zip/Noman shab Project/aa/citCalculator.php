<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="Resources/logo/logoIni.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ASK Management Consultants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        * {
            font-family: 'Roboto', 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        navTop {
            position: relative;
            z-index: 1000;
            width: 100%;
            background: rgb(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            padding: 0vw 0vw;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.15);

        }

        navTop .tMenu {
            position: relative;
            /* max-width: 1281px; */
            /* padding: 0vw 2vw; */
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* margin: 108px 0px 0px 0px; */
            background-color: #F3F8FC;

        }

        .tMenu .logo {
            padding-top: 5px;
            height: 75px;
            margin-left: 50px;
        }

        .temp {
            color: #757e86;
        }

        .temp:hover {
            color: #0ea2bd;
        }

        .tMenu .navTop-links {
            display: inline-flex;
        }

        .navTop-links li {
            list-style: none;
            margin: 30px;
        }

        .navTop-links li a {
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            padding: 9px 9px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .navTop-links li a:hover {
            color: #0ea2bd;
        }

        .navTop-links .mobile-item {
            display: none;
        }

        .navTop-links .drop-menu,
        .navTop-links .dropDown-menu {
            position: absolute;
            width: 250px;
            line-height: 45px;
            top: 65px;
            opacity: 0;
            visibility: hidden;
            box-shadow: 0 6px 10px rgba(92, 91, 91, 0.15);
        }

        .drop-menu a,
        .dropDown-menu a {
            font-size: 18px;
            color: #eceeef;
        }

        .navTop-links li:hover .dropDown-menu {
            transition: all 0.3s ease;
            top: 45px;
            opacity: 1;
            visibility: visible;
            background: #485664;
        }

        .navTop-links li:hover .mega-box {
            transition: all 0.3s ease;
            top: 45px;
            opacity: 1;
            visibility: visible;
        }

        .drop-menu li a {
            width: 100%;
            display: block;
            font-weight: 400;
            border-radius: 0px;
            font-size: 15px;
            padding: 10px 20px 10px 35px;
            line-height: 12px;
        }

        .dropDown-menu li a {
            width: 90%;
            margin-left: 10px;
            display: block;
            font-weight: 400;
            border-radius: 0px;
            font-size: 15px;
            padding: 10px 20px 10px 35px;
            line-height: 12px;
            border-radius: 5px;
        }

        .mega-box {
            position: absolute;
            left: 0;
            width: 100%;
            padding: 0 80px;
            top: 85px;
            opacity: 0;
            visibility: hidden;
        }

        .mega-box img {
            width: 100%;
            max-width: 200px;
        }

        .mega-box .content {
            background: #485664;
            padding: 25px 10px;
            display: flex;
            width: 100%;
            justify-content: space-between;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .mega-box .content .row {
            width: calc(25% - 30px);
            line-height: 30px;
        }

        .content .row img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content .row header {
            color: rgb(139, 219, 254);
            font-size: 20px;
            font-weight: 500;
        }

        .content .row .mega-links {
            margin-left: -40px;
            border-left: 1px solid rgba(241, 239, 239);
        }

        .row .mega-links li {
            padding: 0 0px 0 20px;
        }

        .row .mega-links li a {
            padding: 0px;
            color: rgb(250, 252, 252);
            font-size: 15px;
            display: block;
            padding: 5px 10px 5px 20px;
            line-height: 15px;
            text-indent: -1.8em;
        }

        .row .mega-links li a span {
            color: gold;
        }

        .row .mega-links li a:hover {
            color: rgb(245, 249, 249);
            background: #0ea2bd;
        }

        .dropDown-menu li a:hover {
            color: rgb(245, 249, 249);
            background: #0ea2bd;
        }

        .tMenu .btn {
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: none;
        }

        .tMenu .btn.close-btn {
            position: absolute;
            right: 30px;
            top: 10px;
        }

        @media screen and (max-width: 1355px) {
            .tMenu .btn {
                display: block;
            }

            .tMenu .navTop-links {
                position: fixed;
                height: 100vh;
                width: 90%;
                max-width: 330px;
                top: 0;
                left: -90%;
                display: block;
                padding: 50px 10px;
                line-height: 30px;
                overflow-y: auto;
                box-shadow: 0px 15px 15px rgba(253, 253, 253, 0.18);
                background: #373637 url('/static/JAVA/Images/Card/dotted.jpg');
                background-position: center;
                opacity: 0.95;
                transition: all 0.3s ease;
            }

            .tMenu .logo {
                width: 300px;
                margin-left: 0px;
            }

            /* custom scroll bar */
            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: #242526;
            }

            ::-webkit-scrollbar-thumb {
                background: #3A3B3C;
            }

            #menu-btn:checked~.navTop-links {
                left: 0%;
            }

            #menu-btn:checked~.btn.menu-btn {
                display: none;
            }

            #close-btn:checked~.btn.menu-btn {
                display: block;
            }

            .navTop-links li {
                margin: 15px 10px;
            }

            .navTop-links li a {
                /* mobile view */
                padding: 0 0px;
                display: block;
                font-size: 17px;
                color: #eceeef;

            }

            .navTop-links .drop-menu {
                position: static;
                opacity: 1;
                top: 65px;
                visibility: visible;
                padding-left: 0px;
                width: 100%;
                max-height: 0px;
                overflow: hidden;
                box-shadow: none;
                transition: all 0.3s ease;
                background: #485664;
            }

            .navTop-links .dropDown-menu {
                position: static;
                opacity: 1;
                top: 65px;
                visibility: visible;
                padding-left: 0px;
                width: 100%;
                max-height: 0px;
                overflow: hidden;
                box-shadow: none;
                transition: all 0.3s ease;
                background: #485664;
            }

            .navTop-links .drop-menu a {
                color: #eceeef;
            }

            .navTop-links .dropDown-menu a {
                color: #eceeef;
                padding-left: 20px;
            }

            #showDropA:checked~.drop-menu,
            #showDropB:checked~.drop-menu {
                max-height: 100%;
                color: #fa0707;
            }

            #showDropA:checked~.dropDown-menu,
            #showDropB:checked~.dropDown-menu {
                max-height: 100%;
                color: #fa0707;
            }

            #showMegaA:checked~.mega-box,
            #showMegaB:checked~.mega-box,
            #showMegaC:checked~.mega-box,
            #showMegaD:checked~.mega-box {
                max-height: 100%;
                padding: 0px;
            }

            .navTop-links .desktop-item {
                display: none;
            }

            .navTop-links .mobile-item {
                display: block;
                color: #f2f2f2;
                font-size: 17px;
                font-weight: 500;
                padding-left: 0px;
                cursor: pointer;
                border-radius: 5px;
                transition: all 0.3s ease;
            }

            .navTop-links .mobile-item:hover {
                background: #3A3B3C;
                color: rgb(242, 239, 239);
            }

            navTop input {
                display: none;
            }

            .drop-menu li,
            .dropDown-menu li {
                margin: 0;
            }

            .drop-menu li a,
            .dropDown-menu li a {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px 10px 10px 0px;
                line-height: 12px
            }

            .mega-box {
                position: static;
                top: 65px;
                opacity: 1;
                visibility: visible;
                padding: 0 0px;
                max-height: 0px;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .mega-box .content {
                box-shadow: none;
                flex-direction: column;
                padding: 20px 20px 0 20px;
            }

            .mega-box .content .row {
                width: 100%;
                margin-bottom: 15px;
                border-top: 1px solid rgba(226, 25, 25, 0.08);
            }

            .mega-box .content .row:nth-child(1),
            .mega-box .content .row:nth-child(2) {
                border-top: 0px;
            }

            .content .row .mega-links {
                border-left: 0px;
                padding-left: 15px;
            }

            .row .mega-links li {
                margin: 0;
            }

            .row .mega-links li a {
                text-indent: -1.2em;
            }

            .content .row header {
                font-size: 19px;
            }
        }


        .hirst {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .thirst {
            position: relative;
            display: inline-block;
            margin-right: 20px;
        }

        .dropdown-container {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 232px;
        }

        .dropdown-container>div {
            border-bottom: 1px solid #ccc;
            padding: 8px 0;
        }

        .thirst:hover .dropdown-container {
            display: block;
        }

        .dropdown-container div a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            font-weight: 500;
            /* Change this to the desired hover background color */
        }

        .dropdown-container div:hover {
            background-color: #0083c9;
            /* color: #fcfdf7; Change this to the desired hover background color */
        }
    </style>
</head>
<script>
    let mOpen = document.querySelector('#menu-btn');
    let mClose = document.querySelector('#menu-close');
    let sMenu = document.querySelector('navTop div ul');

    mOpen.onclick = () => {
        sMenu.style.right = '0px';
    }
</script>
<navTop>
    <div class="tMenu">
        <div>

            <a href="https://ask-management-consultants.com/"><img class="logo" src="Resources/logo/ASK.png"
                    alt="ASK Management Consultants"></a>
        </div>
        <input type="radio" name="slider" id="menu-btn" style="display:none">
        <input type="radio" name="slider" id="close-btn" style="display:none">
        <ul class="navTop-links">
            <label for="close-btn" class="btn close-btn">✖</label>
            <li style="color:white;"><a href="https://ask-management-consultants.com/" class="temp"
                    href="/">Home</a></li>

            <ul class="hirst">
                <li class="thirst">
                    <a href="#" class="desktop-item temp">Who We Are ⌵</a>
                    <div class="dropdown-container">
                        <div>
                            <a href="https://ask-management-consultants.com/about-us/" style="color: black;">About
                                Us</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/our-philosophy-2/" style="color: black;">Our
                                Philosophy</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/our-personnel-2/" style="color: black;">Our
                                Personnel</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/industry-specialisation-2/"
                                style="color: black;">Industry Specialization</a>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="hirst">
                <li class="thirst">
                    <a href="#" class="desktop-item temp">Services ⌵</a>
                    <div class="dropdown-container">
                        <div>
                            <a href="https://ask-management-consultants.com/outsourcing-2/"
                                style="color: black;">Outsourcing</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/advisory-specialized-services/"
                                style="color: black;">Advisory & Specialized Services</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/audit-assurance-2/"
                                style="color: black;">Audit & Assurance</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/taxation-2/"
                                style="color: black;">Taxation</a>
                        </div>
                        <div>
                            <a href="https://ask-management-consultants.com/training-2/"
                                style="color: black;">Training</a>
                        </div>
                    </div>
                </li>
            </ul>
            <li><a class="temp" href="https://ask-management-consultants.com/blog-2/">Blog</a></li>
            <li><a class="temp" href="https://ask-management-consultants.com/careers-2/">Careers</a></li>

            <li><a class="temp" href="https://ask-management-consultants.com/contact-us-2/">Contact Us</a></li>


            <li><a href="/login"><img src="/static/JAVA/Images/Icon/menuA.png" style="width:22px;" class="Menu"
                        alt=""> </a></li>
        </ul>
        <label for="menu-btn" class="btn menu-btn">
            <i class="fa fa-bars"
                style="font-size:36px;position:relative; top:3px; right:10px; z-index:12;color:#000"></i>
            <!-- <img src="/static/JAVA/Images/Icon/menu.jpg" style="position:relative; top:3px; right:10px; z-index:12" width=30px> -->
        </label>
    </div>
</navTop>
<div class="conTop">
    <div class="heading">
        <img src="Resources/icon/tax.png" alt="" class='img1'>
        <div class="headingText">
            <div class="headingText1"> Corporate Income Tax </div>
            <div class="headingText2"> Calculator </div>
        </div>
    </div>
</div>
<div class="conMid">
    <div class="conMidMain" id="about-home">
        <div class="conMidHeading">
            Calculate Your <span style="color:#09768E; font-size:25px; ">Tax </span>in Simple Steps
        </div>
        <div class="container">
            <div class="row">
                <div class="conPBar progress-barr">
                    <div class="col-sm-3 step">
                        <p>Registeration</p>
                        <div class="bullet"> <span>1</span> </div>
                        <div class="check " style="margin:-2px 0;">✓</div>
                    </div>
                    <div class="col-sm-3 step">
                        <p>Basic Info</p>
                        <div class="bullet"> <span>2</span></div>
                        <div class="check " style="margin:-2px 0;">✓</div>
                    </div>
                    <div class="col-sm-3 step">
                        <p>Legal Status</p>
                        <div class="bullet"> <span>3</span> </div>
                        <div class="check " style="margin:-2px 0;">✓</div>
                    </div>
                    <div class="col-sm-3 step">
                        <p>Final Submition</p>
                        <div class="bullet"> <span>4</span> </div>
                        <div class="check " style="margin:-2px 0;">✓</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="two" class="two conA">
            <div class="conBox" style="padding-left:30px; border-top: 4px solid #09768E;">
                <h2>Basic Information</h2>
                <hr style="border-bottom: 1px solid lightgray; margin: 0 0 20px 0">
                <br>

                <div class="row">
                    <label class="Lab2" style="position:relative;"> <span>Accounting Period: <span
                                class="required">*</span>
                            <span style="cursor:pointer;color:red; font-size:14px;" onclick="yearExam()"> <img
                                    style="position:absolute; z-index:20px; left:-50px; width:18px; top:5px; right:0px"
                                    src="{% static 'JAVA/gif/icon-info.gif' %}" alt=""> </span>
                        </span>
                    </label>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="startDate" style="font-size:13px;">Start Date...</label>
                        <input type="date" id="startDate" name="startDate"
                            style="border:1px solid gray; padding: 3px 5px;">
                    </div>
                    <!-- <br> -->
                    <div class="col-sm-6">
                        <label for="endDate" style="font-size:13px; ">End Date.....</label>
                        <input type="date" id="endDate" name="endDate"
                            style="border:1px solid gray; padding: 3px 5px;">
                    </div>

                    <!-- </br></br> -->
                    <script>
                        function yearExam() {
                            var examDiv = document.getElementById("yearExam");
                            var currentDisplay = window.getComputedStyle(examDiv, null).getPropertyValue("display");

                            examDiv.style.display = currentDisplay === "none" ? "block" : "none";

                        }
                    </script>
                    <div style="display:none;  border:1px solid; width:450px; box-shadow: 3px 3px 4px #346459;  z-index: 2; position:absolute; top:30px; z-index: 100; background:rgb(249, 249, 248); border-radius: 10px;"
                        id="yearExam">
                        <div class="bgPic">
                            <p style="font-size:11px;"> Example: Start Date 1st Jan 2024 --- End Date: 31 Dec 2024
                                <br>
                            </p>
                            <p style="font-size:11px; margin-left: 50px;"> Start Date 1st Jun 2023 --- End Date: 31
                                May 2024 </p>
                        </div>
                    </div>

                </div>

                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">

                <div class="field">
                    <p class="Lable">What is the entity residential status:</p>
                    <div class="brsi">
                        <input type="radio" id="bi_rs_r" name="bi_rs" onclick="bi_rs_r()">
                        <span>Resident</span>
                        <div id="bi_rs_div">
                            <p>Your global income i.e. from inside and out side UAE will be taxed. Please enter global
                                income figures in the calculator.</p>
                        </div>
                    </div>

                    <div class="brsi">
                        <input type="radio" id="bi_rs_nr" name="bi_rs" onclick="bi_rs_nr()">
                        <span>Non Resident</span>
                    </div>
                    <div id="bi_rs_nr_div">
                        <p>Do you have a Permanat Establishment or nexus In UAE </p>
                        <div class="cried">
                            <input type="radio" id="bi_rs_nr_yes" name="nonResPE" onclick="bi_rs_nr_yes()">
                            <span>Yes</span> <span id="bi_rs_nr_yes_span" class="erps"> ( Your income is subject to
                                0%
                                WHT )</span>
                        </div>
                        <div class="cried">
                            <input type="radio" id="bi_rs_nr_no" name="nonResPE" onclick="bi_rs_nr_yes()">
                            <span>No </span>
                        </div>
                    </div>

                    <div class="cried">
                        <input type="radio" id="individual" name="bi_rs" onclick="bi_rs_i()">
                        <span>Individual</span>
                    </div>
                    <div id="bi_rs_i_div">
                        <p>Is your revenue greater than AED 1M, Have you elected for tax in UAE </p>
                        <div class="cried">
                            <input type="radio" id="bi_rs_i_elect_Yes" name="bi_rs_i_elect"
                                onclick="bi_rs_i_elect_yes()">
                            <span>Yes</span>
                        </div>
                        <div class="erpis">
                            <input type="radio" id="bi_rs_i_elect_no" name="bi_rs_i_elect"
                                onclick="bi_rs_i_elect_no()">
                            <span>No </span> <span id="bi_rs_i_elect_noSpan" class="erps"> ( Your are not liable to
                                tax
                                )</span>
                        </div>
                    </div>

                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">

                <div class="field" id="turnover_Div">
                    <p class="Lable">Is your annual turnover below AED 3,000,000:</p>
                    <div class="brsi">
                        <input type="radio" id="bi_to_Yes" name="bi_to" onclick="bi_to_No_div()">
                        <span>Yes</span>
                    </div>
                    <div id="bi_to_Yes_div">
                        <p>You are eligibile for SME relief. It will be treated as if you have no taxable income in the
                            tax period.</p>
                    </div>
                    <div class="brsi">
                        <input type="radio" id="bi_to_No" name="bi_to" onclick="bi_to_No_div()">
                        <span>No</span>
                    </div>

                    <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">
                </div>

                <br><br>
            </div>
            <div class="tempBtnDiv" style="text-align:center; padding:5px; border-radius:10px;">
                <!-- style="background:#3e4d6dae; text-align:center; padding:5px; border-radius:10px;"> -->
                <span><button class="btnTemp" onclick="tempInfo()" style="display: none;"> Temp Details
                    </button></span> <!---->
                <button onclick="toggleDiv(this)" class="btnTemp" style="display: none;">Computation</button>
                <button id="downloadBtn" style="display: none;">Download as PDF</button>
                <!-- <a href="https://clique360.net/_test/citCalculator" id="downloadBtn"
                    style="padding: 10px; text-decoration: none;">Refresh</a> -->
                <a id="downloadBtn" class="refresh" style="padding: 10px; text-decoration: none;">Refresh</a>
            </div>
            <div class="btnDiv">
                <button class="btnPrevious" onclick="preOne()"> ⮜ Previous </button>
                <button class="btnNext" id="bttnNext" onclick="nextThree()"> Next ⮞</button>
                <button class="btnNext" id="btnSupSede" onclick="nextFour()" style="display:none"> Next ⮞-</button>
                <button class="btnEmpty" id="btnEmpty">◉</button>
            </div>
        </div>

        <div id="three" class="three conA">

            <div class="conBox" style="padding-left:30px; border-top: 4px solid #09768E;">
                <h2>Legal Status</h2>
                <hr style="border-bottom: 1px solid lightgray; margin: 0 0 20px 0">
                <br>

                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_rPE" name="ls" onclick="ls_rPE()" value="Resident PE">
                        <span class="Lable2">Resident PE </span>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">

                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_fPE" name="ls" onclick="ls_fPE()" Value="Foreign PE">
                        <span class="Lable2">Foreign PE </span>
                    </div>
                </div>
                <div id="ls_fPE_div">
                    <p>Has the election been made to exempt foreign income </p>
                    <div class="cried">
                        <input type="radio" id="ls_fPE_yes" name="ls_fPE_ele" onclick="ls_fPE_yes()">
                        <span>Yes</span> <span id="ls_fPE_ele_yesSpan" class="erps"> ( Foreign Income do not include
                            it in
                            Computation of UAE tax )</span>
                    </div>
                    <div class="erpis">
                        <input type="radio" id="ls_fPE_no" name="ls_fPE_ele" onclick="ls_fPE_yes()">
                        <span>No </span>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">

                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_uPS" name="ls" onchange="ls_uPS()"
                            value="Unincorporated Partner Ship">
                        <span class="Lable2">Unincorporated Partnership </span>
                    </div>
                </div>
                <div id="ls_uPS_div">
                    <label class="Lab2"> <span>Percentage of ownership: <span class="required">*</span></span>
                        <input class="inputX" type="number" id="bi_Year" name="percentage_of_ownerShip"
                            placeholder="Entr Your Percentage of Ownership" oninput="getPercentage(this)"> </label>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">


                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_iPS" name="ls" onclick="ls_iPS()"
                            value="Incorporated Partner Ship">
                        <span class="Lable2">Incorporated partner Ship </span>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">


                <div class="field">
                    <div class="erise">
                        <input type="radio" id="oJP" name="ls" onclick="ls_oJP()"
                            value="Other Judicial Person except Free zone">
                        <span class="Lable2">Other Judicial Person except Free zone </span>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">


                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_FZ" name="ls" onclick="ls_FZ()" value="FreeZone">
                        <span class="Lable2">Freezone</span>
                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">


                <div class="field">
                    <div class="erise">
                        <input type="radio" id="ls_PF" name="ls" onclick="ls_PF()" value="Private Fund">
                        <span class="Lable2">Private Fund </span>
                    </div>
                </div>
                <div id="ls_PF_div">
                    <p>Has the election been made to exempt foreign income </p>
                    <div class="cried">
                        <input type="radio" id="ls_PF_yes" name="ls_PF_ele" onclick="ls_PF_yes()">
                        <span>Yes</span> <span id="ls_PF_ele_yesSpan" class="erps"> ( Exampt )</span>
                    </div>
                    <div class="erpis">
                        <input type="radio" id="ls_PF_no" name="ls_PF_ele" onclick="ls_PF_no()">
                        <span>No </span>

                        <div id="ls_PF_ele_noSpan" style="margin-left:8px; padding:5px 10px;font-size:10px;">
                            <label class="Lab2"> <span>Fund net income</span>
                                <input class="inputX" type="number" id="bi_Year" name="bi_Year"
                                    placeholder="Input fund net income"> </label>
                        </div>

                    </div>
                </div>
                <hr style="border-bottom: 1px solid lightgray; margin: 10px 0;">

                <br><br>
            </div>
            <div class="tempBtnDiv" style="text-align:center; padding:5px; border-radius:10px;">
                <!-- style="background:#3e4d6dae; text-align:center; padding:5px; border-radius:10px;"> -->
                <span><button class="btnTemp" onclick="tempInfo()" style="display: none;"> Temp Details
                    </button></span> <!---->
                <button onclick="toggleDiv(this)" class="btnTemp" style="display: none;">Computation</button>
                <button id="downloadBtn" style="display: none;">Download as PDF</button>
                <!-- <a href="https://clique360.net/_test/citCalculator" id="downloadBtn"
                    style="padding: 10px; text-decoration: none;">Refresh</a> -->
                <a id="downloadBtn" class="refresh" style="padding: 10px; text-decoration: none;">Refresh</a>
            </div>
            <div class="btnDiv">
                <button class="btnPrevious" onclick="preTwo()"> ⮜ Previous </button>
                <button class="btnNext" onclick="nextFour()"> Next ⮞</button>
                <button class="btnEmpty3" id="btnEmpty3">◉</button>
            </div>
        </div>


        <div id="four" class="four conA">

            <div id="div1" class="hidden cem"><span>Resident PE</span></div>
            <div id="div2" class="hidden cem"><span>Foreign PE</span></div>
            <div id="div3" class="hidden cem"><span>Unincorporated Partner Ship</span></div>
            <div id="div4" class="hidden cem"><span>Incorporated partner Ship</span></div>
            <div id="div5" class="hidden cem"><span>Other Judicial Person except Free zone</span></div>

            <div id="div6" class="hidden cxm">
                <h2 id="selectionHeading">FreeZone </h2>
                <br>
                <div class="WESX">
                    <div>
                        <p style="font-weight:bold; color:darkgreen"> Your income from Qualifying transactions with
                            free zone entities:
                            <!-- <span style="font-size:12px; color:darkgreen"> (Taxable at standard rate) </span> -->
                        </p>
                        <label class="Lab5">
                            <span style="font-size:11px;">1. Manufacturing of goods or materials;</span><br>
                            <span style="font-size:11px;">2. Processing of goods or materials; </span> <br>
                            <span style="font-size:11px;">3. Holding of shares and other securities; </span> <br>
                            <span style="font-size:11px;">4. Ownership, management and operation of Ships;
                            </span><br>
                            <span style="font-size:11px;">5. Reinsurance services subject to the regulatory oversight
                                of the relevant competent authority in the UAE; </span> <br>
                            <span style="font-size:11px;">6. Fund management services subject to the regulatory
                                oversight by the relevant
                                competent authority in the UAE; </span> <br>
                            <span style="font-size:11px;">7. Wealth and investment management services subject to the
                                regulatory oversight by the
                                relevant competent authority in the UAE; </span> <br>
                            <span style="font-size:11px;">8. Headquarter services to Related Parties; </span> <br>
                            <span style="font-size:11px;">9. Treasury and financing services to Related Parties;
                            </span> <br>
                            <span style="font-size:11px;">10. Financing and leasing of Aircraft, including engines and
                                rotable components; </span> <br>
                            <span style="font-size:11px;">11. Distribution of goods or materials in or from a
                                Designated Zone to a customer that
                                resells such goods or materials, or parts thereof or processes or alters such goods or
                                materials or parts thereof for the purposes of sale or resale; </span> <br>
                            <span style="font-size:11px;">12. Logistics services; </span> <br>
                            <span style="font-size:11px;">13. Any ancillary activities (which serve no independent
                                function) to the above
                                activities. </span> <br>

                        </label>
                    </div>
                    <div>
                        <input class="inputC" type="text" id="stdTax" name="stdTax"
                            oninput="formatInput(this)">
                    </div>
                </div>
                <br>

                <div class="WESX">
                    <div>
                        <p style="font-weight:bold; color:darkgreen"> Your Income from transactions with non freeZone
                            persons for Qualifying Activities:
                        </p>
                    </div>
                    <div>
                        <input class="inputC" type="text" id="stdTaxNCP" name="stdTaxNCP"
                            oninput="formatInput(this)">
                    </div>
                </div>
                <br>

                <div class="WESX">
                    <div>
                        <p style="font-weight:bold; color:darkgreen"> Your other income- Excluded/Non Qualifying
                            incomes </p>
                        <label class="Lab5">
                            <span style="font-size:11px;">1.Transaction with natural persons except qualifying
                                activities: </span><br>
                            <span style="font-size:11px;">2.Banking, Insurance, Finance, Leasing: </span> <br>
                            <span style="font-size:11px;">3.Ownership or exploitation of UAE immovable property, other
                                than Commercial Property: </span> <br>
                            <span style="font-size:11px;">4.Ownership or exploitation of intellectual property assets:
                            </span><br>
                            <span style="font-size:11px;">5.Activities that are ancillary (which serve no independent
                                function) to the other activities: </span> <br>

                        </label>
                    </div>
                    <div>
                        <input class="inputC" type="text" id="stdTaxCP" name="stdTaxCP"
                            oninput="formatInput(this)">
                    </div>
                </div>
                <div class="WESX">
                    <div>
                        <p style="font-weight:bold; color:darkgreen"> Non commercial property Income </p>
                    </div>
                    <div>
                        <input class="inputC" type="text" id="salOthFZ" name="salOthFZ"
                            oninput="formatInput(this)">
                    </div>
                </div>
                <div class="WESX">
                    <div>
                        <p style="font-weight:bold; color:darkgreen"> Commercial property income in FreeZone</p>
                    </div>
                    <div>
                        <input class="inputC" type="text" id="nonFZper" name="nonFZper"
                            oninput="formatInput(this)">
                    </div>
                </div>
                <br>

                <!-- <p style="font-weight:bold; color:darkgreen"> Income from below activities <span
                        style="font-size:12px; color:darkgreen"> (Exampt subject to conditions) </span> </p>
                <br style="height:10px;"> -->
                <!-- <label class="Lab4">
                    <span>Income derived from sale to other free zone
                    </span>
                </label>
                <input class="inputC" type="text" id="salOthFZ" name="salOthFZ" oninput="formatInput(this)"
                    style="float:right;">

                <label class="Lab4">
                    <span style="position:relative;">Income derived from non-free zone persons
                        <span style="font-size:11px;">from qualifying activities </span>
                        <span style="cursor:pointer;color:red; font-size:14px;" onclick="qulBusAct()"> <img
                                style="position:absolute; z-index:20px; width:18px; top:5px; right:0px"
                                src="{% static 'JAVA/gif/icon-info.gif' %}" alt=""> </span>
                    </span>

                    <input class="inputC" type="text" id="nonFZper" name="nonFZper" oninput="formatInput(this)"
                        style="float:right;">
                </label> -->

                <div style="display:none; position:relative; border:1px solid; width:450px; box-shadow: 3px 3px 4px #346459;  z-index: 2; position:absolute; z-index: 100; background:rgb(249, 249, 248); border-radius: 10px;"
                    id="qbi">
                    <div class="bgPic">
                        <p style="font-size:14px; font-weight:100">Qualifying Business Activities: <br></p>
                        <p onclick="qulBusAct()"
                            style="position:absolute; right:0px; top:0px; color:red; font-weight:bold; background:lightgray; width:20px; height:20px; border-radius:50%; text-align:center; cursor:pointer;">
                            X</p>
                        <span style="font-size:11px;">
                            - Mnaufacturing, <br>
                            - Pricessing of goods material, <br>
                            - Holding of Shares and other securities, <br>
                            - Ownership, management of ships, <br>
                            - Reinsurance Service subject ot regualtory oversight of relevant authority, <br>
                            - Fund managementservice subject to regualtory oversight, <br>
                            - Wealth and investment managemet service subject ot regulatory authority oversight,<br>
                            - HQ services, <br>
                            - Treasury and financing services, <br>
                            - Financing and leasing aircraft, <br>
                            - Logistic servoces, <br>
                            - Any ancillary services to above <br>
                        </span>
                    </div>
                </div>

                <!-- <div style="position:relative">
                    <label class="Lab4">
                        <span style="position:relative;">Income derived from non-free zone persons
                            <span style="font-size:11px;">from non-qualifying activities </span>
                            <span style="cursor:pointer;color:red; font-size:14px;" onclick="nonQulBusAct()"> <img
                                    style="position:absolute; z-index:20px; width:18px; top:5px; right:0px"
                                    src="{% static 'JAVA/gif/icon-info.gif' %}" alt=""> </span>
                        </span>
                    </label> -->

                <!-- <div style="display:none;  border:1px solid; width:450px; box-shadow: 3px 3px 4px #346459;  z-index: 2; position:absolute; top:30px; z-index: 100; background:rgb(249, 249, 248); border-radius: 10px;"
                        id="non_qbi">
                        <div class="bgPic">
                            <p style="font-size:14px; font-weight:100">Non-Qualifying Income of a Qualifying Free Zone
                                Person: <br></p>
                            <p onclick="nonQulBusAct()"
                                style="position:absolute; right:0px; top:0px; color:red; font-weight:bold; background:lightgray; width:20px; height:20px; border-radius:50%; text-align:center; cursor:pointer;">
                                X</p>
                            <span style="font-size:11px;">
                                - If non qualifying income is below AED 5M or 5% of revenue? <br>

                            </span>
                        </div>
                    </div> -->
                <input class="inputC" type="hidden" id="deminins" name="deminins" oninput="formatInput(this)"
                    style="float:right;">
                <!-- </div>  -->

                <script>
                    function qulBusAct() {
                        var qbi = document.getElementById("qbi");
                        var currentDisplay = window.getComputedStyle(qbi, null).getPropertyValue("display");

                        qbi.style.display = currentDisplay === "none" ? "block" : "none";

                        var nonqbi = document.getElementById("non_qbi");
                        nonqbi.style.display = "none"
                    }

                    function nonQulBusAct() {
                        var nonqbi = document.getElementById("non_qbi");
                        var currentDisplay = window.getComputedStyle(non_qbi, null).getPropertyValue("display");

                        nonqbi.style.display = currentDisplay === "none" ? "block" : "none";

                        var qbi = document.getElementById("qbi");
                        qbi.style.display = "none"

                    }
                </script>



                <label class="Lab4" style='display:none'>
                    <input class="inputC" type="text" id="incFrom" name="incFrom" oninput="formatInput(this)"
                        value=0>
                </label>

            </div>

            <div id="div7" class="hidden cem"><span>Private Fund</span></div>

            <div class="conBox" style="min-height:600px; padding-left:60px; border-top: 4px solid #09768E;"
                id="genInput">
                <h2 id="selectionHeading">Input Data </h2>
                <br><br>

                <div>
                    <label class="Lab4"> <span>Income from operations <br><span class="sems">(Enter as positive
                                figure)</span> </span>
                        <input class="inputC" type="text" id="calIncome" name="calIncome"
                            oninput="formatInput(this), getSum(this)" required> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Cost Of Income <br><span class="sems">(Enter as negative
                                figure)</span> </span>
                        <input class="inputC" type="text" id="calCos" name="calCos"
                            oninput="formatInput(this), getSum(this)" required> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Expenses<br><span class="sems">(Enter as negative
                                figure)</span> </span>
                        <input class="inputC" type="text" id="calExp" name="calExp"
                            oninput="formatInput(this), getSum(this)" required> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Accounting Income from operations <br><span
                                class="sems">(Calculated Field)</span> </span>
                        <input class="inputC" type="text" id="calAccInc" name="calAccInc"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Property Income - Commercial FreeZone <br><span class="sems">(Enter
                                as negative
                                figure)</span> </span>
                        <input class="inputC" type="text" id="calProInc" name="calProInc"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Did you elect for realization basis of accounting ? </span>

                        <select id="calReaBaseS" name="calReaBaseS">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Amount of unrealized gains included above <br><span
                                class="sems">(Gains enter as negative figure, losses enter as positive figure)</span>
                        </span>
                        <input class="inputC" type="text" id="calRelGain" name="calRelGain"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Amount of expense included above not wholly related to business- enter
                            only non business portion <br><span class="sems">(Enter as positive figure )</span>
                        </span>
                        <input class="inputC" type="text" id="expenses_for_business" name="expenses_for_business"
                            oninput="formatInput(this)"> </label>
                </div>


                <div>
                    <label class="Lab4"> <span>Any income or capital gains already taxed in UAE or foreign: <br><span
                                class="sems">(Enter as negative figure)</span> </span>
                        <input class="inputC" type="text" id="calCapGain" name="calCapGain"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Any domestic dividend included in total income:<br><span
                                class="sems">(Enter as negative figure)</span> </span>
                        <input class="inputC" type="text" id="calDomDiv" name="calDomDiv"
                            oninput="formatInput(this)"> </label>
                </div>

                <div>
                    <label class="Lab4"> <span>Foreign dividends or participating income in accounting
                            income:<br><span class="sems">(Enter as negative figure)</span>
                        </span>
                        <input class="inputC" type="text" id="calForDiv" name="calForDiv"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Net Interest Expense Limitation <br><span class="sems">(Enter as
                                positive figure for net interest expense and negative figure
                                for net interest income)</span> </span>
                        <input class="inputC" type="text" id="calIntExp" name="calIntExp"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span> Depreciation and Amortization <br><span class="sems">(Enter as
                                positive figure)</span> </span>
                        <input class="inputC" type="text" id="calDepAmot" name="calDepAmot"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Entertainment Expenditure<br><span class="sems">(Enter as positive
                                figure)</span> </span>
                        <input class="inputC" type="text" id="calEntExp" name="calEntExp"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Expense not wholly or fully for businees:<br><span
                                class="sems">(Enter as positive figure)</span> </span>
                        <input class="inputC" type="text" id="calBusExp" name="calBusExp"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Transfer Pricing, related parties and connected parties:<br><span
                                class="sems">(Enter as negative figure if sales were made at lower then market value
                                and negative figure is vice versa)</span> </span>
                        <input class="inputC" type="text" id="calTraPri" name="calTraPri"
                            oninput="formatInput(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Tax credit Foreign Income<br><span class="sems">(Enter as negative
                                figure)</span> </span>
                        <input class="inputC" type="text" id="tax_credit_foreign_income"
                            name="tax_credit_foreign_income" oninput="formatInput(this)"> </label>
                </div>

                <br>
                <div>
                    <label class="Lab4"> <span>Unincorporated Partnership:
                            <br> <span class="sems">(Entr Your Percentage of Ownership)</span>
                        </span>
                        <input class="inputC" type="text" id="calUnInoPart" name="calUnInoPart"
                            oninput="formatInput(this);getPercentage(this)"> </label>
                </div>
                <div>
                    <label class="Lab4"> <span>Carry forward tax loss: <br><span class="sems">(Please enter
                                negative figure)</span> </span>
                        <input class="inputC" type="text" id="calCarLoss" name="calCarLoss"
                            oninput="formatInput(this)"> </label>
                </div>


                <div style="display:none;">
                    <label class="Lab4"> <span>Calculation Type: </span>
                        <input class="inputC" type="text" id="calType" name="calType"
                            oninput="formatInput(this)"> </label>
                </div>

                <br><br>

            </div>

            <div class="btnDiv" style="position:relative">

                <div class="tempBtnDiv" style="text-align:center; padding:5px; border-radius:10px;">
                    <!-- style="background:#3e4d6dae; text-align:center; padding:5px; border-radius:10px; display: none;"> -->
                    <h4 style="color:white;display: none;">Temporary Box</h4>
                    <select id="fruits" onchange="populateData()" style="display: none;">
                        <option value="">Select Scenario </option>
                        <option value="3">Scenario 3 - Individual</option>
                        <option value="4">Scenario 4 - Individual</option>
                        <option value="5">Scenario 5 - Individual</option>
                        <option value="6">Scenario 6- Free Zone - nonCommerical Property</option>
                        <option value="7">Scenario 7- Free Zone - Commerical Property</option>
                        <option value="8">Scenario 8 - Normal less Than 3 Million </option>
                        <option value="9">Scenario 9- Normal more Than 3 Million </option>
                    </select>

                    <!-- <button onclick="getCalValues()" class="btnTemp">Computation</button> -->
                    <a id="downloadBtn" class="refresh" style="padding: 10px; text-decoration: none;">Refresh</a>
                    <a id="downloadBtn" class="refreshBtnS" style="padding: 10px; text-decoration: none;">Clear
                    </a>
                </div>

                <div id="confEmail">
                    <button class="btnPrevious" onclick="preThree()"> ⮜ Previous </button>
                    <button class="btnNext" onclick="funSubmit()"> Submit ⮞</button>
                </div>
                <div id="sendEmail" style="display:none">
                    <!-- <button class="btnNext"><a id='my-link' onclick="convertPDF()" target ="_blank">Print Invoice
                        </a></button> -->
                    <a href="https://mail.google.com/" target="_blank" class="btnNext"
                        style="padding: 15px; width: 100%; background: #ed0202; text-decoration: none; color: #ffffff; display: inline-block;">Please
                        Click Here to Check Email
                    </a>

                </div>

            </div>
        </div>
        <div id="one" class="one conA">
            <div style="text-align:center; ">
                <div class="conBox">
                    <div style="text-align:center; margin-top:5px;">
                        <img src="Resources/logo/ASK.png" alt="" style="width:120px;">
                    </div>
                    <br><br>
                    <div>
                        <label class="Lab1" for="cName"> <span>Name: <span class="required">*</span></span>
                            <input class="inputA" type="text" id="cName" name="cName" placeholder="">
                        </label>
                    </div>

                    <div>
                        <label class="Lab1" for="cEmail"> <span>Email: <span class="required">*</span></span>
                            <input class="inputA" type="email" id="cEmail" name="cEmail" placeholder="">
                        </label>
                    </div>

                    <div>
                        <label class="Lab1" for="cMobile"> <span>Mobile:</span>
                            <input class="inputA" type="text" id="cMobile" name="cMobile" placeholder="">
                        </label>
                    </div>

                    <div>
                        <label class="Lab1" for="cCompany"> <span>Company:</span>
                            <input class="inputA" type="text" id="cCompany" name="cCompany" placeholder="">
                        </label>
                    </div>


                    <div class="disclaimer">

                        <p>
                            <span>Disclaimer: </span>
                            This calcualtor is for informational purposes only, site oweners will not be responsible
                            for any loss resulting from use of calcualtor. Please obtain advise from a tax expert in
                            respect of detrmination of your tax liability. This calculator does not include group
                            reliefs,
                            business by government entites, restucturing relief, tax treaty relief and such other
                            credits
                            you may be eligible for.
                        </p>
                    </div>
                </div>
                <div style="text-align:center;">

                    <div class="tempBtnDiv" style="text-align:center; padding:5px; border-radius:10px;">
                        <!-- style="background:#3e4d6dae; text-align:center; padding:5px; border-radius:10px;"> -->
                        <span><button class="btnTemp" onclick="tempInfo()"style="display: none;"> Temp Details
                            </button></span> <!---->
                        <button onclick="toggleDiv(this)" class="btnTemp" style="display: none;">Computation</button>
                        <button id="downloadBtn" style="display: none;">Download as PDF</button>
                        <a id="downloadBtn" class="refresh" style="padding: 10px; text-decoration: none;">Refresh</a>
                        <a id="downloadBtn" class="refreshBtn"
                            style="padding: 10px; text-decoration: none;">Clear</a>
                    </div>

                    <button class="btnFirst" onclick="nextTwo()">Get Started ⮞</button>
                </div>
            </div>
        </div>
    </div>
</div>
<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo"
    style="background-color: #152860;height: 150px;">
    <div class="footer-width-fixer">
        <div class="elementor-element elementor-element-7265ea7 elementor-shape-circle elementor-grid-0 e-grid-align-center elementor-widget elementor-widget-social-icons"
            data-id="7265ea7" data-element_type="widget" data-widget_type="social-icons.default">
            <div class="elementor-widget-container">
                <style>
                    .elementor-social-icons-wrapper {
                        display: flex;
                        gap: 10px;
                        justify-content: center;
                        align-items: center;
                    }

                    .elementor-social-icon {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background-color: #69727d;
                        border-radius: 50%;
                        width: 40px;
                        height: 40px;
                        color: #fff;
                        transition: background-color 0.3s;
                    }

                    .elementor-social-icon:hover {
                        margin-bottom: 10px;
                    }
                </style>
                <div class="contt" style="padding-top: 50px;">
                    <div class="elementor-social-icons-wrapper">
                        <a class="elementor-social-icon" style="background-color: #3b5998;text-decoration: none;"
                            href="https://www.facebook.com/askconsultpk" target="_blank">
                            <i class="fa fa-facebook" style="font-size:24px;"></i>
                        </a>
                        <a class="elementor-social-icon" style="background-color: #EB0B0B;text-decoration: none;"
                            href="mailto:info@ask-management-consultants.com" target="_blank">
                            <i class="fa fa-envelope" style="font-size:24px"></i>
                        </a>
                        <a class="elementor-social-icon" style="background-color: #25d366;text-decoration: none;"
                            href="https://wa.me/923407007004" target="_blank">
                            <i class="fa fa-whatsapp" style="font-size:24px"></i>
                        </a>
                        <a class="elementor-social-icon" style="background-color: #1da1f2;text-decoration: none;"
                            href="https://twitter.com/aamersikandar" target="_blank">
                            <i class="fa fa-twitter" style="font-size:24px"></i>
                        </a>
                        <a class="elementor-social-icon" style="background-color: #cd201f;text-decoration: none;"
                            href="https://www.youtube.com/@aamersikandar7712" target="_blank">
                            <i class="fa fa-youtube-play" style="font-size:24px"></i>
                        </a>
                        <a class="elementor-social-icon" style="background-color: #0077b5;text-decoration: none;"
                            href="https://www.linkedin.com/company/14492185/admin/" target="_blank">
                            <i class="fa fa-linkedin-square" style="font-size:24px"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-element elementor-element-b59badf elementor-widget elementor-widget-text-editor"
            data-id="b59badf" data-element_type="widget" data-widget_type="text-editor.default">
            <div class="elementor-widget-container" style="text-align: center;">
                <p style="color: #ffffff;">© 2018 – 2024 <span style="color: #ffffff;"><a
                            style="color: #ffffff;text-decoration: none;"
                            href="https://ask-management-consultants.com">ask-management-consultants.com</a></span> All
                    rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<style>
    .cem {
        margin: 10px 0;
        cursor: pointer;
    }

    .cem span {
        padding: 15px;
        border-radius: 8px;
        background: #5ab8d0;
        color: white;
        transition: background 0.3s ease;
    }

    .cem:hover span {
        background: #0056b3;
    }

    .hidden {
        display: none;
    }
</style>
<style>
    .btnDiv {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background: linear-gradient(135deg, #3e4d6dae, #2a2f32);
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .tempBtnDiv {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
    }

    h4 {
        margin-bottom: 10px;
    }

    select {
        padding: 8px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
        /* Set a background color */
        color: #000;
        /* Set text color */
        width: 100%;
        /* Set the width to 100% */
        box-sizing: border-box;
        /* Include padding and border in the element's total width and height */
    }

    .btnTemp {
        padding: 10px;
        background: #5ab8d0;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #downloadBtn {
        margin-top: 4px;
        padding: 4px;
        background: #5ab8d0;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<style>
    .secBreak {
        padding: 10px;
    }

    .Lab1>span,
    .Lable {
        min-width: 120px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
        color: #09768E;
        font-size: 15px;
    }

    .Lable2 {
        font-weight: bold;
        color: #09768E;
        font-size: 15px;
    }

    .inputA {
        font-size: 15px;
        min-width: 310px;
        padding: 3px 10px;
        margin: 4px 0 10px 0;
        box-sizing: border-box;
        border: solid 1px rgb(210, 207, 207);
        box-shadow: 1px 1px 4px #EBEBEB;
        border: 0.5px solid #09768E;
    }

    .inputA:hover {
        background: #F3F2F0;
        border: 0.5px solid #8e3809;
    }

    .Lab2>span {
        width: 200px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
        color: #09768E;
        font-size: 15px;
    }

    .Lab3>span {
        width: 300px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
        color: #09768E;
        font-size: 15px;
    }

    .inputB {
        font-size: 15px;
        min-width: 180px;
        padding: 3px 10px;
        margin: 4px 0 10px 0;
        box-sizing: border-box;
        border: solid 1px rgb(210, 207, 207);
        box-shadow: 1px 1px 4px #EBEBEB;
        border: 0.5px solid #09768E;
    }

    .inputB:hover {
        background: #F3F2F0;
        border: 0.5px solid #8e3809;
    }

    .inputA::placeholder {
        color: rgb(239, 233, 233);
    }

    .Lab4>span {
        width: 440px;
        font-weight: bold;
        float: left;
        padding-top: 10px;
        padding-right: 5px;
        color: #09768E;
        font-size: 13px;
        border-bottom: 1px dotted gray;
    }

    .inputC {
        font-size: 13px;
        text-align: right;
        min-width: 100px;
        max-width: 150px;
        padding: 2px 10px;
        margin: 3px 0 32px 0;
        box-sizing: border-box;
        border: solid 1px rgb(210, 207, 207);
        box-shadow: 1px 1px 4px #EBEBEB;
        border: 0.5px solid #09768E;
    }

    .sems {
        font-size: 13px;
    }

    .inputC:hover {
        background: #F3F2F0;
        border: 0.5px solid #8e3809;
    }

    .required {
        color: red;
    }

    .hidden {
        display: none;
    }

    .bgPic {
        padding: 15px;
        border-radius: 10px;
        background: url('/static/JAVA/Images/BackPng/backPng5A.png') no-repeat;
        background-size: 100%;
        background-position: right top;
    }

    @media (max-width: 500px) {
        .secBreak {
            padding: 0px;
        }
    }


    #about-home {
        background-image: linear-gradient(rgba(240, 241, 253, 0.9), rgba(65, 88, 96, 0.9)), url('calculation1.jpg');
        width: 100%;
        background-size: cover;
        background-position: center;
    }

    .conTop {
        background: #09768E;
        width: 100%;
        max-height: 85px;
    }

    .heading {
        display: -webkit-box;
        padding: 8px 5% 15px 5%;
    }

    .headingText {
        margin: 0px 10px;
    }

    .headingText1 {
        font-size: 30px;
        color: white;
    }

    .headingText2 {
        font-size: 20px;
        color: rgb(251, 243, 138);
    }

    .heading img {
        width: 55px;
    }

    .conMid {
        background: #09768E;
        width: 100%;
    }

    .conMidMain {
        width: 100%;
        min-height: 650px;
        margin: auto;
        border-radius: 5px;
        padding: 15px 35px 10px 25px;
        background-color: #f2f2f2;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .conMidHeading {
        text-align: center;
        font-size: 25px;
        font-weight: 100;
        color: #8e2609;

    }

    .conA {
        width: 95%;
        border-radius: 5px;
        margin: auto;
        padding: 0px 35px 0px 25px;

    }

    .conBox {
        margin: 20px auto;
        /* padding: 10px 20px 10px 20px; */
        background-color: #ffff;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .conPBar {
        width: 500px;
        border-radius: 5px;
        padding: 5px 35px 5px 25px;
        background: transparent;
        margin: auto;
    }

    h2 {
        font-size: 25px;
        color: #03404e;
    }

    .title {
        font-size: 18px;
        color: #8e0b09;
        margin-bottom: 35px;
    }

    .hrLine {
        border-bottom: 1px solid rgb(219, 218, 218);
    }


    .conB {
        width: 95%;
        border-radius: 5px;
        margin: auto;
        padding: 0px 35px 0px 25px;

    }

    #bi_to_Yes_div {
        display: none;
    }

    #bi_rs_nr_div,
    #bi_rs_i_div,
    #bi_rs_nr_yes_span,
    #bi_rs_i_elect_noSpan {
        display: none;
    }

    #ls_fPE_div,
    #ls_fPE_ele_yesSpan,
    #ls_uPS_div,
    #ls_uPS_ele_yesSpan,
    #ls_PF_div,
    #ls_PF_ele_yesSpan,
    #ls_PF_ele_noSpan {
        display: none;
    }

    .btnDiv {
        width: 600px;
        margin: auto;
        display: flex;
        justify-content: center;
    }

    .btnPrevious,
    .btnNext {
        min-width: 100px;
        padding: 10px 20px;
        border-radius: 5px;
        width: 120px;
        background: #5ab8d0;
        color: white;
        margin: 0 20px;
    }

    .btnPrevious:hover,
    .btnNext:hover {
        background: #337281;
    }

    .btnEmpty,
    .btnEmpty3 {
        min-width: 100px;
        padding: 10px 20px;
        border-radius: 5px;
        width: 120px;
        background: #aeb8ba;
        color: white;
        margin: 0 20px;
        display: none;
    }

    .btnFirst {
        min-width: 100px;
        padding: 10px 15px;
        border-radius: 5px;
        width: 120px;
        background: #5ab8d0;
        color: white;
        font-size: small !important;
        box-shadow: 2px 2px 6px 2px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .btnFirst:hover {
        background: #337281;
    }

    #one {
        display: block;
    }

    #two,
    #three,
    #four {
        display: none;
    }

    #bACYear {
        width: 200px;
    }

    .progress-barr {
        display: -webkit-box;
        user-select: none;
    }

    @media (max-width: 1355px) {
        .progress-barr .step p {
            /* for responsive */
            margin-right: 4px !important;
            /* for responsive */
        }

        .progress-barr .step .bullet:before,
        .progress-barr .step .bullet:after {
            right: -60px !important;
            width: 59px !important;
        }

        .conMidHeading {
            font-size: 18px !important;
        }

        .headingText1 {
            font-size: 23px !important;
        }

        .conBox {
            width: 290px !important;
        }

        .inputA {
            min-width: 0 !important;
            width: 230px !important;
        }

        /* .inputC {
            min-width: 0 !important;
            width: 90px !important;
        } */

        .btnPrevious,
        .btnNext {
            padding: 1px 0px !important;

            width: 225px !important;
        }

        .btnDiv {
            width: 278px !important;

        }

        .swal2-container.swal2-center>.swal2-popup {
            grid-column: 1 !important;
            margin-left: 28px !important;

        }

        .swal2-popup {
            width: 20em !important;

        }

        .brsi {
            width: 125px !important;

        }

        #bi_rs_div {
            width: 210px !important;

        }

        #bi_rs_nr_div {
            width: 210px !important;

        }

        #bi_rs_i_div {
            width: 218px !important;

        }

        #bi_to_Yes_div {
            width: 218px !important;

        }

        #ls_fPE_div {
            width: 218px !important;

        }

        #ls_uPS_div {
            width: 218px !important;

        }

        #ls_PF_div {
            width: 218px !important;

        }

        #calReaBaseS {
            width: 200px !important;

        }

        .cried {
            width: 115px !important;

        }

        .inputX {
            min-width: 0 !important;
            width: 165px !important;

        }

        .erpis {
            width: 42px !important;

        }

        .erise {
            width: 218px !important;

        }

        .erps {
            width: 150px !important;

        }

        .Lab4>span {
            width: 150px !important;
        }

        .mainDiv {
            width: 381px !important;
        }

        .mainDiv_F {
            width: 381px !important;
        }

        .cxm {
            width: 280px !important;
        }

        .WESX {
            display: block !important;
        }

        /* Add more styles as needed */
    }


    .progress-barr .step {
        text-align: center;
        /* width: 100%; */
        position: relative;
    }

    .progress-barr .step p {
        font-weight: 500;
        font-size: 13px;
        /* font-size: 14px; */
        color: #640401;
        margin-top: 7px;
        margin-right: 0;
        margin-left: 0;
        margin-bottom: 0;
    }

    .progress-barr .step .bullet {


        height: 25px;
        width: 25px;
        border: 1px solid #640401;
        display: inline-block;
        border-radius: 50%;
        position: relative;
        transition: 0.2s;
        font-weight: 500;
        font-size: 17px;
        line-height: 25px;
    }

    .progress-barr .step .bullet.active {
        border-color: #09768E;
        background: #09768E;
    }

    .progress-barr .step .bullet span {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .progress-barr .step .bullet.active span {
        display: none;
    }

    .progress-barr .step .bullet:before,
    .progress-barr .step .bullet:after {
        position: absolute;
        content: '';
        bottom: 11px;
        /* right: -60px; */
        right: -87px;
        height: 2px;
        /* width: 59px; */
        width: 86px;
        background: rgb(172, 74, 70);
    }

    .progress-barr .step .bullet.active:after {
        background: #09768E;
        transform: scaleX(0);
        transform-origin: left;
        animation: animate 0.3s linear forwards;
    }

    @keyframes animate {
        100% {
            transform: scaleX(1);
        }
    }

    .progress-barr .step:last-child .bullet:before,
    .progress-barr .step:last-child .bullet:after {
        display: none;
    }

    .progress-barr .step p.active {
        color: #09768E;
        transition: 0.2s linear;
    }

    .progress-barr .step .check {
        position: absolute;
        left: 50%;
        top: 70%;
        font-size: 15px;
        transform: translate(-50%, -50%);
        display: none;
    }

    .progress-barr .step .check.active {
        display: block;
        color: #fff;
    }

    .brsi {
        width: 180px;
        margin-left: 20px;
        font-weight: bold;
    }

    #bi_rs_div {
        display: none;
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 18px;
        padding: 5px 10px;
        font-size: 12px;
    }

    #bi_rs_nr_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
        /* display: block; */
    }

    #bi_to_Yes_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
    }

    #bi_rs_i_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
    }

    #ls_fPE_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
        /* display: block; */
    }

    #ls_uPS_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
        /* display: block; */
    }

    #ls_PF_div {
        border: 1px solid gray;
        width: 470px;
        background: rgb(253, 253, 202);
        margin-left: 38px;
        padding: 5px 10px;
        font-size: 12px;
        /* display: block; */
    }

    .inputX {
        font-size: 15px;
        min-width: 310px;
        padding: 3px 10px;
        margin: 4px 0 10px 0;
        box-sizing: border-box;
        border: solid 1px rgb(210, 207, 207);
        box-shadow: 1px 1px 4px #EBEBEB;
        border: 0.5px solid #09768E;
    }

    .erpis {
        width: 450px;
        margin-left: 20px;
        font-weight: bold;
    }

    .cried {
        width: 400px;
        margin-left: 20px;
        font-weight: bold;
    }

    .erps {
        color: red;
        font-size: 12px;
        margin-left: 15px;
    }

    .erise {
        width: 300px;
        margin-left: 20px;
        font-weight: bold;
    }

    #calReaBaseS {
        padding: 5px 10px;
        width: 150px;
        float: right;
        margin-right: 30px;
        background: lightgray;
    }

    .cxm {
        width: 700px;
        min-height: 450px;
        margin: 20px auto;
        padding: 20px 40px 20px 60px;
        border-top: 4px solid #09768E;
        background: white;
    }

    .WESX {
        display: flex;
        justify-content: space-between;
    }

    /* add rae  */
    .one.conA .conBox {
        position: relative;
        width: 60%;
        border-top: 4px solid #09768E;
    }

    .two .conBox {
        position: relative;
        width: 60%;
        border-top: 4px solid #09768E;
    }

    .three .conBox {
        position: relative;
        width: 60%;
        border-top: 4px solid #09768E;
    }

    .four .conBox {
        position: relative;
        width: 60%;
        border-top: 4px solid #09768E;
    }

    .one.conA .conBox .disclaimer {
        margin-top: 20px;
        width: 100%;
        left: 0px;
        bottom: 0px;
        padding: 20px 30px;
        font-size: 13px;
        background: rgb(230, 253, 253);
    }

    .one.conA .conBox .disclaimer p span {
        font-weight: bold;
        color: black;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get references to all elements with the "refresh" class
        var refreshBtns = document.querySelectorAll(".refresh");

        // Add click event listener to each Refresh button
        refreshBtns.forEach(function(refreshBtn) {
            refreshBtn.addEventListener("click", function() {
                // Reload the page
                location.reload();
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get reference to the Refresh button
        var refreshBtn = document.querySelector(".refreshBtn");

        // Add click event listener to the Refresh button
        refreshBtn.addEventListener("click", function() {
            // Get references to input elements
            var cNameInput = document.getElementById("cName");
            var cEmailInput = document.getElementById("cEmail");
            var cMobileInput = document.getElementById("cMobile");
            var cCompanyInput = document.getElementById("cCompany");

            // Clear the values of input fields
            cNameInput.value = "";
            cEmailInput.value = "";
            cMobileInput.value = "";
            cCompanyInput.value = "";
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get reference to the Refresh button
        var refreshBtn = document.querySelector(".refreshBtnS");
        // Add click event listener to the Refresh button
        refreshBtn.addEventListener("click", function() {
            // Get references to input elements
            var calIncome = document.getElementById("calIncome");
            var calCos = document.getElementById("calCos");
            var calExp = document.getElementById("calExp");
            var calAccInc = document.getElementById("calAccInc");
            var calProInc = document.getElementById("calProInc");
            var calReaBaseS = document.getElementById("calReaBaseS");
            var calRelGain = document.getElementById("calRelGain");
            var expenses_for_business = document.getElementById("expenses_for_business");
            var calCapGain = document.getElementById("calCapGain");
            var calDomDiv = document.getElementById("calDomDiv");
            var calForDiv = document.getElementById("calForDiv");
            var calIntExp = document.getElementById("calIntExp");
            var calDepAmot = document.getElementById("calDepAmot");
            var calEntExp = document.getElementById("calEntExp");
            var calBusExp = document.getElementById("calBusExp");
            var calTraPri = document.getElementById("calTraPri");
            var tax_credit_foreign_income = document.getElementById("tax_credit_foreign_income");
            var calUnInoPart = document.getElementById("calUnInoPart");
            var calCarLoss = document.getElementById("calCarLoss");
            // for free zone 
            var stdTax = document.getElementById("stdTax");
            var stdTaxNCP = document.getElementById("stdTaxNCP");
            var stdTaxCP = document.getElementById("stdTaxCP");
            var salOthFZ = document.getElementById("salOthFZ");
            var nonFZper = document.getElementById("nonFZper");

            // Clear the values of input fields
            calIncome.value = "";
            calCos.value = "";
            calExp.value = "";
            calAccInc.value = "";
            calProInc.value = "";
            calReaBaseS.value = "Yes"; // Reset select dropdown to default value
            calRelGain.value = "";
            expenses_for_business.value = "";
            calCapGain.value = "";
            calDomDiv.value = "";
            calForDiv.value = "";
            calIntExp.value = "";
            calDepAmot.value = "";
            calEntExp.value = "";
            calBusExp.value = "";
            calTraPri.value = "";
            tax_credit_foreign_income.value = "";
            calUnInoPart.value = "";
            calCarLoss.value = "";
            // for free zone
            stdTax.value = "";
            stdTaxNCP.value = "";
            stdTaxCP.value = "";
            salOthFZ.value = "";
            nonFZper.value = "";
        });

        // console.log("Inputs cleared successfully");
    });
</script>
<script>
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    let current = 1;


    function nextTwo() {

        var cName = document.getElementById("cName").value;
        var cEmail = document.getElementById("cEmail").value;
        var cMobile = document.getElementById("cMobile").value;
        var cCompany = document.getElementById("cCompany").value;

        if (cName === '' || cEmail === '') {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Please enter all the details before proceeding.....!',
            });
            // alert('Please enter all the details before proceeding.....!');

        } else if (!validateEmail(cEmail)) {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Please enter a valid email address....!',
            });
            // alert('Please enter a valid email address....!');
        } else {
            nextTwoA()
        }
    }

    function nextTwoA() {
        var divOne = document.getElementById("one");
        var divTwo = document.getElementById("two");

        divOne.style.display = "none";
        divTwo.style.display = "block";

        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
    }

    function preOne() {
        var divOne = document.getElementById("one");
        var divTwo = document.getElementById("two");

        divOne.style.display = "block";
        divTwo.style.display = "none";

        bullet[current - 2].classList.remove("active");
        progressCheck[current - 2].classList.remove("active");
        progressText[current - 2].classList.remove("active");
        current -= 1;

    }

    function nextThree() {
        var s_Year = document.getElementsByName("startDate")[0].value;
        var e_Year = document.getElementsByName("endDate")[0].value;
        var bi_to_Yes = document.getElementsByName("bi_to")[0].checked;
        var bi_to_No = document.getElementsByName("bi_to")[1].checked;
        var bi_rs_r = document.getElementsByName("bi_rs")[0].checked;
        var bi_rs_nr = document.getElementsByName("bi_rs")[1].checked;
        var bi_rs_ind = document.getElementsByName("bi_rs")[2].checked;

        if (s_Year && e_Year && (bi_to_Yes || bi_to_No) && (bi_rs_r || bi_rs_nr || bi_rs_ind)) {
            nextThreeA();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Please fill the input and select radio buttons to proceed....!',
            });
            // alert("Please fill the input and select radio buttons to proceed....!");
        }
    }


    function nextThreeA() {
        var divTwo = document.getElementById("two");
        var divThree = document.getElementById("three");

        divTwo.style.display = "none";
        divThree.style.display = "block";


        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        current += 1;
    }

    function preTwo() {
        var divTwo = document.getElementById("two");
        var divThree = document.getElementById("three");

        divTwo.style.display = "block";
        divThree.style.display = "none";

        bullet[current - 2].classList.remove("active");
        progressCheck[current - 2].classList.remove("active");
        progressText[current - 2].classList.remove("active");
        current -= 1;

    }

    function nextFour() {
        var ls_rPE = document.getElementsByName("ls")[0].checked;
        var ls_fPE = document.getElementsByName("ls")[1].checked;
        var ls_uPS = document.getElementsByName("ls")[2].checked;
        var ls_iPS = document.getElementsByName("ls")[3].checked;
        var ls_oJP = document.getElementsByName("ls")[4].checked;
        var ls_FZ = document.getElementsByName("ls")[5].checked;
        var ls_PF = document.getElementsByName("ls")[6].checked;

        if (ls_uPS) {
            // If Unincorporated Partnership is selected, validate the percentage_of_ownerShip
            var percentageInput = document.getElementById("bi_Year");
            var percentageValue = percentageInput.value;

            if (percentageValue === "" || isNaN(percentageValue) || +percentageValue < 0 || +percentageValue > 100) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please enter a valid percentage of ownership (between 0 and 100).',
                });
                return; // Stop execution if validation fails
            }
        }

        if ((ls_rPE || ls_fPE || ls_uPS || ls_iPS || ls_oJP || ls_FZ || ls_PF)) {

            nextFourA();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Please select one of the following option to proceed....!',
            });
            // alert("Please select one of the option to proceed....!");
        }
    }

    function nextFourA() {
        var divThree = document.getElementById("three").style.display = "none";
        var divFour = document.getElementById("four").style.display = "block";


        if (selIndi == "Individual") {
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            progressText[current - 1].classList.add("active");
            current += 1;

            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            progressText[current - 1].classList.add("active");
            current += 1;
        } else {
            bullet[current - 1].classList.add("active");
            progressCheck[current - 1].classList.add("active");
            progressText[current - 1].classList.add("active");
            current += 1;
        }

        document.getElementById("two").style.display = "none";
        gatherSelectedValues();

    }

    function preThree() {

        if (selIndi == "Individual") {
            document.getElementById("two").style.display = "block";
            document.getElementById("four").style.display = "none";

            bullet[current - 1].classList.remove("active");
            progressCheck[current - 1].classList.remove("active");
            progressText[current - 1].classList.remove("active");
            current -= 1;

            bullet[current - 1].classList.remove("active");
            progressCheck[current - 1].classList.remove("active");
            progressText[current - 1].classList.remove("active");
            current -= 1;

        } else {
            document.getElementById("three").style.display = "block";
            document.getElementById("four").style.display = "none";

            bullet[current - 1].classList.remove("active");
            progressCheck[current - 1].classList.remove("active");
            progressText[current - 1].classList.remove("active");
            current -= 1;

            hidDiv()
        }
    }


    function funSubmit() {

        let tIncome = document.getElementsByName("calAccInc")[0].value;
        let totIncome = parseFloat(tIncome.replace(/,/g, ''));
        console.log(totIncome)
        if (totIncome <= 2999999) {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Total Accounting Income is Less than 3 million, Please Apply for SME Relief ...!',
            });
            // alert("Total Accounting Income is Less than 3 million, Please Apply for SME Relefe ...!")
        } else {
            funSubmitA()
        }

    }


    function funSubmitA() {
        bullet[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");

        document.getElementById('confEmail').style.display = 'none';
        document.getElementById('sendEmail').style.display = 'block';

        getCalValues()
    }


    function convertPDF() {
        var cName = document.getElementById("cName").value;
        var cEmail = document.getElementById("cEmail").value;
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;
        FatchData.name = cName;
        FatchData.email = cEmail;
        FatchData.startDate = startDate;
        FatchData.endDate = endDate;

        var jsonString = JSON.stringify(FatchData);

        var arr = ["Medica Care Solution", "BaseFR", "Medica Trading LLC"]
        document.getElementById('my-link').setAttribute('href', `citComputationPDF?query_name= ${jsonString}`);

        document.getElementById('sendEmail').style.display = 'none';
    }


    let selIndi, divId, typeVal
    console.log(selIndi + "===========")

    function bi_rs_r() {
        var bi_rs_r = document.getElementById("bi_rs_r");
        var bi_rs_nr_div = document.getElementById("bi_rs_nr_div");
        var bi_rs_i_div = document.getElementById("bi_rs_i_div");


        bi_rs_nr_div.style.display = bi_rs_r.checked ? "none" : "block";
        bi_rs_i_div.style.display = bi_rs_r.checked ? "none" : "block";


        document.getElementById("bi_rs_div").style.display = "block";


        document.getElementById("bttnNext").style.display = "block";
        document.getElementById("btnEmpty").style.display = "none";
        document.getElementById("btnSupSede").style.display = "none";

        document.getElementById("turnover_Div").style.display = "block";

        selIndi = "None"
    }

    function bi_rs_nr() {
        var bi_rs_nr = document.getElementById("bi_rs_nr");
        var bi_rs_nr_div = document.getElementById("bi_rs_nr_div");
        var bi_rs_i_div = document.getElementById("bi_rs_i_div");


        bi_rs_nr_div.style.display = bi_rs_nr.checked ? "block" : "none";
        bi_rs_i_div.style.display = bi_rs_nr.checked ? "none" : "block";


        document.getElementById("bttnNext").style.display = "block";
        document.getElementById("btnEmpty").style.display = "none";
        document.getElementById("btnSupSede").style.display = "none";


        document.getElementById("bi_rs_div").style.display = "none";

        document.getElementById("turnover_Div").style.display = "block";

        selIndi = "None"
    }

    function bi_rs_nr_yes() {
        var bi_rs_nr_yes = document.getElementById("bi_rs_nr_yes");
        var bi_rs_nr_yes_span = document.getElementById("bi_rs_nr_yes_span");


        bi_rs_nr_yes_span.style.display = bi_rs_nr_yes.checked ? "block" : "none";
    }



    function bi_rs_i() {

        var s_Year = document.getElementsByName("startDate")[0].value;
        var e_Year = document.getElementsByName("endDate")[0].value;

        if (s_Year && e_Year) {


            var individual = document.getElementById("individual");
            var bi_rs_nr_div = document.getElementById("bi_rs_nr_div");
            var bi_rs_i_div = document.getElementById("bi_rs_i_div");

            bi_rs_nr_div.style.display = individual.checked ? "none" : "block";
            bi_rs_i_div.style.display = individual.checked ? "block" : "none";


            document.getElementById("bttnNext").style.display = "block";
            document.getElementById("btnEmpty").style.display = "none";


            document.getElementById("bi_rs_i_elect_no").checked = false;
            document.getElementById("bi_rs_i_elect_noSpan").style.display = "none";

            document.getElementById("bi_rs_div").style.display = "none";

            document.getElementById("turnover_Div").style.display = "none";

            document.getElementById("bttnNext").style.display = "none";
            document.getElementById("btnSupSede").style.display = "block";
            selIndi = "Individual"

        } else {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: 'Please fill Start and End Date....!',
            });
            // alert("Please fill Start and End Date....!");
            document.getElementById("bttnNext").style.display = "none";
            document.getElementById("btnEmpty").style.display = "block";
            document.getElementById("individual").checked = false;
        }
    }

    function bi_rs_i_elect_no() {
        var bi_rs_i_elect_no = document.getElementById("bi_rs_i_elect_no");
        var bi_rs_i_elect_noSpan = document.getElementById("bi_rs_i_elect_noSpan");


        bi_rs_i_elect_noSpan.style.display = bi_rs_i_elect_no.checked ? "block" : "none";

        document.getElementById("bttnNext").style.display = "none";
        document.getElementById("btnEmpty").style.display = "block";
        document.getElementById("btnSupSede").style.display = "none";
    }

    function bi_rs_i_elect_yes() {
        var bi_rs_i_elect_no = document.getElementById("bi_rs_i_elect_no");
        var bi_rs_i_elect_noSpan = document.getElementById("bi_rs_i_elect_noSpan");

        bi_rs_i_elect_noSpan.style.display = "none";

        document.getElementById("bttnNext").style.display = "block";
        document.getElementById("btnEmpty").style.display = "none";

        document.getElementById('bi_to_No').checked = true;
        document.getElementById('ls_rPE').checked = true;


        document.getElementById("bttnNext").style.display = "none";
        document.getElementById("btnSupSede").style.display = "block";
        selIndi = "Individual"
    }

    function bi_to_No_div() {
        var bi_to_No = document.getElementById("bi_to_No");
        var bi_to_No_div = document.getElementById("bi_to_No_div");


        bi_to_Yes_div.style.display = bi_to_Yes.checked ? "block" : "none";
        if (bi_to_Yes.checked) {
            document.getElementById("bttnNext").style.display = "none";
            document.getElementById("btnEmpty").style.display = "block";
        } else {
            document.getElementById("bttnNext").style.display = "block";
            document.getElementById("btnEmpty").style.display = "none";
        }
    }


    function ls_hide() {
        var ls_fPE_div = document.getElementById("ls_fPE_div");
        ls_fPE_div.style.display = ls_fPE ? "none" : "block";

        var ls_uPS_div = document.getElementById("ls_uPS_div");
        ls_uPS_div.style.display = ls_uPS ? "none" : "block";

        var ls_PF_div = document.getElementById("ls_PF_div");
        ls_PF_div.style.display = ls_PF ? "none" : "block";
    }

    function ls_rPE() {
        ls_hide()
    }


    function ls_fPE() {
        ls_hide()
        var ls_fPE = document.getElementById("ls_fPE");
        var ls_fPE_div = document.getElementById("ls_fPE_div");


        ls_fPE_div.style.display = ls_fPE ? "block" : "none";
    }

    function ls_fPE_yes() {
        var ls_fPE_yes = document.getElementById("ls_fPE_yes");
        var ls_fPE_ele_yesSpan = document.getElementById("ls_fPE_ele_yesSpan");

        ls_fPE_ele_yesSpan.style.display = ls_fPE_yes.checked ? "block" : "none";
    }


    function ls_uPS() {
        ls_hide()
        var ls_uPS = document.getElementById("ls_uPS");
        var ls_uPS_div = document.getElementById("ls_uPS_div");

        ls_uPS_div.style.display = ls_uPS ? "block" : "none";
    }


    function ls_iPS() {
        ls_hide()
    }

    function ls_oJP() {
        ls_hide()
    }

    function ls_FZ() {
        ls_hide()
    }


    function ls_PF() {
        ls_hide()
        var ls_PF = document.getElementById("ls_PF");
        var ls_PF_div = document.getElementById("ls_PF_div");


        ls_PF_div.style.display = ls_PF ? "block" : "none";
    }


    function ls_PF_op() {
        var ls_PF_ele_yesSpan = document.getElementById("ls_PF_ele_yesSpan");
        ls_PF_ele_yesSpan.style.display = ls_PF_yes.checked ? "none" : "block";

        var ls_PF_ele_noSpan = document.getElementById("ls_PF_ele_noSpan");
        ls_PF_ele_noSpan.style.display = ls_PF_no.checked ? "none" : "block";
    }

    function ls_PF_yes() {
        ls_PF_op()
        ls_PF_ele_noSpan.style.display = ls_PF_no.checked ? "block" : "none";

    }

    function ls_PF_no() {
        ls_PF_op()
        ls_PF_ele_yesSpan.style.display = ls_PF_yes.checked ? "block" : "none";
    }

    function hidDiv() {
        document.getElementById('div1').classList.add('hidden');
        document.getElementById('div2').classList.add('hidden');
        document.getElementById('div3').classList.add('hidden');
        document.getElementById('div4').classList.add('hidden');
        document.getElementById('div5').classList.add('hidden');
        document.getElementById('div6').classList.add('hidden');
        document.getElementById('div7').classList.add('hidden');

        document.getElementById("genInput").style.display = "block";
    }


    function gatherSelectedValues() {
        var radioButtons = document.querySelectorAll('input[name="ls"]:checked');

        var jsonValues = [];
        radioButtons.forEach(function(radioButton) {
            var id = radioButton.id;
            var value = radioButton.value;
            jsonValues.push({
                [id]: value
            });
        });

        let Val = jsonValues[0][Object.keys(jsonValues[0])[0]]
        console.log(Val + "+++++++++++++++++");

        showDiv(Val)


        typeVal = Val
        var Type = document.getElementById("calType")
        Type.value = typeVal

    }


    function showDiv(Val) {

        var valuesToDivs = {
            'Resident PE': 'div1',
            'Foreign PE': 'div2',
            'Unincorporated Partner Ship': 'div3',
            'Incorporated Partner Ship': 'div4',
            'Other Judicial Person except Free zone': 'div5',
            'FreeZone': 'div6',
            'Private Fund': 'div7'
        };

        var selectedValue = Val
        var divId = valuesToDivs[selectedValue];


        if (selIndi == "Individual") {
            document.getElementById("genInput").style.display = "block";
        } else {


            var headingElement = document.getElementById('selectionHeading');
            headingElement.innerHTML = Val;

            document.getElementById(divId).classList.remove('hidden');
            if (divId == 'div6') {
                document.getElementById("genInput").style.display = "none";
            }

        }

    };




    tempInfoData = {
        'cName': 'farhad Ahmad',
        'cEmail': 'farhadsfz86@gmail.com',
        'cMobile': '+971 50 768 8990',
        'cCompany': 'farhad Trading LLC',
    }

    function validateEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function tempInfo() {
        for (var key in tempInfoData) {
            var element = document.getElementById(key);

            if (element) {
                if (element.tagName.toLowerCase() === 'select') {

                    var options = element.options;
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].value === tempInfoData[key]) {
                            options[i].selected = true;
                        }
                    }
                } else {

                    element.value = tempInfoData[key];
                }
            }
        }

    }

    function populateData() {


        var selectElement = document.getElementById("fruits");
        var selectedValue = selectElement.options[selectElement.selectedIndex].value;

        if (selectedValue === "3") {
            DataPopulate = DataPopulate3
        }
        if (selectedValue === "4") {
            DataPopulate = DataPopulate4
        }
        if (selectedValue === "5") {
            DataPopulate = DataPopulate5
        }
        if (selectedValue === "6") {
            DataPopulate = DataPopulate6
        }
        if (selectedValue === "7") {
            DataPopulate = DataPopulate7
        }
        if (selectedValue === "8") {
            DataPopulate = DataPopulate8
        }
        if (selectedValue === "9") {
            DataPopulate = DataPopulate9
        }

        for (var key in DataPopulate) {
            var element = document.getElementById(key);

            if (element) {
                if (element.tagName.toLowerCase() === 'select') {

                    var options = element.options;
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].value === DataPopulate[key]) {
                            options[i].selected = true;
                        }
                    }
                } else {
                    element.value = DataPopulate[key];
                }
            }
        }
        var Type = document.getElementById("calType")
        Type.value = typeVal
    }


    function formatInput(inputElement) {
        var numberValue = parseFloat(inputElement.value.replace(/,/g, ''));

        if (!isNaN(numberValue)) {

            var formattedValue = numberValue.toLocaleString();

            inputElement.value = formattedValue;
        }
    }

    function getSum(inputElement) {

        var calIncome = parseFloat(document.getElementsByName("calIncome")[0].value.replace(/,/g, '')) || 0;
        var calCos = parseFloat(document.getElementsByName("calCos")[0].value.replace(/,/g, '')) || 0;
        var calExp = parseFloat(document.getElementsByName("calExp")[0].value.replace(/,/g, '')) || 0;
        var sum = calIncome + calCos + calExp;

        console.log('Sum: ' + sum);
        document.getElementsByName('calAccInc')[0].value = sum.toLocaleString();
    }

    function getPercentage(input) {
        // Get the value of percentage_of_ownerShip
        var percentageValue = input.value;

        // Update the value of calUnInoPart with the percentageValue
        document.getElementById("calUnInoPart").value = percentageValue;
    }
</script>




<style>
    .tempBtnDiv {
        min-width: 100px;
        max-width: 200px;
        position: fixed;
        top: 150px;
        right: 20px;
        z-index: 200;
    }

    .btnTemp {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        cursor: pointer;
    }

    #myPopupDiv {
        position: fixed;
        top: 0;
        left: 0;
        display: none;
        padding: 10px;
        background: rgba(24, 24, 24, 0.66);
        width: 100%;
        height: 100%;
        overflow: auto;
        z-index: 100;


    }

    .mainDiv {
        position: relative;
        margin: 50px auto;
        width: 800px;
        min-height: 500px;
        background: white;
    }

    .mainDivBG {
        padding: 20px 40px;
        background: url('/static/JAVA/Images/BackPng/backPng5A.png') no-repeat;
        background-size: 100%;
        background-position: right top;
    }

    .calWorking {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px gray dotted;
        font-size: 14px;
    }

    .calWorking p {
        margin-bottom: 0 !important;
    }

    #myPopupDiv_F {
        position: fixed;
        top: 0;
        left: 0;
        display: none;
        padding: 10px;
        background: rgba(24, 24, 24, 0.66);
        width: 100%;
        height: 100%;
        overflow: auto;
        z-index: 100;


    }

    .mainDiv_F {
        position: relative;
        margin: 50px auto;
        width: 800px;
        min-height: 500px;
        background: white;
    }

    .mainDivBG_F {
        padding: 20px 40px;
        background: url('/static/JAVA/Images/BackPng/backPng5A.png') no-repeat;
        background-size: 100%;
        background-position: right top;
    }

    .calWorking_F {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px gray dotted;
        font-size: 14px;
    }

    .calWorking_F p {
        margin-bottom: 0 !important;
    }
</style>
<div id="myPopupDiv_F">

    <div class="mainDiv_F">
        <div class="mainDivBG_F">
            <div style="position:absolute; top:5px; right:5px; background:rgb(208, 213, 214); border-radius:50%; min-width:25px; min-height:25px; margin:auto; cursor:pointer; padding:5px; box-shadow: 3px 3px 4px #efe1e1;; font-size:12px;"
                onclick="closediv_F()">
                <input type="hidden" name="FreeZone">
                ❌
            </div>
            <div style="text-align:center">
                <img src="Resources/logo/ASK.png" alt="" style="width:200px;">
            </div>
            <br>
            <h4 id="greeting_F" style="color:gray; padding:10px 0 5px 0"> Dear Abdul Shakoor,
            </h4>
            <h6 style="color:gray; font-weight:100; text-align: justify; text-justify: inter-word;">
                Thanks for using ASK management tax calculator. Please be reminded that the
                calculator is for
                informational purposes only and may not cover all the circumstances relevant to
                you. You are
                therefore
                advised to obtain qualified opinion in respect of your tax liability. The use of
                calculator does
                not
                create any liability on ASK management consultants or its employees.
            </h6>


            <h3 style="padding: 10px 20px; text-align: center; color: rgb(107, 168, 182);"> Tax
                Computation
            </h3>

            <h5 id="taxYear_F" style="color:rgb(56, 162, 143); padding: 0px 0 0px 0; font-weight:100;">
                Your
                Tax year
                is: </h5>
            <h5 id="returnDate_F" style="color:rgb(56, 162, 143); padding: 0px 0 10px 0; font-weight:100;">
                Your
                first
                Tax return is due on: </h5>

            <div class="calWorking_F"
                style="padding: 3px 9px 3px 9px; font-weight: bold; background:rgb(164, 218, 221); margin-bottom:10px; border-bottom: 2px double;">
                <p>Description </p>
                <p> A m o u n t </p>
            </div>

            <div class="calWorking_F" style="font-weight: bold;">
                <p>Qualifying Income </p>
                <p id="a1_F"> 7,000,000 </p>
            </div>

            <div class="calWorking_F" style="background:#a4d4dd;">
                <p style="padding:5px 0; font-weight:bold;">Taxable Income @ 9%</p>
                <p id="i1_F" style="padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                    7,000,000 </p>
            </div>
            <div class="calWorking_F" style="background:#a4d4dd;">
                <p style="padding:5px 0; font-weight:bold;">Tax Payable</p>
                <p id="i2_F" style="padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                    7,000,000 </p>
            </div>
            <!-- <div class="calWorking_F">
                <p> Add back unrealized gains for elections made </p>
                <p id="b2"> 7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p>Add back not wholly expenses for business </p>
                <p id="b3"> 7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p>Exempt capital gains or foreign income</p>
                <p id="b4"> 7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p>Domestic dividends</p>
                <p id="b5"> 7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p>Add back surplus interest expense</p>
                <p id="b6"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Entertainment Expenditure</p>
                <p id="b7"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Not wholly or fully Business expense</p>
                <p id="b8"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Transfer pricing adjustment</p>
                <p id="b9"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p style="padding-top:10px; font-weight:bold;">Adjusted Profit</p>
                <p id="c1" style="padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double;">
                    7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Unincorporated Partnership</p>
                <p id="d1"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Less Carry forward tax loss</p>
                <p id="e1"> 7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p style="padding-top:10px; font-weight:bold;">Taxable Income</p>
                <p id="f1" style="padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double; ">
                    7,000,000 </p>
            </div>

            <div class="calWorking_F">
                <p>First 375000 Exempt </p>
                <p id="g1"> 7,000,000 </p>
            </div>
            <div class="calWorking_F">
                <p>Tax credit Foreign Income</p>
                <p id="h1"> 7,000,000 </p>
            </div>
            <div class="calWorking_F" style="background:#a4d4dd;">
                <p style="padding:5px 0; font-weight:bold;">Tax Liability</p>
                <p id="i2" style="padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                    7,000,000 </p>
            </div> -->





            <h4 style='color:gray; padding: 30px 0 10px 0;'> Other Matters </h4>
            <h5 style='color:gray; padding: 00px 0 10px 0;'> You may elect below (where
                relevant to you): </h5>
            <ol class='textOM_F'>
                <li>Benefit from small business relief if your annual turnover is below AED
                    3,000,000 in current
                    year
                    and previous years </li>
                <li>Exempt Foreign permanat establishmnet Income </li>
                <li>Account for gain and losses on realisation basis </li>
                <li>Be subject to Corporate tax if you are a Qualifying Free Zone person </li>
                <li>Apply relief in relation to transfer of qualifying assets </li>
                <li> Apply busines restructuring relief </li>
                <li>Apply transitionla relief </li>
            </ol>
            <br>

            <h5 style='color:gray; padding: 00px 0 10px 0;'> You may make below applications to
                FTA </h5>
            <ol class='textOM_F'>
                <li>To be exempt from Corporate Tax, if the Person is a public pension fund or a
                    public social
                    security
                    fund, a private pension fund or a private social security fund that meet the
                    relevant
                    conditions, or
                    a Qualifying Investment Fund </li>
                <li>To be exempt from Corporate Tax, if they are a juridical person that is
                    wholly owned and
                    controlled
                    by certain types of Exempt Persons387 and meet the relevant condition (e.g.
                    used exclusively
                    for
                    holding assets or investing funds for the benefit of the Exempt Person)
                </li>
                <li>To continue to be exempt from Corporate Tax if the Person temporarily fails
                    to meet the
                    conditions
                    of exemption; </li>
                <li>To treat a Government Entity’s taxable Businesses as a single Taxable
                    Person; </li>
                <li>To treat an Unincorporated Partnership as a single Taxable Person </li>
                <li>To treat a Family Foundation as an Unincorporated Partnership </li>
                <li>To request a clarification from the FTA </li>
                <li>To request a refund from the FTA </li>
                <li>To adjust Taxable Income following an adjustment by a foreign tax authority
                </li>
                <li>To move from the Cash Basis of Accounting to Accrual Basis of Accounting
                </li>
                <li>To form, join or leave a Tax Group, replace a Parent Company in a Tax Group,
                    or cease to be
                    a Tax
                    Group </li>
                <li>To deregister for Corporate Tax </li>
                <li>To change their Tax Period </li>
            </ol>
            <br>
            <h5 style='color:rgb(203, 98, 98); padding: 0px 0 15px 0;'>
                <!-- REPORT ERROR in tax calculations -->
                Click <a href="mailto:tax@ask-management-consultants.com">Communicate Error</a> found in Tax
                Calculations.
            </h5>

            <h5 style='color:rgb(203, 98, 98); padding: 00px 0 10px 0;'>
                Choose <a href="mailto:info@ask-management-consultants.com">Contact US</a> to address your Specific
                needs.
                <!-- Contact us for your specific requirements. -->
            </h5>

            <style>
                .textOM_F {
                    list-style-type: decimal;
                }

                .textOM_F li {
                    font-size: 10px;
                    margin-bottom: 5px;
                    margin-left: 15px;
                    padding-left: 10px;
                    color: gray;
                }
            </style>
        </div>

    </div>
</div>

<div id="myPopupDiv">

    <div class="mainDiv">
        <div class="mainDivBG">
            <div style="position:absolute; top:5px; right:5px; background:rgb(208, 213, 214); border-radius:50%; min-width:25px; min-height:25px; margin:auto; cursor:pointer; padding:5px; box-shadow: 3px 3px 4px #efe1e1;; font-size:12px;"
                onclick="closediv()">
                ❌
            </div>
            <div style="text-align:center">
                <img src="Resources/logo/ASK.png" alt="" style="width:200px;">
            </div>
            <br>
            <h4 id="greeting" style="color:gray; padding:10px 0 5px 0"> Dear Abdul Shakoor,
            </h4>
            <h6 style="color:gray; font-weight:100; text-align: justify; text-justify: inter-word;">
                Thanks for using ASK management tax calculator. Please be reminded that the
                calculator is for
                informational purposes only and may not cover all the circumstances relevant to
                you. You are
                therefore
                advised to obtain qualified opinion in respect of your tax liability. The use of
                calculator does
                not
                create any liability on ASK management consultants or its employees.
            </h6>


            <h3 style="padding: 10px 20px; text-align: center; color: rgb(107, 168, 182);"> Tax
                Computation
            </h3>

            <h5 id="taxYear" style="color:rgb(56, 162, 143); padding: 0px 0 0px 0; font-weight:100;">
                Your
                Tax year
                is: </h5>
            <h5 id="returnDate" style="color:rgb(56, 162, 143); padding: 0px 0 10px 0; font-weight:100;">
                Your
                first
                Tax return is due on: </h5>

            <div class="calWorking"
                style="padding: 3px 9px 3px 9px; font-weight: bold; background:rgb(164, 218, 221); margin-bottom:10px; border-bottom: 2px double;">
                <p>Description </p>
                <p> A m o u n t </p>
            </div>

            <div class="calWorking" style="font-weight: bold;">
                <p>Total Accounting Income </p>
                <p id="a1"> 7,000,000 </p>
            </div>

            <h4 style="padding-top:10px;"> Adjustments: </h4>
            <div class="calWorking">
                <p> Commercial FreeZone Property Income waiver </p>
                <p id="b1"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p> Add back unrealized gains for elections made </p>
                <p id="b2"> 7,000,000 </p>
            </div>

            <div class="calWorking">
                <p>Add back not wholly expenses for business </p>
                <p id="b3"> 7,000,000 </p>
            </div>

            <div class="calWorking">
                <p>Exempt capital gains or foreign income</p>
                <p id="b4"> 7,000,000 </p>
            </div>

            <div class="calWorking">
                <p>Domestic dividends</p>
                <p id="b5"> 7,000,000 </p>
            </div>

            <div class="calWorking">
                <p>Add back surplus interest expense</p>
                <p id="b6"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Entertainment Expenditure</p>
                <p id="b7"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Not wholly or fully Business expense</p>
                <p id="b8"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Transfer pricing adjustment</p>
                <p id="b9"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p style="padding-top:10px; font-weight:bold;">Adjusted Profit</p>
                <p id="c1" style="padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double;">
                    7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Unincorporated Partnership</p>
                <p id="d1"> 7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Less Carry forward tax loss</p>
                <p id="e1"> 7,000,000 </p>
            </div>

            <div class="calWorking">
                <p style="padding-top:10px; font-weight:bold;">Taxable Income</p>
                <p id="f1" style="padding: 5px 0 5px 10px; font-weight: bold; border-top: 1px double; ">
                    7,000,000 </p>
            </div>

            <div class="calWorking">
                <p>First 375000 Exempt </p>
                <p id="g1"> 7,000,000 </p>
            </div>
            <div class="calWorking" style="background:#a4d4dd;">
                <p style="padding:5px 0; font-weight:bold;">Tax Liability @9%</p>
                <p id="i1" style="padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                    7,000,000 </p>
            </div>
            <div class="calWorking">
                <p>Tax credit Foreign Income</p>
                <p id="h1"> 7,000,000 </p>
            </div>
            <div class="calWorking" style="background:#a4d4dd;">
                <p style="padding:5px 0; font-weight:bold;">Tax Liability</p>
                <p id="i2" style="padding: 3px 0 3px 10px; font-weight: bold; border-bottom: 2px double; ">
                    7,000,000 </p>
            </div>





            <h4 style='color:gray; padding: 30px 0 10px 0;'> Other Matters </h4>
            <h5 style='color:gray; padding: 00px 0 10px 0;'> You may elect below (where
                relevant to you): </h5>

            <ol class='textOM'>
                <li>Benefit from small business relief if your annual turnover is below AED
                    3,000,000 in current
                    year
                    and previous years </li>
                <li>Exempt Foreign permanat establishmnet Income </li>
                <li>Account for gain and losses on realisation basis </li>
                <li>Be subject to Corporate tax if you are a Qualifying Free Zone person </li>
                <li>Apply relief in relation to transfer of qualifying assets </li>
                <li> Apply busines restructuring relief </li>
                <li>Apply transitionla relief </li>
            </ol>
            <br>

            <h5 style='color:gray; padding: 00px 0 10px 0;'> You may make below applications to
                FTA </h5>
            <ol class='textOM'>
                <li>To be exempt from Corporate Tax, if the Person is a public pension fund or a
                    public social
                    security
                    fund, a private pension fund or a private social security fund that meet the
                    relevant
                    conditions, or
                    a Qualifying Investment Fund </li>
                <li>To be exempt from Corporate Tax, if they are a juridical person that is
                    wholly owned and
                    controlled
                    by certain types of Exempt Persons387 and meet the relevant condition (e.g.
                    used exclusively
                    for
                    holding assets or investing funds for the benefit of the Exempt Person)
                </li>
                <li>To continue to be exempt from Corporate Tax if the Person temporarily fails
                    to meet the
                    conditions
                    of exemption; </li>
                <li>To treat a Government Entity’s taxable Businesses as a single Taxable
                    Person; </li>
                <li>To treat an Unincorporated Partnership as a single Taxable Person </li>
                <li>To treat a Family Foundation as an Unincorporated Partnership </li>
                <li>To request a clarification from the FTA </li>
                <li>To request a refund from the FTA </li>
                <li>To adjust Taxable Income following an adjustment by a foreign tax authority
                </li>
                <li>To move from the Cash Basis of Accounting to Accrual Basis of Accounting
                </li>
                <li>To form, join or leave a Tax Group, replace a Parent Company in a Tax Group,
                    or cease to be
                    a Tax
                    Group </li>
                <li>To deregister for Corporate Tax </li>
                <li>To change their Tax Period </li>
            </ol>
            <br>
            <h5 style='color:rgb(203, 98, 98); padding: 0px 0 15px 0;'>
                <!-- REPORT ERROR in tax calculations -->
                Click <a href="mailto:tax@ask-management-consultants.com">Communicate Error</a> found in Tax
                Calculations.
            </h5>

            <h5 style='color:rgb(203, 98, 98); padding: 00px 0 10px 0;'>
                Choose <a href="mailto:info@ask-management-consultants.com">Contact US</a> to address your Specific
                needs.
                <!-- Contact us for your specific requirements. -->
            </h5>

            <style>
                .textOM {
                    list-style-type: decimal;
                }

                .textOM li {
                    font-size: 10px;
                    margin-bottom: 5px;
                    margin-left: 15px;
                    padding-left: 10px;
                    color: gray;
                }
            </style>
        </div>

    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    // Disable right-click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Disable Ctrl+U
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
        }
    });
    document.addEventListener("keydown", function(e) {
        if (e.key === "F12" || (e.ctrlKey && e.key === "Shift" && e.code === "KeyI")) {
            e.preventDefault();
            // alert("Developer tools are blocked on this page.");
        }
    });
</script>
<script>
    function getCalValues() {
        var divFour = document.getElementById("four");
        var divOne = document.getElementById("one");
        var divtwo = document.getElementById("two");

        function extractInputsData(container) {
            var inputs = container.querySelectorAll('input, select');
            var jsonData = {};

            for (var i = 0; i < inputs.length; i++) {
                var inputId = inputs[i].id;
                var inputValue = inputs[i].value;
                jsonData[inputId] = inputValue;
            }

            return jsonData;
        }

        var jsonDataFour = extractInputsData(divFour);
        var jsonDataOne = extractInputsData(divOne);
        var jsonDatatwo = extractInputsData(divtwo);

        // Call the fetchCalculation function with the jsonData objects
        fetchCalculation(jsonDataFour, jsonDataOne, jsonDatatwo);

        // Now you have jsonDataFour and jsonDataOne available for further use or logging
        console.log(jsonDataFour);
        console.log(jsonDataOne);
        console.log(jsonDatatwo);
    }
    FatchData = {}

    function fetchCalculation(DataFour, DataOne, Datatwo) {
        const jsonDataFour = DataFour;
        const jsonDataOne = DataOne;
        const jsonDatatwo = Datatwo;

        // Combine the data from both divs if needed
        const combinedData = {
            ...jsonDataFour,
            ...jsonDataOne,
            ...jsonDatatwo
        };

        // alert(JSON.stringify(combinedData));
        console.log(JSON.stringify(combinedData));

        $.ajax({
            url: 'calculate_sum.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(combinedData),
            success: function(result) {
                console.log('Result:', result);

                // Parse the JSON result
                const data = JSON.parse(result);

                //Call the toggleDiv function here, passing the 'data' object
                toggleDiv(data);

                // Send email to owner and visitor
                sendEmailToOwnerAndVisitor(data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    function toggleDiv(data) {
        // Now you can use the 'data' parameter as needed
        console.log(data);


        if (data.calType == 'FreeZone') {
            document.getElementById("greeting_F").innerHTML = `Dear  ${data.cName},`;
            var startDate = document.getElementById("startDate").value;
            var dateParts = startDate.split("-");
            var aYear = dateParts[0];
            document.getElementById("taxYear_F").innerHTML =
                `Your Tax year is: <span style="font-weight:bold"> ${aYear} </span>`;
            document.getElementById("returnDate_F").innerHTML =
                `Your first Tax return is due on: <span style="font-weight:bold"> 31-12-${aYear} </span>`;
            document.getElementById("a1_F").innerHTML = `${data.Qualifying_Income}`

            document.getElementById("i1_F").innerHTML = `${data.Taxable_Income_9}`

            document.getElementById("i2_F").innerHTML = `${data.Tax_Payable}`;
        } else {
            document.getElementById("greeting").innerHTML = `Dear  ${data.cName},`;
            var startDate = document.getElementById("startDate").value;
            var dateParts = startDate.split("-");
            var aYear = dateParts[0];
            document.getElementById("taxYear").innerHTML =
                `Your Tax year is: <span style="font-weight:bold"> ${aYear} </span>`;
            document.getElementById("returnDate").innerHTML =
                `Your first Tax return is due on: <span style="font-weight:bold"> 31-12-${aYear} </span>`;
            document.getElementById("a1").innerHTML = `${data.Accounting_Income}`
            var calProInc = document.getElementById("calProInc").value;
            document.getElementById("b1").innerHTML = `${calProInc}`

            document.getElementById("b2").innerHTML = `${data.Amount_of_unrealized_gains}`

            document.getElementById("b3").innerHTML = `${data.expenses_for_business}`

            document.getElementById("b4").innerHTML = `${data.Exempt_capital}`;

            document.getElementById("b5").innerHTML = `${data.Domestic_dividends}`;

            document.getElementById("b6").innerHTML = `${data.surplus_interest_expense}`;

            document.getElementById("b7").innerHTML = `${data.Entertainment_Expenditure}`;

            document.getElementById("b8").innerHTML = `${data.Not_wholy_or_fully_Business_expense}`;

            document.getElementById("b9").innerHTML = `${data.Transfer_pricing_adjustment}`;

            document.getElementById("c1").innerHTML = `${data.Adjusted_Profit}`;

            document.getElementById("d1").innerHTML = `${data.unincorporated_Partnership}`;

            document.getElementById("e1").innerHTML = `${data.calCarLoss}`;

            document.getElementById("f1").innerHTML = `${data.Taxable_Income}`;

            document.getElementById("g1").innerHTML = `${data.First_375000_Exempt}`;

            document.getElementById("i1").innerHTML = `${data.Tax_Payable_9}`;

            document.getElementById("h1").innerHTML = `${data.tax_credit_foreign_income}`;

            document.getElementById("i2").innerHTML = `${data.Tax_Liability}`;
        }
        if (data.calType == 'FreeZone') {
            var myDiv = document.getElementById("myPopupDiv_F");
        } else {
            var myDiv = document.getElementById("myPopupDiv");
        }
        // Show or hide the div based on its current state
        if (myDiv.style.display === "none" || myDiv.style.display === "") {
            myDiv.style.display = "block";
            setFatchData(FatchData); // Assuming this function is related to showing data, adjust as needed
        } else {
            myDiv.style.display = "none";
        }

    }

    function closediv_F() {
        var myDiv = document.getElementById("myPopupDiv_F");
        // Show or hide the div based on its current state
        if (myDiv.style.display === "none" || myDiv.style.display === "") {
            myDiv.style.display = "block";
            setFatchData(FatchData); // Assuming this function is related to showing data, adjust as needed
        } else {
            myDiv.style.display = "none";
        }
    }

    function closediv() {
        var myDiv = document.getElementById("myPopupDiv");
        // Show or hide the div based on its current state
        if (myDiv.style.display === "none" || myDiv.style.display === "") {
            myDiv.style.display = "block";
            setFatchData(FatchData); // Assuming this function is related to showing data, adjust as needed
        } else {
            myDiv.style.display = "none";
        }
    }

    function setFatchData(data) {
        for (var key in data) {
            var element = document.getElementById(key);
            if (element) {
                element.textContent = data[key].toLocaleString();
            }
        }
    }

    function sendEmailToOwnerAndVisitor(data) {
        console.log(JSON.stringify(data));
        $.ajax({
            url: 'send-mail.php', // Replace with the actual PHP script to handle email sending
            type: 'POST',
            data: {
                // ownerEmail: 'hilmandshah36@gmail.com', // Replace with the owner's email address
                visitorEmail: data.cEmail, // Use the email from the form data
                subject: 'Tax Computation Result',
                message: JSON.stringify(data)
            },
            success: function(result) {
                console.log('Email Result:', result);
            },
            error: function(xhr, status, error) {
                console.error('Email AJAX Error:', status, error);
            }
        });
    }
</script>

<script>
    DataPopulate = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '8,000,000',
        'calCos': '4,000,000',
        'calExp': '1,000,000',
        'calAccInc': '3,000,000',
        'calRelGain': '50,000',
        'calProInc': '0',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'Yes',
        'calIntExp': '-50,000',
        'calDepAmot': '300,000',
        'calEntExp': '50,000',
        'calBusExp': '300,000',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'selIndi',
    }


    DataPopulate3 = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '8,000,000',
        'calCos': '4,000,000',
        'calExp': '1,000,000',
        'calAccInc': '3,000,000',
        'calRelGain': '50,000',
        'calProInc': '0',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'Yes',
        'calIntExp': '-50,000',
        'calDepAmot': '300,000',
        'calEntExp': '50,000',
        'calBusExp': '300,000',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'selIndi',
    }

    DataPopulate4 = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '80,000,000',
        'calCos': '40,000,000',
        'calExp': '1,000,000',
        'calAccInc': '39,000,000',
        'calRelGain': '0',
        'calProInc': '0',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'Yes',
        'calIntExp': '2,500,000',
        'calDepAmot': '300,000',
        'calEntExp': '50,000',
        'calBusExp': '0',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'selIndi',
    }

    DataPopulate5 = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '80,000,000',
        'calCos': '40,000,000',
        'calExp': '1,000,000',
        'calAccInc': '39,000,000',
        'calRelGain': '0',
        'calProInc': '1,000,000',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'Yes',
        'calIntExp': '25,000,000',
        'calDepAmot': '300,000',
        'calEntExp': '50,000',
        'calBusExp': '0',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '500,000',
        'calType': 'selIndi',
    }

    DataPopulate6 = {
        'stdTax': '7,000,000',
        'stdTaxNCP': '200,000',
        'salOthFZ': '5,000,000',
        'nonFZper': '3,000,000',
        'deminins': '2,000,000',
        'incFrom': '0',
        'calIncome': '0',
        'calCos': '0',
        'calExp': '0',
        'calAccInc': '5,000,000',
        'calRelGain': '0',
        'calProInc': '200,000',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'No',
        'calIntExp': '0',
        'calDepAmot': '0',
        'calEntExp': '0',
        'calBusExp': '0',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'Resident',
    }

    DataPopulate7 = {
        'stdTax': '7,000,000',
        'stdTaxNCP': '0',
        'salOthFZ': '5,000,000',
        'nonFZper': '3,000,000',
        'deminins': '2,000,000',
        'incFrom': '0',
        'calIncome': '0',
        'calCos': '0',
        'calExp': '0',
        'calAccInc': '5,000,000',
        'calRelGain': '0',
        'calProInc': '200,000',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'No',
        'calIntExp': '0',
        'calDepAmot': '0',
        'calEntExp': '0',
        'calBusExp': '0',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'Resident',
    }

    DataPopulate8 = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '6,000,000',
        'calCos': '3,000,000',
        'calExp': '500,000',
        'calAccInc': '2,500,000',
        'calRelGain': '0',
        'calProInc': '0',
        'calRelBus': '0',
        'calCapGain': '0',
        'calDomDiv': '0',
        'calForDiv': '0',
        'calReaBaseS': 'No',
        'calIntExp': '100,000',
        'calDepAmot': '120,000',
        'calEntExp': '100,000',
        'calBusExp': '0',
        'calTraPri': '0',
        'calUnInoPart': '0',
        'calCarLoss': '0',
        'calType': 'Resident',
    }

    DataPopulate9 = {
        'stdTax': '75,000,000',
        'stdTaxNCP': '1,000,000',
        'salOthFZ': '44,500,000',
        'nonFZper': '32,500,000',
        'deminins': '150,500,000',
        'incFrom': '0',
        'calIncome': '12,000,000',
        'calCos': '4,000,000',
        'calExp': '1,500,000',
        'calAccInc': '6,500,000',
        'calRelGain': '-1,200,000',
        'calProInc': '2,000,000',
        'calRelBus': '0',
        'calCapGain': '1,300,000',
        'calDomDiv': '1,000,000',
        'calForDiv': '800,000',
        'calReaBaseS': 'No',
        'calIntExp': '1,500,000',
        'calDepAmot': '350,000',
        'calEntExp': '500,000',
        'calBusExp': '110,000',
        'calTraPri': '600,000',
        'calUnInoPart': '0',
        'calCarLoss': '5,145,000',
        'calType': 'Resident',
    }
</script>
