<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Receipt example</title>
    <style>
        * {
            margin: none;
            font-size: 12px;
            font-family: 'Times New Roman';
            -webkit-print-color-adjust: exact !important;
            /* Chrome, Safari, Edge */
            color-adjust: exact !important;
            /*Firefox*/
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary hidden-print" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header hidden-print">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ticket">
                        <p class="centered fw-bold">Job Card</p>
                        <img src="./logo.png" alt="Logo">
                        <p class="centered fw-bold">Company Name
                            <br>Company Salogan
                        </p>
                        <p class="fw-bold">Job #99999</p>
                        <p>Booking Date: 29-12-2022</p>
                        <p>Delivery Date: 29-12-2022</p>
                        <p>Job Title:_____________
                            _____________
                        </p>
                        <p>Client Name:_____________
                        </p>
                        <p>Client Mobile # 03008639171
                        </p>
                        <p>Warrenty: Omega Power</p>
                        <p>Complaints:
                            <br> 1.___________
                            <br> 2.___________
                            <br> 3.___________
                        </p>
                        <p>Accessories:
                            <br> 1.___________
                            <br> 2.___________
                            <br> 3.___________
                        </p>
                        <p class="centered fw-bold"> Estimated Cost: 120,000</p>
                        <p class="centered bold"> Rupees One Lac Twenty Thousand Only</p>
                        <p class="centered bold"> We Deal in (Multilines)</p>

                        <p class="centered bold"> Contact # 1 03130456524</p>
                        <p class="centered bold"> Contact # 1 03130456524</p>
                        <p class="centered">
                            Company Address
                        </p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary hidden-print" data-bs-dismiss="modal">Close</button>
                    <button id="btnPrint" class="hidden-print">Print</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="script.js"></script> --}}
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>

</html>
