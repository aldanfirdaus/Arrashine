@extends('index2')

@section('content')

    <div class="container py-5 mt-5">

        <div class="row justify-content-center">

            <div class="col-lg-8">


                <div class="card shadow border-0">

                    <div class="card-body p-4" style="font-family: Lato, sans-serif;
                            font-weight: 300;
                            font-style: normal;">
                        <div class="text-center text-dark py-3 mb-3">
                            <h2 class="mb-0 mb-2" style="font-family: 'Bellefair', serif; !important">CONTACT US</h2>
                            <small>Please contact us at +62 897 925 678 or by using the form below. <br> We will get back to
                                you as soon as we can..</small>
                        </div>

                        <form action="/contact" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" style="font-family: 'Bellefair', serif; !important">
                                    Name
                                </label>

                                <input type="text" name="name" class="form-control" placeholder="Type Full Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="font-family: 'Bellefair', serif; !important">
                                    Email
                                </label>

                                <input type="email" name="email" class="form-control" placeholder="Type Email Address">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" style="font-family: 'Bellefair', serif; !important">
                                    Subject
                                </label>

                                <input type="text" name="subject" class="form-control" placeholder="Type Subject">
                            </div>

                            <div class="mb-4">
                                <!-- <label class="form-label fw-semibold">
                                                Pesan
                                            </label> -->

                                <textarea name="message" rows="6" class="form-control mt-4"
                                    placeholder="Type Message Here"></textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn border border-black px-4 send">
                                    Send Message
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>
        .send {
            background-color: transparent;
            color: #000;
            transition: all 0.3s ease;
        }

        .send:hover {
            background-color: #212529;
            /* warna gelap */
            color: #fff;
            /* tulisan putih */
            border-color: #1A1C26;
        }
    </style>
@endsection